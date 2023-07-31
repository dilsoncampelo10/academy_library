<?php

namespace app\controllers;

use core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            "name" => "Dilson"
        ];
        $this->viewWithTemplate("main", "home", $data);
    }
}
