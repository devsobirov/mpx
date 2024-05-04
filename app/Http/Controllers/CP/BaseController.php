<?php

namespace App\Http\Controllers\CP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class BaseController extends Controller
{

    public function __construct()
    {
        \App::setLocale('ru');
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

    protected function sendPreparedResponse(bool $allowCaching = false)
    {
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
}
