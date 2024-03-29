<?php 
require_once "src/page/template/header.php";
require_once "src/page/template/footer.php";
require_once "src/conexion/conexion.php";

$sentencia = $DB -> query('SELECT * FROM persona');
$persona = $sentencia -> fetchAll(PDO::FETCH_OBJ);
//print_r($persona);
?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <!--===============================================================
                        ALERTAS INICIO
            ================================================================-->
            
            <!--CAMPOS SIN RELLENAR-ERROR (FORMULARIO)-->
            <?php 
                if(isset($_GET['mensaje']) AND $_GET['mensaje']=='falta-datos'){
            ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>ERROR: </strong> Rellene todos los campos.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php
                }
            ?>

            <!--REGISTRO EXITOSO-SUCCESS (FORMULARIO)-->
            <?php 
                if(isset($_GET['mensaje']) AND $_GET['mensaje']=='registrado'){
            ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>La informacion se ha registrado correctamente</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php
                }
            ?>

            <!--EDITAR-ELIMINAR-ERROR (CODIGO DE LA PERSONA-VIA POST)-->
            <?php 
                if(isset($_GET['mensaje']) AND $_GET['mensaje']=='error'){
            ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>ERROR: </strong> Vuelve a intentar
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php
                }
            ?>

            <!--EDICIÓN EXITOSA-SUCCESS (TABLA)-->
            <?php 
                if(isset($_GET['mensaje']) AND $_GET['mensaje']=='editado'){
            ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>La informacion se ha editado exitosamente</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php
                }
            ?>

            <!--ELIMINACIÓN EXITOSA-SUCCESS (TABLA)-->
            <?php 
                if(isset($_GET['mensaje']) AND $_GET['mensaje']=='eliminado'){
            ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>La informacion se ha eliminado exitosamente</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php
                }
            ?>

            <!--===============================================================
                        ALERTAS FIN
            ================================================================-->

            <div class="card table-card">
                <div class="card-header text-center">
                    <b>Lista de Personas</b>
                </div>
                <div class="p-4">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Edad</th>
                                <th scope="col">Pais</th>
                                <th class="text-center" scope="col" colspan="2">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($persona as $datos){ //persona es el nombre de la tabla de la BD
                            ?>
                            <tr>
                                <td scope="row"><?php echo $datos->id_codigo; ?></td> <!--IMPRIMIMOS EL TADO DE LA COLUMNA DESEADA-->
                                <td><?php echo $datos->nombre; ?></td>
                                <td><?php echo $datos->edad; ?></td>
                                <td><?php echo $datos->pais; ?></td>
                                <td class="text-center"><a href="src/page/editar.php?codigo=<?php echo $datos->id_codigo; ?>"><i class="bi bi-pencil-square text-success"></i></a></td>
                                <td class="text-centerr"><a href="src/validation/eliminar.php?codigo=<?php echo $datos->id_codigo; ?>"><i class="bi bi-calendar2-x text-danger"></i></a></td>
                                
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <b>Ingresar Datos</b>
                </div>
                <form class="p-4" method="POST" action="src/validation/registro.php">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="txtNombre" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Edad</label>
                        <input type="number" class="form-control" name="txtEdad" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pais</label>
                        <input type="text" class="form-control" name="txtPais" autofocus required>
                    </div>
                    <!--PARA LOS BOTONES-->
                    <div class="d-grid">
                        <input type="hidden" name="oculto" value="1">
                        <input type="submit" class="btn btn-primary" value="Registrar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>