<?php

namespace App\Models;

use App\Interfaces\HasImageUploadContract;
use App\Interfaces\HasPublicUrlContract;
use App\Traits\HasImageUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements
    HasPublicUrlContract,
    HasImageUploadContract
{
    use HasTranslations;
    use HasImageUpload;

    public $translatable = ['genres', 'description'];
    protected $guarded = false;
    protected $casts = ['released_at' => 'datetime'];

    const IMAGE_BASE_DIR = 'assets/images/games';

    public function category(): BelongsTo
    {
        return $this->belongsTo(GameCategory::class, 'category_id', 'id');
    }

    public function getUrlParams(): array
    {
        // TODO: Implement getUrlParams() method.
    }

    public function getFullUrl(...$args): string
    {
        // TODO: Implement getFullUrl() method.
    }
}
