<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageHelper
{
    public static function uploadImage($file, $folder, $update = null, $width = null, $height = null)
    {
        $fileUrl = null;

        if ($file) {
            // Delete existing file if $update is provided and has a file path
            if ($update) {
                $oldFilePath = public_path($update);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Generate a unique file name
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $uniqueName = Str::slug($originalName) . '_' . uniqid() . '.' . $extension;
            // $uniqueName = Str::slug($originalName) . '.' . $extension;

            // Define the directory path
            $directory = public_path($folder);

            // Ensure the directory exists; create if it doesn't
            if (!File::isDirectory($directory)) {
                File::makeDirectory($directory, 0777, true, true);
            }

            $destinationPath = $directory . '/' . $uniqueName;

            if ($width && $height) {
                // Resize image using GD
                $imagePath = $file->getRealPath();
                list($origWidth, $origHeight, $type) = getimagesize($imagePath);
                $image = null;

                switch ($type) {
                    case IMAGETYPE_JPEG: $image = imagecreatefromjpeg($imagePath); break;
                    case IMAGETYPE_PNG: $image = imagecreatefrompng($imagePath); break;
                    case IMAGETYPE_GIF: $image = imagecreatefromgif($imagePath); break;
                    case IMAGETYPE_WEBP: $image = imagecreatefromwebp($imagePath); break;
                }

                if ($image) {
                    $newImage = imagecreatetruecolor($width, $height);

                    if ($type == IMAGETYPE_PNG || $type == IMAGETYPE_GIF || $type == IMAGETYPE_WEBP) {
                        imagecolortransparent($newImage, imagecolorallocatealpha($newImage, 0, 0, 0, 127));
                        imagealphablending($newImage, false);
                        imagesavealpha($newImage, true);
                    }

                    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight);

                    switch ($type) {
                        case IMAGETYPE_JPEG: imagejpeg($newImage, $destinationPath, 90); break;
                        case IMAGETYPE_PNG: imagepng($newImage, $destinationPath); break;
                        case IMAGETYPE_GIF: imagegif($newImage, $destinationPath); break;
                        case IMAGETYPE_WEBP: imagewebp($newImage, $destinationPath, 90); break;
                    }
                    imagedestroy($image);
                    imagedestroy($newImage);
                } else {
                    $file->move($directory, $uniqueName);
                }
            } else {
                // Move the file to the directory with the new unique name
                $file->move($directory, $uniqueName);
            }

            $fileUrl = "{$folder}/{$uniqueName}";
        } else {
            $fileUrl = $update ? $update : null;
        }

        return $fileUrl;
    }

    public static function deleteImage($imagePath)
    {
        if ($imagePath && file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
            return true;
        }
        return false;
    }
}
