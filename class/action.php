<?php 

class Action {

    public $id;
    public $firstname;
    public $lastname;
    public $age;
    public $gender;
    public $username;
    public $password;
    public $email;
    public $user_type;

    // Select all users
    public function display_user() {
        $query = "SELECT * FROM users";
        $result = $this->connection->query($query);

        if($result == false) {
            return false;
        }

        $rows = [];

        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    //Select user by id
    public function display_userby_id($id) {
        $query = "SELECT * FROM users WHERE id = $id";
        return $query;
    }

    //Add new user
    public function add_user() {
        $stmt = $this->connection->prepare("INSERT into users (`firstname`,`lastname`,`age`,`gender`,`username`,`password`,`email`,`user_type`) VALUES (?,?,?,?,?,?,?,?);");
        $stmt->bind_param("ssisssss", $this->firstname,$this->lastname,$this->age,$this->gender,$this->username,$this->password,$this->email,$this->user_type);
        $stmt->execute(); 

        if($stmt) {
            $stmt->close();
            return true;
        } else {
            return false;
        }
        return $stmt;
    }

    //Delete user
    public function delete_user($id) {
        $stmt = $this->connection->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if($stmt) {
            $stmt->close();
            return true;
        } else {
            return false;
        }
        return $stmt;
    }

    //Update user
    public function update_user($id) {
        $stmt = $this->connection->prepare("UPDATE users SET firstname = ?,  lastname = ?, age = ?, gender = ?, username = ?, email = ?, user_type = ? WHERE id = $id");
        $stmt->bind_param("ssissss", $this->firstname,$this->lastname, $this->age,$this->gender,$this->username,$this->email,$this->user_type);
        $stmt->execute();

        if($stmt) {
            $stmt->close();
            return true;
        } else {
            return false;
        }
        return $stmt;
    }
}






?>