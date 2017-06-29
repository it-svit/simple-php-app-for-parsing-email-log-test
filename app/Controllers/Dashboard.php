<?php

namespace App\Controllers;

class Dashboard extends Controller
{
    public function index()
    {
        echo $this->twig->render('dashboard.html');
    }
}
