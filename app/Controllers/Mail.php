<?php

namespace App\Controllers;

use App\Models;

class Mail extends Controller
{
    public function index()
    {
        $errors = Models\Error::whereHas('logs')->with('logs')->get()->toArray();
        echo $this->twig->render('mail.html', compact('errors'));
    }
}
