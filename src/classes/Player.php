<?php
class Player {
    public $name;
    public  $board;
    public $game;
    public $playerNum;
function __construct($name, $playerNum)
{
    $this->name = $name;
    $this->playerNum = $playerNum;
}

public function placeShip(Ship $ship) {
    $this->board->placeShip($ship);
}
}
?>