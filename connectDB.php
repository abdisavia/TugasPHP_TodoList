<?php
$severname = "localhost";
$username ="root";
$password ="";
$dbName = "todolist";

$conn = mysqli_connect($severname, $username, $password,$dbName);

if($conn -> connect_error){
    die("Connection failed: " . $conn ->connect_error);
}
?>