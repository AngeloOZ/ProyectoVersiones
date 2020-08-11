<?php
    if(!isset($_SESSION["validarIngreso"])){
        header('location: login');
        return;
    }else{
        if($_SESSION["validarIngreso"] != "ok"){
            header('location: login');
        }
    }
    $usuarios = ControladorFormularios::ctrCargarDatos("usuario");
?>
<title>Usuarios</title>
    <header class="header">
        <h1 class="title-header">Usuarios</h1>
    </header>
    <div class="contenedor">
        <div class="add mx-width">
            <a href="inicio" class="btn-back">
                <span><i class="fas fa-arrow-left"></i></span>
            </a>
            <div class="acciones-btn">
                <a href="index.php?pagina=usuarios-edit&action=agregar" class="btn-add btn-abrir-popup"><span><i class="fas fa-plus-circle"></i></span><span>Agregar</span></a>
                <a href="index.php?pagina=reporte-usuarios" target="_blank" class="btn-add btn-report">
                    <span><i class="fas fa-file-pdf"></i></span>
                    <span>Generar Reporte</span>
                </a>
            </div>
        </div>
        <div class="container">
            <table class="table mx-width">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Username</th>
                        <th>Nombre</th>
                        <th>Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($usuarios as $key => $value):?>
                    <tr>
                        <td data-title="Código:"><?php echo $value["codigousuario"]; ?></td>
                        <td data-title="Username:"><?php echo $value["nombre"]; ?></td>
                        <td data-title="Nombre:"><?php echo $value["nombrereal"]; ?></td>
                        <td>
                            <div class="btn-action">
                                <a href="index.php?pagina=usuarios-edit&action=editar&token=<?php echo $value["codigousuario"]?>" class="btn btn-edit"><i class="far fa-edit"></i></a>
                                <form action="" method="post">
                                <input type="hidden" name="eliminarRegistro" value="<?php echo $value["codigousuario"]?>">
                                <button type="submit" class="btn btn-delete"><i class="fas fa-trash-alt"></i></button>
                                    <?php
                                        $eliminar = new ControladorUsuarios();
                                        $eliminar->ctrEliminarRegistro();
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