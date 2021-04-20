<?php
class Ship {
    public $starting;
    public $length;
    public $up;
    function __construct($starting, $length1, $up1) {
        $this->starting = $starting;
        $this->length = $length1;
        $this->up = $up1;
    }

    public function getPoints() {
        $points = array();
        if($this->up) {
            if((($this->starting->y)-$this->length+1) < 0 ){
                return NULL;
            }

            for ($i = 0; $i < $this->length; $i++) {
                array_push($points, new Position($this->starting->x,  $this->starting->y-$i));
            }

        } else {
            if($this->starting->x < 0 ){
                return NULL;
            }

            for ($i = 0; $i < $this->length; $i++) {
                array_push($points, new Position($this->starting->x+$i,  $this->starting->y));
            }

        }
        return $points;
    }
}
?>