<?php
class AuthUser {

    const STAT_NON=0; //未指定
    const STAT_REGISTERED=1; //登録完了
    const STAT_REGISTERING=2; //仮登録
    const STAT_CANCEL=9; //退会

    private static $stats = array(
        AuthUser::STAT_NON => "Not set",
        AuthUser::STAT_REGISTERED => "Registered",
        AuthUser::STAT_REGISTERING => "Registering",
        AuthUser::STAT_CANCEL => "Cancel",
    );

    const PERMISSION_NON=0; //未指定
    const PERMISSION_USER=1; //ユーザー

    private static $permissions = array(
        AuthUser::PERMISSION_NON => "Not set",
        AuthUser::PERMISSION_USER => "User",
    );

    const ACTIVE_NON=0; //未指定
    const ACTIVE_CONFIRMED=1; //確認済
    const ACTIVE_CHECKING=8; //確認中
    const ACTIVE_REFUSAL=9; //拒否

    private static $actives = array(
        AuthUser::ACTIVE_NON => "Not set",
        AuthUser::ACTIVE_CONFIRMED => "Confirmed",
        AuthUser::ACTIVE_CHECKING => "Checking",
        AuthUser::ACTIVE_REFUSAL => "Refusal",
    );

    const AUTH_KEY_VALUE="user_auth";

    public static function loginId($loginId, $password) {
        $_auth_key_value=AuthUser::AUTH_KEY_VALUE;
        $_sql="SELECT login, pass, permission, '{$_auth_key_value}' AS user_auth FROM users WHERE login = :login AND pass = :pass AND stat = :stat AND active = :active;";
        $_params=array(
            "login"=>$loginId,
            "pass"=>$password,
            "stat"=>AuthUser::STAT_REGISTERED,
            "active"=>AuthUser::ACTIVE_CONFIRMED,
        );
        $_login = Db::queryOne($_sql, $_params);
        if (!empty($_login)) {
            $_SESSION['login']=$_login['login'];
            $_SESSION['pass']=$_login['pass'];
            $_SESSION['permission']=$_login['permission'];
            $_SESSION['user_auth']=AuthUser::AUTH_KEY_VALUE;
            return true;
        }
        return false;
    }

    public static function loginEmail($email, $password) {
        $_auth_key_value=AuthUser::AUTH_KEY_VALUE;
        $_sql="SELECT login, pass, permission, '{$_auth_key_value}' AS {$_auth_key_value} FROM users WHERE email = :email AND pass = :pass AND stat = :stat AND active = :active;";
        $_params=array(
            "email"=>$email,
            "pass"=>$password,
            "stat"=>AuthUser::STAT_REGISTERED,
            "active"=>AuthUser::ACTIVE_CONFIRMED,
        );
        $_login = Db::queryOne($_sql, $_params);
        if (!empty($_login)) {
            $_SESSION['login']=$_login['login'];
            $_SESSION['pass']=$_login['pass'];
            $_SESSION['permission']=$_login['permission'];
            $_SESSION['user_auth']=AuthUser::AUTH_KEY_VALUE;
            return true;
        }
        return false;
    }

    public static function logout() {
        if (!empty($_SESSION)) {
            $_SESSION=null;
            session_destroy();
        }
    }

    public static function getActive() {
        return false;
    }

    public static function isLogin() {
        if (!empty($_SESSION["user_auth"]) && $_SESSION["user_auth"]===AuthUser::AUTH_KEY_VALUE) {
            return true;
        }
        return false;
    }
}
