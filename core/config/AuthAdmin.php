<?php
class AuthAdmin {

    const STAT_NON=0; //未指定
    const STAT_REGISTERED=1; //登録完了
    const STAT_REGISTERING=2; //仮登録
    const STAT_CANCEL=9; //退会

    private static $stats = array(
        AuthAdmin::STAT_NON => "Not set",
        AuthAdmin::STAT_REGISTERED => "Registered",
        AuthAdmin::STAT_REGISTERING => "Registering",
        AuthAdmin::STAT_CANCEL => "Cancel",
    );

    const PERMISSION_NON=0; //未指定
    const PERMISSION_OPERATOR=1; //オペレーター
    const PERMISSION_MANAGER=97; //運営管理者
    const PERMISSION_SUB_ADMIN=98; //副システム管理者
    const PERMISSION_ADMIN=99; //システム管理者

    private static $permissions = array(
        AuthAdmin::PERMISSION_NON => "Not set",
        AuthAdmin::PERMISSION_OPERATOR => "Operator",
        AuthAdmin::PERMISSION_MANAGER => "Manager",
        AuthAdmin::PERMISSION_SUB_ADMIN => "Sub Administrator",
        AuthAdmin::PERMISSION_ADMIN => "Administrator",
    );

    const ACTIVE_NON=0; //未指定
    const ACTIVE_CONFIRMED=1; //確認済
    const ACTIVE_CHECKING=8; //確認中
    const ACTIVE_REFUSAL=9; //拒否

    private static $actives = array(
        AuthAdmin::ACTIVE_NON => "Not set",
        AuthAdmin::ACTIVE_CONFIRMED => "Confirmed",
        AuthAdmin::ACTIVE_CHECKING => "Checking",
        AuthAdmin::ACTIVE_REFUSAL => "Refusal",
    );

    const AUTH_KEY_VALUE="admin_auth";

    public static function loginId($loginId, $password) {
        $_auth_key_value=AuthUser::AUTH_KEY_VALUE;
        $_sql="SELECT login, pass, permission, '{$_auth_key_value}' AS user_auth FROM administrators WHERE login = :login AND pass = :pass AND stat = :stat AND active = :active;";
        $_params=array(
            "login"=>$loginId,
            "pass"=>$password,
            "stat"=>AuthAdmin::STAT_REGISTERED,
            "active"=>AuthAdmin::ACTIVE_CONFIRMED,
        );
        $_login = Db::queryOne($_sql, $_params);
        if (!empty($_login)) {
            $_SESSION['login']=$_login['login'];
            $_SESSION['pass']=$_login['pass'];
            $_SESSION['permission']=$_login['permission'];
            $_SESSION['user_auth']=AuthAdmin::AUTH_KEY_VALUE;
            return true;
        }
        return false;
    }

    public static function loginEmail($email, $password) {
        $_auth_key_value=AuthAdmin::AUTH_KEY_VALUE;
        $_sql="SELECT login, pass, permission, '{$_auth_key_value}' AS {$_auth_key_value} FROM administrators WHERE email = :email AND pass = :pass AND stat = :stat AND active = :active;";
        $_params=array(
            "email"=>$email,
            "pass"=>$password,
            "stat"=>AuthAdmin::STAT_REGISTERED,
            "active"=>AuthAdmin::ACTIVE_CONFIRMED,
        );
        $_login = Db::queryOne($_sql, $_params);
        if (!empty($_login)) {
            $_SESSION['login']=$_login['login'];
            $_SESSION['pass']=$_login['pass'];
            $_SESSION['permission']=$_login['permission'];
            $_SESSION['user_auth']=AuthAdmin::AUTH_KEY_VALUE;
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
        if (!empty($_SESSION[AuthAdmin::AUTH_KEY_VALUE]) && $_SESSION[AuthAdmin::AUTH_KEY_VALUE]===AuthAdmin::AUTH_KEY_VALUE) {
            return true;
        }
        return false;
    }
}
