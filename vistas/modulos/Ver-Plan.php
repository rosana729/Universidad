<?php
if ($_SESSION["rol"] != "Administrador") {
    echo '<script>window.location = "Inicio";</script>';
    return;
}

?>
<div class="content-wrapper">
    <section class="content-header">
        <?php
        $exp = explode("/", $_GET["url"]);
        $columnaC = "libreta";
        $valorC = $exp[2];
        $estudiante = UsuariosC::VerUsuariosC($columnaC, $valorC);
        echo '<h1>Plan de Estudio del Estudiante: ' . $estudiante["nombre"] . ' ' . $estudiante["apellido"] . ' <br> Libreta:' . $estudiante["libreta"] . '</h1>';
        ?>

    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Horas Cursada</th>
                            <th>Forma Aprobacion</th>
                            <th>Año que Cursa</th>
                            <th>Estado</th>
                            <th>Editar/Agregar Notas</th>
                                   </tr>
                    </thead>
                    <tbody>
     
<?php
                        $materiasC = new MateriasC();
                        $materiasCursadasC = new MateriasCursadasC();
                        $resultado = $materiasC->VerMateriasC();
                        $libreta = $exp[2];
                        $primerAnioCarrera = 1; // Definir el año correspondiente al primer año de la carrera

                        // Verificar si el estudiante ha sido inscripto recientemente y no tiene materias
                        $materiaId = $exp[2]; // Reemplazar 'id_materia' por el valor real de la variable que contiene el ID de la materia
                        $sinMaterias = true; // Establecer un valor predeterminado para $sinMaterias

                        if (!empty($materiasC->VerMaterias3C($libreta, $materiaId))) {
                            $sinMaterias = false;
                        }

                        foreach ($resultado as $key => $value) {
                            if (isset($estudiante["id_carrera"]) && $value["carrera"] == $estudiante["id_carrera"]) {
                                $estadoMateria = $materiasCursadasC->VerMateriasCursadasC($libreta, $value["id_materia"]);

                                // Mostrar las materias en estado "Regular" o "No cursadas" si cumplen las condiciones
                                if ($estadoMateria === false && $value["anio_cursada"] == $primerAnioCarrera) {
                                    echo '<tr>
                                            <td>' . $value["nombre"] . '</td>
                                            <td>' . $value["horas_cursada"] . '</td>
                                            <td>' . $value["forma_aprobacion"] . '</td>
                                            <td>' . $value["anio_cursada"] . '</td>
                                            <td>No cursada</td>
                                            <td><a href="http://localhost/universidad/Nota-Materia/' . $exp[1] . '/' . $exp[2] . '/' . $value["id_materia"] . '">
                                                    <button class="btn btn-success btn-sm pull-left">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761-5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                        </svg>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>';
                                } elseif (isset($estadoMateria["estado"]) && $estadoMateria["estado"] == "Regular") {
                                    echo '<tr>
                                            <td>' . $value["nombre"] . '</td>
                                            <td>' . $value["horas_cursada"] . '</td>
                                            <td>' . $value["forma_aprobacion"] . '</td>
                                            <td>' . $value["anio_cursada"] . '</td>
                                            <td>Regular</td>
                                            <td><a href="http://localhost/universidad/Nota-Materia/' . $exp[1] . '/' . $exp[2] . '/' . $value["id_materia"] . '">
                                                    <button class="btn btn-success btn-sm pull-left">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761-5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                        </svg>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>';
        }
    }
}
?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    
    <section class="content-header">
        <h1>Materias Aprobadas</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Horas Cursada</th>
                            <th>Forma Aprobacion</th>
                            <th>Año que Cursa</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
foreach ($resultado as $key => $value) {
    if (isset($estudiante["id_carrera"]) && $value["carrera"] == $estudiante["id_carrera"]) {
        $estadoMateria = $materiasCursadasC->VerMateriasCursadasC($libreta, $value["id_materia"]);
        if ($estadoMateria !== false && isset($estadoMateria["estado"]) && ($estadoMateria["estado"] == "Aprobada" || $estadoMateria["estado"] == "Promocionada")) {
            echo '<tr>
                    <td>' . $value["nombre"] . '</td>
                    <td>' . $value["horas_cursada"] . '</td>
                    <td>' . $value["forma_aprobacion"] . '</td>
                    <td>' . $value["anio_cursada"] . '</td>
                    <td>' . $estadoMateria["estado"] . '</td>
                    </tr>';
        }
    }
}
?>                    </tbody>
                </table>
            </div>
        </div>
    </section>
                      </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
        

