<?php
//Inicia la conexion
session_start();

//Validamos si esta logueado
if (!empty($_SESSION['activo'])) {
    header("Location:listaEstudiantes.php");
}

//Incluir la DB
include_once('conexiondb.php');

//Verificar si se envio una solicitud con POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //Validar inicio de sesión
    if (isset($_POST["btningresar"])) {
        //Evalua el acceso
      if (empty($_POST["user"]) && empty($_POST["password"])) {
        $error = "Error, algunos campos estan vacios";
        }else{
            //Obtenemos los valores del formulario
            $user=$_POST["user"];
            $password=md5($_POST["password"]);

            //Consulta SQL
            $sql = "SELECT * FROM administrador WHERE usuario='$user' AND password='$password'";

            //Preparar la consulta
            $resultado = $conn->query($sql);

            //Ejecutar la consulta
            $resultado->execute();

            //Obtener los resultados
            $registro = $resultado->fetch(PDO::FETCH_ASSOC);

            if (!$registro) {
                $error = "Acceso Inválido";
            }else{
                //Creamos sesión
                $_SESSION['activo'] = true;
                $_SESSION['nombre'] = $registro['nombre'];
                $_SESSION['apellidos'] = $registro['apellidos'];

                //Redireccionar a la lista
                header("Location:listaEstudiantes.php");
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" type="opacity: .8" href="img/noveno.jpg">
    <!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    
</head>
<body>
    <div class="float-center mt-4 mb-4">
        <img src="img/ITES.png" class="img-fluid mx-auto d-block" style="width: 800px;"  alt="Logo Tec-Hop">
    </div>

    <div class="container-fluid bg-light pt-5 pb-5" style="display: flex; justify-content: center; align-items: center;">
        
        <div class="card p-5 m-2 text-center" style="width: 500px;">
            <h2 style="color: gray;"><b>Inicio de sesión</b></h2>
                <?php if(isset($error)) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><?php echo $error; ?></strong> 
                </div>
                <?php endif;?>    
            <div class="container mt-3" style="display: flex; justify-content: center; align-items: center;">
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" style="width: 350px;">
                    <div class="input-group mb-3">
                        <input type="user" class="form-control" name="user" placeholder="Usuario" require>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Contraseña" require>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" name="btningresar" class="btn btn-primary d-block w-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
                            <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                            </svg>
                            <b><i class="bi bi-box-arrow-in-right"></i>&nbsp; Ingresar</b>
                            </button>
                        </div>
                    </div>
                </form>  
            </div>
        </div>
    </div>

    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>