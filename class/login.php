<?php 

class Login extends Database {

    public static $msg;
    public $success;

    public function login_user($username, $password) {
        global $database;
        $stmt = $database->connection->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s",$username);
        $stmt->execute();

        $result = $stmt->get_result();
        
        $num_rows = $result->num_rows;

        if($num_rows > 0) {

            $row = $result->fetch_assoc();

            if(password_verify($password, $row['password'])) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_type'] = $row['user_type'];
                $_SESSION['success'] = $this->success;
                return true;
            } else {
                return false;
            }
        }
    }

    public function logout() {
        session_destroy();
        header("Location: login.php");
    }

    public function is_loggedin($id,$location) {
        if($id == null) {
            return header("location:".$location);
        }
    }
}




?>