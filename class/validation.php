<?php 

class Validation extends Database {
    
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

    //Select Duplicate Username
    public function check_username($username)
    {
        $stmt = $this->connection->prepare("SELECT username FROM users WHERE username = ? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();
        $num_rows = $result->num_rows;

        if ($num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }


    //Select Duplicate Email 
    public function check_email($email) {
        $stmt = $this->connection->prepare("SELECT email FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $num_rows = $result->num_rows;

        if ($num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function compare_password($password, $confirm_password) {
        if($password != $confirm_password) {
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