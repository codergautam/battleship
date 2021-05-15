<?php
include_once("../easyinclude.php");
$res = new \stdClass();

$code = $_GET["code"];

$lobby = DbUtils::getLobby($code);

if($lobby) {
    if($lobby[5] == "waiting") {
        $res->id = $lobby[2];
        $res->playerId = $lobby[4];
        $res->success = true;
        echo json_encode($res);
        DbUtils::setState($code, "occupied");
    } else {
    $res->success = false;
    $res->errormsg = "Lobby is in wrong state";
    echo json_encode($res);
    }
} else {
    $res->success = false;
    $res->errormsg = "Lobby not found";
    echo json_encode($res);
}
?>