<?php

namespace App\Controller;

class ContactController extends Controller {
    public function index() {
        $this->titlePage = "Contact Shop";
        $this->renderView('Contact', $this->titlePage, $this->data);
    }
}