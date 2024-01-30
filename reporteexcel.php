<?php
    //Inicia la conexion
    session_start();

    //Validamos si esta logueado
    if (!$_SESSION['activo']) {
        header("Location:login.php");
    }

    //Incluir la DB
    include_once('conexiondb.php');

    header("Content-Type: application/xls");    
    header("Content-Disposition: attachment; filename=Estudiantes_Foro_" .date('Y:m:d:m:s').".xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");

    $output = "";

    $output='
    <style>
        #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin: -20px;
        text-align: center;
        }

        #tr {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin: -20px;
            text-align: center;
        }

    </style>

    <meta charset="UTF-8">
        <div style="text-align: center;">
        <h1>Reporte de Estudiantes</h1>
        <h4>5to Foro de Innovación y Tecnología</h4>
        </div>
        <table id="customers">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nombre</th>
                    <th>Matrícula</th>
                    <th>Edad</th>
                    <th>Sexo</th>
                    <th>Carrera</th>
                    <th>Semestre</th>
                    <th>Email</th>
                </tr>
            <tbody>
    ';

    $query = "SELECT * FROM alumnos";
    $stmt = $conn->query($query);
    $stmt->execute();
    $alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($alumnos as $key=>$value){

    $output.='
        <tr id="tr">
            <td>'.$value['idalumno'].'</td>
            <td>'.$value['nombre']." ".$value['apellidos'].'</td>
            <td>'.$value['matricula'].'</td>
            <td>'.$value['edad'].'</td>
            <td>'.$value['sexo'].'</td>
            <td>'.$value['carrera'].'</td>
            <td>'.$value['semestre'].'</td>
            <td>'.$value['email'].'</td>
        </tr>
    ';
    }
    

    $output.='
            </tbody>
        </table>
    ';

    echo $output

?>