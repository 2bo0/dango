<?php
Router::get("/", "PcAppController", "index");
Router::get("/index.php", "PcAppController", "index");
Router::get("/admin/", "AdminAppController", "index");
Router::get("/sp/", "SpAppController", "index");