<?php

namespace core;

class Controller
{
    public function view(string $view, array $data = []): void
    {
        extract($data);
   
        require_once "resources/views/" . $view . ".php";
    }

    public function redirect(string $location): void
    {
        header("location: http://localhost/academy_library/" . $location);
        exit();
    }
}
