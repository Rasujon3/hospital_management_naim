<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('home.index'); // resources/views/home/index.blade.php
    }

    /**
     * Display the About page.
     *
     * @return \Illuminate\View\View
     */
    public function about(): View
    {
        return view('home.about'); // resources/views/home/about.blade.php
    }

    /**
     * Display the Services page.
     *
     * @return \Illuminate\View\View
     */
    public function services(): View
    {
        return view('home.services'); // resources/views/home/services.blade.php
    }

    /**
     * Display the Contact page.
     *
     * @return \Illuminate\View\View
     */
    public function contact(): View
    {
        return view('home.contact'); // resources/views/home/contact.blade.php
    }
}
