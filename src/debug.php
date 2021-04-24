<?php
include_once("classes/classes.php");
//$pos = new Position("A2");
$board = new Board(10, 10);
$ship = new Ship(new Position("C1"), 3, true);
$ship1 = new Ship(new Position("D1"), 3, true);

echo $board->placeShip($ship);
echo $board->placeShip($ship1);
echo "<pre>";
echo($board->toAscii());
echo("<br>");
var_dump($ship->getPoints());
echo "</pre>";
?>