<?php

namespace App\Http\Controllers\CP;

use App\Http\Controllers\CP\BaseController as  Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(25);
        $this->view('cp.products.index', compact('products'));
        return $this->sendPreparedResponse();
    }

    public function create()
    {
        $this->view('cp.products.create');
        return $this->sendPreparedResponse();
    }
}
