<?php

namespace App\Models;

use App\Interfaces\HasPublicUrlContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Category extends Model implements HasPublicUrlContract
{
    use HasTranslations;

    protected $table = 'categories';
    public $timestamps = false;
    protected $guarded = false;

    public $translatable = ['name'];

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function scopeParents(Builder $query)
    {
        $query->where('parent_id', null);
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
        return $this->parent_id === null;
    }

    public function isChild(): bool
    {
        return (bool) $this->parent_id;
    }
}
