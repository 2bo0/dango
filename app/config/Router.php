<?php
Router::get("/", "PcAppController", "index");
Router::get("/index.php", "PcAppController", "index");
Router::get("/sp/", "SpAppController", "index");