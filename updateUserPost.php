<?php

include 'databaseConnection.php';

$newUser = new dataBaseConnection();
$newUser->dbConnection();
$newUser->selectDatabase();
$id = $_POST['Id'];
$title = $_POST['Title'];
$body = $_POST['Body'];
$response = $newUser->updateUserPost($id , $title , $body);

$newUser->closeConnection();

echo json_encode($response);
?>