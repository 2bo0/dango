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

    public static function isGet() {
        if (Router::REQUEST_METHOD_GET === (isset($_SERVER["REQUEST_METHOD"])) ? $_SERVER["REQUEST_METHOD"] : Router::REQUEST_METHOD_GET) {
            return true;
        }
        return false;
    }

    public static function isPost() {
        if (Router::REQUEST_METHOD_POST === (isset($_SERVER["REQUEST_METHOD"])) ? $_SERVER["REQUEST_METHOD"] : Router::REQUEST_METHOD_GET) {
            return true;
        }
        return false;
    }

    public static function isPut() {
        if (Router::REQUEST_METHOD_PUT === (isset($_SERVER["REQUEST_METHOD"])) ? $_SERVER["REQUEST_METHOD"] : Router::REQUEST_METHOD_GET) {
            return true;
        }
        return false;
    }

    public static function isDelete() {
        if (Router::REQUEST_METHOD_DELETE === (isset($_SERVER["REQUEST_METHOD"])) ? $_SERVER["REQUEST_METHOD"] : Router::REQUEST_METHOD_GET) {
            return true;
        }
        return false;
    }

    public static function isHead() {
        if (Router::REQUEST_METHOD_HEAD === (isset($_SERVER["REQUEST_METHOD"])) ? $_SERVER["REQUEST_METHOD"] : Router::REQUEST_METHOD_GET) {
            return true;
        }
        return false;
    }

    public static function isOptions() {
        if (Router::REQUEST_METHOD_OPTIONS === (isset($_SERVER["REQUEST_METHOD"])) ? $_SERVER["REQUEST_METHOD"] : Router::REQUEST_METHOD_GET) {
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