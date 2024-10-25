<?php
// Project 2
namespace App\Http\Controllers\Project2;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product2;
use App\Models\ProductRating;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    public function index(Request $request, $categorySlug=null, $subCategorySlug=null){
        
       $categorySelected    =   ''; 
       $subCategorySelected =   ''; 

        $brandsArray =   [];
       
     

    $categories             =   Category::orderBy('name','ASC')->with('sub_category')->where('status',1)->get();
    $brands                 =   Brand::orderBy('name','ASC')->get();
    
    $products   =   Product2::where('status',1);

    // Apply filter

    if(! empty($categorySlug) ){
        $category =Category::where('slug',$categorySlug)->first();
        $products=$products->where('category_id',$category->id);
        $categorySelected  = $category->id;
    }

    if(! empty($subCategorySlug) ){
        $subCategory = SubCategory::where('slug',$subCategorySlug)->first();
        $products = $products->where('sub_category_id',$subCategory->id);
        $subCategorySelected   = $subCategory->id;
    }

    if(! empty($request->get('brand')) ){
        $brandsArray = explode(',' ,  $request->get('brand') );
        $products    = $products->whereIn('brand_id', $brandsArray);
    }
    if($request->get('price_max') != '' && $request->get('price_min') != ''){

        if( $request->get('price_max') == 1000 ){
            $products = $products->whereBetween('price',[intval( ($request->get('price_min') )),1000000]); 
        }else{
            $products = $products->whereBetween('price',[intval( ($request->get('price_min') )),intval( ($request->get('price_max') ))]); 
        }
               
    }
    if (!empty($request->get('search'))) {
     $products =   $products->where('title','like','%'.$request->get('search').'%');
    }
   
    // Sort function filter
    if($request->get('sort') != ''){
            if($request->get('sort')=='latest'){
            $products   =   $products->orderBy('id','DESC');  
            }elseif($request->get('sort')=='price_asc'){
                $products   =   $products->orderBy('price','ASC');  
            }else{
                $products   =   $products->orderBy('price','DESC');  
            }
        }else{
            $products   =   $products->orderBy('price','DESC');  
        }

    $products   =   $products->paginate(6);

    $data['categories']     =   $categories;
    $data['brands']         =   $brands;
    $data['products']       =   $products;
    $data['categorySelected']=  $categorySelected;
    $data['subCategorySelected']=   $subCategorySelected;
    $data['brandsArray']    =   $brandsArray;
    $data['priceMax']       =   ( intval( ($request->get('price_max') )==0) ? 1000: $request->get('price_max') );
    $data['priceMin']       =   intval( ($request->get('price_min') ));
    $data['sort']           =   $request->get('sort') ;

        return view('project2_front.shop',$data);
    }
    

    public function product($slug)
    {
        $product   = Product2::where('slug',$slug)
                            ->withCount('product_ratings')
                            ->withSum('product_ratings','rating')
                            ->with(['products_images','product_ratings'])->first();
                            
    //   dd($product);
      //"product_ratings_count"
     //"product_ratings_sum_rating"
            $avgRating = '0.00';
            $avgRatingPercentage = 0;
            if ($product->product_ratings_count > 0) {
                $avgRating = number_format(($product->product_ratings_sum_rating/$product->product_ratings_count),2);
                $avgRatingPercentage = ($avgRating*100)/5;
            }
           
        
        if($product==null){
            abort(404);
        }
        //Fetch Related Product
       $relatedProducts= [];

       if($product->related_products != ''){
           $productArray = explode(',', $product->related_products);
           $relatedProducts = Product2::whereIn('id',$productArray)->where('status',1)->get();
       }
        $data['product']    = $product;
        $data['relatedProducts']    = $relatedProducts;
        $data['avgRating']    = $avgRating;
        $data['avgRatingPercentage']    = $avgRatingPercentage;
        return view('project2_front.product',$data);
    }

    public function saveRating($id,Request $request) {
        $validator      = Validator::make($request->all(),[
            'name'      => 'required|min:3',
            'email'     => 'required|email',
            'rating'    => 'required',
            'comment'   => 'required|min:10',
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors'  => $validator->errors(),   
            ]);
        }
        $count = ProductRating::where('email', $request->email)
                                ->where('product_id', $id)
                                ->count();


        if ($count > 0) {
            session()->flash('error','You have already given your rating of this product.');
            return response()->json([
                'status'=>true,
            ]);
        }
        $productRating = new ProductRating();

        $productRating->product_id  =  $id;
        $productRating->username    =  $request->name;
        $productRating->email       =  $request->email;
        $productRating->comment     =  $request->comment;
        $productRating->rating      =  $request->rating;
        $productRating->status      =  0;
        $productRating->save();

        $message = 'Thank you for the rationgs. We will review your opinions';
        session()->flash('success',$message);

        return response()->json([
            'status' => true,
            'message'=> $message,
        ]);
   }
}
