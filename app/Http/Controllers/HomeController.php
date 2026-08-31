<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.customers.home');
    }

    public function about()
    {
        return view('pages.customers.about');
    }
}
