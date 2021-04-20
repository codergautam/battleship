<?php
class Position {
    public $asString;
    public $x;
    public $y;
    function __construct($loc, $y1 = NULL) {
        if(is_string($loc)) {
            
        $this->asString = $loc;
        $this->x = intval($loc[1])-1;
        $this->y = ord(strtolower($loc[0]))-97;
        } else {
            $this->x = $loc;
            $this->y = $y1;
            $alphas = range('A', 'Z');
            $this->asString = $alphas[$y1].($loc+1);
        }
    }

    public function getPoint($l) {
        return $l->board[$this->x][$this->y];
    }
}
?>