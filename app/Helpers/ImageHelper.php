<?php


namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class ImageHelper extends Image
{
    const FORMAT_DEFAULT = 'webp';
    const FORMAT_FEED = 'png';

    /**
     * @param $img string|\SplFileInfo
     * @param $baseDir string
     * @param int|null $width - auto or px
     * @param int|null $height - auto or px
     * @return string|false full path of stored image or false if failed
     */
    public static function storeAsWebp($img, $baseDir = '', $width = null, $height = null): false|string
    {
        return self::storeAs($img, self::FORMAT_DEFAULT, $baseDir, $width, $height);
    }

    /**
     * @param $img string|\SplFileInfo
     * @param string $format - webp, jpg, jpeg, png
     * @param $baseDir string
     * @param int|null $width - auto or px
     * @param int|null $height - auto or px
     * @return string|false full path of stored image or false if failed
     */
    public static function storeAs($img, string $format, $baseDir = '', $width = null, $height = null)
    {
        $img = self::make($img);
        if (is_int($width) && !$height) {
            $img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        } elseif (is_int($width) && is_int($height)) {
            $img->resize($width, $height);
        }

        return self::storeAndGetPath($img, $baseDir, $format);
    }

    public static function storeAsWebpWithWatermark($img, ?string $pathToWatermark, $baseDir = '', $wd = null, $ht = null): false|string
    {
        $img = self::make($img);

        if ($pathToWatermark && File::exists(public_path($pathToWatermark))) {

            if (is_int($wd) && !$ht) {
                $img->resize($wd, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            } elseif (is_int($wd) && is_int($ht)) {
                $img->resize($wd, $ht);
            }

            $watermark = self::make(public_path($pathToWatermark));
            $height = $img->height() + $watermark->height();

            // Create a canvas with the required dimensions
            $canvas = self::canvas($img->width(), $height);

            // Paste the main image onto the canvas at the top-left corner
            $canvas->insert($watermark);
            $canvas->insert($img, 'top', 0, $watermark->height());

            return self::storeAndGetPath($canvas, $baseDir, self::FORMAT_FEED);
        }

        return self::storeAs($img, self::FORMAT_FEED, $baseDir, $wd, $ht);
    }

    public static function storeAndGetPath(\Intervention\Image\Image $img, $baseDir = '', $format = 'webp'): false|string
    {
        if (!Str::endsWith($baseDir, '/')) {
            $baseDir = trim($baseDir.'/');
        }
        $saveDir = trim($baseDir).date('y-m-d'); // 'public/2022-12-31'
        if (!File::exists(public_path($saveDir))) {
            File::makeDirectory(public_path($saveDir), '0755', true);
        }

        $filename = Str::random(8).".$format";
        $path = $saveDir. '/'. $filename;

        $img->save(public_path($path), 90);

        if (File::exists(public_path($path))) {
            return $path;
        }
        return false;
    }
}
