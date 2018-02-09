<?php

namespace App\Controllers;

use Core\Services\Contracts\Response;

class HomeController extends Controller
{
    /**
     * Show the index page.
     *
     * @return Response
     */
    public function index()
    {
        return view('home');
    }
}