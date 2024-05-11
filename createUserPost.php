<?php



include 'databaseConnection.php';

$newUser = new dataBaseConnection();
$newUser->dbConnection();
$newUser->selectDatabase();
$username = $_POST['User'];
$title = $_POST['Title'];
$body = $_POST['Body'];
$userPost = $newUser->userPost($username , $title , $body);
echo json_encode($userPost);

?>