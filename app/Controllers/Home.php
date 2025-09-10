<?php

namespace App\Controllers;

class Home extends BaseController
{
    // Homepage
    public function index(): string
    {
        return view('index');  // loads app/Views/index.php
    }

    // About page
    public function about(): string
    {
        return view('about');  // loads app/Views/about.php
    }

    // Contact page
    public function contact(): string
    {
        return view('contact');  // loads app/Views/contact.php
    }
}
