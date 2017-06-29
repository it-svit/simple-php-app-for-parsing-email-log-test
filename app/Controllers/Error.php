<?php

namespace App\Controllers;

use App\Models;

class Error extends Controller
{
    public function index()
    {
        $errors = Models\Error::get()->toArray();
        echo $this->twig->render('error.html', compact('errors'));
    }
}
