<?php
include_once("../easyinclude.php");

$res = new \stdClass();
$id = $_GET["id"];
$playerId = $_GET["playerId"];
$pos = $_GET["pos"];
$pos = new Position($pos);

if($id && $playerId) {
$game = DbUtils::getGame($id);
if($game) {
    $player = $game->getPlayerFromId($playerId);
    $enemy = $game->getPlayer($player->playerNum == 1?2:1);
    if($player) {
        if($game->state == 1) {
            if($game->turn == $player->playerNum) {

                if($pos) {
if(!$player->board->isAlreadyHit($pos->x, $pos->y)) {

    $game->hit($pos, $player);
             $res->success = true;
             DbUtils::updateGame($game, $id);
    echo json_encode($res);  

} else {
         $res->success = false;
    $res->errormsg = "Already Hit!";
    echo json_encode($res);  
}
                } else {
                                   $res->success = false;
    $res->errormsg = "Invalid Position!";
    echo json_encode($res);  
                }
            } else {
                 $res->success = false;
    $res->errormsg = "Wait your turn! ";
    echo json_encode($res);
            }
        } else {
                $res->success = false;
    $res->errormsg = "The game is in wrong state to do this.";
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