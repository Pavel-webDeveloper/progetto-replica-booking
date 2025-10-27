<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class HomeController extends Controller
{
    public function index(){

        $listaCategorie = Category::all();
        return view('admin.home', compact('listaCategorie'));
    }
}
