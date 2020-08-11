<?php 
    require_once "conexion.php";
class ModelosVersiones{
    public static function mdlSeleccionarAjax($tabla, $columna, $valor){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $columna = :$columna");
        
        $stmt->bindParam(":".$columna, $valor, PDO::PARAM_STR);

        if($stmt->execute()){
            $respuesta = $stmt->fetch();
            return $respuesta;
        }else{
            return ($stmt->errorInfo());
        }

    }
    public static function mdlInsertarVersion($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(fecha, version, detalle, codigousuario, codigoproducto) VALUES(:fecha, :version, :detalle, :codUser, :codPro)");

        $stmt->bindParam(":fecha", $datos["fecha"]);
        $stmt->bindParam(":version", $datos["version"]);
        $stmt->bindParam(":detalle", $datos["detalle"]);
        $stmt->bindParam(":codUser", $datos["usuario"]);
        $stmt->bindParam(":codPro", $datos["producto"]);

        if($stmt->execute()){
            return "ok";
        }else{
            return ($stmt->errorInfo());
        }
    }
    public static function mdlEditarVersion($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha = :fecha, version = :version, detalle = :detalle, codigousuario = :codUser, codigoproducto = :codPro WHERE id = :id");

        $stmt->bindParam(":fecha", $datos["fecha"]);
        $stmt->bindParam(":version", $datos["version"]);
        $stmt->bindParam(":detalle", $datos["detalle"]);
        $stmt->bindParam(":codUser", $datos["usuario"]);
        $stmt->bindParam(":codPro", $datos["producto"]);
        $stmt->bindParam(":id", $datos["id"]);

        if($stmt->execute()){
            return "ok";
        }else{
            return ($stmt->errorInfo());
        }
    }
    public static function mdlEliminarVersion($tabla, $dato){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt->bindParam(":id", $dato, PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return ($stmt->errorInfo());
        }
        $stmt = null;
    }
    
}
