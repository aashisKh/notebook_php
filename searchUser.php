<?php


include 'databaseConnection.php';

$newUser = new dataBaseConnection();
$newUser->dbConnection();
$newUser->selectDatabase();
$username = $_POST['User'];
$response = $newUser->searchUserName($username);

echo json_encode($response);

?>