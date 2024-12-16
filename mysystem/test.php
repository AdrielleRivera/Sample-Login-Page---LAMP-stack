<?php
$servername = "localhost";
$username = "Denny";
$password = "saintgabriel";
$dbname = "profile";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, Age, Email FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<div class="main-box top">';
        echo '  <div class="box">';
        echo '    <p>Hello <b>' . $row["id"] . '</b>, Welcome</p>';
        echo '  </div>';
        echo '  <div class="box">';
        echo '    <p>Your email is <b>' . $row["Email"] . '</b>.</p>';
        echo '  </div>';
        echo '  <div class="bottom">';
        echo '    <div class="box">';
        echo '      <p>And you are <b>' . $row["Age"] . '</b> years old.</p>';
        echo '    </div>';
        echo '  </div>';
        echo '</div>';
    }
} else {
    echo "0 results";
}


$conn->close();
?>
