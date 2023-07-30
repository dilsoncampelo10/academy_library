<?php

namespace core;

class Core
{
    private $url;

    public function __construct()
    {
        $this->run();
    }

    private function run(): void
    {
        $defaultController = "HomeController";
        $defaultAction = "index";
        $defaultParams = [];

        $this->url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_SPECIAL_CHARS);

        if ($this->url != "") {
            $this->url = explode("/", $this->url);
            $defaultController = ucfirst($this->url[0]) . "Controller";
            array_shift($this->url);

            if ($this->url[0] != "") {
                $defaultAction = $this->url[0];
                array_shift($this->url);
                if (count($this->url) > 0) {
                    $defaultParams = $this->url;
                }
            }
        }

        if (!file_exists("../app/controllers" . $defaultController . ".php") || !method_exists("app\\controllers\\" . $defaultController, $defaultAction)) {
            $defaultController = "ErrorController";
            $defaultAction = "index";
        }

        $newController = "app\\controllers\\" . $defaultController;
        $c = new $newController();

        call_user_func_array([$c, $defaultAction], $defaultParams);
    }
}
