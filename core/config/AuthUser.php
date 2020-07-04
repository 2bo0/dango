<?php
class AuthUser {

    const DB_TABLE_NAME="users";

    const AUTH_PERMISSION_NON=0;
    const AUTH_PERMISSION_USER=1;

    private static $auth_permissions = array(
        AuthUser::AUTH_PERMISSION_NON => "Not set",
        AuthUser::AUTH_PERMISSION_USER => "User",
    );

    const ACTIVE_NON=0;
    const ACTIVE_ALLOWED=1;
    const ACTIVE_CHECKING=8;
    const ACTIVE_DENIED=9;

    private static $actives = array(
        AuthUser::ACTIVE_NON => "Not set",
        AuthUser::ACTIVE_ALLOWED => "Allowed",
        AuthUser::ACTIVE_CHECKING => "Checking",
        AuthUser::ACTIVE_DENIED => "Denied",
    );

    public static function login() {
        return false;
    }

    public static function logout() {
        return false;
    }

    public static function getActive() {
        return false;
    }

    public static function isLogin() {
        return false;
    }
}
