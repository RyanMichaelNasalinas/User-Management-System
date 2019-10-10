<?php 

class Validation {
    
    //Validate Fields
    public function check_empty($data,$fields) {
        $msg = null;
        foreach($fields as $field) {
            if(empty($data[$field])) {
                $msg .= "<b>".ucfirst($field)." ,"."</b>";
            }
        }
        return $msg;
    }

    public function is_admin($user_type) {
        if($user_type == "administrator") {
            return true;
        } else {
            return false;
        }
    }
    
    public function redirect($location) {
        return header("Location:$location");
    }


    public static function helper_uc($field) {
        return ucfirst($field);
    }

    public static function helper_he($field) {
        return htmlentities($field);
    }

}




?>