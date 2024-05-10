<?php


namespace App\Interfaces;


interface HasImageUploadContract
{
    public static function getImageBaseDir(): string;

    public static function getImgWidth(): int;

    public static function getWatermarkPath(): ?string;

    public static function getImgHeight(): ?int;
}
