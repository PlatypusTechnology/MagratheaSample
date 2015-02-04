
testeaaa


<?php
$servername = "127.0.0.1";
$username = "paulo";
$password = "p4ul0";
$dbname = "smple";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM tab_movies";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		print_r($row);
	}
} else {
    echo "0 results";
}
$conn->close();
?>