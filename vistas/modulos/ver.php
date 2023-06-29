<div class="content-wrapper">
    <section class="content">
        <div class="box">
            <div class="box-body">
                <form method="post" action="<?php echo empty($notas) ? 'insertar' : 'actualizar'; ?>">
                    <?php
                    $exp = explode("/", $_GET["url"]);
                    $columnaC = "libreta";
                    $valorC = $exp[2];
                    $estudiante = UsuariosC::VerUsuariosC($columnaC, $valorC);
                    echo '<h1>Alumno: ' . $estudiante["nombre"] . ' ' . $estudiante["apellido"] . ' <br> Libreta:' . $estudiante["libreta"] . '</h1>';
                    $columna = "id_materia";
                    $valor = $exp[3];
                    $materia = MateriasC::VerMaterias2C("materias", $valor);
                    if ($materia) {
                        echo '<h2>Materia: ' . $materia["nombre"] . '</h2>';
                    }
                    ?>

                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <?php
                            $libreta = $estudiante["libreta"];
                            $idMateria = $valor;
                            $notaFinal = "";
                            $formaAprobacion = "";

                            // Obtener las notas si están disponibles
                            $notas = MateriasCursadasC::VerMateriasCursadasC($libreta, $idMateria);

                            // Verificar si se encontraron notas o no
                            $notasDisponibles = ($notas !== false);

                            // Inicializar las variables
                            $parcial1 = "";
                            $parcial2 = "";
                            $parcial3 = "";
                            $parcial4 = "";
                            $estado = "";

                            // Procesar el formulario de notas si se ha enviado
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $parcial1 = isset($_POST["parcial_1"]) && is_numeric($_POST["parcial_1"]) ? $_POST["parcial_1"] : 0;
                                $parcial2 = isset($_POST["parcial_2"]) && is_numeric($_POST["parcial_2"]) ? $_POST["parcial_2"] : 0;
                                $parcial3 = isset($_POST["parcial_3"]) && is_numeric($_POST["parcial_3"]) ? $_POST["parcial_3"] : 0;
                                $parcial4 = isset($_POST["parcial_4"]) && is_numeric($_POST["parcial_4"]) ? $_POST["parcial_4"] : 0;

                                // Calcular la nota final como promedio de las notas parciales
                                $notaFinal = ($parcial1 + $parcial2 + $parcial3 + $parcial4) / 4;

                                // Calcular la forma de aprobación según la nota final y la forma de aprobación de la materia
                                if ($notaFinal >= 7 && $materia["forma_aprobacion"] == "promocion") {
                                    $formaAprobacion = "Promoción";
                                } else {
                                    $formaAprobacion = "Con examen final";
                                }

                                $estado = $_POST["estado"];

                                // Guardar los datos en la base de datos
                                $datosC = array(
                                    "libreta" => $libreta,
                                    "id_materia" => $valor,
                                    "estado" => $estado,
                                    "parcial_1" => $parcial1,
                                    "parcial_2" => $parcial2,
                                    "parcial_3" => $parcial3,
                                    "parcial_4" => $parcial4,
                                    "nota_final" => $notaFinal
                                );
                                $datosA = array(
                                    "libreta" => $libreta,
                                    "id_materia" => $valor,
                                    "estado" => $estado,
                                    "parcial_1" => $parcial1,
                                    "parcial_2" => $parcial2,
                                    "parcial_3" => $parcial3,
                                    "parcial_4" => $parcial4,
                                    "nota_final" => $notaFinal
                                );

                                if ($notasDisponibles) {
                                    // Actualizar los datos de las notas existentes
                                    MateriasCursadasC::ActualizarMateriasCursadasC($datosC);
                                } else {
                                    // Insertar los nuevos datos de las notas
                                    MateriasCursadasC::InsertarMateriasCursadasC($datosA);
                                }
                            }

                            if ($notasDisponibles) {
                                $parcial1 = $notas['parcial_1'];
                                $parcial2 = $notas['parcial_2'];
                                $parcial3 = $notas['parcial_3'];
                                $parcial4 = $notas['parcial_4'];

                                // Calcular la nota final si se encontraron las notas
                                $notaFinal = ($parcial1 + $parcial2 + $parcial3 + $parcial4) / 4;

                                // Calcular la forma de aprobación según la nota final y la forma de aprobación de la materia
                                if ($notaFinal >= 7 && $materia["forma_aprobacion"] == "promocion") {
                                    $formaAprobacion = "Promoción";
                                } else {
                                    $formaAprobacion = "Con examen final";
                                }

                                // Obtener el valor del estado desde las notas encontradas
                                $estado = $notas["estado"];
                            }

                            echo '<h2>Parcial 1:</h2>
                            <input type="text" class="input-lg" name="parcial_1" value="' . $parcial1 . '">
                            <h2>Parcial 2:</h2>
                            <input type="text" class="input-lg" name="parcial_2" value="' . $parcial2 . '">
                            <h2>Parcial 3:</h2>
                            <input type="text" class="input-lg" name="parcial_3" value="' . $parcial3 . '">
                            <h2>Parcial 4:</h2>
                            <input type="text" class="input-lg" name="parcial_4" value="' . $parcial4 . '">
                            <br><br>';

                            if (!$notasDisponibles) {
                                // Formulario vacío, el usuario puede agregar las notas
                                echo 'No se encontraron notas. Agrega las notas:';
                            }
                            ?>
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <h2>Fecha</h2>
                            <input type="date" class="input-lg" name="fecha" value="<?php echo date('Y-m-d'); ?>">
                            <h2>Estado</h2>
                            <select class="input-lg" name="estado">
                                <option value=""><?php echo "Estado actual: " . $estado; ?></option>
                                <option value="No Cursada" <?php echo ($estado == "No Cursado" ? "selected" : ""); ?>>No Cursado</option>
                                <option value="Aprobada" <?php echo ($estado == "Aprobado" ? "selected" : ""); ?>>Aprobado</option>
                                <option value="Desaprobada" <?php echo ($estado == "Desaprobado" ? "selected" : ""); ?>>Desaprobado</option>
                                <option value="Regular" <?php echo ($estado == "Regular" ? "selected" : ""); ?>>Regular</option>
                            </select>

                            <?php if ($notasDisponibles) {
                             echo '<input type="hidden" name="forma_aprobacion"><h2>Forma de Aprobación:'.$formaAprobacion.'</h2>';
                             } else{
                                '<input type="hidden" name="forma_aprobacion" value="<?php echo $formaAprobacion; ?>';
                            } ?>

                            <h2>Nota Final:</h2>
                            <input type="text" class="input-lg" name="nota_final" value="<?php echo $notaFinal; ?>">
                            <input type="hidden" name="libreta" value="<?php echo $libreta; ?>">
                            <input type="hidden" name="id_materia" value="<?php echo $valor; ?>">
                            <br><br>
                            <?php if ($notasDisponibles) {
                             echo '<button class="btn btn-success btn-lg" type="submit" name="volver">Actualizar</button>
                             <button class="btn btn-primary btn-lg" type="button" onclick="goBack()">Volver</button>
                            <script>
                                function goBack() {
                                    window.history.back();
                                }
                            </script>';
                            } else {
                                echo '<button class="btn btn-success btn-lg" type="submit" name="volver">Agregar</button>
                                <button class="btn btn-primary btn-lg" type="button" onclick="goBack()">Volver</button>
                            <script>
                                function goBack() {
                                    window.history.back();
                                }
                            </script>';
                            } ?>



                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
public function VerMateriasCursadasAnioC($libreta, $anio) {
    $materiasCursadas = array();

    // Obtener las materias cursadas por libreta
    $materiasCursadasEstudiante = $this->VerMateriasCursadasC($libreta, null);

    // Obtener las materias correspondientes al año de cursada
    $materiasAnio = MateriasM::ObtenerMateriasPorAnioM($anio);

    // Filtrar las materias cursadas por año
    foreach ($materiasCursadasEstudiante as $materiaCursada) {
        $idMateria = $materiaCursada["id_materia"];
        foreach ($materiasAnio as $materia) {
            if ($materia["id_materia"] == $idMateria) {
                $materiasCursadas[] = $materia;
                break;
            }
        }
    }

    return $materiasCursadas;
}

function ContarMateriasAprobadas($libreta, $anio) {
    $materiasCursadasC = new MateriasCursadasC();
    $materiasAprobadas = 0;
    $materiasTotales = 0;

    $resultado = $materiasCursadasC->VerMateriasCursadasAnioC($libreta, $anio);
    
    foreach ($resultado as $key => $value) {
        if ($value["estado"] == "Aprobada") {
            $materiasAprobadas++;
        }
        $materiasTotales++;
    }

    return array($materiasAprobadas, $materiasTotales);
}
public function ObtenerDatosNotaFinalM($libreta, $idMateria) {
    $resultado = MateriasCursadasM::O($libreta, $idMateria);
    return $resultado;
}


