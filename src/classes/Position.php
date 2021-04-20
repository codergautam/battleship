<?php
class Position {
    public $asString;
    public $x;
    public $y;
    function __construct($loc) {
        $this->asString = $loc;
        $this->x = intval($loc[1])-1;
        $this->y = ord(strtolower($loc[0]))-97;
    }

    public function getPoint($l) {
        return $l->board[$this->x][$this->y];
    }
}
?>