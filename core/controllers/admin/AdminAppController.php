<?php
class AdminAppController extends AppController
{
    function __construct() {
        parent::__construct();
    }

    public function index() {
        echo "admin page.";
    }
}