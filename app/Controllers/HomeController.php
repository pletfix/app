<?php

namespace App\Controllers;

class HomeController extends Controller
{
    /**
     * Show the index page.
     *
     * @return string
     */
    public function index()
    {
        return view('home');
    }
}