<?php

include 'databaseConnection.php';

$newUser = new dataBaseConnection();
$newUser->dbConnection();
$newUser->selectDatabase();
$response = $newUser->checkUserID($_COOKIE['key']);

if($response == "false"){
    echo $response;
}else{
    echo $response;
}



?>