<?php

include 'databaseConnection.php';

$newUser = new dataBaseConnection();
$newUser->dbConnection();
$newUser->selectDatabase();
$userId = $_POST['Id'];
$response = $newUser->deleteUser($userId);
$newUser->closeConnection();
echo $response;
?>