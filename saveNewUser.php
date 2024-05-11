<?php

include 'databaseConnection.php';

$newUser = new dataBaseConnection();
$newUser->dbConnection();
$newUser->selectDatabase();
$newUser->createUserLoginTable();

$username = $_POST['username'];
$password = $_POST['password'];
$type = $_POST['type'];
if($type == "signup"){
    $checkUser = $newUser->checkUserExistance($username);
    if($checkUser == "true"){
        echo "exist";
    }else{
        $val = $newUser->saveUserToDatabase($username ,$password);
        echo $val;

    }

}

if($type == "login"){
    $val = $newUser->checkUserLogin($username ,$password);
    echo $val;   
}

// $response = $newUser->saveUserToDatabase("aashis6" , "12345");
// echo $response;

?>