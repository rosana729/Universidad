<?php
class NotasC {
    public static function VerNotasC($libreta, $idMateria) {
        $resultado = NotasM::VerNotasM($libreta, $idMateria);
        return $resultado;
    }
    
    public function AgregarNotasC() {
        if (isset($_POST["parcial_1"]) && isset($_POST["parcial_2"]) && isset($_POST["parcial_3"]) && isset($_POST["parcial_4"])) {
            $libreta = $_POST["libreta"];
            $idMateria = $_POST["id_materia"];
            $parcial1 = $_POST["parcial_1"];
            $parcial2 = $_POST["parcial_2"];
            $parcial3 = $_POST["parcial_3"];
            $parcial4 = $_POST["parcial_4"];
            $formaAprobacion = $_POST["forma_aprobacion"];
            $notaFinal = $_POST["nota_final"];

            // Aquí debes guardar los datos en la base de datos

            // Guardar las notas en la tabla 'notas'
            $resultado = NotasM::AgregarNotasM($libreta, $idMateria, $parcial1, $parcial2, $parcial3, $parcial4, $notaFinal);

            // Actualizar el estado en la tabla 'materias_cursadas'
            $estado = $_POST["estado"];
            $datosCursada = array(
                "libreta" => $libreta,
                "id_materia" => $idMateria,
                "estado" => $estado
            );
            $resultadoCursada = MateriasCursadasM::AgregarMateriasCursadasM("materias_cursadas", $datosCursada);

            if ($resultado && $resultadoCursada) {
                echo '<script> window.location = "Ver-Plan"; </script>';
            }
        }
    }
}
 
?>
