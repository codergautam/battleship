<?php
include_once("../easyinclude.php");

$res = new \stdClass();

$id = $_GET["id"];
$playerId = $_GET["playerId"];

$game = DbUtils::getGame($id);

if($playerId) {
if($game) {
$player = $game->getPlayerFromId($playerId);
if($player) {
    $res->board =  $player->board->board;
     $res->state = $game->state;
    if($game->state == 0) {
    $res->shipsToPlace = 5 - count($player->board->ships);
    $res->donePlacing = $player->donePlacing;
    }
    $res->success = true;
    echo json_encode($res);
} else {
    $res->success = false;
    $res->errormsg = "Invalid Player Id.";
    echo json_encode($res);
}
} else {
    $res->success = false;
    $res->errormsg = "Invalid Game Id.";
    echo json_encode($res);
}
} else {
        $res->success = false;
    $res->errormsg = "Player Id Not Specified.";
    echo json_encode($res);
}

?>