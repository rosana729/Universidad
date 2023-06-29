<?php
class CarreraC {
    public function CrearCarreraC() {
        if(isset($_POST["carrera"])) {
            $tablaBD = "carreras";
            $carrera = $_POST["carrera"];
            $descripcion = $_POST["descripcion"];
            $fecha = $_POST["fecha"];
            $facultad = $_POST["facultad"];
            $anios_cursada = $_POST["anios_cursada"];
            
            $resultado = CarrerasM::CrearCarrerasM($tablaBD, $carrera, $descripcion, $fecha, $facultad, $anios_cursada);
            
            if ($resultado == true) {
                echo '<script>
                window.location = "carreras";
                </script>';
                exit;
            }
        }
    }
    //Ver Carreras
    public static function VerCarreraC(){
        $tablaBD = "carreras";
        $resultado = CarrerasM::VerCarrerasM($tablaBD);
        return $resultado;
    }
    static public function CarreraC($columna, $valor) {
        $tablaBD = "carreras";
        $resultado = CarrerasM::CarreraM($tablaBD, $columna, $valor);
        return $resultado;
    }
    
    //editar Carreras
    public function EditarCarrerasC() {
        $tablaBD = "carreras";
        $exp = explode("/", $_GET["url"]);
        $id = $exp[1];
        $resultado = CarrerasM::EditarCarrerasM($tablaBD, $id);
    
        echo '<div class="col-md-6 col-xs-12">
        <h2>Nombre Carrera</h2>
        <input type="text" name="carrera" class="form-control input-lg" value="' . $resultado["nombre"] . '" required>
        <input type="hidden" name="Cid" value="' . $resultado["id_carrera"] . '">
        <h2>Descripción</h2>
        <input type="text" name="descripcion" class="form-control input-lg" value="' . $resultado["descripcion"] . '" required>
        <h2>Fecha de Apertura</h2>
        <input type="date" name="fecha" class="form-control input-lg" value="' . $resultado["fecha_apertura"] . '" required>
        <h2>Facultad</h2>
        <input type="text" name="facultad" class="form-control input-lg" value="' . $resultado["facultad"] . '" required>
        <h2>Años de Cursada</h2>
        <input type="number" name="anios_cursada" class="form-control input-lg" value="' . $resultado["anios_cursada"] . '" required>
        <br>
        <button class="btn btn-success" type="submit">Guardar Cambios</button>
        </div>';
        }
    
    public function ActualizarCarreraC() {
        if (isset($_POST["carrera"])) {
            $tablaBD = "carreras";
            $datosC = array(
                "id" => $_POST["Cid"],
                "nombre" => $_POST["carrera"],
                "descripcion" => $_POST["descripcion"],
                "fecha" => $_POST["fecha"],
                "facultad" => $_POST["facultad"],
                "anios_cursada" => $_POST["anios_cursada"]
            );
            $resultado = CarrerasM::ActualizarCarreraM($tablaBD, $datosC);
            
            if ($resultado == true) {
                echo '<script>
                window.location = "http://localhost/universidad/carreras";
                </script>';
                exit;
            }
        }
    }
 
    public function BorrarCarrerasC(){
        $exp = explode("/", $_GET["url"]);
        $id = $exp[1];
        If(isset($id)){
            $tablaBD = "carreras";
            $resultado = CarrerasM::BorrarCarrerasM($tablaBD, $id);
            if($resultado == true){
                echo '<script>
                window.location = "http://localhost/universidad/carreras";
                </script>';
                exit;
            }else {
                echo '<script>
                alert("Error al eliminar la carrera");
                window.location = "http://localhost/universidad/carreras";
                </script>';
                exit;
        }
    }
}

}
?>
