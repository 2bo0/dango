<?php
class PcAppController extends AppController
{
    function __construct() {
        parent::__construct();
    }

    public function index() {
        echo "pc page.";
    }
}