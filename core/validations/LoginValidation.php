<?php
class LoginValidation {

    private $rules=array(
        "login_id"=>array(
            "rule"=>"empty|minLength(5)|maxLength(12)",
            "label"=>"ログインID",
            "error_msg_templates"=>array(
                "empty"=>"ログインIDを入力してください",
            ),
        ),
        "password"=>array(
            "rule"=>"empty",
            "label"=>"パスワード",
        ),
    );

    function __construct() {
    }

    public function check($data) {
        $v = new Validation();
        $v->setRules($this->rules);
        return $v->check($data);
    }
}