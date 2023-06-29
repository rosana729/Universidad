<?php
class MateriasCursadasC {
    public static function VerMateriasCursadasC($libreta, $idMateria) {
        $resultado = MateriasCursadasM::VerMateriasCursadasM($libreta, $idMateria);
        return $resultado;
    
    }
    
    public static function ObtenerMateriaNoAprobadasC($libreta, $idMateria) {
        $resultado = MateriasCursadasM::VerMateriasCursadasM($libreta, $idMateria);
        return $resultado;
    }
    
    public static function ObtenerMateriaAprobadasC($libreta, $idMateria) {
        $resultado = MateriasCursadasM::VerMateriasCursadasM($libreta, $idMateria);
        return $resultado;
    }
public static function ActualizarEstadoC($libreta, $idMateria, $estado) {
    $resultado = MateriasCursadasM::ActualizarEstadoM($libreta, $idMateria, $estado);
    return $resultado;
}
public function VerMateriasCursadas2C(){
    $tablaBD = "materias_cursadas";
    $resultado = MateriasCursadasM::VerMateriasCursadas2M($tablaBD);
    return $resultado;

}
public static function ActualizarMateriasCursadasC() {
    if (isset($_POST["libreta"]) && !empty($_POST["libreta"]) && !empty($_POST["id_materia"]) && !empty($_POST["estado"]) && !empty($_POST["parcial_1"]) && !empty($_POST["parcial_2"]) && !empty($_POST["parcial_3"]) && !empty($_POST["parcial_4"]) && !empty($_POST["nota_final"])) {
        $tablaBD = "materias_cursadas"; // Nombre de la tabla en la base de datos
        $datosC = array(
            "libreta" => $_POST["libreta"],
            "id_materia" => $_POST["id_materia"],
            "estado" => $_POST["estado"],
            "parcial_1" => $_POST["parcial_1"],
            "parcial_2" => $_POST["parcial_2"],
            "parcial_3" => $_POST["parcial_3"],
            "parcial_4" => $_POST["parcial_4"],
            "nota_final" => $_POST["nota_final"]
        );

        $resultado = MateriasCursadasM::ActualizarMateriasCursadasM($tablaBD, $datosC);
        
        if ($resultado) {
            echo '<script>
                alert("Notas actualizadas correctamente");
                window.location = "Ver-Plan";
            </script>';
        } else {
            echo '<script>
                alert("Error al actualizar las notas");
            </script>';
        }
    } else {
        echo '<script>
            alert("Error: Todos los campos son obligatorios");
        </script>';
    }
}

public static function InsertarMateriasCursadasC() {
    if (isset($_POST["libreta"]) && !empty($_POST["libreta"]) && !empty($_POST["id_materia"]) && !empty($_POST["estado"]) && !empty($_POST["parcial_1"]) && !empty($_POST["parcial_2"]) && !empty($_POST["parcial_3"]) && !empty($_POST["parcial_4"]) && !empty($_POST["nota_final"])) {
        $tablaBD = "materias_cursadas"; // Nombre de la tabla en la base de datos

        $datosC = array(
            "libreta" => $_POST["libreta"],
            "id_materia" => $_POST["id_materia"],
            "estado" => $_POST["estado"],
            "parcial_1" => $_POST["parcial_1"],
            "parcial_2" => $_POST["parcial_2"],
            "parcial_3" => $_POST["parcial_3"],
            "parcial_4" => $_POST["parcial_4"],
            "nota_final" => $_POST["nota_final"]
        );

        $resultado = MateriasCursadasM::InsertarMateriasCursadasM($tablaBD, $datosC);

        if ($resultado) {
            echo '<script>
                alert("Notas insertadas correctamente");
                window.location = "Ver-Plan";
            </script>';
        } else {
            echo '<script>
                alert("Error al insertar las notas ");
            </script>';
        }
    } else {
        echo '<script>
            alert("Error: Todos los campos son obligatorios");
        </script>';
    }
}

}