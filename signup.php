<?php
session_start();
include "connection.php";
$name=$_GET['username'];
$pwd=$_GET['password'];

$_SESSION['user']=$name;
$_SESSION['pwd']=$pwd;

$sql = "INSERT INTO personinfo (name, password) VALUES ('$name', '$pwd')";
// $res=$conn->query($sql);

if($res=$conn->query($sql)){
    echo "Login Successful";
    header("Location: main.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
?>