<?php
// Project 2
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TempImagesController extends Controller
{ 
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('temp'), $filename);

            $tempImage = TempImage::create(['name' => $filename]);

            return response()->json([
                'status' => true,
                'image_id' => $tempImage->id,
                'ImagePath' => asset('public/temp/' . $filename),
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'No image uploaded'
        ]);
    }

    public function destroy($id)
    {
        $tempImage = TempImage::find($id);

        if ($tempImage) {
            $filePath = public_path('temp/' . $tempImage->name);

            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            $tempImage->delete();

            return response()->json([
                'status' => true,
                'message' => 'Image deleted successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Image not found'
        ]);
    }

    public function create(Request $request)
    {
        $image = $request->file('image');

        if (!empty($image)) {
            $ext = $image->getClientOriginalExtension();
            $newName = time() . '.' . $ext;

            $tempImage = new TempImage();
            $tempImage->name = $newName;
            $tempImage->save();

            $image->move(public_path() . '/temp', $newName);

            // Generate thumbnail based on image type
            $sourcePath = public_path() . '/temp/' . $newName;
            $destPath = public_path() . '/temp/thumb/' . $newName;

            $imageInfo = getimagesize($sourcePath);
            $width = $imageInfo[0];
            $height = $imageInfo[1];
            $newWidth = 300;
            $newHeight = intval($height * ($newWidth / $width));

            switch ($imageInfo[2]) {
                case IMAGETYPE_JPEG:
                    $sourceImage = imagecreatefromjpeg($sourcePath);
                    break;
                case IMAGETYPE_PNG:
                    $sourceImage = imagecreatefrompng($sourcePath);
                    break;
                default:
                    return response()->json([
                        'status' => false,
                        'message' => 'Unsupported image format'
                    ]);
            }

            $thumbnail = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($thumbnail, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            // Save thumbnail based on file type
            switch ($imageInfo[2]) {
                case IMAGETYPE_JPEG:
                    imagejpeg($thumbnail, $destPath, 100);
                    break;
                case IMAGETYPE_PNG:
                    imagepng($thumbnail, $destPath);
                    break;
            }

            imagedestroy($thumbnail);
            imagedestroy($sourceImage);

            return response()->json([
                'status' => true,
                'image_id' => $tempImage->id,
                'ImagePath' => asset('public/temp/' . $newName),
                'message' => 'Temp Image Uploaded Successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No image uploaded'
            ]);
        }
    }
}
