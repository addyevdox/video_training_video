<?php


namespace App\Http\Controllers;


class ProductController extends Controller
{

    public function index() {

        return view('product/products');

    }

    public function productitem() {

        return view('product/productitem');
    }

}