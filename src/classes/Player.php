<?php
class Player {
    public $name;
    public $board;
    public $game;
    public $playerNum;
    public $donePlacing;
function __construct($name )
{
    $this->donePlacing = false;
    $this->name = $name;
    //$this->playerNum = $playerNum;
}

public function placeShip(Ship $ship) {
    $this->board->placeShip($ship);
}

public function onTurn() {
    
}
}
?>