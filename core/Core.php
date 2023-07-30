<?php

namespace core;

class Core
{

    private static Core $instance;

    private static $url;
    private static $defaultController;
    private static $defaultAction;
    private static $defaultParams;

    public function __construct()
    {
        self::getInstance();
    }

    private static function run(): void
    {
        self::setDefault();

        self::getUrl();

        self::checkUrl();

        self::checkExistsController();

        self::invokeController();
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::run();
        }

        return self::$instance;
    }

    private static function getUrl(): void
    {
        self::$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_SPECIAL_CHARS);
    }

    private static function checkUrl(): void
    {
        if (self::$url != "") {
            self::$url = explode("/", self::$url);
            self::$defaultController = ucfirst(self::$url[0]) . "Controller";
            array_shift(self::$url);

            if (self::$url[0] != "") {
                self::$defaultAction = self::$url[0];
                array_shift(self::$url);
                if (count(self::$url) > 0) {
                    self::$defaultParams = self::$url;
                }
            }
        }
    }

    private static function checkExistsController(): void
    {
        if (!file_exists("../app/controllers" . self::$defaultController . ".php") || !method_exists("app\\controllers\\" . self::$defaultController, self::$defaultAction)) {
            self::$defaultController = "ErrorController";
            self::$defaultAction = "index";
        }
    }

    private static function invokeController(): void
    {
        $newController = "app\\controllers\\" . self::$defaultController;
        $c = new $newController();

        call_user_func_array([$c, self::$defaultAction], self::$defaultParams);
    }

    private static function setDefault()
    {
        self::$defaultController = "HomeController";
        self::$defaultAction = "index";
        self::$defaultParams = [];
    }
}
