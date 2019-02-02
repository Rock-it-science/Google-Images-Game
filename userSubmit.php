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
  //Check if only player in game
  $rows = $conn->query("SELECT * FROM " . $roomCode . ";");
  if(mysqli_num_rows($rows) == 1){
    //Show button to start game
    //TODO implement a system for starting the game from this button
    ?>
    <br>
    <button onclick="">Start Game</button>
    <?php
  }
}else{//invalid room code
  echo "invalid room code";
}
?>
