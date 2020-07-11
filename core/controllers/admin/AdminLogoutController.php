<?php
class AdminLogoutController extends AdminAppController
{
    public function index() {
        if (AuthAdmin::isLogin()==false) {
            // ログインしていない場合、

            // ログイン画面にリダイレクトする
            Router::redirect('/admin/login');
        }
        // ログインしている場合、

        // ログアウトする
        AuthAdmin::logout();

        // ログイン画面にリダイレクトする
        Router::redirect('/admin/login');
    }
}