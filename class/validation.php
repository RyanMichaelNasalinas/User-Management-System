<?php 

class Validation {


    //Validate Fields
    public function check_empty($data,$fields) {
        $msg = null;
        foreach($fields as $field) {
            if(empty($data[$field])) {
                $msg .= "<b>".ucfirst($field)."</b> field cannot be emptied<br/>";
            }
        }
        return $msg;
    }


    public static function helper_uc($field) {
        return ucfirst($field);
    }

    public static function helper_he($field) {
        return htmlentities($field);
    }

}




?>