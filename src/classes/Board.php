<?php
class Board {
     public $board;
    public $length;
    public $width;
    public $ships;
    public $pointsHit;
   function __construct($length1, $width1) {
        //echo $length1;
        $this->length = $length1;
        $this->width = $width1;
        $this->ships = [];
        $this->pointsHit = [];
     $array_ = [];

     for ($k = 0 ; $k < $length1 ; $k++){
          $arrayToAdd = [];
          for ($i = 0 ; $i < $width1 ; $i++) {
               array_push($arrayToAdd, " ");
          }
          array_push($array_, $arrayToAdd);
         
     }  
     $this->board = $array_;
   } 
   public function isAllShipsSunk() {
        foreach ($this->ships as $key => $ship) {
             if(!$ship->sunk) return FALSE;

        }
        return TRUE;
   }
   public function getSunkShips() {
        $sunkships = [];
                foreach ($this->ships as $key => $ship) {
             if($ship->sunk) array_push($sunkships, $ship);
        }
        return $sunkships;
   }
   public function isAlreadyHit($x, $y) {
        //echo count($this->pointsHit);
       // echo "<br>";
        if(count($this->pointsHit) >= 1)  {
             
        foreach ($this->pointsHit as $key => $point) {
             if(($point->x == $x) && ($point->y == $y)) {
                  return TRUE;
             }
        }
        return FALSE;
     } else {
          return FALSE;
     }
   }
   public function isPlaceable(Ship $ship)
   {

     if($ship->getPoints() == NULL) return false;
        $output = true;
        foreach ($ship->getPoints() as $key => $point) {

          # check if point is already used
          if(!$this->isEmpty($point)) {
               $output = false;
          }
     }
     return $output;
   }

   public function placeShip(Ship $ship)
   {
        $letter = range("a", "z")[count($this->ships)];
        if($this->isPlaceable($ship)) {
       array_push($this->ships, $ship);
       foreach ($ship->getPoints() as $key => $point) {
            # check if point is already used
            if(!$this->isEmpty($point)) {
                 return false;
            }
            $this->setPoint($point, $letter);
       }
       $ship->letter =$letter;
       return true;
     } else {
          return false;
     }
   }
   public function getRandomPoint() {
        return new Position(mt_rand(0,$this->length-1), mt_rand(0,$this->width-1));
   }
   public function toAscii()
   {
        # code...
        $alphas = range('A', 'Z');
        $output = "  ";
        for ($i = 0; $i < $this->width; $i++ ) {
          $output = $output . strval($i+1);
          $output = $output .  " ";
        }
        $output = $output. "\n";
        foreach ($this->board as $key => $value) {
             # code...
             $output = $output . $alphas[$key] ." ";
             foreach ($value as $key1 => $value1) {
                  # code...
                  $output = $output . $value1 . " ";
             }
             $output = $output . "\n";
        }
        return $output;
   }
   public function getShip($letter)
   {
     foreach ($this->ships as $key => $ship) {
          if($ship->letter == $letter) {
               return $ship;
          }

     }
     return FALSE;
   }

   public function checkShip(Position $point)
   {
        $letters = range("a", "z");
        if(in_array($this->getPoint($point), $letters)) {
          return $this->getShip($this->getPoint($point));

        }
        return FALSE;
   }
   public function setPoint(Position $point, $value) {
        $this->board[$point->y][$point->x] = $value;
   } 

   public function getPoint(Position $point) {
        return $this->board[$point->y][$point->x];
   }

   public function isEmpty(Position $point) {
        return $this->getPoint($point) == " ";
   }
}
?>