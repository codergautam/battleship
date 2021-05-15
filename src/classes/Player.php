<?php
class Player {
   // public $name;
    public $board;
    public $game;
    public $playerNum;
    public $donePlacing;
    public $id;
    public $turn;
function __construct($id )
{
    $this->donePlacing = false;
    $this->turn = false;
    //$this->name = $name;
    //$this->playerNum = $playerNum;
    $this->id = $id;
}

public function placeShip(Ship $ship) {
    $this->board->placeShip($ship);
}

public function onTurn() {
    $this->turn = true;
}
}
?>