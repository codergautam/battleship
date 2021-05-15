<?php
include("../easyinclude.php");

$res = new \stdClass();
$code = $_GET["code"];

$lobby = DbUtils::getLobby($code);
$res->state = $lobby[5];
echo json_encode($res);
?>