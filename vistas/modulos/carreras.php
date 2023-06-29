<?php
if ($_SESSION["rol"] != "Administrador") {
    echo '<script>window.location = "Inicio";</script>';
    return;
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Gestor de Carreras Universitarias</h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
<form method="post">
    <div class="col-md-6 col-xs-12">
        <input type="text" name="carrera" class="form-control" placeholder="Ingresar Nueva Carrera" required>
        <input type="text" name="descripcion" class="form-control" placeholder="Ingresar una descripción" required>
        <input type="date" name="fecha" class="form-control" placeholder="Ingresar Fecha de Apertura" required>
        <input type="text" name="facultad" class="form-control" placeholder="Ingresar Facultad" required>
        <input type="number" name="anios_cursada" class="form-control" placeholder="Ingresar Años de Cursada" required>
    </div>
    <button type="submit" class="btn btn-primary">Crear carrera</button>
</form>

                <?php
                    $crearCarrera = new CarreraC();
                    $crearCarrera->CrearCarreraC();
                ?>

            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Facultad</th>
                        <th>Año</th>
                        <th>Cantidad Inscriptos</th>
                         <th>Acciones</th>
                    </tr>
                </thead> 
                <tbody>
                <?php
$resultado = CarreraC::VerCarreraC();
foreach ($resultado as $key => $value) {
    echo '<tr>
        <td>' . $value["nombre"] . '</td>
        <td>' . $value["facultad"] . '</td>
        <td>';
    $estudiantes = UsuariosC::ObtenerCantidadInscriptosPorAnio($value["id_carrera"]);
    $cantidadTotal = 0; // Variable para almacenar la cantidad total de inscriptos
    $anio = "N/A"; // Valor predeterminado para el año
    if (!empty($estudiantes)) {
        foreach ($estudiantes as $estudianteKey => $estudiante) {
            $cantidadInscriptos = $estudiante["cantidad_inscriptos"];
            $cantidadTotal += $cantidadInscriptos;
            $fechaInscripcion = isset($estudiante["Fecha_Inscripcion"]) ? $estudiante["Fecha_Inscripcion"] : "N/A";
            $anio = date('Y', strtotime($fechaInscripcion));
        }
    }
    echo $anio;
    echo '</td>
        <td>' . $cantidadTotal . '</td>
        <td>
 
                <div class="btn-group">
                    <a href="Editar-Carreras/' . $value["id_carrera"] . '">
                        <button class="btn btn-success">Editar</button>
                    </a>
                    <a href="carreras/' . $value["id_carrera"] . '">
                        <button class="btn btn-danger">Borrar</button>
                    </a>
                    <a href="CrearMaterias/' . $value["id_carrera"] . '">
                        <button class="btn btn-warning">Materias</button>
                    </a>
                    <a href="Estudiantes/' . $value["id_carrera"] . '">
                        <button class="btn btn-primary">Estudiantes</button>
                    </a>
                </div>
            </td>
        </tr>';
}

?>
                    
                </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?php
$borrarCarrera = new CarreraC();
$borrarCarrera -> BorrarCarrerasC();
?>