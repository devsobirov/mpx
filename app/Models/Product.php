<?php

namespace App\Models;

use App\Interfaces\HasImageUploadContract;
use App\Interfaces\HasPublicUrlContract;
use App\Traits\HasImageUpload;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements
    HasPublicUrlContract,
    HasImageUploadContract
{
    use HasTranslations;
    use HasImageUpload;

    public $translatable = ['genres', 'description', 'meta_title', 'meta_description'];
    protected $guarded = false;
    protected $casts = ['released_at' => 'datetime'];

    const IMAGE_BASE_DIR = 'products';

    public function getUrlParams(): array
    {
        return [];
    }

    public function getFullUrl(...$args): string
    {
        return '';
    }
}
