<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataModel;

class FormController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = DataModel::dataForm($request);
            return view('form', $data);
        }
        return response()->view('notFound', [], 404);
    }
}
