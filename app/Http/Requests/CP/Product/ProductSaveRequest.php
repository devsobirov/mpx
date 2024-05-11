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
            'slug' => 'required|unique:products,slug,'.$this->id,
            'image' => ($this->id ? 'nullable' : 'required') .'|image|max:5120',
            'developers' => 'nullable|string|max:255',
            'publishers' => 'nullable|string|max:255',
            'keywords' => 'nullable|string|max:255',
            'discount' => 'nullable|numeric',
            'steam_app_id' => 'nullable|unique:products,steam_app_id,'.$this->id,
            'released_at' => 'nullable|date',
            'status' => 'boolean',
            'image_og' => 'nullable|image|max:255',
            'en' => 'nullable|array',
            'ru' => 'nullable|array',
        ];
    }

    public function prepareForValidation()
    {
        $status = (bool) $this->status;
        $slug = $this->slug ?: \Str::slug($this->name);
        $count = DB::table('products')
            ->whereNot('id', $this->id)
            ->where('slug', $slug)
            ->count();
        if ($count) {
            $slug .= ('-'.$count+1);
        }

        $this->merge(compact('status', 'slug'));
    }
}
