<?php

//require_once "Database.class.php";

class User
{
    private $conn;

    // public $id;
    // public $username;
    // public $table;

    public function __call($name, $arguments)
    {
        $property = preg_replace("/[^0-9a-zA-Z]/", "", substr($name, 3));
        $property = strtolower(preg_replace('/\B([A-Z])/', '_$1', $property));
        if (substr($name, 0, 3) == "get") {
            return $this->_get_data($property);
        } elseif (substr($name, 0, 3) == "set") {
            return $this->_set_data($property, $arguments[0]);
        }
    }


    public static function signup($username, $password, $email, $phone)
    {
        $options = [
            'cost' => 9,
        ];
        $pass = password_hash($password, PASSWORD_BCRYPT, $options);
        $conn = Database::getConnection();
        $sql = "INSERT INTO `auth` (`username`, `password`, `email`, `phone`)
        VALUES ('$username', '$pass', '$email', '$phone');";
        $error = false;
      

        try {
            if ($conn->query($sql) === TRUE) {
                //echo "Success";
                $error = false;
                //return true;
            }

        } catch (mysqli_sql_exception $e) {
           //echo "Error: " . $e->getMessage();
            $error = $e->getMessage();
            //return false;
        }
    
        $conn->close();
        return $error;
    }

       public static function login($email, $password){
        $query = "SELECT * FROM `auth` WHERE `email` = '$email' OR `username` = '$email'";
        //print($query);
        $conn = Database::getConnection();
        $result = $conn->query($query);
        if ($result->num_rows >= 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])){
              // print("password sucess");
                return $row;
            } else {
                //print("password failed");
                return false;
            }
        } else {
            //print("db fail");
            return false;
        }
    }


    public function __construct($user)
    {    //print("...........user......\n");
        // print_r($user);
         //print("..................");
        $this->conn = Database::getConnection();
        $this->user = $user;
        $this->id = null;
        $sql = "SELECT `id` FROM `auth` WHERE `username`= '$user' LIMIT 1";
        //print($sql);
        $result = $this->conn->query($sql);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $this->id = $row['id']; //Updating this from database
        } else {
            throw new Exception("Username does't exist");
        }


    }


    private function _get_data($var)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $sql = "SELECT `$var` FROM `users` WHERE `id` = $this->id";
        //print($sql);
        $result = $this->conn->query($sql);
        if ($result and $result->num_rows == 1) {
            //print("Res: ".$result->fetch_assoc()["$var"]);
            return $result->fetch_assoc()["$var"];
        } else {
            return null;
        }
    }

    //This function helps to  set the data in the database
    private function _set_data($var, $data)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $sql = "UPDATE `users` SET `$var`='$data' WHERE `id`=$this->id;";
        if ($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function setDob($year, $month, $day)
    {
        if (checkdate($month, $day, $year)) { //checking data is valid
            return $this->_set_data('dob', "$year.$month.$day");
        } else {
            return false;
        }
    }

    public function getUsername()
    {
        return $this->user;
    }


    public function authenticate()
    {
    }

  

   
}
