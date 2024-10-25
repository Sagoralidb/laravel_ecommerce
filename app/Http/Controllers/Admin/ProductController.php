<?php
//Project 2
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product2;
use App\Models\product2_images;
use App\Models\ProductRating;
use App\Models\Size;
use App\Models\SubCategory;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
// ProductController.php
public function index(Request $request)
{
    // Fetch products with order count and order IDs
    $products2 = Product2::latest('id')->select('products2.*')
                    ->withCount(['orderItems as order_count' => function($query) {
                        $query->selectRaw('count(*) as order_count')
                              ->groupBy('product_id'); // Change to group by product_id
                    }])
                    ->with('products_images');

    // Filtering by keyword
    if ($request->has('keyword') && $request->filled('keyword')) {
        $products2->where('title', 'like', '%' . $request->keyword . '%');
    }

    // Pagination
    $products2 = $products2->paginate(10);

    $data['products2'] = $products2;

    return view('admin.products2.list', $data);
}


    public function create(){
        
        $tempImages = TempImage::all(); // Fetch all temporary images

        $data           =   [];
        $categories     =   Category::orderBy('name','ASC')->get();
        $brands         =   Brand::orderBy('name','ASC')->get();
        $data['categories'] =   $categories;
        $data['brands']     =   $brands;
        $data['tempImages'] = $tempImages; // Pass temporary images to view

        
        return view('admin.products2.create',$data);
    }
    public function store(Request $request) {

        // Validation logic
        $rules = [
          'title'   => 'required',
          'slug'    => 'required|unique:products2',
          'price'   => 'required|numeric',
          'sku'     => 'required|unique:products2',
          'track_qty'   => 'required|in:Yes,No',
          'category'    => 'required|numeric',
          'is_featured' => 'required|in:Yes,No',
          'size'        => 'required|string',
        ];
    
        if (!empty($request->track_qty) && $request->track_qty == 'Yes') {
          $rules['qty'] = 'required|numeric';
        }
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->passes()) {
            
            $sizes = json_decode($request->input('size'), true);

            if (!is_array($sizes)) {
                return response()->json([
                    'status' => false,
                    'errors' => ['size' => 'Invalid size format.']
                ]);
            }
    
    
          $product2 = new Product2;
          $product2->title          = $request->title;
          $product2->slug           = $request->slug;
          $product2->description    = $request->description;
          $product2->short_description  = $request->short_description;
          $product2->shipping_returns   = $request->shipping_returns;
          $product2->price              = $request->price;
          $product2->compare_price      = $request->compare_price;
          $product2->sku                = $request->sku;
          $product2->barcode            = $request->barcode;
          $product2->track_qty          = $request->track_qty;
          $product2->qty                = $request->qty;
          $product2->status             = $request->status;
          $product2->category_id        = $request->category;
          $product2->sub_category_id    = $request->sub_category;
          $product2->brand_id           = $request->brand;
          $product2->is_featured        = $request->is_featured;
          $product2->related_products   = (!empty($request->related_products)) ? implode(',', $request->related_products) : '';
          $product2->size               = json_encode($sizes);
          $product2->save();
          
          if (!empty($request->image_array)) {
            foreach ($request->image_array as $temp_image_id) {
                $tempImageInfo = TempImage::find($temp_image_id);
                $ext = pathinfo($tempImageInfo->name, PATHINFO_EXTENSION);
        
                // Generate filename and path before saving record
                $imageName = $product2->id . '-' . time() . '.' . $ext;
        
                $product2Image = new product2_images([
                    'product_id' => $product2->id, // Ensure product_id is set
                    'image' => $imageName,
                ]);
        
                // Consider using a database transaction here
                DB::transaction(function () use ($product2Image, $tempImageInfo, $imageName) {
                    $product2Image->save();
                    $this->processProductImage($tempImageInfo, $imageName);
                });
            }
          }
    
          $request->session()->flash('success', 'Product added successfully');
          return response()->json([
            'status' => true,
            'message' => 'Product Added Successfully'
          ]);
        } else {
          return response()->json([
            'status' => false,
            'errors' => $validator->errors()
          ]);
        }
    }
    
      // Separate function for image processing
      public function processProductImage($tempImageInfo, $imageName) 
      {
          $sourcePath = public_path('/temp/' . $tempImageInfo->name);
          $destPathLarge = public_path('uploads/product/large/' . $imageName);
          $destPathSmall = public_path('uploads/product/small/' . $imageName);
      
          if (!File::exists($sourcePath)) {
              throw new \Exception("Source file does not exist: $sourcePath");
          }
      
          $ext = strtolower(pathinfo($sourcePath, PATHINFO_EXTENSION));
          
          // Create image resource based on file type
          switch ($ext) {
              case 'jpeg':
              case 'jpg':
                  $image = imagecreatefromjpeg($sourcePath);
                  break;
              case 'png':
                  $image = imagecreatefrompng($sourcePath);
                  break;
              case 'gif':
                  $image = imagecreatefromgif($sourcePath);
                  break;
              case 'webp':
                  $image = imagecreatefromwebp($sourcePath);
                  break;
              default:
                  throw new \Exception("Unsupported image format: $ext");
          }
      
          if ($image === false) {
              throw new \Exception("Failed to create image from source: $sourcePath");
          }
      
          list($width, $height) = getimagesize($sourcePath);
          $newWidth = 1400;
          $newHeight = intval($height * ($newWidth / $width));
          $largeImage = imagecreatetruecolor($newWidth, $newHeight);
          
          if ($largeImage === false) {
              throw new \Exception("Failed to create large image canvas");
          }
      
          imagecopyresampled($largeImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
          
          // Save large image based on file type
          switch ($ext) {
              case 'jpeg':
              case 'jpg':
                  if (!imagejpeg($largeImage, $destPathLarge, 100)) {
                      throw new \Exception("Failed to save large image to $destPathLarge");
                  }
                  break;
              case 'png':
                  if (!imagepng($largeImage, $destPathLarge)) {
                      throw new \Exception("Failed to save large image to $destPathLarge");
                  }
                  break;
          }
      
          imagedestroy($largeImage);
      
          // Create Small Image
          $smallImage = imagecreatetruecolor(300, 300);
          if ($smallImage === false) {
              throw new \Exception("Failed to create small image canvas");
          }
      
          imagecopyresampled($smallImage, $image, 0, 0, 0, 0, 300, 300, $width, $height);
          
          // Save small image based on file type
          switch ($ext) {
              case 'jpeg':
              case 'jpg':
                  if (!imagejpeg($smallImage, $destPathSmall, 100)) {
                      throw new \Exception("Failed to save small image to $destPathSmall");
                  }
                  break;
              case 'png':
                  if (!imagepng($smallImage, $destPathSmall)) {
                      throw new \Exception("Failed to save small image to $destPathSmall");
                  }
                  break; 
          }
      
          imagedestroy($smallImage);
          imagedestroy($image);
      
          // Delete the temp image after processing
          File::delete($sourcePath);
      }
      

      

    public function edit($id, Request $request){
        $product       = Product2::find($id); // Product2 মডেল থেকে আই ডি খুজে রেব কররাম
        
        if(empty($product)){
            return redirect()->route('products.index')->with('error','Product Not Found');
        }
        // Fetch  Products Images

        $product2Image  =   product2_images::where('product_id',$product->id)->get(); 
       
        $subCategories=SubCategory::where('category_id',$product->category_id)->get();
       //Fetch Related Product
       $relatedProducts= [];
        if($product->related_products != ''){
            $productArray = explode(',', $product->related_products);
            $relatedProducts = Product2::whereIn('id',$productArray)->with('products_images')->get();
        }

        $data            =   []; 
        $categories      =   Category::orderBy('name','ASC')->get();
        $brands          =   Brand::orderBy('name','ASC')->get();

        $data['product']            =   $product;
        $data['subCategories']      =   $subCategories;
        $data['categories']         =   $categories;
        $data['product2Image']      =   $product2Image;
        $data['brands']             =   $brands;
        $data['relatedProducts']    =   $relatedProducts;
        return view('admin.products2.edit',$data);
        

    }


    public function update($id, Request $request){
        
        $product2          = Product2::find($id); 

        $rules = [
            'title'      =>  'required', 
            'slug'       =>  'required|unique:products2,slug,'.$product2->id.',id',      
            'price'      =>  'required|numeric', 
            'sku'        =>  'required|unique:products2,sku,'.$product2->id.',id', 
            'track_qty'  =>  'required|in:Yes,No', 
            'category'   =>  'required|numeric', 
            'is_featured'=>  'required|in:Yes,No', 
            'size'       => 'required|string',
        ];

        if(!empty($request->track_qty) && $request->track_qty =='Yes' ) {
            $rules['qty'] ='required|numeric';
        }

        $validator = Validator::make($request->all(),$rules);
        
        if($validator->passes()){   

            $sizes = json_decode($request->input('size'), true);

            if (!is_array($sizes)) {
                return response()->json([
                    'status' => false,
                    'errors' => ['size' => 'Invalid size format.']
                ]);
            }

            $product2->title            = $request->title;  
            $product2->slug             = $request->slug;  
            $product2->description      = $request->description;  
            $product2->short_description= $request->short_description;         
            $product2->shipping_returns = $request->shipping_returns;   
            $product2->price            = $request->price;  
            $product2->compare_price    = $request->compare_price;  
            $product2->sku              = $request->sku;  
            $product2->barcode          = $request->barcode;  
            $product2->track_qty        = $request->track_qty;  
            $product2->qty              = $request->qty;  
            $product2->status           = $request->status;  
            $product2->category_id      = $request->category;  
            $product2->sub_category_id  = $request->sub_category;  
            $product2->brand_id         = $request->brand;  
            $product2->is_featured      = $request->is_featured;         
            $product2->related_products = (! empty($request->related_products)) ? implode(',', $request->related_products) : '';              
            $product2->size             = json_encode($sizes);
            $product2->save();

        if(!empty($request->immage_array)){
            foreach($request->immage_array as $temp_image_id){
                $tempImageInfo=TempImage::find($temp_image_id);
                $ext = pathinfo($tempImageInfo->name,PATHINFO_EXTENSION);

                $imageName = $product2->id.'_'.time().'.'.$ext;
                $product2Image = new product2_images([
                    'product_id' => $product2->id,
                    'image' =>$imageName,
                ]);
                DB::transaction(function() use ($product2Image, $tempImageInfo, $imageName) {
                    $product2Image->save();
                    $this->processProductImage($tempImageInfo,$imageName);
                });
            }
        }
  

            $request->session()->flash('success','Product Updated successfully');
            return response()->json([
                'status'    => true,
                'message'   =>'Product Updated Successfully'
            ]);
        }else{
            return response()->json([
                'status'    => false,
                'errors'    => $validator->errors()
            ]);
        }
    }

   


 public function destroy($id, Request $request){

    $product2= Product2::find($id); // Product2 ইন্সট্যান্স মডেল থেকে আই ডি খুজে রেব কররাম
   
    if(empty($product2)){
        
        $request->session()->flash('error','Product Not Found');
        return response()->json([
            'status'    =>false,
            'notFound'  =>true,
        ]);
    }
    
       $product2Images = product2_images::where('product_id',$id)->get();

    if(!empty($product2Images)) {
        foreach($product2Images as $product2Image){
         File::delete(public_path('uploads/product/large/'.$product2Image->image) );
         File::delete(public_path('uploads/product/small/'.$product2Image->image) );
        }
        product2_images::where('product_id',$id)->delete();
       }
        $product2->delete();

        $request->session()->flash('success','Product deleted successfully');

            return response()->json([
                'status'    =>true,
                'message'   =>'Product Deleted Successfully'
            ]);
        
 }
    public function getProducts(Request $request){

       $tempProduct =[];
        if($request->term != ""){
            $products = Product2::where('title','like','%'.$request->term.'%')->get();

            if($products != null){
                
                foreach ($products as $product) {
                  $tempProduct[] =array('id' => $product->id,'text' => $product->title );
                }
            }
        }

       return response()->json([
            'tags'  => $tempProduct,
            'status'  => true,
       ]);
    }
    public function productRatings(Request $request) {
        $ratings = ProductRating::select('products2_ratings.*','products2.title as productTitle')->orderBy('products2_ratings.created_at','DESC') ;
        $ratings =$ratings->leftJoin('products2','products2.id','products2_ratings.product_id');
        

        if($request->get('keyword') !=""){
            $ratings= $ratings->orWhere('products2.title','like','%'.$request->keyword.'%');
            $ratings= $ratings->orWhere('products2_ratings.username','like','%'.$request->keyword.'%');
            $ratings= $ratings->orWhere('products2_ratings.comment','like','%'.$request->keyword.'%');
            $ratings= $ratings->orWhere('products2_ratings.rating','like','%'.$request->keyword.'%');
           }

        $ratings = $ratings->paginate(10);

        return view('admin.products2.ratings',[
            'ratings' => $ratings,
        ]);
    }

    public function changeRatingStatus(Request $request) {

        $productRating = ProductRating::find($request->id);

        $productRating->status = $request->status;
        $productRating->save();

        session()->flash('success','Status updated successfully. ');
        return response()->json([
            'status' => true,
        ]);
    }

    public function rating_destroy($id, Request $request) {
        $productRating  = ProductRating::find($id);

        if (empty($productRating)) {
            $request->session()->flash('error','Record not found.');
            return response()->json([
                'status' => false,
            ]);
        }
        $productRating->delete();
        $message = "Ratings data deleted successfully";
        $request->session()->flash('success',$message);
        return response([
            'status'    => true,
            'message'   => $message,
        ]);
    }
}
