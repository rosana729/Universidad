<?php
class NotasM {
    public static function VerNotasM($libreta, $idMateria) {
        $pdo = ConexionBD::cBD()->prepare("SELECT parcial_1, parcial_2, parcial_3, parcial_4 FROM notas WHERE libreta = :libreta AND id_materia = :id_materia");
        $pdo->bindParam(':libreta', $libreta);
        $pdo->bindParam(':id_materia', $idMateria);
        $pdo->execute();
        $res = $pdo->fetch();
        $pdo = null;
        return $res;
    }
    
    public static function AgregarNotasM($libreta, $idMateria, $parcial1, $parcial2, $parcial3, $parcial4, $notaFinal) {
        $pdo = ConexionBD::cBD()->prepare("INSERT INTO notas (libreta, id_materia, parcial_1, parcial_2, parcial_3, parcial_4, nota_final) VALUES (:libreta, :id_materia, :parcial1, :parcial2, :parcial3, :parcial4, :nota_final)");
        $pdo->bindParam(':libreta', $libreta);
        $pdo->bindParam(':id_materia', $idMateria);
        $pdo->bindParam(':parcial1', $parcial1);
        $pdo->bindParam(':parcial2', $parcial2);
        $pdo->bindParam(':parcial3', $parcial3);
        $pdo->bindParam(':parcial4', $parcial4);
        $pdo->bindParam(':nota_final', $notaFinal);
        $resultado = $pdo->execute();
        $pdo = null;
        return $resultado;
    }
}

?>
