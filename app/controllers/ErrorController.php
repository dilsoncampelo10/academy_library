<?php

namespace app\controllers;

use core\Controller;

class ErrorController extends Controller
{
    public function index()
    {
        $this->view("errors/404");
    }
}
