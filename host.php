<html>
<body>
<h1>The Google Images Game</h1>
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
 ?>
</body>
</html>
