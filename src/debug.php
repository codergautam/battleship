<?php
include_once("classes/classes.php");
//$pos = new Position("A2");
$ship = new Ship(new Position("C1"), 2, false);
echo "<pre>";
var_dump($ship->getPoints());
echo "</pre>";
?>