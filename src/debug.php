<?php
include "classes/Game.php";
$gameboard = new Game(" ", " e");
echo "<pre>";
echo $gameboard->board->toAscii();
echo "</pre>";
?>