<?php
  //Inicia la conexion
  session_start();

  //Validamos si esta logueado
  if (!$_SESSION['activo']) {
      header("Location:login.php");
  }

  //Incluir la DB
  include_once('conexiondb.php');

  $query = "SELECT * FROM alumnos";
  $stmt = $conn->query($query);
  $alumnos = $stmt->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/r-2.5.0/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js" rel="stylesheet">
    <link rel="shortcut icon" type="opacity: .8" href="img/noveno.jpg">
</head>
<body>
  <div class="float-center mt-4 mb-4">
    <img src="img/ITES.png" class="img-fluid mx-auto d-block" style="width: 800px;"  alt="Logo Tec-Hop">
  </div>

<div class="container-fluid bg-light pt-2">
  <div class="row mb-5">
    
        

        <div class="col-lg-12 p-4">
            <div class="text-center mb-4">
                <h1 class="mb-3" style="font-family: Georgia, serif;"> <b>Tabla de Estudiantes</b></h1>
                <div class="table-responsive">
                <table id="tblAlumnos" class="table table-striped table-hover display">
                
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nombre completo</th>
                        <th>Matrícula</th>
                        <th>Edad</th>
                        <th>Sexo</th>
                        <th>Carrera</th>
                        <th>Semestre</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($alumnos as $fila) : ?>
                    <tr>
                        <td><?php echo $fila->idalumno;?></td>
                        <td><?php echo $fila->nombre. " " .$fila->apellidos; ?></td>
                        <td><?php echo $fila->matricula; ?></td>
                        <td><?php echo $fila->edad; ?></td>
                        <td><?php echo $fila->sexo; ?></td>
                        <td><?php echo $fila->carrera; ?></td>
                        <td><?php echo $fila->semestre; ?></td>
                        <td><?php echo $fila->email; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
              
        <div class="col-lg-2 text-center mt-3" style="display: flex; justify-content: center; position: relative; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                        
            <a href="reportes.php" type="button" class="btn btn-primary btn-xl pull-right w-100">
              <svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#ffffff" d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/></svg>
                Descargar
              </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

              <a href="reporteexcel.php" type="button" class="btn btn-success btn-xl pull-right w-100">
              <svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#ffffff" d="M128 464H64c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16H224v80c0 17.7 14.3 32 32 32h80V288h48V154.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0H64C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64h64V464zm96-96c0-8.8-7.2-16-16-16s-16 7.2-16 16c0 13.6 4 26.9 11.6 38.2L220.8 432l-17.2 25.8C196 469.1 192 482.4 192 496c0 8.8 7.2 16 16 16s16-7.2 16-16c0-7.3 2.2-14.4 6.2-20.4l9.8-14.7 9.8 14.7c4 6.1 6.2 13.2 6.2 20.4c0 8.8 7.2 16 16 16s16-7.2 16-16c0-13.6-4-26.9-11.6-38.2L259.2 432l17.2-25.8C284 394.9 288 381.6 288 368c0-8.8-7.2-16-16-16s-16 7.2-16 16c0 7.3-2.2 14.4-6.2 20.4L240 403.2l-9.8-14.7c-4-6.1-6.2-13.2-6.2-20.4zm96 128c0 8.8 7.2 16 16 16h48c8.8 0 16-7.2 16-16s-7.2-16-16-16H352V368c0-8.8-7.2-16-16-16s-16 7.2-16 16V496zm88-98.3c0 17.3 9.8 33.1 25.2 40.8l31.2 15.6c4.6 2.3 7.6 7 7.6 12.2c0 7.5-6.1 13.7-13.7 13.7H432c-8.8 0-16 7.2-16 16s7.2 16 16 16h26.3c25.2 0 45.7-20.4 45.7-45.7c0-17.3-9.8-33.1-25.2-40.8l-31.2-15.6c-4.6-2.3-7.6-7-7.6-12.2c0-7.5 6.1-13.7 13.7-13.7H480c8.8 0 16-7.2 16-16s-7.2-16-16-16H453.7c-25.2 0-45.7 20.4-45.7 45.7z"/></svg>
                Descargar
              </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

              <a href="salir.php" type="button" class="btn btn-danger btn-xl pull-right w-100">
              <svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#ffffff" d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg>
                Cerrar
              </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        </div>

  </div>
</div> 
    
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/r-2.5.0/datatables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- page script -->
<script>
  $(function () {   
    $('#tblAlumnos').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });  
  });
</script>        
</body>
<footer class="text-center container">
  <p style="font-family: serif;">
    <strong>Copyright &copy; 2023 <a href="https://hopelchen.tecnm.mx/portal/">TecNM Campus Hopelchén</a>.</strong>
  </p>
</footer>
</html>