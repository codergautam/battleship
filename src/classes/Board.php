<?php
class Board {
     public $board;
    public $length;
    public $width;
    public $ships;
   function __construct($length1, $width1) {
        //echo $length1;
        $this->length = $length1;
        $this->width = $width1;
        $this->ships = [];
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

   public function placeShip($ship)
   {
        $letter = range("a", "z")[count($this->ships)];
       array_push($this->ships, $ship);
       foreach ($ship->getPoints() as $key => $point) {
            # check if point is already used
            if(!$this->isEmpty($point)) {
                 return false;
            }
            $this->setPoint($point, $letter);
       }
       return true;
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

   public function setPoint($point, $value) {
        $this->board[$point->y][$point->x] = $value;
   } 

   public function getPoint($point) {
        return $this->board[$point->y][$point->x];
   }

   public function isEmpty($point) {
        return $this->getPoint($point) == " ";
   }
}
?>