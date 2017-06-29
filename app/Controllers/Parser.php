<?php

namespace App\Controllers;

use App\Services;

class Parser
{
    public function index()
    {
        $parser = new Services\ParserService;
        $parser->parsingProcess();
        header('Location: /mail');
    }
}
