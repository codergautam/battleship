<?php
class ComputerPlayer extends Player {
    function __construct(){

    }

    public function placeShips()
    {
        $board =  $this->board;
        $fivesleft = 1;
        $foursleft = 1;
        $threesleft = 2;
        $twosleft = 1;

       while (count($board->ships) <= 4) {
           # code...
           if($fivesleft > 0) {
                $ship = new Ship(new Position(mt_rand(0,10), mt_rand(0,10)), 5, (mt_rand(0,1) == 1));
                $board->placeShip($ship);
                $fivesleft -= 1;
           } else if($foursleft > 0 ) {
            $ship = new Ship(new Position(mt_rand(0,10), mt_rand(0,10)), 4, (mt_rand(0,1) == 1));
            $board->placeShip($ship);
            $foursleft -= 1;
           } else if($threesleft > 0) {
            $ship = new Ship(new Position(mt_rand(0,10), mt_rand(0,10)), 3, (mt_rand(0,1) == 1));
            $board->placeShip($ship);
            $threesleft -= 1;
           } else if($twosleft > 0) {
            $ship = new Ship(new Position(mt_rand(0,10), mt_rand(0,10)), 2, (mt_rand(0,1) == 1));
            $board->placeShip($ship);
            $twosleft -= 1;
           } else {
            $this->placeShips();
            return;
           }
       }
    }
}
?>