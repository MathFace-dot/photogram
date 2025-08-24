<?php
//require_once "Database.class.php";

class UserSession
{
    /**
     * This function will return a session ID if username and password is correct.
     *
     * @return SessionID
     */

    // public $data;
    // public $id;
    // public $conn;
    // public $token;
    // public $uid;

    public static function authenticate($username, $password,$fingerprint=null)
    {   // if($fingerprint == null) {
            //$fingerprint = $_COOKIE['fingerprint'];
       // }
      //  print("...IN THE FINGERPRINT SESSION....");
       // print($_COOKIE['fingerprint']);

            //printf($username);
        $user = User::login($username, $password);
       // print_r($fingerprint);

         $userobj = new User($username);
        if ($user) {
           // print_r("............\n");
            //$user = new User($user);
            $conn = Database::getConnection();
            $ip = $_SERVER['REMOTE_ADDR'];
            $agent = $_SERVER['HTTP_USER_AGENT'];
            //$now = now();
            
            $fingerprint = $_POST['fingerprint']; //getting a fingerprint 

           // print($fingerprint);
            

            $token = md5(random_int(0, 9999999) . $ip . $agent . time());
           $sql = "INSERT INTO `session` (`uid`, `token`, `ip`, `user_agent`,`fingerprint`)
          VALUES ('$userobj->id', '$token', '$ip', '$agent','$fingerprint');";
            
            // $sql = "INSERT INTO `session` (`uid`, `token`,`login_time`,`ip`, `user_agent`)
            // VALUES ('$userobj->id', '$token','$now','$ip', '$agent')";
           // print($sql);
            //    print_r("............");

           //$s= $conn->query($sql);

            if($conn->query($sql)==true){
              // print("sql sucess  ");
                Session::set('session_token',$token);
                Session::set('fingerprint',$fingerprint);


                return $token;
            }else{
                //print("sql failed  ");
                return false;
            }
        } else {
           // print("user does not exist  ");
            return false;
        }
    }

    /*
    * Authorize function have has 4 level of checks
        1.Check that the IP and User agent field is filled.
        2.Check if the session is correct and active.
        3.Check that the current IP is the same as the previous IP
        4.Check that the current user agent is the same as the previous user agent

        @return true else false;
    */
    public static function authorize($token)
    {    print("getting token......\n");
        //print($token);
        
        try {
            $session = new UserSession($token);
            print_r("...... in session authorizeing ..........");
            //print_r($session);
            //print($_SERVER['REMOTE_ADDR']);
            //print($session->getUserAgent());
           // print($session->isValid());
            if (isset($_SERVER['REMOTE_ADDR']) and isset($_SERVER["HTTP_USER_AGENT"])) {
                if ($session->isValid() and $session->isActive()) {
                    if ($_SERVER['REMOTE_ADDR'] == $session->getIP()) {
                        if ($_SERVER['HTTP_USER_AGENT'] == $session->getUserAgent()) {
                            if ($session->getFingerprint() == $_COOKIE['fingerprint']) { //TODO: This is always true, fix it
                                Session::$user = $session->getUser();
                                return $session;
                            } else {
                                throw new Exception("FingerPrint doesn't match");
                            }
                        } else {
                            throw new Exception("User agent does't match");
                        }
                    } else {
                        throw new Exception("IP does't match");
                    }
                } else {
                   // $session->removeSession();
                    throw new Exception("Invalid session");
                }
            } else {
                throw new Exception("IP and User_agent is null");
            }
        } catch (Exception $e) {
            throw new Exception("Something is wrong");
        }
    }


    /**
     * Cunstruct a user session with the given token
     *
     * @param SessionToken $token
     */
    public function __construct($token)
    {  //print("In construction");
        //print($token);
        $this->conn = Database::getConnection();
        $this->token = $token;
        $this->data = null;
        $sql = "SELECT * FROM `session` WHERE `token`='$token' LIMIT 1";
       // print($sql);
        $result = $this->conn->query($sql);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $this->data = $row;
            $this->uid = $row['uid']; //Updating this from database
            //print(".....sql.......\n");
            //print($this->uid);
        } else {
            throw new Exception("Session is invalid.");
        }
    }

    public function getUser()
    {
        return new User($this->uid);
    }

    /**
     * Check if the validity of the session is within one hour, else it inactive.
     *
     * @return boolean
     */
    public function isValid()
    {
        print("....in is valid....");
        print($this->getFingerprint());
        if($_COOKIE['fingerprint'] == $this->getFingerprint()) {
            return true;
        } else {
            return false;
        }
        if (isset($this->data['login_time'])) {
            $login_time = DateTime::createFromFormat('Y-m-d H:i:s', $this->data['login_time']);
            if (3600 > time() - $login_time->getTimestamp()) {
                return true;
            } else {
                return false;
            }
        } else {
            throw new Exception("login time is null");
        }
    }

    public function getIP()
    {
        return isset($this->data["ip"]) ? $this->data["ip"] : false;
    }

    public function getUserAgent()
    {
        return isset($this->data["user_agent"]) ? $this->data["user_agent"] : false;
    }

    public function deactivate()
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $sql = "UPDATE `session` SET `active` = 0 WHERE `uid`=$this->uid";

        return $this->conn->query($sql) ? true : false;
    }

    public function isActive()
    {
        if (isset($this->data['active'])) {
            return $this->data['active'] ? true : false;
        }
    }

    public function getFingerprint()
    {
        if (isset($this->data['fingerprint'])) {
            return $this->data['fingerprint'] ? true : false;
        }
    }

    //This function remove current session
    public function removeSession()
    {
        if (isset($this->data['id'])) {
            $id = $this->data['id'];
            if (!$this->conn) {
                $this->conn = Database::getConnection();
            }
            $sql = "DELETE FROM `session` WHERE `id` = $id;";
            if ($this->conn->query($sql)) {
                return true;
            } else {
                return false;
            }
        }
    }
}
