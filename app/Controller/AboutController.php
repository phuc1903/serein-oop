<?php

namespace App\Controller;

class AboutController extends Controller {
    public function index() {
        $this->titlePage = "About Shop";
        $this->renderView('About', $this->titlePage, $this->data);
    }
}