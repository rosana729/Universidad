<?php
require_once "../controladores/usuariosC.php";
require_once "../modelos/usuariosM.php";

class UsuariosA {
    public $Uid;

    public function EditarUsuariosA() {
        $columna = "id";
        $valor = $this->Uid;
        $resultado = UsuariosC::VerUsuariosC($columna, $valor);
        echo json_encode($resultado);
    }
}

if(isset($_POST["Uid"])) {
    $editarU = new UsuariosA();
    $editarU->Uid = $_POST["Uid"]; 
    $editarU->EditarUsuariosA();
}
