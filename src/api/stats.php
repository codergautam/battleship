<?php
include_once("../easyinclude.php");

$res = new \stdClass();

$id = $_GET["id"];
$playerId = $_GET["playerId"];

$game = DbUtils::getGame($id);

if($playerId  && $id) {
if($game) {
$player = $game->getPlayerFromId($playerId);
$enemy = $game->getPlayer($player->playerNum == 1 ? 2 : 1);
if($player) {
    //pointsHit
    /*
    $res->pointsHitPlayer = [];

    foreach($player->board->pointsHit as $point) {
        array_push($res->pointsHitPlayer, $point->asString);
    }

        $res->pointsHitEnemy = [];

    foreach($enemy->board->pointsHit as $point) {
        array_push($res->pointsHitEnemy, $point->asString);
    }*/

    //shipsSunk
    $res->shipsSunkPlayer = count($player->board->getSunkShips());
    $res->shipsSunkEnemy = count($enemy->board->getSunkShips());

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
    $res->errormsg = "Player Id or Game Id Not Specified.";
    echo json_encode($res);
}

?>