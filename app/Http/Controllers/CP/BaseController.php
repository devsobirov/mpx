<?php

namespace App\Http\Controllers\CP;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Interfaces\HasImageUploadContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

abstract class BaseController extends Controller
{

    public function __construct()
    {
        \App::setLocale('ru');
        \Config::set('app.abort_if_404', true);
    }

    protected string $layout = 'cp.layouts.cp';
    protected $_preparedContent = '';

    protected function render($view, $params = [], $layouts = [])
    {
        $content = view($view, $params)->render();
        foreach ($layouts as $layout) {
            $content = view($layout, ['content' => $content])->render();
        }
        $this->_preparedContent .= $content;
    }

    protected function sendPreparedResponse(?string $view = '', array $data = [], bool $allowCaching = false)
    {
        if (!empty($view)) {
            $this->view($view, $data);
        }
        $res = response($this->_preparedContent);
        if ($allowCaching) {
            $res->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        }
        return $res;
    }

    protected function view($name, $params = [])
    {
        $this->render($name, $params, request()->ajax() ? [] : [$this->layout]);
    }

    protected function handleTranslation(Model &$model,string $lang, array $data) : void
    {
        if (property_exists($model, 'translatable') && is_array($model->translatable)) {
            foreach ($data as $property => $value) {
                \Log::debug(__METHOD__, compact('property', 'value'));
                if (in_array($property, $model->translatable)) {
                    \Log::debug(__METHOD__, compact('property', 'value'));
                    $model->setTranslation($property, $lang, $value);
                }
            }
        }
    }

    protected function uploadImage(?UploadedFile $img, HasImageUploadContract $model, ?string $watermark = null) : ?string
    {
        $imagePath = false;
        if (!empty($img)) {
            $helper = new ImageHelper();
            $dir = $model::getImageBaseDir();
            $width = $model::getImgWidth();
            $height = $model::getImgHeight();

            $path = $watermark
                ? $helper->storeAsWebpWithWatermark($img, $watermark, $dir, $width, $height)
                : $helper->storeAsWebp($img, $dir, $width, $height);

            if ($path) $imagePath = $path;
        }
        return $imagePath;
    }
}
