<?php
include "classes/Game.php";
$gameboard = new Game(" ", " e");
echo "<pre>";
var_export ($gameboard->board->board);
echo "</pre>";
?>