<?php

namespace App\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
    }

    /**
     * Show the index page.
     *
     * @return string
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Change the locale.
     *
     * @param string $lang Language code
     * @return string
     */
    public function locale($lang)
    {
        cookie()->setForever('locale', $lang);

        return redirect('');
    }
}