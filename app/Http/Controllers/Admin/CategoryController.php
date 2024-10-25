<?php
//Project 2
namespace App\Http\Controllers\Admin;
require './vendor/autoload.php';
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\TempImage;
use App\Models\Thumbnail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\File;



class CategoryController extends Controller
{
    
    public function index(Request $request)
    {
        $categories =   Category::latest();

        if(! empty($request->get('keyword')) ){
            $categories = $categories->where('name','like','%'. $request->get('keyword') .'%');
        }
    $categories = $categories->paginate(10);
       return view('admin.category.list', compact('categories') );  
    }

    public function create()
    {
      return view('admin.category.create');
    }
    

 public function store(Request $request) {
            
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'slug' => 'required|unique:categories',                  
            ]);
        
            if ($validator->passes()) {
                $category = new Category();
                $category->name = $request->name;
                $category->slug = $request->slug;
                $category->status = $request->status;
                $category->showHome = $request->showHome;
                    
                       // Save image here
                if (!empty($request->image_id)) {
                    $tempImage = TempImage::find($request->image_id);
                    $extArray = explode('.', $tempImage->name);
                    $ext = end($extArray);
            
                    // file name and path
                    // $newImageName = $category->id .'-'.'.time().'. '_thumbnail.' . $ext;
                    // Generate a unique filename for the thumbnail image
                    $newImageName = $category->id . '-' . uniqid() . '_thumbnail.' . $ext;

                    $sPath = public_path().'/temp/'.$tempImage->name;               //source path
                    $dPath = public_path().'/uploads/category/'.$newImageName;   // dastination path
                    File::copy($sPath,$dPath);

            $dPath = public_path() . '/uploads/category/thumb/' . $newImageName; // Thumb destination path
            $sPath = public_path().'/temp/'.$tempImage->name; // source path
            list($sWidth, $sHeight) = getimagesize($sPath);
            // Load the source image
            $sImg = imagecreatefromjpeg($sPath);
            // Calculate aspect ratio
            $ratio = $sWidth / $sHeight;
            // Define thumbnail dimensions
            $tWidth = 450;
            $tHeight = 600;
            // Calculate new dimensions based on aspect ratio
            if ($sWidth > $sHeight) {
                $tHeight = $tWidth / $ratio;
            } else {
                $tWidth = $tHeight * $ratio;
            }
            // Create a blank image for the thumbnail
            $tImg = imagecreatetruecolor($tWidth, $tHeight);
            // Resize and crop the source image to fit the thumbnail dimensions
            imagecopyresampled($tImg, $sImg, 0, 0, 0, 0, $tWidth, $tHeight, $sWidth, $sHeight);
            // Save the thumbnail image
            imagejpeg($tImg, $dPath);
            // Free up memory
            imagedestroy($sImg);
            imagedestroy($tImg);



                    // updae image
                    $category->image = $newImageName;
                    $category->save();
        
                $request->session()->flash('success','Category added successfully');
               
                return response()->json([
                    'status'    => true,
                    'message'     =>'Category Added Successfully'
                ]);
                
                    }
                    
            } else{
                    return response()->json([
                        'status'    => false,
                        'errors'     => $validator->errors()
                    ]);
                    }

            }

    public function edit($categoryId, Request $request)
        {
            $category = Category::find($categoryId);

            if (empty($category)) {
                $request->session()->flash('error','Category not found.');
                return response([
                    'status'        => false,
                    'notFound'      =>true,
                ]);
                return redirect()->route('categories.index');
            }

            return view('admin.category.edit', compact('category'));
        }


    public function update($categoryId, Request $request){
        $category = Category::find($categoryId);
        
        if (empty($category)) {
           return response()->json([
            'status'    => false,
            'notFound'  =>true,
            'message'   =>'Category Not Found'
           ]);
        }
            $validator = Validator::make($request->all(), [
                'name' => 'required',                
                'slug' => 'required|unique:categories,slug,'.$category->id.',id',                  
            ]);
        
            if ($validator->passes()) {
               
                $category->name = $request->name;
                $category->slug = $request->slug;
                $category->status = $request->status;
                $category->showHome = $request->showHome;
                $category->save();

                $oldImage = $category->image;
                    
                       // Save image here
                if (!empty($request->image_id)) {
                    $tempImage = TempImage::find($request->image_id);
                    $extArray = explode('.', $tempImage->name);
                    $ext = end($extArray);
            
                    // file name and path
                    $newImageName = $category->id . '-' . time() . '_thumbnail.' . $ext;
                    $sPath = public_path().'/temp/'.$tempImage->name;               //source path
                    $dPath = public_path().'/uploads/category/thumb/'.$newImageName;   // dastination path
                    File::copy($sPath,$dPath);


           
                    // updae image
                    $category->image = $newImageName;
                    $category->save();

                }
                    File::delete(public_path().'/uploads/category/'.$oldImage);
        
                $request->session()->flash('success','Category Updated Successfully');
                
                return response()->json([
                    'status'    => true,
                    'message'     =>'Category updated Successfully'
                ]);
            
                    
                    
            } else{
                    return response()->json([
                        'status'    => false,
                        'errors'     => $validator->errors()
                    ]);
                }

             }

            public function destroy($categoryId, Request $request)
            {
                $category = Category::find($categoryId);
            
                if (empty($category)) {
                    $request->session()->flash('error','Category Not Found');
                    return response()->json([
                        'status' => true, // Use 'status' instead of 'success'
                        'message' => 'Category Not Found'
                    ]);
                }
        
                  File::delete(public_path().'/uploads/category/'.$category->image);
                  
            
                $category->delete();
            
                $request->session()->flash('success', 'Category Deleted Successfully'); // Set flash message
            
                return response()->json([
                    'status' => true, // Use 'status' instead of 'success'
                    'message' => 'Category deleted Successfully'
                ]);
            }
        
            
        
 }