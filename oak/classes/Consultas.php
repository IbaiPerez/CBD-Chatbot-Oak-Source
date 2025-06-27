<?php

require_once("connection.php");

Class Consultas {

    static public function cuenta_simple($tabla) {

        $sql = "SELECT COUNT(*) FROM `$tabla`";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->close();
        $stmt =  null;

    }

    static public function cuentaPokemon_tipo($value) {

        $sql = "SELECT COUNT(*) AS cantidad
            FROM pokemon_tipo
            WHERE id_tipo = (SELECT id_tipo FROM tipo WHERE nombre = '$value')";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->close();
        $stmt =  null;

    }

    static public function get_tipos() {

        $sql = "SELECT * FROM `tipo`";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->close();
        $stmt =  null;

    }

    static public function cuentaPokemon_peso($value, $comparator) {

        if($comparator === "igual") {
            $s = "=";
        } elseif($comparator === "mayor") {
            $s = ">";
        } elseif($comparator === "menor") {
            $s = "<";
        } elseif($comparator === "mayor o igual") {
            $s = ">=";
        } else {
            $s = "<=";
        }

        $sql = "SELECT COUNT(*) AS cantidad
        FROM pokemon
        WHERE peso $s $value";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->close();
        $stmt =  null;

    }

    static public function cuentaPokemon_altura($value, $comparator) {

        if($comparator === "igual") {
            $s = "=";
        } elseif($comparator === "mayor") {
            $s = ">";
        } elseif($comparator === "menor") {
            $s = "<";
        } elseif($comparator === "mayor o igual") {
            $s = ">=";
        } else {
            $s = "<=";
        }

        $sql = "SELECT COUNT(*) AS cantidad
        FROM pokemon
        WHERE altura $s $value";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->close();
        $stmt =  null;

    }


    static public function selecciona_simple($tabla) {


        if($tabla == "tipo_piedra") {
            $x = "nombre_piedra";
        } else {
            $x = "nombre";
        }

        $sql = "SELECT $x FROM `$tabla`";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->close();
        $stmt =  null;

    }

    static public function seleccionaPokemon_tipo($value) {

        $sql = "SELECT * FROM pokemon
        WHERE numero_pokedex IN
        (SELECT numero_pokedex FROM pokemon_tipo
        JOIN tipo ON pokemon_tipo.id_tipo = tipo.id_tipo
        WHERE tipo.nombre = '$value')";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->close();
        $stmt =  null;

    }

        static public function seleccionaPokemon_peso($value, $comparator) {

        if($comparator === "igual") {
            $s = "=";
        } elseif($comparator === "mayor") {
            $s = ">";
        } elseif($comparator === "menor") {
            $s = "<";
        } elseif($comparator === "mayor o igual") {
            $s = ">=";
        } else {
            $s = "<=";
        }

        $sql = "SELECT *
        FROM pokemon
        WHERE peso $s $value";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->close();
        $stmt =  null;

    }

        static public function seleccionaPokemon_altura($value, $comparator) {

        if($comparator === "igual") {
            $s = "=";
        } elseif($comparator === "mayor") {
            $s = ">";
        } elseif($comparator === "menor") {
            $s = "<";
        } elseif($comparator === "mayor o igual") {
            $s = ">=";
        } else {
            $s = "<=";
        }

        $sql = "SELECT *
        FROM pokemon
        WHERE altura $s $value";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->close();
        $stmt =  null;

    }
}

?>