<?php
class UsuariosC {
    public function IniciarSesionC() {
        if (isset($_POST["libreta"]) && preg_match('/^[a-zA-Z0-9\/]+$/', $_POST["libreta"]) && preg_match('/^[a-zA-Z0-9\/]+$/', $_POST["clave"])) {
            $tablaBD = "usuarios";
            $datosC = array("libreta" => $_POST["libreta"], "clave" => $_POST["clave"]);
            $resultado = UsuariosM::IniciarSesionM($tablaBD, $datosC);
            if ($resultado["libreta"] == $_POST["libreta"] && $resultado["clave"] == $_POST["clave"]) {
                $_SESSION["Ingresar"] = true;
                $_SESSION["rol"] = $resultado["rol"];
                $_SESSION["libreta"] = $resultado["libreta"];
                $_SESSION["nombre"] = $resultado["nombre"];
                $_SESSION["apellido"] = $resultado["apellido"];
                $_SESSION["id_carrera"] = $resultado["id_carrera"];
                $_SESSION["id"] = $resultado["id"];
                echo '<script>window.location = "inicio";</script>';
            }else
            echo '<br> <div class="alert-danger>Error al ingresar</div>';
        }
    }
    public function verMisDatos() {
        $tablaDB = "usuarios";
        $id = $_SESSION["id"];
        $resultado = UsuariosM::VerMisDatosM($tablaDB, $id);
            if ($resultado && is_array($resultado)) {
            echo '<form method="post">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <h2>Fecha de Nacimiento:</h2>
                        <input type="text" class="Input-lg" name="fechanac" value="' . ($resultado["fechanac"] ?? '') . '">
                        <input type="hidden" name="Uid" value="' . ($_SESSION["id"] ?? '') . '">
                        <h2>DNI:</h2>
                        <input type="text" class="Input-lg" name="DNI" value="' . ($resultado["dni"] ?? '') . '">
                        <h2>Codigo Postal:</h2>
                        <input type="text" class="Input-lg" name="codigopostal" value="' . ($resultado["codigopostal"] ?? '') . '">
                        
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <h2>Celular:</h2>
                        <input type="text" class="Input-lg" name="celular" value="' . ($resultado["celular"] ?? '') . '">
                        <h2>Contraseña:</h2>
                        <input type="text" class="Input-lg" name="clave" value="' . ($resultado["clave"] ?? '') . '">
                        <h2>Correo Electrónico:</h2>
                        <input type="text" class="Input-lg" name="email" value="' . ($resultado["email"] ?? '') . '">
                        <br><br>
                        <button type="submit" class="btn btn-success">Guardar Datos</button>
                    </div>
                </div>
            </form>';
        } else {
            // Manejar el caso cuando no se encuentra el registro en la base de datos
        }
        
    }
    
    public function GuardarDatosC() {
        if(isset($_POST["Uid"])) {
            $tablaBD = "usuarios";
            $datosC = array(
                "id" => $_POST["Uid"],
                "fechanac" => $_POST["fechanac"],
                "DNI" => $_POST["DNI"],
                "codigopostal" => $_POST["codigopostal"],
                "celular" => $_POST["celular"],
                "clave" => $_POST["clave"],
                "email" => $_POST["email"]
            );
            $resultado = UsuariosM::GuardarDatosM($tablaBD, $datosC);
            if($resultado == true) {
                echo '<script>window.location = "mis-datos";</script>';
            }
        }
    }
    public static function ObtenerCantidadInscriptosPorAnio($idCarrera) {
        $pdo = ConexionBD::cBD()->prepare("SELECT YEAR(Fecha_Inscripcion) AS anio_inscripcion, COUNT(*) AS cantidad_inscriptos, Fecha_Inscripcion FROM usuarios WHERE id_carrera = :idCarrera GROUP BY anio_inscripcion");
        $pdo->bindParam(':idCarrera', $idCarrera, PDO::PARAM_INT);
        $pdo->execute();
        $resultado = $pdo->fetchAll(PDO::FETCH_ASSOC);
        $pdo->closeCursor();
        $pdo = null;
        return $resultado;
    }
    
    
public function CrearUsuarioC() {
    if (isset($_POST["apellidoU"])) {
        $tablaBD = "usuarios";
        $datosC = array(
            "libreta" => $_POST["usuarioU"],
            "clave" => $_POST["claveU"],
            "nombre" => $_POST["nombreU"],
            "apellido" => $_POST["apellidoU"],
            "fechanac" => $_POST["fechaU"],
            "id_carrera" => $_POST["carreraU"],
            "rol" => $_POST["rolU"],
            "dni" => $_POST["DNI"],
            "codigopostal" => $_POST["codigo_postalU"],
            "celular" => $_POST["celularU"],
            "email" => $_POST["emailU"]);
        $resultado = UsuariosM::CrearUsuarioM($tablaBD, $datosC);
        if($resultado=true){
            echo 'window.location = "index.php?url=usuarios&Uid="+Uid';
        }
    }
}
static public function VerUsuariosC($columna, $valor){
    $tablaBD = "usuarios";
    $resultado = UsuariosM::VerUsuariosM($tablaBD, $columna, $valor);
    return $resultado;
}

// Actualizar usuarios
public function ActualizarUsuariosC(){
    if(isset($_POST["Uid"])){
        $tablaBD = "usuarios";
        $datosC = array(
            "id" => $_POST["Uid"],
            "nombre" => $_POST["nombreEU"],
            "apellido" => $_POST["apellidoEU"],
            "fechanac" => $_POST["fechaEU"],
            "dni" => $_POST["dniEU"],
            "codigopostal" => $_POST["codigo_postalEU"],
            "celular" => $_POST["celularEU"],
            "email" => $_POST["emailEU"],
            "libreta" => $_POST["usuario"],
            "clave" => $_POST["claveEU"],
            "carrera" => $_POST["carreraEU"],
            "rol" => $_POST["rolEU"]
        );
        $resultado = UsuariosM::ActualizarUsuariosM($tablaBD, $datosC);
        if($resultado == true){
            echo '<script> window.location = "usuarios"; </script>';
        }
    }
}
public function EliminarUsuarioC(){
    if (isset($_GET["Uid"])){
        $tablaBD = "usuarios";
        $id = $_GET["Uid"];
        $resultado = UsuariosM::EliminarUsuariosM($tablaBD, $id);
        if ($resultado == true){
            echo '<script> window.location = "usuarios"; </script>';
        }
    }
}
}


