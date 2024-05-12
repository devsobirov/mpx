<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GameCategory extends Pivot
{
    public $table = 'game_category';

    public function parent(): BelongsTo
    {
        return $this->belongsTo(GameCategory::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(GameCategory::class, 'parent_id');
    }
}
