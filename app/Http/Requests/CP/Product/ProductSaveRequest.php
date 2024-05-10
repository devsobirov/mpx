<?php

namespace App\Http\Requests\CP\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class ProductSaveRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:products,slug,'.$this->route()->parameter('product')?->id,
            'image' => 'required|image|max:5120',
            'developers' => 'nullable|string|max:255',
            'publishers' => 'nullable|string|max:255',
            'keywords' => 'nullable|string|max:255',
            'discount' => 'nullable|numeric',
            'steam_app_id' => 'nullable|unique:products,steam_app_id,'.$this->route()->parameter('product')?->id,
            'released_at' => 'nullable|date',
            'en' => 'nullable|array',
            'ru' => 'nullable|array',
            'image_og' => 'nullable|image|max:255',
        ];
    }

    public function prepareForValidation()
    {
        $status = (bool) $this->status;
        $slug = $this->slug ?: \Str::slug($this->name);
        if ($count = DB::table('products')->where('slug', $slug)->count()) {
            $slug .= ('-'.$count+1);
        }

        $this->merge(compact('status', 'slug'));
    }
}
