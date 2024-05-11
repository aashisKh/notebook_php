<?php

class dataBaseConnection
{
    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $conn;





    public function dbConnection()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password);
        if ($this->conn->connect_error) {

            die("Connection failed :" . $this->conn->connect_error);
        } else {

            $selectDatabase = mysqli_select_db($this->conn, "notebookdatabase");
            if (!$selectDatabase) {
                $sql = 'CREATE DATABASE notebookdatabase';
                if ($this->conn->query($sql) === TRUE) {
                    // echo "Database is created";
                    mysqli_select_db($this->conn, 'notebookdatabase');
                }
            } else {
                // echo " <br> Database is already present";
            }
        }
    }

    public function createUserLoginTable()
    {
        // mysqli_select_db($this->conn, 'notebookdatabase');
        $selecttable = ' SELECT 1 FROM usertable';

        if (!$this->conn->query($selecttable)) {
            // echo "table is not found";

            $table = "CREATE TABLE usertable (
                sn int(7) UNSIGNED AUTO_INCREMENT unique,
                ID varchar(255) unique primary key,
                Username varchar(30) unique not null,

                Password varchar(30) not null
                )";

            if ($this->conn->query($table) === TRUE) {
                // echo "table is created successfully";
            } else {
                // "Table cannot be created";
            }
        } else {
            // echo " <br> Table is already present";
        }
    }


    public function saveUserToDatabase($username, $password)
    {
        // mysqli_select_db($this->conn, 'notebookdatabase');

        $check =  "";
        // $sql = "SELECT ID FROM usertable where Username = '$username' and Password = '$password' ";

        // if ($this->conn->query($sql)) {
        //     $check = "false";
        // }
        $newID = md5($username);
        $newuser = "INSERT INTO usertable (ID , Username , Password) 
            VALUES ('$newID','$username' , '$password')";

        if ($this->conn->query($newuser)) {
            $check = $newID;
        }

        return $check;
    }
    
    public function selectDatabase()
    {
        mysqli_select_db($this->conn, 'notebookdatabase');
    }

    public function checkUserExistance($username ){
        $exist = "false";
        mysqli_select_db($this->conn, 'notebookdatabase');

        $checkUser = "SELECT ID FROM usertable where Username = '$username' ";
        $res = $this->conn->query($checkUser);
        if($res->num_rows > 0){
           $exist = "true";
        }
        return $exist;
    }
    
    public function checkUserLogin($username , $password){
        $exist = "false";
        mysqli_select_db($this->conn, 'notebookdatabase');

        $checkUser = "SELECT ID FROM usertable where Username = '$username' and Password = '$password' ";
        $res = $this->conn->query($checkUser);
        if($res->num_rows > 0){
           while($row = $res->fetch_assoc()){
            $exist = $row['ID'];
           }
        }
        return $exist;
    }

    public function checkUserID($userID){
        $contain = "false";
        $sql = "SELECT ID FROM usertable WHERE ID = '$userID' ";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            $contain = "true";
        }
        return $contain;
    }
    public function fetchUserData(){
        $userResponse = [];
        $sql = "SELECT * FROM usertable";
        $res = $this->conn->query($sql);
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                array_push($userResponse , $row);
            }
        }
        return $userResponse;
    }

    public function deleteUser($id){
        $sql = "DELETE FROM usertable where ID = '$id' ";
        $checkuser = "SELECT ID FROM usertable where ID = '$id' ";
        $res = $this->conn->query($checkuser);
        if($res->num_rows > 0){
            $this->conn->query($sql);
            return "true";
        }else{
            return "false";
        }
       
    }

    public function updateUserData($id , $username , $password){
        $newUserData = [];
        $newId = md5($id);
        $sql = "UPDATE usertable 
                SET ID = '$newId', Username = '$username' , Password = '$password'
                WHERE ID = '$id' ";
        if($this->conn->query($sql)) {
            $updated = "SELECT *  FROM usertable where ID = '$newId' ";
            $res = $this->conn->query($updated);
            while($row = $res->fetch_assoc()){
                array_push($newUserData , $row['ID']);
                array_push($newUserData , $row['Username']);
                array_push($newUserData , $row['Password']);
                
            }
            return $newUserData;
        }else{
            return "false";
        }       
    }

    public function searchUserName($username){
        $selectedUsers = [];
        $sql = "SELECT * FROM usertable WHERE Username LIKE '$username%' ";
        $response = $this->conn->query($sql);
        if($response->num_rows > 0){
            while($row = $response->fetch_assoc()){
                array_push($selectedUsers , $row);
            }
        }
        return $selectedUsers;
    }

    public function createUserPostTable(){
        $sql = "SELECT 1 from userpost";
        $res = $this->conn->query($sql);
        if(!$res){
            $tableQuery = "CREATE TABLE userpost(
                ID int(7) UNSIGNED AUTO_INCREMENT primary key,
                Username varchar(255)  not null,
                Title varchar(10) not null,
                Post varchar(1000),
                FOREIGN KEY (Username) REFERENCES usertable(Username)
                 ON DELETE CASCADE ON UPDATE CASCADE
            )";
            if($this->conn->query($tableQuery)){
                // echo "<br>Table is created";
            }else{
                // echo "<br>table cannot be created";
            }
        }else{
            // echo "<br>table already present";
        }
    }

    public function userPost($username , $title , $body){
        $newPost = [];
        $sql = "INSERT INTO userpost (Username , Title , Post) 
        VALUES ('$username' , '$title ', '$body')";
        $result = $this->conn->query($sql);
        if($result){
            $latestId = $this->conn->insert_id;
            $newInsertedValue = "SELECT * FROM userpost where ID = $latestId";
            $response = $this->conn->query($newInsertedValue);
            if($response->num_rows > 0){
                while($row = $response->fetch_assoc()){
                    array_push($newPost , $row);
                }
            }
        }else{
            echo "<br> post cannt be created";
        }
        return $newPost;
    }

    public function fetchUserPost($username){
        $getUserPost = [];
        $sql = "SELECT ID, Title , Post from userpost where Username = '$username' ";
        $res = $this->conn->query($sql);
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                array_push($getUserPost , $row);
            }
        }else{
            // echo "Post cannot be fetched";
        }
        return $getUserPost;
    }

    public function updateUserPost($id , $title , $body){
        $updatedPostData = [];
        $updateQuery = "UPDATE userpost SET 
        Title = '$title' , Post = '$body'
        where ID = $id ";

        $res = $this->conn->query($updateQuery);
        if($res){
            $selectQuery = "SELECT * FROM userpost where ID = $id";
            $result = $this->conn->query($selectQuery);
            if($result){
                while($row = $result->fetch_assoc()){
                    array_push($updatedPostData , $row);
                }
            }

        }else{
            echo "cannot update";
        }
        return $updatedPostData;
    }

    public function deleteUserPost($id){
        $sql = "DELETE FROM userpost where ID = $id";
        if($this->conn->query($sql)){
            echo "true";
        }else{
            echo "false";
        }
    }

    public function closeConnection(){
        $this->conn->close();
    }
}
