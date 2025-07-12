<?php

include_once __DIR__ . "/../traits/SQLGetterSetter.trait.php";
class Post {
    //use SQLGetterSetter;
    public function __construct($id){
     $this->id = $id;
    // $this->conn = Database::getConnection();
    //  $this->table = 'posts';
    }

    public static function registerPost($text, $image_tmp) {
        if(isset($_FILES['post_image'])) {
            $author = Session::getUser()->getEmail();
            $image_name = md5($author.time()) . ".jpg"; #TODO: change the id gen algo
            $image_path = get_config('upload_path') . $image_name;
            if(move_uploaded_file($image_tmp, $image_path)){
                
                $insert_command = "INSERT INTO `posts` (`post_text`, `image_uri`, `like_count`, `uploaded_time`, `owner`)
                VALUES ('$text', 'https://c8.alamy.com/comp/RJR7N5/random-objects-on-black-background-vector-illustration-RJR7N5.jpg', '0', now(), '$author')";
                $db = Database::getConnection();
                if($db->query($insert_command)){
                    $id = mysqli_insert_id($db);
                    return new Post($id);
                } else {
                    return false;
                }
            }
            
        } else {
            throw new Exception("Image not uploaded");
        }
        
    }

    public function __call($name, $arguments)
    {
        $property = preg_replace("/[^0-9a-zA-Z]/", "", substr($name, 3));
        $property = strtolower(preg_replace('/\B([A-Z])/', '_$1', $property));
        if (substr($name, 0, 3) == "get") {
            return $this->_get_data($property);
        } elseif (substr($name, 0, 3) == "set") {
            return $this->_set_data($property, $arguments[0]);
        } else {
            throw new Exception("Post::__call() -> $name, function unavailable.");
        }
    }
    private function _get_data($var)
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $sql = "SELECT `$var` FROM `posts` WHERE `id` = $this->id";
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
        $sql = "UPDATE `posts` SET `$var`='$data' WHERE `id`=$this->id;";
        if ($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }


 
}
?>