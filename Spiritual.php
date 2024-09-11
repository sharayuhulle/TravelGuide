<?php
session_start();
?>
<html>
    <head>
     <style>
        header {
            /* background-color: #7209b7;  */
            background-color: #7209b7;
            padding: 10px; /* Add some padding for better visual */
            /* width:100%; */
            height:60px;
            margin-bottom: 15px;
        }
        nav a{
            color:white;
            padding: 15px;
            padding-left: 30px;    
        }
        header div{
            color:white;
            padding-left: 10px;
        }
        .content{
            padding-top: 20px;
        }
        .place img{
            width: 900px;
            height: 500px;
            margin-left: 50px;
        }
        h1{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: xx-large;
            padding: 10px;
            padding-bottom:30px ;
        }
        h2{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            padding-left: 10px;
        }
        #desc{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: large;
            padding-left: 10px;
        }
     </style>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function confirmLogout() {
            var confirmed = confirm("Are you sure you want to logout?");
            if (confirmed) {
                window.location.href = "logout.php"; // Redirect to logout script if confirmed
            }
        }
    </script>
    </head>
    <body>
    <header>
            <nav>
            <a href="main.php">Home</a>
            <a href="login.html">Login</a>
            <a onclick="confirmLogout()"  style="cursor: pointer;">Logout</a>
            <a href="signup.html">Signup</a>
            <div><?php
                // Check if user is logged in and display username
                if(isset($_SESSION['user'])) {
                   echo '<h4>Hi, ' . $_SESSION['user'] . '</h4>';
                }
                ?></div>
            </nav>
    </header>

    <main>
        <?php
        // session_start();
        include "connection.php";

        $sql="SELECT name,description,img FROM spiritual";
        $res=$conn->query($sql);
        echo "<div class=content>";
        echo "<h1>Spiritual Places</h1>";
        if($res->num_rows>0){
            while($row=$res->fetch_assoc()){
                echo "<div class=place>";
                echo "<div><img src='".$row['img']."'></div>";
                echo "<div id=names><p><h2>".$row['name']."</h2></p></div>"; 
                echo "<div id=desc><p>".$row['description']."</p></div>"; 
                echo "</div>";
            }
        }
        echo "</div>";
        $conn->close();
        ?>
    </main>
    </body>
</html>