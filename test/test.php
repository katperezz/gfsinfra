<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assets";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn) {
  // results was successful
  echo "YEY";
} else {
  echo "NYEY";
  // result was not successful
}
?>