<?php
include "classes/Game.php";
include "classes/Position.php";
$gameboard = new Game(" ", " e");
$pos = new Position("K2");
echo "<pre>";
var_dump($pos->getPoint($gameboard->board));
echo "</pre>";
?>