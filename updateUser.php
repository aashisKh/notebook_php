<?php

include 'databaseConnection.php';

$newUser = new dataBaseConnection();
$newUser->dbConnection();
$newUser->selectDatabase();
$id = $_POST['Id'];
$username = $_POST['Username'];
$password = $_POST['Password'];
// $checkUser = $newUser->checkUserExistance($username);
// if($checkUser == "true"){
//     echo "exist";
// }
// if($checkUser == "false"){
    $response = $newUser->updateUserData($id ,$username , $password);
    echo json_encode($response);
// }


$newUser->closeConnection();


?>