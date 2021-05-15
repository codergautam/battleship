<?php
include_once("../easyinclude.php");

$res = new \stdClass();
$id = $_GET["id"];
$playerId = $_GET["playerId"];

if($id && $playerId) {
$game = DbUtils::getGame($id);
if($game) {
    $player = $game->getPlayerFromId($playerId);
    if($player) {
        if($game->state == 0) {
        //serverside ship place check
        if(count($player->board->ships) == 5) {
            $fivesleft = 1;
            $foursleft = 1;
            $threesleft =2;
            $twosleft = 1;
            foreach($player->board->ships as $ship) {
                if($ship->length == 5) {
                    $fivesleft -= 1;
                } else if($ship->length == 4) {
                    $foursleft -= 1;
                }else if($ship->length == 3) {
                    $threesleft -= 1;
                }else if($ship->length == 2) {
                    $twosleft -= 1;
                }
            }
                if($fivesleft == 0 && $foursleft == 0 && $threesleft == 0 && $twosleft == 0) {
                    if($player->donePlacing == false) {
                    $game->donePlacing($player);
                    $player->donePlacing = true;
                    $game->start();
                    DbUtils::updateGame($game, $id);
                                                                    $res->success = true;
    echo json_encode($res);
                    } else {
                                 $res->success = false;
    $res->errormsg = "Already done placing.";
    echo json_encode($res);  
                    }
                } else {
                                                $res->success = false;
    $res->errormsg = "You placed invalid ships.";
    echo json_encode($res);
                }
            
        } else {
                            $res->success = false;
    $res->errormsg = "Need to place 5 ships. Only ".count($player->board->ships)." found.";
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