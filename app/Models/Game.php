<?php

namespace App\Models;

use App\Interfaces\HasImageUploadContract;
use App\Interfaces\HasPublicUrlContract;
use App\Traits\HasImageUpload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Game extends Model implements
    HasPublicUrlContract,
    HasImageUploadContract
{
    use HasTranslations;
    use HasImageUpload;

    public $table = 'games';
    public $translatable = ['genres', 'description'];
    protected $guarded = false;
    protected $casts = ['released_at' => 'datetime'];

    const IMAGE_BASE_DIR = 'assets/images/games';

    public function tree(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'game_category',
            'game_id',
            'category_slug',
            'id',
            'slug',
        )
            ->using(GameCategory::class)
            ->withPivot('id', 'parent_id');
    }

    public function catalog(): BelongsToMany
    {
        return $this->tree()->whereNull('parent_id')->orderByPivot('id');
    }

    public function categories(): BelongsToMany
    {
        return $this->tree()->whereNotNull('parent_id')->orderByPivot('id');
    }

    public function getUrlParams(): array
    {
        return [];
    }

    public function getFullUrl(...$args): string
    {
        return '';
    }
}
