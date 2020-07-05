<?php
Router::get("/admin/", "AdminTopController", "index");
Router::get("/admin/login", "AdminLoginController", "index");
Router::get("/admin/logout", "AdminLogoutController", "index");
Router::get("/admin/plugins", "AdminPluginsController", "index");
Router::post("/admin/plugins", "AdminPluginsController", "index");
Router::get("/admin/users", "AdminUsersController", "index");
Router::post("/admin/users", "AdminUsersController", "index");
Router::get("/admin/administrators", "AdminAdministratorsController", "index");
Router::post("/admin/administrators", "AdminAdministratorsController", "index");
Router::get("/admin/page_templates", "AdminPageTemplatesController", "index");
Router::post("/admin/page_templates", "AdminPageTemplatesController", "index");
