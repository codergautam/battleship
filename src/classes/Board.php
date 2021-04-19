<?php
class Board {
     public $board;
    public $length;
    public $width;
   function __construct($length1, $width1) {
        //echo $length1;
        $this->length = $length1;
        $this->width = $width1;
        
     $array_ = [];

     for ($k = 0 ; $k < $length1 ; $k++){
          $arrayToAdd = [];
          for ($i = 0 ; $i < $width1 ; $i++) {
               array_push($arrayToAdd, "0");
          }
          array_push($array_, $arrayToAdd);
         
     }  
     $this->board = $array_;
   } 

   public function placeShip($ship)
   {
        # code...
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
}
?>