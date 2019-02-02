<?php
$name = $_REQUEST['name'];
$roomCode = $_REQUEST['roomCode'];
//Set up SQL server connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gig";
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
  die("Connection failed: ". $conn->connect_error);
}
//Check if room code is valid
$roomCheck = $conn->query("SELECT 1 FROM " . $roomCode . ";");
if($roomCheck){//Valid room code
  //Add username to corresponding table
  $conn->query("INSERT INTO " . $roomCode . " VALUES ('". $name ."', 0);");
    echo 'joined game';
}else{//invalid room code
  echo "invalid room code";
}
?>
