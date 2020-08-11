<?php
class ControladorFormularios{

    //*-------------------------------------------------------------------------- */
    //*                           Controlador de ingreso                           */
    //*-------------------------------------------------------------------------- */
    public function crtIniciarSession(){
        if(isset($_POST["iniciarUser"]) && isset($_POST["iniciarPwd"])){
            if(!empty($_POST["iniciarUser"]) && !empty($_POST["iniciarPwd"])){
                $tabla = "usuario";
                $item = "nombre";
                $dato = $_POST["iniciarUser"];

                $respuesta = ModeloFormularios::mdlSelecionarRegistro($tabla,$item,$dato);    
                if($respuesta != false){
                    if($_POST["iniciarUser"] == $respuesta["nombre"] && $_POST["iniciarPwd"] == $respuesta["contrasenia"]){
                        $_SESSION["validarIngreso"] = "ok";
                        header('Location: inicio');
                    }else{
                        MsgDanger("El nombre de usuario o contraseña no son correctos");
                    }
                }else{
                    MsgWarning("Nombre de usuario no registrado");
                }
            }else{
                LimpiarCache();
                MsgDanger("Los campos no pueden estar vacíos");
            }
        } 
    }

//* -------------------------------------------------------------------------- */
//*                    Controlador cargar datos a las tablas                   */
//* -------------------------------------------------------------------------- */
    static public function ctrCargarDatos($tabla){
        $datos = ModeloFormularios::mdlSelectionAllRegister($tabla);
        return $datos;
    }


//* -------------------------------------------------------------------------- */
//*                        Verificar de datos existentes                       */
//* -------------------------------------------------------------------------- */
    static public function ctrVerificadorInformacion($tabla, $item, $datoBuscar, $datoComparar){
        $verificador = ModeloFormularios::mdlSelecionarRegistro($tabla,$item,$datoBuscar);
        if(empty($verificador)){
            return true;
        }else{
            return ($verificador[$item] == $datoComparar) ?  false :  true;
        }    
    }
}
//* -------------------------------------------------------------------------- */
//*                      funciones genericas de uso común                      */
//* -------------------------------------------------------------------------- */
function LimpiarCache(){
    echo '<script>
        if(window.history.replaceState){
            window.history.replaceState(null,null, window.location.href);
        }
    </script>';
}
function MsgDanger($message){
    echo "<div class='alert alert-danger'><strong>Error: </strong>$message</div>";
}
function MsgSuccess($message){
    echo "<div class='alert alert-success'>$message</div>";
}
function MsgWarning($message){
    echo "<div class='alert alert-warning'><strong>Alerta: </strong>$message</div>";
}