<?php



include 'databaseConnection.php';

$newUser = new dataBaseConnection();
$newUser->dbConnection();
$newUser->selectDatabase();
$newUser->createUserPostTable();
// $newUser->userPost();
$user = $_POST['User'];
$userPost = $newUser->fetchUserPost($user);
echo json_encode($userPost);
?>