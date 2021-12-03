<?php

namespace App\Http\Controllers\Cabinet\Main;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('cabinet.main.index');
    }
}
