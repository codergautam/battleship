<?php
class ComputerPlayer extends Player {
    function __construct(){
        $this->donePlacing = false;
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
                $ship = new Ship($board->getRandomPoint(), 5, (mt_rand(0,1) == 1));
                if($board->placeShip($ship)) {
                $fivesleft -= 1;
                }
           } else if($foursleft > 0 ) {
            $ship = new Ship($board->getRandomPoint(), 4, (mt_rand(0,1) == 1));
            
            if($board->placeShip($ship)) {
            $foursleft -= 1;
            }
           } else if($threesleft > 0) {
            $ship = new Ship($board->getRandomPoint(), 3, (mt_rand(0,1) == 1));
            if($board->placeShip($ship)) {
            $threesleft -= 1;
            }
           } else if($twosleft > 0) {
            $ship = new Ship($board->getRandomPoint(), 2, (mt_rand(0,1) == 1));
            if($board->placeShip($ship)) {
            $twosleft -= 1;
            }
                  } else {
  
            return;
           }
       }
       $this->donePlacing = true;
       $this->game->donePlacing($this);
       return;
    }

    public function onTurn() {
        echo "Player ".$this->playerNum." turn";
        //$this->game->nextTurn();
    }
}
?>