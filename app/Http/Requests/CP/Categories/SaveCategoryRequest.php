<?php

namespace App\Http\Requests\CP\Categories;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class SaveCategoryRequest extends FormRequest
{
    public $current = null;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'en.name' => 'required|string|max:255',
            'ru.name' => 'required|string|max:255',
            'slug' => 'required|max:255|unique:categories,slug,'.$this->route('category')?->id,
            'watermark' => 'nullable|image',
            'parent' => 'nullable|exists:categories,slug'
        ];
    }

    protected function prepareForValidation()
    {
        $slug = $this->slug;
        $parent = $this->parent;
        $p = $parent ? Category::where('slug', $parent)->first() : null;
        if (!$slug) {
            $slug = strtolower(\Str::slug($this->en['name']));
            $slug = $p ? $p->slug . '/' . $slug : $slug;
        }
        $slug = str_replace( '//', '/', trim($slug, '/'));
        $this->merge(compact('slug', 'parent'));
    }
}
