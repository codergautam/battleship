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
}
?>