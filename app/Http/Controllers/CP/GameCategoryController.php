<?php

namespace App\Http\Controllers\CP;

use App\Http\Controllers\CP\BaseController as Controller;
use App\Models\Category;
use App\Models\Game;
use App\Models\GameCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameCategoryController extends Controller
{
    public function index(Game $game)
    {
        $slugs = DB::table('game_category')->where('game_id', $game->id)->pluck('category_slug')->toArray();

        $list = Category::parents()
            ->with(['children' => function($query) use ($slugs) {
                $query->whereNotIn('slug', $slugs);
            }])
            ->get();

        return $this->sendPreparedResponse(
            'cp.game-categories.index',
            compact('game', 'list', 'slugs')
        );
    }

    public function add(Game $game)
    {
        $category = Category::where('slug', \request('category'))->first();
        if (!$category) {
            return redirect()->back()->with('msg', 'Caetgory not found');
        }

        $parent = GameCategory::where([
            'game_id' => $game->id,
            'category_slug' => $category->parent
        ])->first();

        $game->tree()->attach($category->slug, ['parent_id' => $parent?->id]);
        return redirect()->back()->with('success', 'Success');
    }
}
