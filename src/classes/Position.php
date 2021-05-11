<?php
class Position {
    public $asString;
    public $x;
    public $y;

    public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct'.$numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }

    public function __construct1($loc) {
        $this->asString = $loc;
        $this->x = intval($loc[1])-1;
        $this->y = ord(strtolower($loc[0]))-97;
    }

    public function __construct2($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
        $alphas = range('A', 'Z');
        $this->asString = $alphas[$y].($x+1);
    }
}
?>