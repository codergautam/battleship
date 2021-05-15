<?php
include_once("../easyinclude.php");
$res = new \stdClass();
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$id = generateRandomString();
$playeridone = generateRandomString();
$playeridtwo = generateRandomString();
//used for deleting the lobby later
$secret = generateRandomString();

$code = sprintf("%06d", mt_rand(1, 999999));

$game = new Game(new Player($playeridone), new Player($playeridtwo));

//store game in db for easy access later
DbUtils::newGame($game, $id);

//store lobby in db so that someone else can join
DbUtils::newLobby($code, $secret, $id, $playeridone, $playeridtwo);

//now send back the hoster useful info for their client
$res->id = $id;
$res->playeridone = $playeridone;
$res->secret = $secret;
$res->code = $code;

echo json_encode($res);
?>