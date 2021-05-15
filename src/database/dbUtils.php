<?php
include( "conn.php");

class DbUtils {
    public static function newGame($game, $id) {
        global $pdo;
        $select = "INSERT INTO `battleship_php_ulx`.`games` (`game`, `idref`) VALUES ('".serialize($game)."','".$id."')";
        $statement = $pdo->prepare($select);
        $statement->execute();
    }

    public static function getGame($id) {
        global $pdo;
        $select = "SELECT * FROM `battleship_php_ulx`.`games` WHERE `idref`=:id";
        $statement = $pdo->prepare($select);
        $statement->bindParam(":id", $id);
        $statement->execute();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            return unserialize($row['game']);
        }
    }
        public static function updateGame($game, $id) {
        global $pdo;
        $select = "UPDATE `battleship_php_ulx`.`games`SET `game`=:game WHERE `idref`=:id";
        $statement = $pdo->prepare($select);
        $statement->bindParam(":game", serialize($game));
        $statement->bindParam(":id", $id);
        $statement->execute();
    }

    public static function newLobby($code, $secret, $gameid, $playeridone, $playeridtwo) {
         global $pdo;
        $select = "INSERT INTO `battleship_php_ulx`.`lobbies` (`code`, `gameid`,  `playeridone`, `playeridtwo`, `secret`, `state`) VALUES (:code,:gameid, :playeridone, :playeridtwo, :secret, 'waiting')";
        $statement = $pdo->prepare($select);
        $statement->bindParam(":code", $code);
        $statement->bindParam(":gameid", $gameid);
        $statement->bindParam(":playeridone", $playeridone);
        $statement->bindParam(":playeridtwo", $playeridtwo);
        $statement->bindParam(":secret", $secret);
        $statement->execute();
    }


    public static function deleteLobby($secret) {
                global $pdo;
        $select = "DELETE FROM `battleship_php_ulx`.`lobbies` WHERE `secret`=:secret";
        $statement = $pdo->prepare($select);
        $statement->bindParam(":secret", $secret);
        $statement->execute();
    }

        public static function getLobby($code) {
        global $pdo;
        $select = "SELECT * FROM `battleship_php_ulx`.`lobbies` WHERE `code`=:code";
        $statement = $pdo->prepare($select);
        $statement->bindParam(":code", $code);
        $statement->execute();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            return [$row['code'], $row['secret'], $row['gameid'], $row['playeridone'], $row['playeridtwo'], $row['state']];
        }
        }
                public static function setState($code,$state) {
        global $pdo;
        $select = "UPDATE `battleship_php_ulx`.`lobbies` SET `state`=:state WHERE `code`=:code";
        $statement = $pdo->prepare($select);
        $statement->bindParam(":code", $code);
                $statement->bindParam(":state", $state);
        $statement->execute();
        }
}
?>