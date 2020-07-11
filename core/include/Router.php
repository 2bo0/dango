<?php
class Router {

    const REQUEST_METHOD_GET="GET";
    const REQUEST_METHOD_POST="POST";
    const REQUEST_METHOD_PUT="PUT";
    const REQUEST_METHOD_DELETE="DELETE";
    const REQUEST_METHOD_HEAD="HEAD";
    const REQUEST_METHOD_OPTIONS="OPTIONS";

    private static $data = array(
        Router::REQUEST_METHOD_GET => array(),
        Router::REQUEST_METHOD_POST => array(),
        Router::REQUEST_METHOD_PUT => array(),
        Router::REQUEST_METHOD_DELETE => array(),
        Router::REQUEST_METHOD_HEAD => array(),
        Router::REQUEST_METHOD_OPTIONS => array(),
    );

    public static function redirect($url) {
        header("Location: {$url}", true, 302 );
        exit;
    }

    public static function isGet() {
        $req_method=(isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : "");
        if (Router::REQUEST_METHOD_GET === $req_method) {
            return true;
        }
        return false;
    }

    public static function isPost() {
        $req_method=(isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : "");
        if (Router::REQUEST_METHOD_POST === $req_method) {
            return true;
        }
        return false;
    }

    public static function isPut() {
        $req_method=(isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : "");
        if (Router::REQUEST_METHOD_PUT === $req_method) {
            return true;
        }
        return false;
    }

    public static function isDelete() {
        $req_method=(isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : "");
        if (Router::REQUEST_METHOD_DELETE === $req_method) {
            return true;
        }
        return false;
    }

    public static function isHead() {
        $req_method=(isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : "");
        if (Router::REQUEST_METHOD_HEAD === $req_method) {
            return true;
        }
        return false;
    }

    public static function isOptions() {
        $req_method=(isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : "");
        if (Router::REQUEST_METHOD_OPTIONS === $req_method) {
            return true;
        }
        return false;
    }

    public static function go() {
        $uri = empty($_SERVER["REQUEST_URI"]) ? "/" : $_SERVER["REQUEST_URI"];
        $_uri = $uri;
        $_query_string = "";
        if (preg_match('/\/([^\?]+)?(\?[^\?]+)?/', $uri, $m) && !empty($m) && is_array($m) && count($m)==3) {
            $_uri = "/{$m[1]}";
            $_query_string = "{$m[2]}";
        }
        $_request_method="";
        if ( Router::isGet() === true && array_key_exists($_uri, Router::$data[Router::REQUEST_METHOD_GET]) ) {
            $_request_method=Router::REQUEST_METHOD_GET;
        } else if ( Router::isPost() === true && array_key_exists($_uri, Router::$data[Router::REQUEST_METHOD_POST])  ) {
            $_request_method=Router::REQUEST_METHOD_POST;
        } else if ( Router::isPut() === true && array_key_exists($_uri, Router::$data[Router::REQUEST_METHOD_PUT])  ) {
            $_request_method=Router::REQUEST_METHOD_PUT;
        } else if ( Router::isDelete() === true && array_key_exists($_uri, Router::$data[Router::REQUEST_METHOD_DELETE])  ) {
            $_request_method=Router::REQUEST_METHOD_DELETE;
        } else if ( Router::isHead() === true && array_key_exists($_uri, Router::$data[Router::REQUEST_METHOD_HEAD])  ) {
            $_request_method=Router::REQUEST_METHOD_HEAD;
        } else if ( Router::isOptions() === true && array_key_exists($_uri, Router::$data[Router::REQUEST_METHOD_OPTIONS])  ) {
            $_request_method=Router::REQUEST_METHOD_OPTIONS;
        }
        if ( $_request_method !== "" ) {
            $_class = Router::$data[$_request_method][$_uri]['class'];
            $_i = new $_class;
            $_m = array( $_i, Router::$data[$_request_method][$_uri]['method'] );
            $_m();
        }
    }

    public static function clear($requestMethod=null) {
        if ( $requestMethod === null ) {
            foreach ( Router::$data as $k => $v ) {
                Router::$data[$k] = array();
            }
        } else {
            if ( array_key_exists($requestMethod, Router::$data)===false ) {
                echo "error";
                exit(1);
            }
            Router::$data[$requestMethod] = array();
        }
    }

    public static function get($uri, $class, $classMethod, $authRequired=false) {
        Router::$data[Router::REQUEST_METHOD_GET][$uri] = array(
            "class" => $class,
            "method" => $classMethod,
            "authRequired" => $authRequired,
        );
    }

    public static function post($uri, $class, $classMethod, $authRequired=false) {
        Router::$data[Router::REQUEST_METHOD_POST][$uri] = array(
            "class" => $class,
            "method" => $classMethod,
            "authRequired" => $authRequired,
        );
    }

    public static function put($uri, $class, $classMethod, $authRequired=false) {
        Router::$data[Router::REQUEST_METHOD_PUT][$uri] = array(
            "class" => $class,
            "method" => $classMethod,
            "authRequired" => $authRequired,
        );
    }

    public static function delete($uri, $class, $classMethod, $authRequired=false) {
        Router::$data[Router::REQUEST_METHOD_DELETE][$uri] = array(
            "class" => $class,
            "method" => $classMethod,
            "authRequired" => $authRequired,
        );
    }

    public static function head($uri, $class, $classMethod, $authRequired=false) {
        Router::$data[Router::REQUEST_METHOD_HEAD][$uri] = array(
            "class" => $class,
            "method" => $classMethod,
            "authRequired" => $authRequired,
        );
    }

    public static function options($uri, $class, $classMethod, $authRequired=false) {
        Router::$data[Router::REQUEST_METHOD_OPTIONS][$uri] = array(
            "class" => $class,
            "method" => $classMethod,
            "authRequired" => $authRequired,
        );
    }
}

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
