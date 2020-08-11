<?php
    if(!isset($_SESSION["validarIngreso"])){
        header('location: login');
        return;
    }else{
        if($_SESSION["validarIngreso"] != "ok"){
            header('location: login');
        }
    }
    $productos = ControladorFormularios::ctrCargarDatos("productos");
?>
<title>Productos</title>
<header class="header">
        <h1>Productos</h1>
</header>
    <div class="contenedor">
        <div class="add mx-width">
            <a href="inicio" class="btn-back">
                <span><i class="fas fa-arrow-left"></i></span>
            </a>
            <div class="acciones-btn">
                <a href="index.php?pagina=productos-edit&action=agregar" class="btn-add btn-abrir-popup" id="btn-abrir-popup"><span><i class="fas fa-plus-circle"></i></span><span>Agregar</span></a>
                <a href="index.php?pagina=reporte-productos" target="_blank" class="btn-add btn-report">
                    <span><i class="fas fa-file-pdf"></i></span>
                    <span>Generar Reporte</span>
                </a>
            </div>
        </div>
        <div class="container">
            <table class="table mx-width">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($productos as $key => $value):?>
                    <tr>
                        <td data-title="Nombre:"><?php echo $value["nombre"];?></td>
                        <td data-title="Descripción:"><?php echo $value["detalle"];?></td>
                        <td>
                            <div class="btn-action">
                                <a href="index.php?pagina=productos-edit&action=editar&token=<?php echo $value["codigoproducto"]?>" class="btn btn-edit"><i class="far fa-edit"></i></a>
                                <form action="" method="POST">
                                    <input type="hidden" name="eliminarProducto" value="<?php echo $value["codigoproducto"]?>">
                                    <button class="btn btn-delete"><i class="fas fa-trash-alt"></i></button>
                                    <?php 
                                        $eliminar = new ControladorProductos();
                                        $eliminar->ctrEliminarProducto();
                                    ?>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>