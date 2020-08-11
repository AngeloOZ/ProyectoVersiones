<?php
class ControladorProductos{

//* -------------------------------------------------------------------------- */
//?                        Controlador Agregar Productos                       */
//* -------------------------------------------------------------------------- */
    public function ctrAgregarProducto(){
        if(isset($_POST["insertarNombreProducto"])){
            $nombrePro = trim($_POST["insertarNombreProducto"]);
            $detallePro = trim($_POST["insertarDetalle"]);
            if(!empty($nombrePro) && !empty($detallePro)){
                if(preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚÑñ ]+$/',$nombrePro) &&
                    preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚÑñ,.-_$#%()* ]+$/',$detallePro)
                ){
                    $tabla = 'productos';
                    $datos = array(
                        "nombre" => $nombrePro,
                        "detalle" =>$detallePro
                    );
                    $respuesta = ModeloProductos::mdlRegistrarProducto($tabla,$datos);
                    if($respuesta == "ok"){
                        MsgSuccess("Se registro el producto correctamente");
                        LimpiarCache();
                    }else{
                        MsgDanger("Upss algo salio mal, intentalo más tarde");
                        LimpiarCache();
                    }
                    echo'
                        <script>
                            setTimeout(()=>{
                                window.location = "productos";
                            },2000);
                        </script>
                    ';
                }else{
                    MsgDanger("No se puede ingresar en los campos caracteres especiales como <, >, /, ^, &, |");
                }
            }else{
                MsgDanger("Todos los campos son obligatorios");
            }
        }
    }

//* -------------------------------------------------------------------------- */
//?                         Controlador Editar Producto                        */
//* -------------------------------------------------------------------------- */
    public function crtEditarProducto(){
        if(isset($_POST["insertarNombreProducto"])){  
            $nombrePro = $_POST["insertarNombreProducto"];
            $detallePro = $_POST["insertarDetalle"];
            if(!empty($nombrePro) && !empty($detallePro)){
                if(preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚÑñ ]+$/',$nombrePro) &&
                    preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚÑñ,.-_$#%()* ]+$/',$detallePro)
                ){
                    $tabla = "productos";
                    $datos = array(
                        "nombre" => $nombrePro,
                        "detalle" =>$detallePro,
                        "codigo" => $_POST["insertarCodigoPro"]
                    );
                    $respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);
                    if($respuesta == "ok"){
                        MsgSuccess("Se registro el producto correctamente");
                        LimpiarCache();
                    }else{
                        MsgDanger("Upss algo salio mal, intentalo más tarde");
                        LimpiarCache();
                    }
                    echo'
                        <script>
                            setTimeout(()=>{
                                window.location = "productos";
                            },1500);
                        </script>
                    ';
                }else{
                    MsgDanger("No se puede ingresar en los campos caracteres especiales como <, >, /, ^, &, |");
                }
            }else{
                MsgDanger("Todos los campos son obligatorios");
            }
        }
    }

//* -------------------------------------------------------------------------- */
//?                        Controlador eliminar Producto                       */
//* -------------------------------------------------------------------------- */
    public function ctrEliminarProducto(){
        if(isset($_POST["eliminarProducto"]) && !empty($_POST["eliminarProducto"])){
            $tabla = "productos";
            $respuesta = ModeloProductos::mdlEliminarProducto($tabla, $_POST["eliminarProducto"]);

            if($respuesta == "ok"){
                LimpiarCache();
                echo '<script>window.location = "productos"</script>';
            }
        }
    }

}