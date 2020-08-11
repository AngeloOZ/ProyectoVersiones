<?php
require_once 'conexion.php';

class ModeloFormularios{

/* -------------------------------------------------------------------------- */
/*                             Modelo para ingreso                            */
/* -------------------------------------------------------------------------- */
    static public function mdlSelecionarRegistro($tabla, $item, $valor){
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

        $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt->execute();

        return ($stmt->fetch());

        $stmt = null;
    }
    static public function mdlSelectionAllRegister($tabla){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

        $stmt->execute();

        return ($stmt->fetchAll());

        $stmt = null;
    }
}