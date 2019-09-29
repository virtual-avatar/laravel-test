<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {

        return view('index');
    }

}
