<?php
include_once("../easyinclude.php");

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if($_GET["type"]=="playervsplayer") {
    
} else if($_GET["type"]=="playervscomputer") {
    $id = generateRandomString();
    $playerId = generateRandomString();
    $game = new Game(new Player($playerId), new ComputerPlayer());
    DbUtils::newGame($game, $id); 
    $create = new \stdClass();
    $create->success = true;
    $create->id = $id;
    $create->playerId = $playerId;
    echo json_encode($create);
} else {
    echo "Invalid Request";
}

?>