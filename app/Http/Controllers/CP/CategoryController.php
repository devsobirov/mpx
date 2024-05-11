<?php

namespace App\Http\Controllers\CP;

use App\Http\Controllers\CP\BaseController as Controller;
use App\Http\Requests\CP\Categories\SaveCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::parents()->with('children')->get();
        return $this->sendPreparedResponse(
            'cp.categories.index',
            compact('categories')
        );
    }

    public function form(string $parent)
    {
        $category = Category::where('slug', $parent)->first();
        $categories = Category::parents()->with('children')->get();
        return $this->sendPreparedResponse(
            $category->isParent() ? 'cp.categories.parent' : 'cp.categories.child',
            compact('categories', 'category', 'parent')
        );
    }

    public function save(SaveCategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $this->handleTranslation($category, 'en', $request->en);
        $this->handleTranslation($category, 'ru', $request->ru);
        $category->watermark = $this->uploadImage($request->file('watermark'), $category) ?: $category->watermark;
        $category->slug = $data['slug'];
        $category->parent = $data['parent'];
        $category->save();

        return redirect()->route(
            'cp.categories.form',
            ['parent' => $category->isParent() ? $category->slug : $category->parent]
        )
            ->with('success', 'Успешно');
    }

    public function delete(Category $category)
    {
        $parent = $category->parent ?: null;
        $category->delete();

        $callback = $parent ? redirect()->route('cp.categories.form', compact('parent'))
            : redirect()->route('cp.categories.index');

        return $callback->with('success', 'Успешно');
    }
}
