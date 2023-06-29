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
        $columnaC = "id_carrera";
        $valorC = $exp[1];
        $carrera = CarreraC::CarreraC($columnaC, $valorC);
        echo '<h1>Gestor de materias de la carrera: ' . $carrera["nombre"] . '</h1>';
        ?>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header">
                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#CrearMateria">Crear Materias</button>
            </div>

            <div class="box-body">
                <table class="table table-bordered table-hover table-striped T">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Horas Cursada</th>
                            <th>Forma Aprovacion</th>
                            <th>Año que Cursa</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $verM = new MateriasC();
                        $materias = $verM->VerMateriasC();
                        foreach ($materias as $key => $value) {
                            if ($value["carrera"] == $exp[1]) {
                                echo '<tr>
                                    <td>' . $value["nombre"] . '</td>
                                    <td>' . $value["horas_cursada"] . '</td>
                                    <td>' . $value["forma_aprobacion"] . '</td>
                                    <td>' . $value["anio_cursada"] . '</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-default">Comisiones</button>
                                            <button class="btn btn-danger EliminarMateria" Mid="' . $value['id_materia'] . '" Cid="' . $exp[1] . '">eliminar</button>
                                        </div>
                                    </td>
                                </tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<?php
$eliminarM = new MateriasC();
$eliminarM ->EliminarMateriaC();
?>

<div class="modal fade" id="CrearMateria">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <h2>Nombre:</h2>
                            <input class="form-control input-lg" type="text" name="nombreM" required>
                            <?php
                            echo '<input type="text" name="Cid" value="' . $exp[1] . '">';
                            ?>
                        </div>
                        <div class="form-group">
                        <h2>Horas Cursadas:</h2>
                        <input class="form-control input-lg" type="text" name="horas_cursadaM" required> 
                        </div>
                        <div class="form-group">
                        <h2>Forma Aprobacion:</h2>
                        <select class="form-control input-lg" name="forma_aprobacionM" required>
                            <option value="0">Selecionar opcion</option>
                            <option value="Con examen Final">Con examen Final</option>
                            <option value="promocion">promocion</option>
                        </select>
                        </div>
                        <div class="form-group">
                        <h2>Seleccionar  Carrera:</h2>
                        <select class="form-control input-lg" id="carreraM" name="carreraM" required>
                            <option value="0">Selecionar Carrera</option>
                            <?php
                            $carreras = CarreraC::VerCarreraC();
                            foreach ($carreras as $key => $value){
                                echo'<option value="'.$value["id_carrera"].'">'.$value["nombre"].'</option>';
                            }
                            ?>
                        </select>
                        </div>
                        <div class="form-group">
                        <h2>Año de cursada:</h2>
                        <input class="form-control input-lg" type="number" name="anio_cursadaM" required> 
                        </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Crear</button>
                    <button type="button" class="btn btn-danger">Salir</button>
                </div>

                <?php
                $crearM = new MateriasC();
                $crearM->CrearMateriaC();
                ?>
            </form>
        </div>
    </div>
</div>

      