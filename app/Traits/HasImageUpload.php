<?php


namespace App\Traits;

/**
 * Trait HasImageUpload
 * @package App\Traits
 * @implements App\Interfaces\HasImageUploadContract
 */
trait HasImageUpload
{
    public static function getImageBaseDir(): string
    {
        return self::IMAGE_BASE_DIR;
    }

    public static function getImgWidth(): int
    {
        return defined('self::IMAGE_WIDTH') ? self::IMAGE_WIDTH : 400;
    }

    public static function getWatermarkPath(): ?string
    {
        return defined('self::WATERMARK_PATH') ? self::WATERMARK_PATH : null;
    }

    public static function getImgHeight(): ?int
    {
        return defined('self::IMAGE_HEIGHT') ? self::IMAGE_HEIGHT : null;
    }
}
