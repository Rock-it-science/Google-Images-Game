<?php
//Get passed variable for room code
$roomCode = $_REQUEST['rc'];

$GLOBALS['ep'] = array();

function echoPlayers($roomCode){
  //Set up SQL server connection
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "gig";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
  }
  //Show players currently in game
  $players = array();
  $players_query = $conn -> query("SELECT player FROM " . $roomCode . ";");
  if(mysqli_num_rows($players_query) > 0){
    foreach($players_query->fetch_all() as &$p_row){//For every row in query response
      $p = $p_row[0]; //Get item from row
      if(!in_array($p, $GLOBALS['ep'])){//Don't echo players twice
        echo $p;
      }
      array_push($GLOBALS['ep'], $p);
    }
  }
}

//Temporary solution to below problem
$GLOBALS['ep'] = [];
sleep(10);
echoPlayers($roomCode);

/*
//Current problem: this runs infinitely, but it needs to break in order for the echos to go through
//Solution: Make it a function that is run over and over
while(true){//Outer loop to keep inner loop from never running
  echo 'running';
  while(mysqli_num_rows($players_query) >= 1){//Only check for players if there's players in the room
    echo 'players!';
    $players = $players_query -> fetch_assoc();
    echo $players[0];
    foreach($players as &$p){
      if(!in_array($p, $echoed_players)){//Don't echo players twice
        echo $p;
      }
      $echoed_players .= $p;
    }
    sleep(0.5);
  }
  sleep(1);
}*/
 ?>
