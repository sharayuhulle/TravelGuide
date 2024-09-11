<?php
session_start();
include "connection.php";

if(isset($_SESSION['user']) && isset($_SESSION['placeid']) && isset($_POST['review'])) {
    $username = $_SESSION['user'];
    $placeid = $_SESSION['placeid'];
    $review = $_POST['review'];

    $sql = "INSERT INTO reviews (placeid, name, review) VALUES ( '$placeid', '$username',' $review')";
    

    if($res=$conn->query($sql)=== true){
        echo "Review submitted successfully";
    }
    else{
        echo "Invalid request";
    }
    
}

?>