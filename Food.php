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
        header div{
            color:white;
            padding-left: 10px;
        }

        nav a{
            color:white;
            padding: 15px;
            padding-left: 30px;
            
        }
        h1{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            padding-left: 10px;
        }
        #im{
             width: 350px;
            height: 250px;
            border-radius: 10px;
            padding-top: 15px;
        }
        #names{
            font-size: larger;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            text-align: center;
        }
        #places{
            display: inline-block;
            margin: 10px; 
            background-color:whitesmoke;
            border-radius: 10px;
            
        }
        .foodplaces{
            display:inline-block;
            padding:10px;
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
    //  session_start();
     include "connection.php";

     $sql="SELECT foodplaceid,name,img FROM foodplace";

     $res=$conn->query($sql);

     

     echo "<div id=places>";
     echo"<h1>Food Destinations</h2>";
     if ($res->num_rows > 0) {
        // Loop through each place and display its image and name
        while ($row = $res->fetch_assoc()) {
            echo '<div class="foodplaces">';
            echo "<a href='food_description.php?id=".$row['foodplaceid']."'>"; // Link to description.php with placeid as query parameter
            echo "<img id=im src='".$row['img']."'>";
            echo "</a>";
            echo "<div id=names><p>".$row['name']."</p></div>"; 
            echo '</div>';
        }
    }
    $conn->close();
    echo "</div>"; 
     ?>
    </main>
    </body>
</html>