<?php
include_once("../easyinclude.php");

$res = new \stdClass();

$id = $_GET["id"];
$playerId = $_GET["playerId"];

$game = DbUtils::getGame($id);

if($id && $playerId) {
if($game) {
    $player = $game->getPlayerFromId($playerId);
    if($player) {
    $state = $game->state;
    if($state == 2) {
        $res->win = $game->winner->playerNum == $player->playerNum;
    }
    $res->state = $state;
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
    $res->errormsg = "Game Id or Player Id Not Specified.";
    echo json_encode($res);
}

?>