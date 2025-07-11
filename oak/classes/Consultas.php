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

    static public function cuentaPokemon_evolucion() {

        $sql = "SELECT 
        te.tipo_evolucion AS metodo,
        COUNT(DISTINCT pfe.numero_pokedex) AS cantidad_pokemon
        FROM tipo_evolucion te
        LEFT JOIN forma_evolucion fe ON te.id_tipo_evolucion = fe.tipo_evolucion
        LEFT JOIN pokemon_forma_evolucion pfe ON fe.id_forma_evolucion = pfe.id_forma_evolucion
        GROUP BY te.id_tipo_evolucion, te.tipo_evolucion";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->close();
        $stmt =  null;

    }

    static public function cuentaPokemon_evolucionPiedra($piedra) {

        $sql = "SELECT tp.nombre_piedra, COUNT(DISTINCT pfe.numero_pokedex) AS cantidad_pokemones
        FROM pokemon_forma_evolucion pfe
        JOIN forma_evolucion fe ON pfe.id_forma_evolucion = fe.id_forma_evolucion
        JOIN piedra pi ON fe.id_forma_evolucion = pi.id_forma_evolucion
        JOIN tipo_piedra tp ON pi.id_tipo_piedra = tp.id_tipo_piedra
        WHERE tp.nombre_piedra = '$piedra'";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->close();
        $stmt =  null;

    }


    static public function cuentaPokemon_evolucionNivel($nivel,$comparator) {

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

        $sql = "SELECT COUNT(DISTINCT pfe.numero_pokedex) AS cantidad_pokemones
        FROM pokemon_forma_evolucion pfe
        JOIN nivel_evolucion ne ON pfe.id_forma_evolucion = ne.id_forma_evolucion
        WHERE ne.nivel $s $nivel";
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

    static public function seleccionaPokemon_evolucion($value) {

        $sql = "SELECT 
        p.nombre AS nombre_pokemon
        FROM tipo_evolucion te
        LEFT JOIN forma_evolucion fe ON te.id_tipo_evolucion = fe.tipo_evolucion
        LEFT JOIN pokemon_forma_evolucion pfe ON fe.id_forma_evolucion = pfe.id_forma_evolucion
        LEFT JOIN pokemon p ON p.numero_pokedex = pfe.numero_pokedex
        WHERE te.tipo_evolucion = '$value'";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->close();
        $stmt =  null;

    }

        static public function seleccionaPokemon_evolucionPiedra($piedra) {

        $sql = "SELECT DISTINCT p.nombre AS nombre_pokemon
        FROM pokemon_forma_evolucion pfe
        JOIN forma_evolucion fe ON pfe.id_forma_evolucion = fe.id_forma_evolucion
        JOIN piedra pi ON fe.id_forma_evolucion = pi.id_forma_evolucion
        JOIN tipo_piedra tp ON pi.id_tipo_piedra = tp.id_tipo_piedra
        JOIN pokemon p ON p.numero_pokedex = pfe.numero_pokedex
        WHERE tp.nombre_piedra = '$piedra'";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->close();
        $stmt =  null;

    }


    static public function seleccionaPokemon_evolucionNivel($nivel,$comparator) {

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

        $sql = "SELECT DISTINCT p.nombre AS nombre_pokemon
        FROM pokemon_forma_evolucion pfe
        JOIN nivel_evolucion ne ON pfe.id_forma_evolucion = ne.id_forma_evolucion
        JOIN pokemon p ON p.numero_pokedex = pfe.numero_pokedex
        WHERE ne.nivel $s $nivel";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->close();
        $stmt =  null;

    }

    static public function seleccionaPokemon_conEvolucion() {

        $sql = "SELECT DISTINCT p.nombre AS nombre_pokemon
        FROM pokemon p
        JOIN evoluciona_de ed ON p.numero_pokedex = ed.pokemon_origen;";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->close();
        $stmt =  null;

    }

    static public function seleccionaPokemon_datos($pokemon) {

        $sql = "SELECT
        p.nombre,
        p.peso,
        p.altura,
        GROUP_CONCAT(DISTINCT t.nombre SEPARATOR '/') AS tipo,
        GROUP_CONCAT(DISTINCT evol.nombre SEPARATOR ', ') AS evoluciona_a,
        GROUP_CONCAT(DISTINCT tp.nombre_piedra SEPARATOR ', ') AS piedra_evolucion,
        GROUP_CONCAT(DISTINCT ne.nivel SEPARATOR ', ') AS nivel_evolucion,
        MAX(CASE WHEN te.tipo_evolucion = 'Intercambio' THEN 1 ELSE 0 END) AS intercambio_evolucion
        FROM pokemon p
        LEFT JOIN pokemon_tipo pt ON p.numero_pokedex = pt.numero_pokedex
        LEFT JOIN tipo t ON pt.id_tipo = t.id_tipo
        LEFT JOIN evoluciona_de ed ON p.numero_pokedex = ed.pokemon_origen
        LEFT JOIN pokemon evol ON ed.pokemon_evolucionado = evol.numero_pokedex
        LEFT JOIN pokemon_forma_evolucion pfe ON p.numero_pokedex = pfe.numero_pokedex
        LEFT JOIN forma_evolucion fe ON pfe.id_forma_evolucion = fe.id_forma_evolucion
        LEFT JOIN tipo_evolucion te ON fe.tipo_evolucion = te.id_tipo_evolucion
        LEFT JOIN piedra pi ON fe.id_forma_evolucion = pi.id_forma_evolucion
        LEFT JOIN tipo_piedra tp ON pi.id_tipo_piedra = tp.id_tipo_piedra
        LEFT JOIN nivel_evolucion ne ON fe.id_forma_evolucion = ne.id_forma_evolucion
        WHERE p.nombre = '$pokemon'
        GROUP BY p.numero_pokedex, p.nombre, p.peso, p.altura";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->close();
        $stmt =  null;

    }


    
}

?>