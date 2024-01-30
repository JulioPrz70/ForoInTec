<?php
include_once("conexiondb.php");

if (isset($_POST["btnRegistro"])) {
    
  //Obtener valores
  $nombre = $_POST["nombre"];
  $apellidos = $_POST["apellidos"];
  $matricula = $_POST["matricula"];
  $edad = $_POST["edad"];
  $sexo = $_POST["sexo"];
  $carrera = $_POST["carrera"];
  $semestre = $_POST["semestre"];
  $email = $_POST["email"];

  
  //Validar si esta vacio
  if (empty($nombre) || empty($apellidos) || empty($matricula) || empty($edad) || empty($sexo) || empty($carrera) || empty($semestre) || empty($email)) {
    $error = "Error, algunos campos obligatorios están vacios.";
  }else{
         
       
    $query = "SELECT * FROM alumnos WHERE matricula = $matricula";
    $resultado = $conn->query($query);

    //Ejecutar la consulta
    $resultado->execute();
    //Obtener los resultados
    $registro = $resultado->fetch(PDO::FETCH_ASSOC);
    if ($registro) {
       $error = "La matrícula ingresada ya se encuentra en el sistema.";
      }else{
        //Si entra es porque se puede ingresar un nuevo registro
        $query = "INSERT INTO alumnos(nombre, apellidos, matricula, edad, sexo, carrera, semestre, email)
        VALUES (:nombre, :apellidos, :matricula, :edad, :sexo, :carrera, :semestre, :email)";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $apellidos, PDO::PARAM_STR);
        $stmt->bindParam(":matricula", $matricula, PDO::PARAM_STR);
        $stmt->bindParam(":edad", $edad, PDO::PARAM_INT);
        $stmt->bindParam(":sexo", $sexo, PDO::PARAM_STR);
        $stmt->bindParam(":carrera", $carrera, PDO::PARAM_STR);
        $stmt->bindParam(":semestre", $semestre, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $resultado = $stmt->execute();
        if ($resultado) {
          

        //Inicio Envio de correo electronico
        $result = "";
        if (isset($_POST['btnRegistro'])) {
          //Configuración del servidor
          require 'phpmailer/PHPMailerAutoload.php';
          $mail = new PHPMailer;
          $mail->isSMTP();
          $mail->Host='smtp.gmail.com';
          $mail->Port=587;
          $mail->SMTPAuth=true;
          $mail->SMTPSecure='tls';
          $mail->Username='akatskihuchiah@gmail.com';
          $mail->Password='ibyj lxoh euso rqpy';

          //Configuracion del destinatario
          $mail->setFrom('daniel.pg@hopelchen.tecnm.mx', '5to Foro de Innovacion y Tecnologia');
          $mail->addAddress($_POST['email']);
          $mail->addAddress('akatskihuchiah@gmail.com');
          $mail->addReplyTo('daniel.pg@hopelchen.tecnm.mx', 'Daniel Alberto Panti Gonzales');

          //Configuración del correo
          $mail->isHTML(true);
          $mail->Subject='Registro 5to Foro TECNM';
          $mail->Body='
          <html>
          <html lang="es">
                <body style="text-align: center; padding: 30px;">
                <h1 style="color: secondary; padding-top: 5px;">¡Felicidades Registro Completado!</h1>
                <h1 class="pb-4"><br>Hola '.$_POST['nombre'].' '.$_POST['apellidos'].', 👋<br>Pronto recibiras tu constancia de participación en tu correo; '.$_POST['email'].'<br><br>Nos da gusto que hayas formado parte del 5to Foro de Innovación y Tecnología 😄<br></h1>
                <h5 style="padding: 25px;"><b>Estamos para servirte,</b> <br>
                    Tu equipo del 5to Foro.
                </h5>            
                </body>
              </html>
          ';
          if (!$mail->send()) {
            $result = '<br>Algo salió mal, inténtelo de nuevo.';
          }else{
            $result= '<br>Le hemos enviado un correo de confirmación, revise su bandeja de entrada o SPAM.';
          }
        }

        //Final envio de correo electronico

          $mensaje = "Registro Exitoso";
        }else{
          $error = "Por favor, intentelo de nuevo";
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
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" type="opacity: .8" href="img/noveno.jpg">
    
</head>
<body>
  <div class="float-center mt-4 mb-4">
    <img src="img/ITES.png" class="img-fluid mx-auto d-block" style="width: 800px;"  alt="Logo Tec-Hop">
  </div>

<div class="container-fluid bg-light pt-2">
  <div class="row mb-5">
            <div class="text-center p-3">
              <h1 style="font-family: Georgia, serif;"><b> 5° Foro de Innovación y Tecnología </b></h1>
            </div>

            <div class="row">
              <div class="col-sm-12" style="text-align: center;">
                  <?php if(isset($mensaje)) : ?>
                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            <strong>
                            <?php echo $mensaje; 
                            ?>
                            </strong>
                        </div>
                  <?php endif;?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12" style="text-align: center;">
                <?php if(isset($error)) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?php echo $error; ?></strong> 
                        </div>
                  <?php endif;?>
                </div>
            </div>
    <div class="col-lg-12 p-4" style="display: flex; justify-content: center; position: relative; top: 50%; left: 50%; transform: translate(-50%, -0%);">
            
            <form role="form" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" class="row g-3 needs-validation" novalidate>
              <div class="col-md-5">
                  <label for="nombre" class="form-label">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" required>
                  <div class="valid-feedback">
                    Correcto!
                  </div>
              </div>
              <div class="col-md-5">
                  <label for="apellidos" class="form-label">Apellidos</label>
                  <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                  <div class="valid-feedback">
                    Correcto!
                  </div>
              </div>
              <div class="col-md-2">
                  <label for="matricula" class="form-label">Matrícula</label>
                  <input type="text" class="form-control" id="matricula" name="matricula" required>
                  <div class="valid-feedback">
                    Correcto!
                  </div>
              </div>

              <div class="col-md-2">
                  <label for="edad" class="form-label">Edad</label>
                  <input type="text" class="form-control" id="edad" name="edad" required>
                  <div class="valid-feedback">
                    Correcto!
                  </div>
              </div>
              <div class="col-md-4">
              <label for="sexo" class="form-label">Sexo</label>
                  <select class="form-select" id="sexo" name="sexo" required>
                  <option selected disabled value="">Seleccione una opción</option>
                  <option value="H">Hombre</option>
                  <option value="M">Mujer</option>
                  </select>
                  <div class="invalid-feedback">
                    Ingrese su sexo!
                  </div>
              </div>
              <div class="col-md-6">
                  <label for="carrera" class="form-label">Carrera</label>
                  <select class="form-select" id="carrera" name="carrera" required>
                  <option selected disabled value="">Seleccione una opción</option>
                  <option value="Ingeniería en Sistemas Computacionales">Ingeniería en Sistemas Computacionales</option>
                  <option value="Administración de Empresas">Administración de Empresas</option>
                  <option value="Ingeniería en Innovación Agrícola Sustentable">Ingeniería en Innovación Agrícola Sustentable</option>
                  </select>
                  <div class="invalid-feedback">
                    Ingrese su carrera!
                  </div>
              </div>

              
              <div class="col-md-3">
                  <label for="semestre" class="form-label">Semestre</label>
                  <select class="form-select" id="semestre" name="semestre" required>
                  <option selected disabled value="">Seleccione una opción</option>
                  <option value="1">Primero</option>
                  <option value="2">Segundo</option>
                  <option value="3">Tercero</option>
                  <option value="4">Cuarto</option>
                  <option value="5">Quinto</option>
                  <option value="6">Sexto</option>
                  <option value="7">Septimo</option>
                  <option value="8">Octavo</option>
                  </select>
                  <div class="invalid-feedback">
                    Ingrese el semestre que cursa!
                  </div>
              </div>
              <div class="col-md-9">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="valid-feedback">
                    Correcto!
                </div>
              </div>

              <div class="col-12 p-2">
                  <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="permiso" required>
                  <label class="form-check-label" for="permiso">
                      Recibir información por correo.
                  </label>
                  <div class="invalid-feedback">
                      Debe estar seleccionada.
                  </div>
                  </div>
              </div>

              <div class="col-12 text-center">
                  <button class="btn btn-success" type="submit" name="btnRegistro">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                      <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                    </svg>
                    <i class="fa fas-person-check-fill">Registrarse</i>
                  </button>
                  <br>
                      <h5 class="notifCorrecto"><?= $result;?></h5>
              </div>
            </form>
    </div>


    

  </div>
  <div class="col-lg-2 text-center mt-3" style="display: flexbox; justify-content: center; position: relative; top: 50%; left: 50%; transform: translate(-50%, -0%);">
      <img src="img/noveno.jpg" class="img-thumbnail rounded-5 mb-3" style="width: 125px;" alt="Aniversario logo">
      <strong>
        <a href="https://hopelchen.tecnm.mx/portal/">
          <h6 
          style="font-family: Gill Sans, sans-serif;"><b>TecNM Campus Hopelchén</b>
          </h6>
        </a>
      </strong>
  </div>
</div> 

    <script>
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
<footer class="text-center container">
  <p style="font-family: serif;">
    <strong>Copyright &copy; 2023.</strong>
  </p>
</footer>
</html>