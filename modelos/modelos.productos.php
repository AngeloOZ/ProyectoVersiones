<?php
require_once "conexion.php";
class ModeloProductos{
    static public function mdlRegistrarProducto($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, detalle) VALUES(:nombre, :detalle)");

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return ($stmt->errorInfo());
        }
        $stmt = null;
    }
    static public function mdlEditarProducto($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, detalle = :detalle WHERE codigoproducto = :id");

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["codigo"], PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";   
        }else{
            return ($stmt->errorInfo());
        }
        $stmt = null;
    }
    static public function mdlEliminarProducto($tabla, $id){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE codigoproducto = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return ($stmt->errorInfo());
        }
        $stmt = null;
    }
}