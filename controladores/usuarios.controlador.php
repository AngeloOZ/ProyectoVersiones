<?php
class ControladorUsuarios{
//* -------------------------------------------------------------------------- */
//*                         Controlador agregar Usuario                        */
//* -------------------------------------------------------------------------- */
    public function ctrRegistrarUsuarios(){
        if(isset($_POST["insertarCodigo"])){
            if(!empty($_POST["insertarPwd"])  &&
                !empty($_POST["insertarUsername"])&&
                !empty($_POST["insertarNombre"]) &&
                !empty($_POST["insertarCodigo"])   
            ){
                if(
                    preg_match('/^[a-zA-Z0-7áéíóúÁÉÍÓÚÑñ]+$/', $_POST["insertarUsername"]) &&
                    preg_match('/^[0-9]+$/', $_POST["insertarCodigo"]) &&
                    preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚÑñ ,.-]+$/', $_POST["insertarNombre"]) &&
                    preg_match('/^[0-9a-zA-Z]+$/', $_POST["insertarPwd"])
                ){
                    $tabla = 'usuario';

                    $verificarIdUser = ControladorFormularios::ctrVerificadorInformacion($tabla,"codigousuario", $_POST["insertarCodigo"], $_POST["insertarCodigo"]);
                    $verificarUser = ControladorFormularios::ctrVerificadorInformacion($tabla,"nombre", $_POST["insertarUsername"], $_POST["insertarUsername"]);

                    if($verificarIdUser && $verificarUser){
                        $datos = array(
                            "codigo" => $_POST["insertarCodigo"],
                            "username" => $_POST["insertarUsername"],
                            "nombre" => $_POST["insertarNombre"],
                            "password" => $_POST["insertarPwd"]
                        );
                        $respuesta = ModeloUsuarios::mdlRegistarUsuarios($tabla,$datos);
                        if($respuesta == "ok"){
                            MsgSuccess("Usuario registrado correctamente");
                        }else{
                            MsgDanger($respuesta);
                            LimpiarCache();
                        }
                        echo '
                            <script>
                                setTimeout(()=>{
                                    window.location = "usuarios";
                                },2000)
                            </script>
                        ';
                    }else{
                        MsgDanger("El código de usuario o username ya existe");
                    }
                }else{
                    MsgWarning("No se permite caracteres especiales");
                }
            }else{
                MsgDanger("Todos los campos deben ser llenados");
            }
        }
    }
//* -------------------------------------------------------------------------- */
//*                         Controlador editar Usuario                         */
//* -------------------------------------------------------------------------- */
    public function ctrEditarUsuarios(){
        if(isset($_POST["insertarUsername"])){
            if( !empty($_POST["insertarUsername"])&&
            !empty($_POST["insertarNombre"])){
                $password = "";
                if(!empty($_POST['insertarPwd'])){
                    $password = $_POST['insertarPwd'];
                }else{
                    $password = $_POST['insertarPwdAntigua'];
                }
                if(
                    preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚÑñ]+$/', $_POST["insertarUsername"]) &&
                    preg_match('/^[0-9 -]+$/', $_POST["insertarCodigo"]) &&
                    preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚÑñ ]+$/', $_POST["insertarNombre"])
                ){
                    $tabla = 'usuario';
                    $verificarCod = ControladorFormularios::ctrVerificadorInformacion($tabla,"codigousuario",$_POST['insertarCodigo'], $_POST['insertarCodigo']);
                    if(!$verificarCod){
                        $datos = array(
                            "codigo" => $_POST["insertarCodigo"],
                            "username" => $_POST["insertarUsername"],
                            "nombre" => $_POST["insertarNombre"],
                            "password" => $password
                        );
                        $respuesta = ModeloUsuarios::mdlActualizarUsuarios($tabla,$datos);
                        if($respuesta == "ok"){
                            MsgSuccess("Los datos se actualizaron correctamente");
                            echo'
                            <script>
                                setTimeout(()=>{
                                    window.location = "usuarios";
                                },1500)
                            </script>
                        ';
                        }else{
                            MsgDanger($respuesta);
                            LimpiarCache();
                            echo'
                            <script>
                                setTimeout(()=>{
                                    window.location = "usuarios";
                                },3000)
                            </script>
                        ';
                        }
                    }else{
                        MsgDanger("Ups parece que hubo un error"); 
                    }
                }else{
                    MsgDanger("No se permiten caracteres especiales como <, >, ?, / en el username ni espacios en blanco"); 
                }
            }else{
                MsgDanger("No pueden estar los campos vacios    "); 
            }
        }
    }

//* -------------------------------------------------------------------------- */
//*                        Controlador eliminar Usuario                        */
//* -------------------------------------------------------------------------- */
    public function ctrEliminarRegistro(){
        if(isset($_POST["eliminarRegistro"]) && !empty($_POST["eliminarRegistro"])){
            $tabla = "usuario";
            $respuesta = ModeloUsuarios::mdlEliminarUsuario($tabla, $_POST["eliminarRegistro"]);
            
            if($respuesta == "ok"){
                LimpiarCache();
                echo '
                    <script>
                        window.location = "usuarios";
                    </script>
                ';
            }
        }
    }
}