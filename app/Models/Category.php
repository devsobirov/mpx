<?php

namespace App\Models;

use App\Interfaces\HasImageUploadContract;
use App\Interfaces\HasPublicUrlContract;
use App\Traits\HasImageUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Category extends Model implements
    HasPublicUrlContract,
    HasImageUploadContract
{
    use HasTranslations;
    use HasImageUpload;

    const IMAGE_WIDTH = 350;
    const IMAGE_BASE_DIR = 'cp-assets/img/watermark';

    protected $table = 'categories';
    public $timestamps = false;
    protected $guarded = false;

    public $translatable = ['name'];

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent', 'slug');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent', 'slug');
    }

    public function scopeParents(Builder $query)
    {
        $query->where('parent', null);
    }

    public function getUrlParams(): array
    {
        return [];
    }

    public function getFullUrl(...$args): string
    {
        return '';
    }

    public function isParent(): bool
    {
        return $this->parent === null || $this->parent === '';
    }

    public function isChild(): bool
    {
        return (bool) $this->parent;
    }
}
