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

        .mustvisitsub {
    display: inline-block; /* Display the divs in a line */
    margin: 10px; /* Add margin between each div */

        }
      
        .mustvisit img{
            width:100%;
            height: 500px;
        }
        .mustvisitsub img{
            width: 350px;
            height: 250px;
            border-radius: 10px;
            padding-top: 15px;
        }
        #im{
            border-radius: 10px;
        }
        #names{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: x-large;
        }
        #desc{
            font-size: larger;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        #subnames{
            font-size: larger;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            text-align: center;
        }
        h2{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            padding-left:10px;
            padding-top: 5px;
        }
        #subplace{
            display: inline-block;
            margin: 10px; 
            background-color:whitesmoke;
            border-radius: 10px;
            height: 350px;
        }
        #time {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            background-color: whitesmoke;
            border-radius: 10px;
        }
        #time p{
            font-size:large;
            padding-bottom:10px;
            padding-left: 10px;
        } 
        #reviews{
            font-size: larger;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            background-color: whitesmoke;
            border-radius: 10px;
        }
        #reviews p{
            padding-left:10px;
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
            $placeid=$_GET['id'];
            $_SESSION['placeid']=$placeid;

            $sql="SELECT name,description,img,besttime FROM mustvisit WHERE placeid='$placeid'";
            $res=$conn->query($sql);
            
            echo "<div class=content>";
            echo "<div id=mainplace>";
            if ($res->num_rows > 0) {
                // Loop through each place and display its image and name
                while ($row = $res->fetch_assoc()) {
                    $best_time=$row['besttime'];
                    echo '<div class="mustvisit">';
                    echo "<div id=im><img src='".$row['img']."'></div>";
                    
                    echo "<div id=names><p><h1>".$row['name']."</h1></p></div>"; 
                    echo "<div id=desc><p>".$row['description']."</p></div>"; 
                    echo '</div>';
                }
            } else {
                // If no places are found, display a message
                echo "No places found";
            }
        echo "</div>";

        echo "<h2>You can explore</h2>";
        
        $sqlplaces="SELECT subplaceid,name,img FROM mustvisitsub WHERE placeid='$placeid'";
        $resplaces=$conn->query($sqlplaces);
        echo "<div id=subplace>";
        if ($resplaces->num_rows > 0) {
            // Loop through each place and display its image and name
            while ($row = $resplaces->fetch_assoc()) {

                echo '<div class="mustvisitsub">';
                echo "<img id=im src='".$row['img']."'>";
                echo "</a>";
                echo "<div id=subnames><p>".$row['name']."</p></div>";  
                echo '</div>';
            }
        }
        echo "</div>";
        echo "<div id=time>";
        echo "<h2>Best Time To Visit</h2>";
        echo "<p>".$best_time."</p>";
        echo "</div></div>";

        // Fetch and display reviews
        $sql_reviews = "SELECT name, review FROM reviews WHERE placeid='$placeid'";
        $res_reviews = $conn->query($sql_reviews);
        echo "<div id='reviews'>";
        if ($res_reviews->num_rows > 0) {
            echo "<h2>Reviews</h2>";
            while ($row_review = $res_reviews->fetch_assoc()) {
                echo "<div class='review'>";
                echo "<p><strong>" . $row_review['name'] . " </strong><br>" . $row_review['review'] . "</p><hr>";
                echo "</div>";
            }
        } else {
            echo "No reviews yet.";
        }
        echo "</div>";

        // If user is logged in, display review form
if (isset($_SESSION['user'])) {
    echo "<div id='add-review'>";
    echo "<h2>Add Review</h2>";
    echo "<form id='reviewform' action='add_review.php' method='post'>";
    echo "<label for='review'>Your Review:</label><br>";
    echo "<textarea id='review' name='review' rows='4' cols='50'></textarea><br><br>";
    echo "<input type='submit' value='Submit Review'>";
    echo "</form>";
    echo "</div>";
} else {
    echo "<p>Login to add a review.<a href=login.html>Login</a></p>";
}


            ?>
        </main>
    </body>
</html>