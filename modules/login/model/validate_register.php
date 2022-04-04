<?php

    function validate($email){
        $dao = new DAOLogin();
        if($dao->select_email($email)){
            $check=false;
        }else {
            $check=true;
        }
        return $check;
    }

    function validate_username($username){
        $dao = new DAOLogin();
        if($dao->select_user_validate($username)){
            $check=false;
        }else {
            $check=true;
        }
        return $check;
    }

?>