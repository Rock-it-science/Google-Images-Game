<html>
<body>
<h1>The Google Images Game</h1>
<p id='players'></p>
<?php
//Creates a new room

//Set up SQL server connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gig";
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
  die("Connection failed: ". $conn->connect_error);
}
//Generate room code
$characters = '123456789abcdefghjkmnpqrstuvwxyz'; //Removed ambiguous characters
$roomCode = '';
for ($i = 0; $i < 6; $i++) {
    $roomCode .= $characters[rand(0, strlen($characters) - 1)];
}
//Create SQL table with name roomCode
$conn->query("CREATE TABLE " . $roomCode . "(player TEXT, score INTEGER);");
//Display room code
echo 'Room code: ' . $roomCode;

//Show players currently in game
$echoed_players = array();
$players = array();
$b = true;
while($b){//TODO Change this to stop when "start game" button is pressed
  //TODO Only procede if room is not empty
  $players_query = $conn->query("SELECT 'player' FROM " . $roomCode . ";");
  $players = $players_query -> fetch_assoc();
  echo $players[0];
  foreach($players as &$p){
    if(!in_array($p, $echoed_players)){//Don't echo players twice
      echo $p;
    }
    $echoed_players .= $p;
  }
  sleep(1);
  $b = false;
}
 ?>
</body>
</html>
