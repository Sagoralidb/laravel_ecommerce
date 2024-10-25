<?php
//Project 2
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\product2_images;
use App\Models\Product2Images; // মডেলের নাম ধরে সেটা করা হয়েছে
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductImageController extends Controller
{
    public function update(Request $request){
        // ইমেজ এর সংক্রান্ত তথ্য নিয়ে আসা
        $image = $request->image;
        $ext = strtolower($image->getClientOriginalExtension());
        $sourcePath = $image->getPathName();

        // পণ্যের ছবি সংরক্ষণ এর জন্য মডেল তৈরি
        $product2Image = new product2_images();
        // পণ্যের আইডি নির্ধারণ এবং সংরক্ষণ
        $product2Image->product_id = $request->product_id;
        $product2Image->image = null; // এটি যদি নতুন ছবি আপলোড না করে থাকে, তবে এটি কোনো কিছু সেট না করা
        $product2Image->save();

        // ছবির নাম তৈরি এবং সংরক্ষণ
        $imageName = $request->product_id . '-' . $product2Image->id . '-' . time() . '.' . $ext;
        $product2Image->image = $imageName;
        $product2Image->save();

        // ছবি সংরক্ষণের জন্য স্থানীয় ফাইল তৈরি
        $destPathLarge = public_path() . '/uploads/product/large/' . $imageName;
        $destPathSmall = public_path() . '/uploads/product/small/' . $imageName;

        // ছবি প্রক্রিয়াকরণের জন্য চিত্র তৈরি
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
                return response()->json([
                    'status' => false,
                    'message' => 'Unsupported image format'
                ]);
        }

        if ($image === false) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create image from source'
            ]);
        }

        list($width, $height) = getimagesize($sourcePath);
        $newWidth = 1400;
        $newHeight = intval($height * ($newWidth / $width));
        $largeImage = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($largeImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // বড় ছবি সংরক্ষণ করা
        switch ($ext) {
            case 'jpeg':
            case 'jpg':
                imagejpeg($largeImage, $destPathLarge, 100);
                break;
            case 'png':
                imagepng($largeImage, $destPathLarge);
                break;
        }

        imagedestroy($largeImage);

        // ছোট ছবি তৈরি করা এবং সংরক্ষণ করা
        $smallImage = imagecreatetruecolor(300, 300);
        imagecopyresampled($smallImage, $image, 0, 0, 0, 0, 300, 300, $width, $height);

        switch ($ext) {
            case 'jpeg':
            case 'jpg':
                imagejpeg($smallImage, $destPathSmall, 100);
                break;
            case 'png':
                imagepng($smallImage, $destPathSmall);
                break;
        }

        imagedestroy($smallImage);
        imagedestroy($image);

        return response()->json([
            'status'    => true,
            'image_id'  => $product2Image->id,
            'ImagePath' => asset('public/uploads/product/small/' . $product2Image->image),
            'message'   => 'Image saved successfully'
        ]);
    }
    
    public function destroy(Request $request){
        $product2Image= product2_images::find($request->id);

        if( empty($product2Image)){

            return response()->json([
                'status'    => false,
                'message'   => 'Image Not Found'
            ]);

        }
        //Delete images from folder

        File::delete(public_path('uploads/product/large/'.$product2Image->image));
        File::delete(public_path('uploads/product/small/'.$product2Image->image));

        $product2Image->delete();

        return response()->json([
            'status'    => true,
            'message'   => 'Image deleted successfully'
        ]);
    }
}
