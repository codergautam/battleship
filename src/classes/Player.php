<?php
class Player {
   // public $name;
    public $board;
    public $game;
    public $playerNum;
    public $donePlacing;
    public $id;
function __construct($id )
{
    $this->donePlacing = false;
    //$this->name = $name;
    //$this->playerNum = $playerNum;
    $this->id = $id;
}

public function placeShip(Ship $ship) {
    $this->board->placeShip($ship);
}

public function onTurn() {
    
}
}
?>