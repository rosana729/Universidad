<div class="content-wrapper">
    <section class="content">
        <div class="box-body">
        <?PHP
            $datos = new UsuariosC();
            $datos -> verMisDatos();
            ?>
          <?PHP
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $guardar = new UsuariosC();
                $guardar->GuardarDatosC();
            }
            
            
            ?>

        </div>
    </section>
</div>