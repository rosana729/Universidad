<?php

require_once "conexionBD.php";

class MateriasM {
    public static function CrearMateriaM($tablaBD, $datosC) {
        try {
            $pdo = ConexionBD::cBD()->prepare("INSERT INTO $tablaBD(nombre, horas_cursada, forma_aprobacion, carrera, anio_cursada) VALUES(:nombre, :horas_cursada, :forma_aprobacion, :carrera, :anio_cursada)");  
            $pdo->bindParam(":nombre", $datosC["nombre"], PDO::PARAM_STR);
            $pdo->bindParam(":horas_cursada", $datosC["horas_cursada"], PDO::PARAM_INT);
            $pdo->bindParam(":forma_aprobacion", $datosC["forma_aprobacion"], PDO::PARAM_STR);
            $pdo->bindParam(":carrera", $datosC["carrera"], PDO::PARAM_INT);
            $pdo->bindParam(":anio_cursada", $datosC["anio_cursada"], PDO::PARAM_INT);
            
            if ($pdo->execute()) {
                return true;
            }
            
            $pdo->closeCursor();
            $pdo = null;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
        return false;
    }
    public static function VerMateriasM($tablaBD) {
        $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD");
        $pdo->execute();
        $res = $pdo->fetchAll(PDO::FETCH_ASSOC);
        $pdo->closeCursor();
        $pdo = null;
        return $res;
    }
    public static function VerMaterias2M($tablaBD, $id) {
        $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD WHERE id_materia = :id_materia");
        $pdo->bindParam(':id_materia', $id);
        $pdo->execute();
        $res = $pdo->fetch();
        $pdo->closeCursor();
        $pdo = null;
        return $res;
    }
    public static function VerMateriasPorLibretaM($libreta) {
        $pdo = ConexionBD::cBD()->prepare("SELECT * FROM materias WHERE libreta = :libreta");
        $pdo->bindParam(':libreta', $libreta);
        $pdo->execute();
        $res = $pdo->fetch();
        $pdo->closeCursor();
        $pdo = null;
        return $res;
    }
    
    public static function VerMaterias3M($tablaBD, $libreta, $id_materia) {
        $pdo = ConexionBD::cBD()->prepare("SELECT m.*, c.id_carrera
                                          FROM $tablaBD AS m
                                          JOIN carreras AS c ON m.carrera = c.id_carrera
                                          WHERE m.id_materia = :id_materia
                                          AND EXISTS (SELECT 1 FROM materias_cursadas WHERE id_materia = m.id_materia AND libreta = :libreta)");
        $pdo->bindParam(':id_materia', $id_materia);
        $pdo->bindParam(':libreta', $libreta);
        $pdo->execute();
        $res = $pdo->fetch();
        $pdo = null;
        return $res;
    }
    
    public static function EliminarMateriaM($tablaBD, $id) {
        $pdo = ConexionBD::cBD()->prepare("DELETE FROM $tablaBD WHERE id_materia = :id_materia");
        $pdo->bindParam(":id_materia", $id, PDO::PARAM_INT);
        $pdo->execute();
    
        if ($pdo->rowCount() > 0) {
            $pdo->closeCursor();
            $pdo = null;
            return true;
        }
        
        $pdo->closeCursor();
        $pdo = null;
        return false;
    }
    public static function VerMateriasCursadasM($libreta, $idMateria) {
        $pdo = ConexionBD::cBD()->prepare("SELECT estado FROM materias_cursadas WHERE libreta = :libreta AND id_materia = :id_materia");
        $pdo->bindParam(":libreta", $libreta);
        $pdo->bindParam(":id_materia", $idMateria);
        $pdo->execute();

        return $pdo->fetch(PDO::FETCH_ASSOC);
    }
    public static function ObtenerMateriasPorAnioM($tablaBD, $anio) {
        $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD WHERE anio_cursada = :anio");
        $pdo->bindParam(":anio", $anio, PDO::PARAM_INT);
        $pdo->execute();
        $res = $pdo->fetchAll(PDO::FETCH_ASSOC);
        $pdo->closeCursor();
        $pdo = null;
        return $res;
    }
    public static function ObtenerMateriasPorAnio2M($anio) {
        $pdo = ConexionBD::cBD()->prepare("SELECT * FROM materias WHERE anio_cursada = :anio");
        $pdo->bindParam(":anio", $anio, PDO::PARAM_INT);
        $pdo->execute();
        $res = $pdo->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
        return $res;
    }     
   }
