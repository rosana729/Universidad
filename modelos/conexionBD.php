<?php
class ConexionBD {
    public static function cBD() {
        $db = new PDO("mysql:host=localhost;dbname=universidad", "root", "");
        $db->exec("set names utf8");
        return $db;
    }
}
