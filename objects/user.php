<!--***********************
    Written by David Tullis
    Last Modified - 4/19/20
    ***********************-->


<?php
// The class which has the functions that check for username and password at login
class User{
 
    
    private $conn;
    private $table_name = "users";
 
    
    public $user_id;
    public $name;
    public $address;
    public $acc_commision;
    public $password;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
    
 
    // check if given user_id exist in the database
    function idExists(){
    
        // query to check if user_id exists
        $query = "SELECT name, password, acc_commision, address
                FROM " . $this->table_name . "
                WHERE user_id = ?
                LIMIT 0,1";
    
        // prepare the query
        $stmt = $this->conn->prepare( $query );
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        $stmt->bindParam(1, $this->user_id);
        $stmt->execute();
    
        // get number of rows
        $num = $stmt->rowCount();
    
        // if user_id exists, assign values to object properties for easy access and use for php sessions
        if($num>0){
    
            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // assign values to object properties
            $this->name = $row['name'];
            $this->address = $row['address'];
            $this->acc_commision = $row['acc_commision'];
            $this->password = $row['password'];
    
            // return true because user_id exists in the database
            return true;
        }
    
        // return false if user_id does not exist in the database
        return false;
    }

    function passwordExists(){
    
        // query to check if user_id exists
        $query = "SELECT user_id, name, acc_commision, address
                FROM " . $this->table_name . "
                WHERE password = ?
                LIMIT 0,1";
    
        $stmt = $this->conn->prepare( $query );
        $this->password=htmlspecialchars(strip_tags($this->password));
        $stmt->bindParam(1, $this->password);
        $stmt->execute();
    
        // get number of rows
        $num = $stmt->rowCount();
    
        // if user_id exists, assign values to object properties for easy access and use for php sessions
        if($num>0){
    
            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // assign values to object properties
            $this->name = $row['name'];
            $this->address = $row['address'];
            $this->acc_commision = $row['acc_commision'];
            $this->user_id = $row['user_id'];
    
            // return true because user_id exists in the database
            return true;
        }
    
        // return false if user_id does not exist in the database
        return false;
    }

}