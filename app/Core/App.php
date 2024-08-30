<?php

namespace App\Core;
use App\Core\Router;

class App {

    protected $router;

    public function __construct() {
        $this->router = new Router;
    }

    public function run() {
    }
}