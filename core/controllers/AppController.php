<?php
class AppController
{
    function __construct() {
        Database::connect();
    }
}