<?php


namespace App\Services;


use App\Services\Interfaces\ImageServiceInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageService implements ImageServiceInterface
{
    public function deleteImage($image_path)
    {
        $is_default_image = Str::contains($image_path, '/defaults/');

        if (!$is_default_image) {
            File::delete(public_path($image_path));
        }

    }

    public function saveImage($image, $image_name, $path, $crop = false, $width = null, $height = null)
    {
        if (!file_exists(public_path($path))) {
            if (!mkdir($concurrentDirectory = public_path($path), 0777, true) && !is_dir($concurrentDirectory)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
            }
        }

        $pub_path = public_path($path . $image_name);
        $loc = $path . $image_name;

        if ($crop) {
            if ($height != null && $width != null) {
                Image::make($image)->crop($height, $width)->save($pub_path, 60);
            } else {
                $height = Image::make($image)->height();
                Image::make($image)->crop($height, $height)->save($pub_path, 60);
            }
        } else {
            $img = Image::make($image->getRealPath());
            $img = $this->resizeImage($img, 1000);
            $img->save($pub_path,60);

        }

        return $loc;
    }

    private function resizeImage($image, $requiredSize) {
        $width = $image->width();
        $height = $image->height();

        // Check if image resize is required or not
        if ($requiredSize >= $width && $requiredSize >= $height) return $image;

        $aspectRatio = $width/$height;
        if ($aspectRatio >= 1.0) {
            $newWidth = $requiredSize;
            $newHeight = $requiredSize / $aspectRatio;
        } else {
            $newWidth = $requiredSize * $aspectRatio;
            $newHeight = $requiredSize;
        }

        $image->resize($newWidth, $newHeight);
        return $image;
    }
}
