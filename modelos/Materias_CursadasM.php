
<?php
require_once "conexionBD.php";
class MateriasCursadasM {
static public function ObtenerEstadoMateriaM($idMateria) {
        $stmt = ConexionBD::cBD()->prepare("SELECT estado FROM materias_cursadas WHERE id_materia = :idMateria");
        $stmt->bindParam(":idMateria", $idMateria, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public static function VerMateriasCursadasM($libreta, $idMateria) {
        $pdo = ConexionBD::cBD()->prepare("SELECT * FROM materias_cursadas WHERE libreta = :libreta AND id_materia = :id_materia");
        $pdo->bindParam(":libreta", $libreta);
        $pdo->bindParam(":id_materia", $idMateria);
        $pdo->execute();
    
        return $pdo->fetch(PDO::FETCH_ASSOC);
    }
    public static function OptenerMateriasporAnioM($libreta, $idMateria) {
        $pdo = ConexionBD::cBD()->prepare("SELECT * FROM materias_cursadas WHERE libreta = :libreta AND id_materia = :id_materia");
        $pdo->bindParam(":libreta", $libreta);
        $pdo->bindParam(":id_materia", $idMateria);
        $pdo->execute();
    
        return $pdo->fetch(PDO::FETCH_ASSOC);
    }

    public static function ActualizarEstadoM($libreta, $idMateria, $estado) {
        try {
            $pdo = ConexionBD::cBD()->prepare("UPDATE materias_cursadas SET estado = :estado WHERE libreta = :libreta AND id_materia = :id_materia");
            $pdo->bindParam(":libreta", $libreta);
            $pdo->bindParam(":id_materia", $idMateria);
            $pdo->bindParam(":estado", $estado);
    
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
static public function ObtenerMateriaNoAprobadasM($idMateria) {
    $stmt = ConexionBD::cBD()->prepare("SELECT estado FROM materias_cursadas WHERE id_materia = :idMateria AND estado NOT IN ('Aprobada', 'Promocionada')");
    $stmt->bindParam(":idMateria", $idMateria, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

static public function ObtenerMateriaAprobadasM($idMateria) {
    $stmt = ConexionBD::cBD()->prepare("SELECT estado FROM materias_cursadas WHERE id_materia = :idMateria AND estado IN ('Aprobada', 'Promocionada')");
    $stmt->bindParam(":idMateria", $idMateria, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
public static function VerMateriasCursadas2M($tablaBD) {
    $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD");
    $pdo->execute();
    $res = $pdo->fetchAll(PDO::FETCH_ASSOC);
    $pdo->closeCursor();
    $pdo = null;
    return $res;
}
public static function ActualizarMateriasCursadasM($tablaBD, $datosC) {
    // Verificar si el registro existe
    $pdo = ConexionBD::cBD()->prepare("SELECT COUNT(*) as count FROM $tablaBD WHERE libreta = :libreta AND id_materia = :id_materia");
    $pdo->bindParam(":libreta", $datosC["libreta"], PDO::PARAM_STR);
    $pdo->bindParam(":id_materia", $datosC["id_materia"], PDO::PARAM_INT);
    $pdo->execute();
    
    $rowCount = $pdo->fetch(PDO::FETCH_ASSOC)['count'];
    
    if ($rowCount === 0) {
        // El registro no existe, puedes manejar el caso aquí (lanzar una excepción, mostrar un mensaje de error, etc.)
        return false;
    }
    
    // El registro existe, realizar la actualización
    $stmt = ConexionBD::cBD()->prepare("UPDATE $tablaBD SET estado = :estado, parcial_1 = :parcial_1, parcial_2 = :parcial_2, parcial_3 = :parcial_3, parcial_4 = :parcial_4, nota_final = :nota_final WHERE libreta = :libreta AND id_materia = :id_materia");
    $stmt->bindParam(":libreta", $datosC["libreta"], PDO::PARAM_STR);
    $stmt->bindParam(":id_materia", $datosC["id_materia"], PDO::PARAM_INT);
    $stmt->bindParam(":estado", $datosC["estado"], PDO::PARAM_STR);
    $stmt->bindParam(":parcial_1", $datosC["parcial_1"], PDO::PARAM_STR);
    $stmt->bindParam(":parcial_2", $datosC["parcial_2"], PDO::PARAM_STR);
    $stmt->bindParam(":parcial_3", $datosC["parcial_3"], PDO::PARAM_STR);
    $stmt->bindParam(":parcial_4", $datosC["parcial_4"], PDO::PARAM_STR);
    $stmt->bindParam(":nota_final", $datosC["nota_final"], PDO::PARAM_STR);
    
    return $stmt->execute();
}
    
public static function InsertarMateriasCursadasM($tablaBD, $datosC){
        $id_materia = $datosC["id_materia"];
        
        // Verificar si el registro ya existe
        $pdo = ConexionBD::cBD()->prepare("SELECT COUNT(*) as count FROM $tablaBD WHERE id_materia = :id_materia");
        $pdo->bindParam(":id_materia", $id_materia, PDO::PARAM_INT);
        $pdo->execute();
        
        $rowCount = $pdo->fetch(PDO::FETCH_ASSOC)['count'];
        
        if ($rowCount > 0) {
            return false;
        }
                // El registro no existe, realizar la inserción
        $stmt = ConexionBD::cBD()->prepare("INSERT INTO $tablaBD (libreta, id_materia, estado, parcial_1, parcial_2, parcial_3, parcial_4, nota_final) VALUES (:libreta, :id_materia, :estado, :parcial_1, :parcial_2, :parcial_3, :parcial_4, :nota_final)");
        $stmt->bindParam(":libreta", $datosC["libreta"], PDO::PARAM_STR);
        $stmt->bindParam(":id_materia", $id_materia, PDO::PARAM_INT);
        $stmt->bindParam(":estado", $datosC["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":parcial_1", $datosC["parcial_1"], PDO::PARAM_STR);
        $stmt->bindParam(":parcial_2", $datosC["parcial_2"], PDO::PARAM_STR);
        $stmt->bindParam(":parcial_3", $datosC["parcial_3"], PDO::PARAM_STR);
        $stmt->bindParam(":parcial_4", $datosC["parcial_4"], PDO::PARAM_STR);
        $stmt->bindParam(":nota_final", $datosC["nota_final"], PDO::PARAM_STR);
        
        return $stmt->execute();
    }
    public static function ObtenerDatosNotaFinalM($libreta, $idMateria) {
        $pdo = ConexionBD::cBD()->prepare("SELECT estado, nota_final FROM materias_cursadas WHERE libreta = :libreta AND id_materia = :idMateria");
        $pdo->bindParam(":libreta", $libreta, PDO::PARAM_STR);
        $pdo->bindParam(":idMateria", $idMateria, PDO::PARAM_INT);
        $pdo->execute();
        $res = $pdo->fetch(PDO::FETCH_ASSOC);
        $pdo = null;
        return $res;
    }
}