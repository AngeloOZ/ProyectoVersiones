<?php
    require_once "conexion.php";
    class ModeloUsuarios{
        static public function mdlRegistarUsuarios($tabla, $datos){
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigousuario,nombre,contrasenia,nombrereal) values(:codigo, :user, :pass, :nombre)");
    
            $stmt->bindParam(":codigo", $datos['codigo'], PDO::PARAM_INT);
            $stmt->bindParam(":user", $datos['username'], PDO::PARAM_STR);
            $stmt->bindParam(":pass", $datos['password'], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
    
            if($stmt->execute()){
                return "ok";
            }else{
                return ($stmt->errorInfo());
            }
            $stmt = null;
        }
        static public function mdlActualizarUsuarios($tabla, $datos){
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre=:nombre, contrasenia = :pass, nombrereal = :nombrereal WHERE codigousuario = :coduser");

            $stmt->bindParam(":nombre", $datos['username'], PDO::PARAM_STR);
            $stmt->bindParam(":pass", $datos["password"], PDO::PARAM_STR);
            $stmt->bindParam(":nombrereal", $datos["nombre"],PDO::PARAM_STR);
            $stmt->bindParam(":coduser",$datos["codigo"], PDO::PARAM_INT);

            if($stmt->execute()){
                return "ok";
            }
            else{
                return ($stmt->errorInfo());
            }           
            $stmt = null;
        }
        static public function mdlEliminarUsuario($tabla, $id){
            $stmt = Conexion::conectar()->prepare("DELETE FROM  $tabla WHERE codigousuario = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_STR);

            if($stmt->execute()){
                return "ok";
            }else{
                return ($stmt->errorInfo());
            }
            $stmt = null;
        }
    }
