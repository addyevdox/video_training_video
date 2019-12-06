<?php


namespace App\Http\Controllers;


class PeopleController extends Controller
{
    public function index() {
        return view('people');
    }

}