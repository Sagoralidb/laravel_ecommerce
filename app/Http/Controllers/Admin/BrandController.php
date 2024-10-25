<?php
//Project 2
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index(Request $request)
    {

        $brands   = Brand::latest('id');
        if($request->get('keyword')){
            $brands=$brands->where('name','like','%'.$request->keyword.'%');
            $brands=$brands->orwhere('slug','like','%'.$request->keyword.'%');

            // $subCategories = $subCategories->orwhere('categories.name','like','%'. $request->get('keyword') .'%');
        }

        $brands   = $brands->paginate(10);

        return view('admin.brands.list',compact('brands'));
      
    }


   public function create()
   {
    return view('admin.brands.create');
   }

   public function store(Request $request)
   {
      $validator    =  Validator::make($request->all(),[
        'name'  => 'required',
        'slug'  => 'required|unique:brands'
    ]);
    if($validator->passes()){
        $Brand          =  new Brand();
        $Brand->name    =  $request->name;
        $Brand->slug    =  $request->slug;
        $Brand->status  =  $request->status;
        $Brand->save();

        $request->session()->flash('success','Brand added successfully');
        return response()->json([
            'status'    => true,
            'message'   => 'Brand added successfully',
        ]);
    }else{
        return response()->json([
            'status'    => false,
            'errors'    => $validator->errors(),
        ]);
    }

   }

   public function edit($id, Request $request)
   {
    $brand=Brand::find($id);

    if(empty($brand) ){

        $request->session()->flash('error','No Brand Found');
        return redirect()->route('brands.index');
    }

    $data['brand'] =   $brand;
    return view('admin.brands.edit',$data);
   }

   public function update($id, Request $request)
   {
    $brand = Brand::find($id);

    if(empty($brand) ){

        $request->session()->flash('error','No Brand Found');
        return response()->json([
            'status'    => false,
            'notFoune'  => true,
        ]);
    }

    
    $validator    =  Validator::make($request->all(),[
        'name'  => 'required',
        'slug'  =>  'required|unique:brands,slug,'.$brand->id.',id'
    ]);
    if($validator->passes()){
        // $Brand          =  new Brand();
        $brand->name    =  $request->name;
        $brand->slug    =  $request->slug;
        $brand->status  =  $request->status;
        $brand->save();

        $request->session()->flash('success','Brand Updated successfully');
        return response()->json([
            'status'    => true,
            'message'   => 'Brand Updated successfully',
        ]);
    }else{
        return response()->json([
            'status'    => false,
            'errors'    => $validator->errors(),
        ]);
    }
   }

   public function destroy($id){
        $brand = Brand::find($id);

        if (!$brand) {
            return response()->json([
                'status' => false,
                'message' => 'Brand not found',
            ], 404);
        }

        $brand->delete();

        return response()->json([
            'status' => true,
            'message' => 'Brand deleted successfully',
        ]);
    }
}
