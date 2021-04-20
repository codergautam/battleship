<?php


class Game {
    public $player2;
    public $player1;
    public $board;
    function __construct($player11, $player22) {
        $this->player1 = $player11;
        $this->player2 = $player22;
        $this->board = new Board(10, 10);
    }
}
?>