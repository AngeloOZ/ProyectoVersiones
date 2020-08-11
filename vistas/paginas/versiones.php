<?php
    if(!isset($_SESSION["validarIngreso"])){
        header('location: login');
        return;
    }else{
        if($_SESSION["validarIngreso"] != "ok"){
            header('location: login');
        }
    }
    $versiones = ControladorFormularios::ctrCargarDatos("versiones");
?>
<title>Versiones</title>
<header class="header">
        <h1>Versiones</h1>
    </header>
    <div class="contenedor">
        <div class="add mx-width">
            <a href="inicio" class="btn-back">
                <span><i class="fas fa-arrow-left"></i></span>
            </a>
            <div class="acciones-btn">
                <a href="index.php?pagina=versiones-edit&action=agregar" class="btn-add btn-abrir-popup" id="btn-abrir-popup">
                    <span><i class="fas fa-plus-circle"></i></span>
                    <span>Agregar</span>
                </a>
                <a href="index.php?pagina=reporte-version" target="_blank" class="btn-add btn-report">
                    <span><i class="fas fa-file-pdf"></i></span>
                    <span>Generar Reporte</span>
                </a>
            </div>
        </div>
        <div class="container">
            <table class="table mx-width">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Versión</th>
                        <th>Detalle</th>
                        <th>Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($versiones as $valor){ ?>
                        <tr>
                            <td data-title="Id:"><?php echo $valor["id"];?></td>
                            <td data-title="Fecha:"><?php echo $valor["fecha"];?></td>
                            <td data-title="Versión:"><?php echo $valor["version"];?></td>
                            <td data-title="Detalle:"><?php echo $valor["detalle"];?></td>
                            <td>
                                <div class="btn-action">
                                    <a href="index.php?pagina=versiones-edit&action=editar&token=<?php echo $valor['id']  ?>" class="btn btn-edit"><i class="far fa-edit"></i></a>
                                    <form action="" method="post">
                                        <input type="hidden" name="eliminarVersion" value="<?php echo $valor['id'] ?>">    
                                        <button class="btn btn-delete"><i class="fas fa-trash-alt"></i></button>
                                        <?php 
                                            $eliminar = new ControladorVersion();
                                            $eliminar->ctrEliminarVersion();
                                        ?>                                    
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>