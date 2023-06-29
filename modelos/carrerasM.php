<?php
require_once "conexionBD.php";
class CarrerasM extends ConexionBD{
    //crear carrera
    static public function CrearCarrerasM($tablaBD, $carrera, $descripcion, $fecha, $facultad, $anios_cursada) {
        $pdo = ConexionBD::cBD()->prepare("INSERT INTO $tablaBD (nombre, descripcion, fecha_apertura, facultad, anios_cursada) VALUES (:nombre, :descripcion, :fecha_apertura, :facultad, :anios_cursada)");
        $pdo->bindParam(":nombre", $carrera, PDO::PARAM_STR);
        $pdo->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
        $pdo->bindParam(":fecha_apertura", $fecha, PDO::PARAM_STR);
        $pdo->bindParam(":facultad", $facultad, PDO::PARAM_STR);
        $pdo->bindParam(":anios_cursada", $anios_cursada, PDO::PARAM_INT);
    
        if ($pdo->execute()) {
            return true;
        }
        
        $pdo->closeCursor();
        $pdo = null;
    }
   static public function VerCarrerasM($tablaBD) {
    $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD");
    $pdo->execute();
    $resultado = $pdo->fetchAll();
    $pdo->closeCursor();
    $pdo = null;
    return $resultado;
}
static public function CarreraM($tablaBD, $columna, $valor) {
    $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD WHERE $columna = :$columna");
    $pdo->bindParam(":".$columna, $valor, PDO::PARAM_STR);
    $pdo->execute();
    $result = $pdo->fetch();
    $pdo->closeCursor();
    $pdo = null;
    return $result;
}

static public function EditarCarrerasM($tablaBD, $id)
{
    $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD WHERE id_carrera = :id_carrera");
    $pdo->bindParam(":id_carrera", $id, PDO::PARAM_INT);
    $pdo->execute();
    $resultado = $pdo->fetch();
    $pdo->closeCursor();
    $pdo = null;
    return $resultado;
}

public static function ActualizarCarreraM($tablaBD, $datosC) {
    $pdo = ConexionBD::cBD()->prepare("UPDATE $tablaBD SET nombre = :nombre, descripcion = :descripcion, fecha_apertura = :fecha_apertura, facultad = :facultad, anios_cursada = :anios_cursada WHERE id_carrera = :id_carrera");
    $pdo->bindParam(":id_carrera", $datosC["id"], PDO::PARAM_INT);
    $pdo->bindParam(":nombre", $datosC["nombre"], PDO::PARAM_STR);
    $pdo->bindParam(":descripcion", $datosC["descripcion"], PDO::PARAM_STR);
    $pdo->bindParam(":fecha_apertura", $datosC["fecha"], PDO::PARAM_STR);
    $pdo->bindParam(":facultad", $datosC["facultad"], PDO::PARAM_STR);
    $pdo->bindParam(":anios_cursada", $datosC["anios_cursada"], PDO::PARAM_INT);
    
    if ($pdo->execute()) {
        return true;
    }
    
    $pdo->closeCursor();
    $pdo = null;
    return false;
}
public static function BorrarCarrerasM($tablaBD, $id) {
    $pdo = ConexionBD::cBD()->prepare("DELETE FROM $tablaBD WHERE id_carrera = :id_carrera");
    $pdo->bindParam(":id_carrera", $id, PDO::PARAM_INT);
    
    if($pdo->execute()){
        return true;
    }
    
    $pdo->closeCursor();
    $pdo = null;
    return false;
}
}
