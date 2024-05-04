<?php

namespace App\Models;

use App\Interfaces\HasPublicUrlContract;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements HasPublicUrlContract
{
    use HasTranslations;

    public $translatable = ['genres', 'description', 'meta_title', 'meta_description'];
    protected $casts = ['released_at' => 'datetime'];

    public function getUrlParams(): array
    {
        return [];
    }

    public function getFullUrl(...$args): string
    {
        return '';
    }
}
