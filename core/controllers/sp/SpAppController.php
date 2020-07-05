<?php
class SpAppController extends AppController
{
    function __construct() {
        parent::__construct();
    }

    public function index() {
        echo "sp page.";
    }
}