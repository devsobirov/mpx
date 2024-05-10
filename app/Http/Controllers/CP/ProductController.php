<?php

namespace App\Http\Controllers\CP;

use App\Http\Controllers\CP\BaseController as  Controller;
use App\Http\Requests\CP\Product\ProductSaveRequest;
use App\Models\Product;
use App\Services\Parsers\FetchSteamService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(25);
        return $this->sendPreparedResponse('cp.products.index', compact('products'));
    }

    public function form(?Product $product)
    {
        return !$product->exists
            ? $this->sendPreparedResponse('cp.products.create')
            : $this->sendPreparedResponse('cp.products.edit', compact('product'));
    }

    public function save(ProductSaveRequest $request)
    {
        $product = $request->id
            ? Product::findOrFail($request->id)
            : new Product();
        $this->fillBaseFields($product, $request->validated());
        $product->image = $this->uploadImage($request->file('image'), $product) ?: $product->image;
        $product->image_og = $this->uploadImage($request->file('og_image'), $product) ?: $product->image_og;
        $product->image_feed = $this->uploadImage($request->file('image'), $product, $product::getWatermarkPath()) ?:
            $product->image_feed;
        $this->handleTranslation($product, 'ru', $request->ru);
        $this->handleTranslation($product, 'en', $request->en);
        $product->save();

        return $request->expectsJson()
            ? response(['success' => 'ok', 'product' => $product], 200)
            : redirect()->route('cp.products.form', ['product' => $product->id])->with('success', 'Успешно');
    }

    public function fetchSteam(Request $request)
    {
        $steamService = new FetchSteamService();
        $steamService->handle($request->link);
        if ($msg = $steamService->error) {
            return response(['link' => $msg], 400);
        }
        return $steamService->data;
    }

    private function fillBaseFields(&$product, array $data)
    {
        $baseFields = ['name', 'slug', 'developers', 'publishers', 'keywords', 'discount', 'steam_app_id', 'released_at'];
        foreach ($baseFields as $property) {
            if (isset($data[$property])) {
                $product->$property = $data[$property];
            }
        }
    }
}
