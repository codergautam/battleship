<?php
include_once("../easyinclude.php");

$res = new \stdClass();

$pos = $_GET["pos"];
$up = $_GET["up"];
$length = $_GET["length"];
$id = $_GET["id"];
$playerId = $_GET["playerId"];

if($id && $playerId) {
$game = DbUtils::getGame($id);
if($game) {
    $player = $game->getPlayerFromId($playerId);
    if($player) {
        if($game->state == 0) {
           $ship = new Ship(new Position($pos), intval($length), ($up==1?true:false));
           if($player->board->isPlaceable($ship)) {
            $player->board->placeShip($ship);
              $res->success = true;
              DbUtils::updateGame($game, $id);
    echo json_encode($res);
           } else {
                               $res->success = false;
    $res->errormsg = "Invalid Ship / Can't Place.";
    echo json_encode($res);
           }
        } else {
                $res->success = false;
    $res->errormsg = "Already Done Placing.";
    echo json_encode($res);
        }
} else {
    $res->success = false;
    $res->errormsg = "Invalid Player Id.";
    echo json_encode($res);
}
} else {
        $res->success = false;
    $res->errormsg = "Invalid Game Id";
    echo json_encode($res);
}
} else {
    $res->success = false;
    $res->errormsg = "Game Id or Player Id not Specified";
    echo json_encode($res);
}
?>