<?php

class MateriasC {
    public function CrearMateriaC() {
        if (isset($_POST["nombreM"])) {
            $tablaBD = "materias"; // Nombre de la tabla en la base de datos

            $datosC = array(
                "nombre" => $_POST["nombreM"],
                "horas_cursada" => $_POST["horas_cursadaM"],
                "forma_aprobacion" => $_POST["forma_aprobacionM"],
                "carrera" => $_POST["carreraM"],
                "anio_cursada" => $_POST["anio_cursadaM"]
            );

            $respuesta = MateriasM::CrearMateriaM($tablaBD, $datosC);

            if ($respuesta) {
                echo '<script>
                    alert("La materia se ha creado correctamente");
                    window.location = "CrearMaterias.php?url= "http://localhost/universidad/CrearMaterias/";
                </script>';
            } else {
                echo '<script>
                    alert("Error al crear la materia");
                </script>';
            }
        }
    }
 
public function VerMateriasC(){
        $tablaBD = "materias";
        $resultado = MateriasM::VerMateriasM($tablaBD);
        return $resultado;

}
public static function VerMateriasPorLibreta($libreta) {
    $resultado = MateriasM::VerMateriasPorLibretaM($libreta);
    return $resultado;
}
public static function VerMaterias2C($tablaBD, $id) {
    $resultado = MateriasM::VerMaterias2M($tablaBD, $id);
    return $resultado;
}
public static function VerMaterias3C($libreta, $id_materia) {
    $tablaBD = "materias";
    $resultado = MateriasM::VerMaterias3M($tablaBD, $libreta, $id_materia);
    return $resultado;
}

public function EliminarMateriaC() {
    if (isset($_GET["Mid"])) {
        $tablaBD = "materias";
        $id = $_GET["Mid"];
        $Cid = $_GET["Cid"];
        $resultado = MateriasM::EliminarMateriaM($tablaBD, $id);
        if ($resultado == true) {
            $url = "http://localhost/universidad/CrearMaterias.php?rand=" . uniqid();
            header("Location: " . $url);
            exit();
        }
    }
}
public static function ObtenerMateriasPorAnioC($anio) {
    $resultado = MateriasM::ObtenerMateriasPorAnio2M($anio);
    return $resultado;
}

}
