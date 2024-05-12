<?php

namespace App\Http\Requests\CP\Game;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class SaveGameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:games,slug,'.$this->post('id', 0),
            'image' => ($this->id ? 'nullable' : 'required') .'|image|max:5120',
            'developers' => 'nullable|string|max:255',
            'publishers' => 'nullable|string|max:255',
            'keywords' => 'nullable|string|max:255',
            'discount' => 'nullable|numeric',
            'steam_app_id' => 'nullable|unique:games,steam_app_id,'.$this->post('id', 0),
            'released_at' => 'nullable|date',
            'status' => 'boolean',
            'image_og' => 'nullable|image|max:5120',
            'en' => 'nullable|array',
            'ru' => 'nullable|array',
        ];
    }

    public function prepareForValidation()
    {
        $status = (bool) $this->status;
        $slug = $this->slug ?: \Str::slug($this->name);
        $count = DB::table('games')
            ->where('id', '!=', $this->id ?? 0)
            ->where('slug', $slug)
            ->count();
        if ($count) {
            $slug .= ('-'.$count+1);
        }

        $this->merge(compact('status', 'slug'));
    }
}
