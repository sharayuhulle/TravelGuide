<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Travel Website</title>
    <style>
         body {
            margin: 0; /* Remove default margins */
        }
        header {
            background-color: #7209b7; /* Set background color */
            padding: 10px; /* Add some padding for better visual */
            width:100%;
            height:200px;
        }
        h1, nav {
            color: white; /* Set text color to white */
        }
        h2{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        main{
            padding: 10px;
            margin-top: 40px;
        }
         /* Remove bullets from list items */
         nav ul {
            list-style-type: none;
            padding:25px;
            margin: 30px;
        }
        nav li {
            display: inline;
            padding:10px;
            margin-right: 50px; /* Add some space between menu items */
           
        }
        li a {
            color : white;
        }
        .content{
            display: inline-block;
            margin: 10px;
        }
        .mustvisit {
            /* width: 400px;
            height: auto; */
            display: inline-block; 
            margin: 10px; 
        }
       img{
        width:350px;
        height:250px;
        margin-left: 50px;
        border-radius: 10px;
       }

       .content h2{
        padding-left: 5px;
        padding-top: 5px;
        margin-left:5px;
       }
    
       #names{
        text-align: center;
        font-size:larger;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
       }
    </style>
    <!-- Include jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
     $("img").hover(function(){
      $(this).css({width:'370px',height:'270px'}); // Change width and height on hover
     }, function(){
      $(this).css({width:'350px',height:'250px'}); // Change width and height back to original when mouse leaves
     });
    });
   </script>
    <!-- Include jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            // Add change event listener to the category dropdown
            $("#category").change(function(){
                // Get the selected value of the dropdown
                var selectedCategory = $(this).val();
                // Redirect to the appropriate page based on the selected option
                if (selectedCategory) {
                    window.location = selectedCategory + ".php"; // Assuming the page names correspond to the option values
                }
            });
            
            // Hover effect for images
            $("img").hover(function(){
                $(this).css({width:'370px',height:'270px'}); // Change width and height on hover
            }, function(){
                $(this).css({width:'350px',height:'250px'}); // Change width and height back to original when mouse leaves
            });
        });
    </script>
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
        <h1>Welcome!</h1>
        <nav>
            <ul>
                <li><a href="main.php">Home</a></li>
                <li>
                <select id="category" name="category">
                    <option disabled selected hidden>Select category</option>
                    <option value="food">Food</option>
                    <option value="unesco">UNESCO</option>
                    <option value="spiritual">Spiritual</option>
                </select>
                </li>
                <li><a href="login.html">Login</a></li>
                <li><a onclick="confirmLogout()"  style="cursor: pointer;">Logout</a></li>
                <li><a href="signup.html">Signup</a></li>
                <li>
                <?php
                // Check if user is logged in and display username
                if(isset($_SESSION['user'])) {
                   echo '<h4>Hi, ' . $_SESSION['user'] . '</h4>';
                }
                ?></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php
        // Start session and include database connection
        // session_start();
        include "connection.php";

        // Query to select places from the mustvisit table
        $sql = "SELECT placeid, name, img FROM mustvisit";
        $res = $conn->query($sql);
        
        echo "<div class=content>";
        echo "<h2> Must Visit Places </h2>";

        // Check if places are found
        if ($res->num_rows > 0) {
            // Loop through each place and display its image and name
            while ($row = $res->fetch_assoc()) {
                echo '<div class="mustvisit">';
                echo "<a href='description.php?id=".$row['placeid']."'>"; // Link to description.php with placeid as query parameter
                echo "<img src='".$row['img']."'>";
                echo "</a>";
                echo "<div id=names><p>".$row['name']."</p></div>"; 
                echo '</div>';
            }
        } else {
            // If no places are found, display a message
            echo "No places found";
        }

        // Close database connection
        $conn->close();
        echo "</div>";
        ?>
    </main>

</body>
</html>
