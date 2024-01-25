<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // list page
    public function list() {
        return view('admin.category.list');
    }

    // create page
    public function create() {
        return view('admin.category.create');
    }

    // recreate
    public function recreate(Request $request) {
        dd($request->all());
    }
}
