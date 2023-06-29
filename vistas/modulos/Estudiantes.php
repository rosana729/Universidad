<?php
if ($_SESSION["rol"] != "Administrador") {
    echo '<script>window.location = "http://localhost/universidad/inicio";</script>';
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
        echo '<h1>Estudiante de:'.$carrera["nombre"].'</h1>';
        ?>
        
    </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Libreta</th>
                            <th>Apellidos y Nombre</th>
                            <th>Editar/Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $columna = null;
                        $valor = null;
                        $resultado = UsuariosC::VerUsuariosC($columna, $valor);
                        foreach ($resultado as $key => $value) {
                            if($value["id_carrera"] == $exp[1]){
                                echo '<tr>
                                    <td>'.$value["libreta"].'</td>
                                    <td>'.$value["apellido"].' '.$value["nombre"].'</td>
                                    <td>
                                        <a href="http://localhost/universidad/Ver-Plan/'.$value["id_carrera"].'/'.$value["libreta"].'">
                                            <button class="btn btn-primary">Plan de Estudios</button>
                                        </a>
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
