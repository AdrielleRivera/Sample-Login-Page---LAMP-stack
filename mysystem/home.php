<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "profile";

   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }

   $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
            <p><a href="home.php">My System</a> </p>
        </div>

        <div class="right-links">

            <?php 



            $res_Uname = $res_Email = $res_Age = $res_id = "";
            
            $id = $_SESSION['id'];
            $query = mysqli_query($con,"SELECT id, Age, Username, Email FROM users WHERE id='$id'");

            if (!$query) {die("Query Failed: " . mysqli_error($con));
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password']; // Assuming a password is required

    // Retrieve user data from the database
    $sql = "SELECT Username, Email, Age FROM users WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch user details
        $row = $result->fetch_assoc();
        $res_Uname = $row['Username'];
        $res_Age = $row['Age'];
        $res_Email = isset($row['Email']) ? $row['Email'] : "Email not available";

       
 // Store user data in session
        $_SESSION['username'] = $res_Uname;
        $_SESSION['email'] = $res_Email;
        $_SESSION['age'] = $res_Age;
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
}

// Check if user is logged in
if (isset($_SESSION['username'])) {
    $res_Uname = $_SESSION['username'];
    // $res_Email = $_SESSION['email'];
    $res_Age = $_SESSION['age'];
} 
            ?>


            <a href='edit.php'>Change Profile</a>
            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>  


        </div>
    </div>

    <main>

       <div class="main-box top">
          <div class="top">
            <div class="box">
                <p>Hello <b><?php echo htmlspecialchars($res_Uname); ?></b>, Welcome</p>
            </div>
            <div class="box">
                <p>Your email is <b><?php echo $res_Email ?></b>.</p>
            </div>
          </div>
          <div class="bottom">
            <div class="box">
                <p>And you are <b><?php echo $res_Age ?> years old</b>.</p> 
            </div>
          </div>
       </div>

    </main>
</body>
</html>
