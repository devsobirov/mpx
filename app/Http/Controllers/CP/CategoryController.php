<?php

namespace App\Http\Controllers\CP;

use App\Http\Controllers\CP\BaseController as Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::parents()->with('children')->get();
        dd($categories);
    }
}
