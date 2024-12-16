<?php 
session_start();

// Include database configuration
include("php/config.php");

// Check if the user is logged in
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">My System</a></p>
        </div>

        <div class="right-links">
           <?php 
            // Initialize variables to avoid undefined variable issues
            $res_Uname = $res_Email = $res_Age = $res_id = "";

            // Fetch user details
            $id = $_SESSION['id'];
            $query = mysqli_query($con, "SELECT Age, Email, Username FROM users WHERE id='$id'");

            if ($query && mysqli_num_rows($query) > 0) {
                $result = mysqli_fetch_assoc($query);
                $res_Uname = htmlspecialchars($result['Username']);
                $res_Email = htmlspecialchars($result['Email']);
                $res_Age = htmlspecialchars($result['Age']);
                $res_id = htmlspecialchars($result['id']);
            } 
            
            echo "<a href='edit.php?Id=$res_id'>Change Profile</a>";
            ?> 


            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
        </div>
    </div>
    <main>
        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <p>Hello <b><?php echo $res_Uname; ?></b>, Welcome</p>
                </div>
                <div class="box">
                    <p>Your email is <b><?php echo $res_Email; ?></b>.</p>
                </div>
            </div>
            <div class="bottom">
                <div class="box">
                    <p>And you are <b><?php echo $res_Age; ?> years old</b>.</p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>