<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function search(){
        $busca = request('search');
        return view('products', ['busca'=>$busca]);
    }

    public function view($id = null){
        return view('product', ['id'=>$id]);
    }
}
