<?php

include 'databaseConnection.php';

$newUser = new dataBaseConnection();
$newUser->dbConnection();
$newUser->selectDatabase();

$newUser->deleteUser(82);
$response = $newUser->fetchUserData();
$newUser->closeConnection();

echo json_encode($response);
 
?>