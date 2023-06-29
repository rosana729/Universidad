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

                            // Obtener las notas si están disponibles
                            $notas = MateriasCursadasC::VerMateriasCursadasC($libreta, $idMateria);

                            // Verificar si se encontraron notas o no
                            $notasDisponibles = ($notas !== false);
                            if (!$notasDisponibles) {
                                echo 'No se encontraron notas. Agrega las notas:';
                            }

                            // Inicializar las variables
                            $parcial1 = "";
                            $parcial2 = "";
                            $parcial3 = "";
                            $parcial4 = "";
                            $estado = "";
                            $notaFinal = 0;
                            // Procesar el formulario de notas si se ha enviado
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $parcial1 = $_POST["parcial_1"];
                                $parcial2 = $_POST["parcial_2"];
                                $parcial3 = $_POST["parcial_3"];
                                $parcial4 = $_POST["parcial_4"];

                                // Calcular la nota final como promedio de las notas parciales
                                $notaFinal = ($parcial1 + $parcial2 + $parcial3 + $parcial4) / 4;

                                // Calcular la forma de aprobación según las notas parciales y la forma de aprobación de la materia
                                if ($parcial1 >= 4 && $parcial2 >= 4 && $parcial3 >= 4 && $parcial4 >= 4) {
                                    if ($notaFinal >= 7 && $materia["forma_aprobacion"] == "promocion") {
                                        $formaAprobacion = "Promoción";
                                    } else {
                                        $formaAprobacion = "Con examen final";
                                    }
                                } elseif ($parcial1 < 4 && $parcial2 < 4 && $parcial3 < 4 && $parcial4 < 4) {
                                    $formaAprobacion = "Desaprobada";
                                    $notaFinal = 2;
                                } else {
                                    $formaAprobacion = "Con examen final";
                                    $notaFinal = ($parcial1 + $parcial2 + $parcial3 + $parcial4) / 3;
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
                                $notaFinal = $notas['nota_final'];

                                // Calcular la forma de aprobación según la nota final y la forma de aprobación de la materia
                                if ($parcial1 >= 4 && $parcial2 >= 4 && $parcial3 >= 4 && $parcial4 >= 4) {
                                    if ($notaFinal >= 7 && $materia["forma_aprobacion"] == "promocion") {
                                        $formaAprobacion = "Promoción";
                                    } else {
                                        $formaAprobacion = "Con examen final";
                                    }
                                } elseif ($notaFinal == 2) {
                                    $formaAprobacion = "Desaprobada";
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
                                echo '<input type="hidden" name="forma_aprobacion" value="' . $formaAprobacion . '">';
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