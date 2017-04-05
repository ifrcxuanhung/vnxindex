<?php

class Auth extends Models {

    public $type = 'shop_owner';
    private $errors = array();
    public $minval = 3;
    public $maxval = 22;
    public $minpass = 3;
    public $info;

    function __construct() {
        parent::__construct();
        @session_start();
    }

    public function login($email, $pass) {
        $err = false;
        $data = null;
        $password = md5($pass);
        if (!$this->email($email)) {
            $this->errors[] = 'Email invalid.';
            $err = true;
        }
        if ($err == false) {
            if ($this->type == 'cv') {
                $field = 'cv_id';
            } else {
                $field = 'id';
            }
            $sql = "SELECT $field  FROM $this->type WHERE email='" . $email . "' AND password='" . $password . "' AND active=1";
            
            $result = $this->fetchobject($sql);
            if ($result) {
                $data->type = $this->type;
                $data->id = $result->$field;
                $this->set_session('user', $data);
                return 1;
            }
            $this->errors[] ='Mauvais nom d`utilisateur ou mot de passe';
            return $this->errors;
        }
    }

    // Email validation
    private function email($email) {
        $reg = "#^(((([a-z\d][\.\-\+_]?)*)[a-z0-9])+)\@(((([a-z\d][\.\-_]?){0,62})[a-z\d])+)\.([a-z\d]{2,6})$#i";
        if (!preg_match($reg, $email)) {
            return false;
        } else {
            return true;
        }
    }

    private function set_session($name, $value) {
        $_SESSION[$name] = $value;
    }

    private function destroy_session($name) {
        unset($_SESSION[$name]);
    }

    public function logout() {
        self::destroy_session('user');
        Redirect(WEBSITE_URL);
    }

    public function check() {
        if (isset($_SESSION['user'])) {
            return TRUE;
        }
        return FALSE;
    }

    public function get_info() {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']->type == 'cv') {
                $field = 'cv_id';
            } else {
                $field = 'id';
            }
            $sql = "SELECT *  FROM " . $_SESSION['user']->type . " WHERE $field='" . $_SESSION['user']->id . "'";
            $result = $this->fetchobject($sql);
            if($result){
                $result->type=$_SESSION['user']->type;
            }
            return $result;
        }
        return FALSE;
    }
}
?>
