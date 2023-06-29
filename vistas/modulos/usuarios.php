<?php
if ($_SESSION["rol"] != "Administrador") {
    echo '<script>window.location = "Inicio";</script>';
    return;
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Gestor de Usuarios</h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
            <button class="btn btn-primary" data-toggle="modal" data-target="#CrearUsuario" id="crearUsuarioButton">Crear Nuevo Usuario</button>
            </div>
            <div class = "box-body">
                
            <table class="table table-bordered table-hover table-striped T">
    <thead>
        <tr>
            <th>Libreta</th>
            <th>DNI</th>
            <th>Apellidos y Nombre</th>
            <th>Edad</th>
            <th>Codigo Postal</th>
            <th>Correo Electronico</th>
            <th>Carrera</th>
            <th>Fecha de Inscripcion</th>
            <th>Editar/Borrar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $columna = null;
        $valor = null;
        $resultado = UsuariosC::VerUsuariosC($columna, $valor);
        foreach ($resultado as $key => $value) {
            if ($value["rol"] != "Administrador") {
                echo '<tr>
                    <td>' . $value["libreta"] . '</td>
                    <td>' . $value["dni"] . '</td>
                    <td>' . $value["nombre"] . ' ' . $value["apellido"] . '</td>';
                    
                // Cálculo de la edad
                $fechaNacimiento = new DateTime($value["fechanac"]);
                $fechaActual = new DateTime();
                $edad = $fechaActual->diff($fechaNacimiento)->y;
                
                echo '<td>' . $edad . '</td>
                    <td>' . $value["codigopostal"] . '</td>
                    <td>' . $value["email"] . '</td>';

                if ($value["id_carrera"] == 0) {
                    echo '<td>Usuario Administrador</td>';
                } else {
                    $columnaC = "id_carrera";
                    $valorC = $value["id_carrera"];
                    $carrera = CarreraC::CarreraC($columnaC, $valorC);
                    if (!empty($carrera)) {
                        $nombreCarrera = $carrera["nombre"];
                        echo '<td>' . $nombreCarrera . '</td>';
                    } else {
                        echo '<td>Carrera no encontrada</td>'; // O algún otro mensaje de error
                    }
                }

                if (isset($value["Fecha_Inscripcion"])) {
                    $fechaInscripcion = DateTime::createFromFormat('Y-m-d', $value["Fecha_Inscripcion"]);
                    $fechaInscripcionFormateada = $fechaInscripcion->format('d/m/Y');
                    echo '<td>' . $fechaInscripcionFormateada . '</td>';
                } else {
                    echo '<td>-</td>'; // O algún otro valor predeterminado si no está definido
                }

                echo '<td>
                    <div class="btn-group">
                        <button class="btn btn-success EditarUsuario" Uid="'.$value["id"].'" data-toggle="modal" data-target="#EditarUsuario">Editar</button>
                        <button class="btn btn-danger EliminarUsuario" Uid="'.$value["id"].'">Borrar</button>
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
<script>
    // Verificar si la página ha sido recargada después de regresar
    if (performance.navigation.type === 2) {
        // Abrir el modal al cargar la página después de regresar
        $(document).ready(function() {
            $('#CrearUsuario').modal('show');
        });
    }
</script>
<div class = "modal fade" id="CrearUsuario">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class = "modal-body"> 
                    <div class="box-body">
                        <div class="form-group">
                        <h2>Usuario:</h2>
                        <input class="form-control input-lg"  type="text" name="usuarioU" required> 
                        <div class="form-group">
                        <h2>Nombre:</h2>
                        <input class="form-control input-lg" type="text" name="nombreU" required> 
                        </div>
                        <div class="form-group">
                        <h2>Apellido:</h2>
                        <input class="form-control input-lg" type="text" name="apellidoU" required> 
                        </div>
                        <div class="form-group">
                        <h2>Fecha Nacimiento:</h2>
                        <input class="form-control input-lg" type="date" name="fechaU" required> 
                        </div>
                        <div class="form-group">
                        <h2>DNI:</h2>
                        <input class="form-control input-lg" type="text" name="DNI" required> 
                        </div>
                        <div class="form-group">
                        <h2>Codigo Postal:</h2>
                        <input class="form-control input-lg" type="text" name="codigo_postalU" required> 
                        </div>
                        <div class="form-group">
                        <h2>Celular:</h2>
                        <input class="form-control input-lg"  type="text" name="celularU" required> 
                        </div>
                        <div class="form-group">
                        <h2>Correo Electronico:</h2>
                        <input class="form-control input-lg"  type="email" name="emailU" required> 
                        </div>                        
                        </div>
                        <div class="form-group">
                        <h2>Contraseña:</h2>
                        <input class="form-control input-lg"  type="text" name="claveU" required> 
                        </div>
                        <div class="form-group">
                        <h2>Seleccionar Carrera:</h2>
                        <select class="form-control input-lg" name="carreraU" required>
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
                        <h2>Seleccionar Rol:</h2>
                        <select class="form-control input-lg" name="rolU" required>
                            <option value="0">Selecionar Rol</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Estudiante">Estudiante</option>
                        </select>
                        </div>
                    </div>
                </div>
                <div class ="modal-footer">
                    <button type="submit" class="btn btn-primary">Crear</button>
                    <button onclick="window.location.href = 'index.php?url=usuarios&Uid=' + $('#Uid').val();" class="btn btn-danger">Salir</button>

                </div>
            </form>
        </div>
    </div>
</div>
<div class = "modal fade" id="EditarUsuario">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class = "modal-body">
                    <div class="box-body">
                        <div class="form-group">
                        <h2>Nombre:</h2>
                        <input class="form-control input-lg" type="text" id="nombreEU" name="nombreEU" required> 
                        <input class="form-control input-lg" type="hidden" id="Uid" name="Uid" required> 
                        </div>
                        <div class="form-group">
                        <h2>Apellido:</h2>
                        <input class="form-control input-lg" type="text" id="apellidoEU" name="apellidoEU" required> 
                        </div>
                        <div class="form-group">
                        <h2>Fecha Nacimiento:</h2>
                        <input class="form-control input-lg" type="date" id="fechaEU" name="fechaEU" required> 
                        </div>
                        <div class="form-group">
                        <h2>DNI:</h2>
                        <input class="form-control input-lg" type="text" id="dniEU" name="dniEU" required> 
                        </div>
                        <div class="form-group">
                        <h2>Codigo Postal:</h2>
                        <input class="form-control input-lg" type="text" id="codigo_postalEU" name="codigo_postalEU" required> 
                        </div>
                        <div class="form-group">
                        <h2>Celular:</h2>
                        <input class="form-control input-lg"  type="text" id="celularEU" name="celularEU" required> 
                        </div>
                        <div class="form-group">
                        <h2>Correo Electronico:</h2>
                        <input class="form-control input-lg"  type="email" id="emailEU" name="emailEU" required> 
                        </div>                        
                        <div class="form-group">
                        <h2>Usuario:</h2>
                        <input class="form-control input-lg"  type="text" id="usuario" name="usuario" required> 
                        </div>
                        <div class="form-group">
                        <h2>Contraseña:</h2>
                        <input class="form-control input-lg"  type="text" id="claveEU" name="claveEU" required> 
                        </div>
                        <div class="form-group">
                        <h2>Seleccionar  Carrera:</h2>
                        <select class="form-control input-lg" id="carreraEU" name="carreraEU" required>
                            <option value="0">Selecionar Carrera</option>
                            <?php
                            $carreras = CarreraC::VerCarreraC();
                            foreach ($carreras as $key => $value){
                                echo'<option value="'.$value["id_carrera"].'">'.$value["nombre"].'</option>';
                            }
                            ?>
                        </select>
                        </div>
                        <div class="form-group" id="carrera">
                        <h2 id="rolactual"></h2>
                        <h2>Seleccionar Rol:</h2>
                        <select class="form-control input-lg" id="rolEU" name="rolEU" required>
                        <option value="0">Seleccionar Rol</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Estudiante">Estudiante</option>
                        </select>
                </div>
                    </div>
                </div>
                <div class ="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <button onclick="window.location.href = 'index.php?url=usuarios&Uid=' + $('#Uid').val();" class="btn btn-danger">Salir</button>

                </div>
                <?php
                    $crearU = new UsuariosC();
                    $crearU->CrearUsuarioC();
                    $actualizarU = new UsuariosC;
                    $actualizarU -> ActualizarUsuariosC();
                ?>

            </form>
        </div>
    </div>
</div>
<?php
    $eliminarU = new UsuariosC();
    $eliminarU->EliminarUsuarioC();
    
?>