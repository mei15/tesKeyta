<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produk;
use DB;

class homecontroller extends Controller
{
    public function index()
    {
        $products = produk::take(4)->get();
        return view('home.index',compact('products'));
        
    }
}
