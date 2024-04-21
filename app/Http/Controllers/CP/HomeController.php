<?php

namespace App\Http\Controllers\CP;

use Illuminate\Http\Request;
use App\Http\Controllers\CP\BaseController as Controller;


class HomeController extends Controller
{
    public function index()
    {
        $this->view('cp.home');
        return $this->sendPreparedResponse();
    }
}
