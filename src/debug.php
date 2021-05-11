<?php
include_once("classes.php");
//$pos = new Position("A2");
$game = new Game(new ComputerPlayer(), new ComputerPlayer());
$game->player1->placeShips();
$game->player2->placeShips();
echo "<pre><h3>Player 1 board</h3><br>";
echo($game->board1->toAscii());
echo("<br><h3>Player 2 board</h3>");
echo("<br>".$game->board2->toAscii());
echo "</pre>";
?>