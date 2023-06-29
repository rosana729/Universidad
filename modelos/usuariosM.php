<?php
require_once "conexionBD.php";
class UsuariosM extends ConexionBD {
    static public function IniciarSesionM($tablaBD, $datosC) {
        $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD WHERE libreta = :libreta");
        $pdo->bindParam(":libreta", $datosC["libreta"], PDO::PARAM_STR);
        $pdo->execute();
        $ress = $pdo->fetch();
        $pdo->closeCursor();
        $pdo = null;
        return $ress;
    }
    public static function VerMisDatosM($tablaBD, $id) {
        $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD WHERE id = :id");
        $pdo->bindParam(":id", $id, PDO::PARAM_STR);
        $pdo->execute();
        $ress = $pdo->fetch();
        $pdo->closeCursor();
        $pdo = null;
        return $ress;
    }
    public static function VerUsuarios2M($tablaBD) {
        $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD");
        $pdo->execute();
        $resultado = $pdo->fetchAll();
        $pdo->closeCursor();
        $pdo = null;
        return $resultado;
    }
    
    public static function GuardarDatosM($tablaBD, $datosC) {
        $pdo = ConexionBD::cBD()->prepare("UPDATE $tablaBD SET fechanac=:fechanac, DNI=:dni, codigopostal=:codigopostal, celular=:celular, clave=:clave, email=:email WHERE id=:id");
        $pdo->bindParam(":id", $datosC["id"], PDO::PARAM_INT);
        $pdo->bindParam(":fechanac", $datosC["fechanac"], PDO::PARAM_STR);
        $pdo->bindParam(":dni", $datosC["DNI"], PDO::PARAM_STR);
        $pdo->bindParam(":codigopostal", $datosC["codigopostal"], PDO::PARAM_STR);
        $pdo->bindParam(":celular", $datosC["celular"], PDO::PARAM_STR);
        $pdo->bindParam(":clave", $datosC["clave"], PDO::PARAM_STR);
        $pdo->bindParam(":email", $datosC["email"], PDO::PARAM_STR);
        if($pdo->execute()) {
            $pdo->closeCursor();
            $pdo = null;
            return true;
        }
        $pdo->closeCursor();
        $pdo = null;
        return false;
    }
    public static function CrearUsuarioM($tablaBD, $datosC) {
        $datosC["Fecha_Inscripcion"] = date("Y-m-d"); // Obtiene la fecha actual
        $pdo = ConexionBD::cBD()->prepare("INSERT INTO $tablaBD(libreta, clave, nombre, apellido, fechanac, id_carrera, rol, dni, codigopostal, celular, email, Fecha_Inscripcion) VALUES(:libreta, :clave, :nombre, :apellido, :fechanac, :id_carrera, :rol, :dni, :codigopostal, :celular, :email, :Fecha_Inscripcion)");
        $pdo->bindParam(":libreta", $datosC["libreta"], PDO::PARAM_STR);
        $pdo->bindParam(":clave", $datosC["clave"], PDO::PARAM_STR);
        $pdo->bindParam(":nombre", $datosC["nombre"], PDO::PARAM_STR);
        $pdo->bindParam(":apellido", $datosC["apellido"], PDO::PARAM_STR);
        $pdo->bindParam(":fechanac", $datosC["fechanac"], PDO::PARAM_STR);
        $pdo->bindParam(":id_carrera", $datosC["id_carrera"], PDO::PARAM_INT);
        $pdo->bindParam(":rol", $datosC["rol"], PDO::PARAM_STR);
        $pdo->bindParam(":dni", $datosC["dni"], PDO::PARAM_STR);
        $pdo->bindParam(":codigopostal", $datosC["codigopostal"], PDO::PARAM_STR);
        $pdo->bindParam(":celular", $datosC["celular"], PDO::PARAM_STR);
        $pdo->bindParam(":email", $datosC["email"], PDO::PARAM_STR);
        $pdo->bindParam(":Fecha_Inscripcion", $datosC["Fecha_Inscripcion"], PDO::PARAM_STR);
        if($pdo->execute()){
            return true;
        }
        $pdo = null;
    }
    static public function VerUsuariosM($tablaBD, $columna, $valor) {
        if ($columna != null) {
            $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD WHERE $columna = :$columna");
            $pdo->bindParam(":".$columna, $valor, PDO::PARAM_STR);
            $pdo->execute();
            $result = $pdo->fetch();
            $pdo->closeCursor(); 
            return $result;
        } else {
            $pdo = ConexionBD::cBD()->prepare("SELECT * FROM $tablaBD");
            $pdo->execute();
            $result = $pdo->fetchAll();
            $pdo->closeCursor(); 
            return $result;
        }
    }
    static public function ActualizarUsuariosM($tablaBD, $datosC) {
        $pdo = ConexionBD::cBD()->prepare("UPDATE $tablaBD SET apellido = :apellido, nombre = :nombre, fechanac = :fechanac, id_carrera = :id_carrera, rol = :rol, dni = :dni, codigopostal = :codigopostal, celular = :celular, email = :email, libreta = :libreta, clave = :clave WHERE id = :id");
        $pdo->bindParam(":apellido", $datosC["apellido"], PDO::PARAM_STR);
        $pdo->bindParam(":nombre", $datosC["nombre"], PDO::PARAM_STR);
        $pdo->bindParam(":fechanac", $datosC["fechanac"], PDO::PARAM_STR);
        $pdo->bindParam(":id_carrera", $datosC["carrera"], PDO::PARAM_INT);
        $pdo->bindParam(":rol", $datosC["rol"], PDO::PARAM_STR);
        $pdo->bindParam(":dni", $datosC["dni"], PDO::PARAM_STR);
        $pdo->bindParam(":codigopostal", $datosC["codigopostal"], PDO::PARAM_STR);
        $pdo->bindParam(":celular", $datosC["celular"], PDO::PARAM_STR);
        $pdo->bindParam(":email", $datosC["email"], PDO::PARAM_STR);
        $pdo->bindParam(":libreta", $datosC["libreta"], PDO::PARAM_STR);
        $pdo->bindParam(":clave", $datosC["clave"], PDO::PARAM_STR);
        $pdo->bindParam(":id", $datosC["id"], PDO::PARAM_INT);
        if($pdo->execute()){
            return true;
        }
         $pdo = null;
    }
    
    static public function EliminarUsuariosM($tablaBD, $id){
        $pdo = ConexionBD::cBD()->prepare("DELETE FROM $tablaBD WHERE id = :id");
        $pdo->bindParam(":id", $id, PDO::PARAM_INT);
        if ($pdo->execute()) {
            return true;
        }
        $pdo = null;
    }
    
}
?>

