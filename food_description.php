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
        .place img{
            width:100%;
            height: 500px;
        }
        .food{
            display: inline-block;
            padding:10px;
        }
        .food img{
            width: 350px;
            height: 250px;
            border-radius: 10px;
            padding-top: 15px;
        }
        h2{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            padding-left: 10px;
        }
        #names{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: x-large;
        }
        #sub{
            display: inline-block;
            margin: 10px; 
            background-color:whitesmoke;
            border-radius: 10px;
        }
        #desc{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: large;
            margin-bottom: 15px;
        }
        #foodname{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: large;
            text-align: center;
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
        $foodplaceid=$_GET['id'];

        $sql="SELECT name,description,img FROM foodplace WHERE foodplaceid='$foodplaceid'";
        $res=$conn->query($sql); 
        
        echo "<div class=content>";
        echo "<div id=main>";
        if ($res->num_rows > 0) {
            // Loop through each place and display its image and name
            while ($row = $res->fetch_assoc()) {
                echo '<div class="place">';
                echo "<div><img src='".$row['img']."'></div>";
                echo "<div id=names><p><h1>".$row['name']."</h1></p></div>"; 
                echo "<div id=desc><p>".$row['description']."</p></div>"; 
                echo '</div>';
            }
        } 
        echo "</div>";

        $sql1="SELECT name,img FROM foods WHERE foodplaceid='$foodplaceid'";
        $foodres=$conn->query($sql1);

        echo "<div id=sub>";
        echo "<h2>You can try</h2>";
        if($foodres->num_rows > 0){
         
            while($row=$foodres->fetch_assoc()){
                echo "<div class=food>";
                echo "<div><img src='".$row['img']."'></div>";
                echo "<div id=foodname><p>".$row['name']."</p></div>";
                echo "</div>";
            }
        }
        echo "</div>";

        echo "</div>";
        $conn->close();
        ?>
    </main>
    </body>
</html>