<?php
include_once("classes/classes.php");
//$pos = new Position("A2");
$board = new Board(10, 10);
$ship = new Ship(new Position("C1"), 3, true);
$board->placeShip($ship);
echo "<pre>";
echo($board->toAscii());
echo("<br>");
var_dump($ship->getPoints());
echo "</pre>";
?>