<?php
class Board {
     public $board;
    public $length;
    public $width;
   function __construct($length1, $width1) {
        //echo $length1;
        $this->length = $length1;
        $this->height = $height1;
        
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
}
?>