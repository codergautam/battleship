<?php
include_once("../easyinclude.php");

$res = new \stdClass();

$id = $_GET["id"];
$playerId = $_GET["playerId"];

$game = DbUtils::getGame($id);

if($playerId) {
if($game) {
$player = $game->getPlayerFromId($playerId);
$enemy = $game->getPlayer($player->playerNum == 1 ? 2 : 1);
if($player) {
$res->enemyFinished = $enemy->donePlacing;
if(!$res->enemyFinished) {
    $res->needToPlace = 5-  count($enemy->board->ships);
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