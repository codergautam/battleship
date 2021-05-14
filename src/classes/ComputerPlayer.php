<?php
class ComputerPlayer extends Player {
    public $pointsHit;
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
           //echo('<br><b>PLAYER </b>'.$this->playerNum );
           if($fivesleft > 0) {
                $ship = new Ship($board->getRandomPoint(), 5, (mt_rand(0,1) == 1));
                if($board->placeShip($ship)) {
                $fivesleft -= 1;
                //var_dump($ship);

                }
           } else if($foursleft > 0 ) {
            $ship = new Ship($board->getRandomPoint(), 4, (mt_rand(0,1) == 1));
            
            if($board->placeShip($ship)) {
            $foursleft -= 1;
           // var_dump($ship);
            //echo('<br>');
            }
           } else if($threesleft > 0) {
            $ship = new Ship($board->getRandomPoint(), 3, (mt_rand(0,1) == 1));
            if($board->placeShip($ship)) {
                //var_dump($ship);
               // echo('<br>');
            $threesleft -= 1;
            }
           } else if($twosleft > 0) {
            $ship = new Ship($board->getRandomPoint(), 2, (mt_rand(0,1) == 1));
           // var_dump($ship);
           // echo('<br>');
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
        /*
        echo "Player ".$this->playerNum."<br>";
        $enemy = $this->game->getPlayer($this->playerNum == 1 ? 2 : 1);
        echo "<br>";
        var_dump($enemy->board->ships[0]);
        $this->game->hit($enemy->board->ships[0]->getPoints()[0], $this); 
        */
        
        $enemy = $this->game->getPlayer($this->playerNum == 1 ? 2 : 1);

        $randomPoint = [mt_rand(0,$enemy->board->width-1), mt_rand(0,$enemy->board->length-1)];
        if($this->board->isAlreadyHit($randomPoint[0], $randomPoint[1])) {
            $this->onTurn();
        } else {
        $this->game->hit(new Position($randomPoint[0], $randomPoint[1]), $this);
        
        }
        
        //$this->game->nextTurn(); 
    }
}
?>