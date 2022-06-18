<?php

class database{
    public static function conectar(){
        try {
            //code...
            $conexion=new PDO("mysql:host=localhost;dbname=empresa",'root','sistemas');
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            //retornamos la conexion
            return $conexion;
        } catch (PDOException $err) {
            return "Falla de conexion".$err;
        }
    }
}