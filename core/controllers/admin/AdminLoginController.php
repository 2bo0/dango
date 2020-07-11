<?php
class AdminLoginController extends AdminAppController
{
    public function index() {
        if (AuthAdmin::isLogin()==true) {
            // ログインしている場合、

            // トップ画面にリダイレクトする
            Router::redirect('/admin/');
        }
        if (Router::isPost()==true) {
            // POST処理があった時、

            $v = new LoginValidation();
            $errors=$v->check($_POST);
            if (empty($errors)) {
                // エラーがなかった場合、

                if (AuthAdmin::loginId($_POST["login_id"], $_POST["password"])==true) {
                    // ログインIDでログインに成功した場合、

                    // トップ画面にリダイレクトする
                    Router::redirect('/admin/');
                } else if (AuthAdmin::loginEmail($_POST["login_id"], $_POST["password"])==true) {
                    // メールアドレスでログインに成功した場合、

                    // トップ画面にリダイレクトする
                    Router::redirect('/admin/');
                } else {
                    // ログインに失敗した場合、

                    $errors=array("screen_message"=>"loged in fails!");
                }
            }
        }

        $template = $this->twig->load('admin/login.html.twig');
        $data = array(
            'title' => 'sample',
            'errors' => empty($errors) ? null : $errors,
            'message'  => 'My Webpage11!',
        );
        echo $template->render($data);
    }
}