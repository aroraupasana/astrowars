<?php                                //to insert or update user data to the database 
class User {
    private $dbHost     = "localhost";
    private $dbUsername = "upasana";
    private $dbPassword = "anasapu@123";
    private $dbName     = "Astrowars";
    private $userTbl    = "users";

	
	function __construct(){        if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
echo '<script>console.log("connection done")</script>';
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
	
	function checkUser($userData = array()){ 
        if(!empty($userData)){
            //Check whether user data already exists in database
            $prevQuery = "SELECT * FROM ".$this->userTbl." WHERE oauth_provider = '".$userData['oauth_provider']."' AND oauth_uid = '".$userData['oauth_uid']."'";
            $prevResult = $this->db->query($prevQuery);
            if($prevResult->num_rows > 0){
                //Update user data if already exists
                $query = "UPDATE ".$this->userTbl." SET first_name = '".$userData['first_name']."', last_name = '".$userData['last_name']."',tank_name = '".$userData['tank_name']."', email = '".$userData['email']."', mobile = '".$userData['mobile']."', gender = '".$userData['gender']."', locale = '".$userData['locale']."', picture = '".$userData['picture']."', link = '".$userData['link']."', modified = '".date("Y-m-d H:i:s")."' WHERE oauth_provider = '".$userData['oauth_provider']."' AND oauth_uid = '".$userData['oauth_uid']."'";
                $update = $this->db->query($query);
            }else{
                //Insert user data
                // "SELECT CONCAT((first_name ,last_name ) FROM users";
               // "SELECT first_name + id As tank_name FROM users";
              //"SELECT CONCAT(first_name ,last_name ) As tank_name FROM users";
             //$this->db->query("SELECT CONCAT(first_name , last_name ) As tank_name FROM users");
             //$this->db->query("SELECT first_name , last_name ,first_name + " " + last_name  As tank_name //FROM users");
                $query = "INSERT INTO ".$this->userTbl." SET oauth_provider = '".$userData['oauth_provider']."', oauth_uid = '".$userData['oauth_uid']."', first_name = '".$userData['first_name']."', last_name = '".$userData['last_name']."',tank_name = '".$userData['tank_name']."', email = '".$userData['email']."', mobile = '".$userData['mobile']."', gender = '".$userData['gender']."', locale = '".$userData['locale']."', picture = '".$userData['picture']."', link = '".$userData['link']."', created = '".date("Y-m-d H:i:s")."', modified = '".date("Y-m-d H:i:s")."'";
               // $this->db->query("SELECT CONCAT(first_name , last_name ) As tank_name FROM users");
                $insert = $this->db->query($query);

            }
            
            //Get user data from the database
            $result = $this->db->query($prevQuery);
            $userData = $result->fetch_assoc();
        }
        
        //Return user data
        return $userData;
    }
}
?>