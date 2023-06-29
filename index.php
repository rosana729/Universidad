<?php
require_once "controladores/plantillaC.php";
require_once "controladores/usuariosC.php";
require_once "modelos/usuariosM.php";
require_once "controladores/carrerasC.php";
require_once "modelos/carrerasM.php";
require_once "controladores/materiasC.php";
require_once "modelos/materiasM.php";
require_once "controladores/notasC.php";
require_once "modelos/notasM.php";
require_once "controladores/Materias_CursadasC.php";
require_once "modelos/Materias_CursadasM.php";

$plantilla = new Plantilla();
$plantilla->LlamarPlantilla();
?>

