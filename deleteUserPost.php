<?php



include 'databaseConnection.php';

$newUser = new dataBaseConnection();
$newUser->dbConnection();
$newUser->selectDatabase();
$id = $_POST['ID'];
$response = $newUser->deleteUserPost($id);
echo $response;
?>