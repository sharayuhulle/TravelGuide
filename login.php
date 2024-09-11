<?php
session_start();
include "connection.php";

$name=$_GET['username'];
$pwd=$_GET['password'];

$sql = "SELECT * FROM personinfo WHERE name = '$name' AND password = '$pwd'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, set session variables and redirect to main.php
    $_SESSION['user'] = $name;
    // header("Location: main.php");
    // exit();
    echo "success";
} else {
    // User not found, display message and provide a link to login.html
    // echo "Unknown user. Please login first. <a href='login.html'>Login</a>";
    echo "error";
}