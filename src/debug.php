<?php
include_once("classes.php");
//$pos = new Position("A2");
$game = new Game(new Player("lol", 1), new ComputerPlayer());

$game->player2->placeShips();
echo "<pre>";
echo($game->board2->toAscii());
echo("<br>");
echo "</pre>";
?>