<?php


class Game {
    public  $player2;
    public  $player1;
    public  $board1;
    public  $board2;
    public $state;
    function __construct($player11, $player22) {
        $this->player1 = $player11;
        $this->player2 = $player22;
        $this->board1 = new Board(10, 10);
        $this->board2= new Board(10, 10);
        $this->state = 0;

        $this->player1->board = $this->board1;
        $this->player2->board = $this->board2;
        $this->player1->game = $this;
        $this->player2->game = $this;
    }

}
?>