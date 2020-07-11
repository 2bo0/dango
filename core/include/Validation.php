<?php
class Validation {

    private $charset="UTF-8";
    private $rules=null;
    private $errors=null;
    private $error_msg_templates=array(
        "empty"=>"{{label}} is empty!",
        "alpha"=>"{{label}} is alphabet!",
        "numeric"=>"{{label}} is numeric!",
        "maxLength"=>"{{label}} is maxLength {{max-length}}!",
        "minLength"=>"{{label}} is minLength {{min-length}}!",
        "datetime"=>"{{label}} is datetime!",
        "date"=>"{{label}} is date!",
        "time"=>"{{label}} is time!",
        "hour"=>"{{label}} is hour 00-23!",
        "minute"=>"{{label}} is minute 00-59!",
        "second"=>"{{label}} is second 00-59!",
    );
    private $error_msg_replace_params=array(
        "empty"=>null,
        "alpha"=>null,
        "numeric"=>null,
        "maxLength"=>array(
            "{{max-length}}"
        ),
        "minLength"=>array(
            "{{min-length}}"
        ),
        "between"=>array(
            "{{between-from-val}}",
            "{{between-to-val}}",
        ),
        "datetime"=>null,
        "date"=>null,
        "time"=>null,
        "hour"=>null,
        "minute"=>null,
        "second"=>null,
    );

    function __construct() {
    }

    public function setRules($rules) {
        if (is_array($rules)==false || is_array($rules) && count($rules)==0) {
            return;
        }
        $this->rules=$rules;
    }

    public function check($data_array) {
        $this->errors=null;
        if (is_array($data_array)==false||is_array($data_array) && empty($data_array)) {
            return false;
        }
        if (is_array($this->rules)==false || is_array($this->rules) && count($this->rules)==0) {
            echo "no rules!";
            exit(1);
        }
        foreach ($this->rules as $key => $value) {
            if (empty($value['rule']) || empty($value['label'])) {
                echo "rule config error!";
                exit(1);
            }
        }
        foreach ($this->rules as $key => $value) {
            $data="";
            if (array_key_exists($key,$data_array)) {
                $data=$data_array[$key];
            }

            $rules=explode("|",$value['rule']);
            foreach ($rules as $rule) {
                if (preg_match('/^([a-zA-Z¥d]+)[¥(]([!-~]+)[¥)]$/', $rule, $m)) {
                    $validation_func = array( $this, "{$m[1]}Validation" );
                    $params_values=explode(",", $m[2]);
                    if($validation_func($data, $params_values)==false) {
                        $rep_params=null;
                        if ($params_values!==null && is_array($params_values) && $this->error_msg_replace_params[$m[1]]!==null) {
                            $params_keys=$this->error_msg_replace_params[$m[1]];
                            $rep_params=array();
                            foreach ($params_keys as $k => $v) {
                                $rep_params[$v]=$params_values[$k];
                            }
                        }
                        $error_msg_template=$this->error_msg_templates[$m[1]];
                        if (array_key_exists("error_msg_templates", $this->rules[$key]) && array_key_exists($m[1], $this->rules[$key]["error_msg_templates"])) {
                            $error_msg_template=$this->rules[$key]["error_msg_templates"][$m[1]];
                        }
                        $this->addError($key, $error_msg_template, $rep_params);
                    }
                } else {
                    $validation_func = array( $this, "{$rule}Validation" );
                    if($validation_func($data)==false) {

                        $error_msg_template=$this->error_msg_templates[$rule];
                        if (array_key_exists("error_msg_templates", $this->rules[$key]) && array_key_exists($rule, $this->rules[$key]["error_msg_templates"])) {
                            $error_msg_template=$this->rules[$key]["error_msg_templates"][$rule];
                        }
                        $this->addError($key, $error_msg_template);
                    }
                }
            }
        }
        return $this->errors;
    }

    private function addError($field, $msg, $params=null) {
        if ($this->errors==null) {
            $this->errors=array();
        }
        $msg=str_replace('{{label}}',$field,$msg);
        if ($params!==null && is_array($params)) {
            foreach ($params as $k => $v) {
                $msg=str_replace($k,$v,$msg);
            }
        }
        if (array_key_exists($field, $this->errors)===false) {
            $this->errors[$field]=$msg;
        } else {
            $this->errors[$field].=$msg;
        }
    }

    private function emptyValidation($v) {
        if (!empty($v)) {
            return true;
        }
        return false;
    }

    private function alphaValidation($v) {
        if (preg_match('/^[a-zA-Z]+$/', $v, $m)) {
            return true;
        }
        return false;
    }

    private function numericValidation($v) {
        if (preg_match('/^\d+$/', $v, $m)) {
            return true;
        }
        return false;
    }

    private function maxLengthValidation($v, $params) {
        if (mb_strlen($v, $this->charset)<=$params[0]) {
            return true;
        }
        return false;
    }

    private function minLengthValidation($v, $params) {
        if (mb_strlen($v, $this->charset)>=$params[0]) {
            return true;
        }
        return false;
    }

    private function datetimeValidation($v) {
        if (preg_match('/^(2[0-9]{3})\/(0[1-9]|1[0-2])\/([0-2][0-9]|3[0-1])\s([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/', $v, $m)) {
            return true;
        }
        return false;
    }

    private function dateValidation($v) {
        if (preg_match('/^(2[0-9]{3})\/(0[1-9]|1[0-2])\/([0-2][0-9]|3[0-1])$/', $v, $m)) {
            return true;
        }
        return false;
    }

    private function timeValidation($v) {
        if (preg_match('/^([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/', $v, $m)) {
            return true;
        }
        return false;
    }

    private function hourValidation($v) {
        if (preg_match('/^([01][0-9]|2[0-3])$/', $v, $m)) {
            return true;
        }
        return false;
    }

    private function minuteValidation($v) {
        if (preg_match('/^([0-5][0-9])$/', $v, $m)) {
            return true;
        }
        return false;
    }

    private function secondValidation($v) {
        if (preg_match('/^([0-5][0-9])$/', $v, $m)) {
            return true;
        }
        return false;
    }
//
//    private function mb_str_replace($search, $replace, $subject, $encoding = null) {
//        $tmp = mb_regex_encoding();
//        mb_regex_encoding(func_num_args() > 3 ? $encoding : mb_internal_encoding());
//        foreach ((array)$search as $i => $s) {
//            if (!is_array($replace)) {
//                $r = $replace;
//            } elseif (isset($replace[$i])) {
//                $r = $replace[$i];
//            } else {
//                $r = '';
//            }
//            $s = mb_ereg_replace('[.\\\\+*?\\[^$(){}|]', '\\\\0', $s);
//            $subject = mb_ereg_replace($s, $r, $subject);
//        }
//        mb_regex_encoding($tmp);
//        return $subject;
//    }
}