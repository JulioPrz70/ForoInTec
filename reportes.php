<?php
//Funcion para guardar los datos en memoria a partir de este punto
ob_start();

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Estudiantes PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" type="opacity: .8" href="img/noveno.jpg">
    
    <style>
        #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin: -20px;
        text-align: center;
        }

        #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        background-color: #1b5f76;
        color: white;
        text-align: center;
        }
    </style>
    
</head>
<body>
    <div style="text-align: center;">
    <h1>Reporte de Estudiantes</h1>
    <h4>5to Foro de Innovación y Tecnología</h4>
    <br>
    <br>
        <table id="customers">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nombre</th>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
           
</body>
</html>


<?php
    //Guardar los datos en una variable
    $html=ob_get_clean();
    
    //Importar
    require_once '../Foro/libreria/dompdf/autoload.inc.php';

    //Creacion de objeto
    use Dompdf\Dompdf;
    $dompdf = new Dompdf();


    //Configurar para mostrar imagenes
    $options = $dompdf->getOptions();
    $options->set(array('isRemoteEnable' => true));
    $dompdf->setOptions($options);

    //Enviar la variable con la info guardada
    $dompdf->loadHtml($html);

    //Formato carta vertical
    $dompdf->setPaper('letter');
    
    //Formato horizontal
    //$dompdf->setPaper('A4', 'landscape')

    //Render, poder ser visible
    $dompdf->render();

    //Nombre defecto del doc y abre el doc usando False, usando true se descarga automaticamente
    $dompdf->stream("Estudiantes_Foro.pdf", array("Attachment" => false));


?>