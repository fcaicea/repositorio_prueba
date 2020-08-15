<?php

//conexion a base de datos
$conexion = mysqli_connect("localhost","root","root","encuesta_metro");
//verifica conexion.
if(!$conexion){echo '<h4>Error al conextar a la base de datos</h4>';}
else {
  echo '<h4>Conectado a la base de datos</h4>';
  }
// Recepcion de infromacion desde el formulario
$rut = $_POST["_rut"];
$edad = $_POST["_edad"];
$genero = $_POST["_genero"];
$horario = $_POST["_uso"];
$frecuencia =$_POST["_frecuencia"];
$linea1 = $_POST["_linea1"];
$linea2= $_POST["_linea2"];
$linea3= $_POST["_linea3"];
$linea4 = $_POST["_linea4"];
$linea5= $_POST["_linea5"];
$linea6 = $_POST["_linea6"];
$calidad = $_POST["_calidad"];
$observaciones = $_POST["_observaciones"];
$fecha = $_POST["_fecha"];
$hora = $_POST["_hora"];

// se crea instruccion para ingreso y verificacion del rut.

$verifica_rut = mysqli_query($conexion,"SELECT * FROM rut WHERE numero_rut = '$rut';");
if (mysqli_num_rows($verifica_rut)>0){
  echo '<h3>El RUT ya se encuentra registrado</h3>';
  exit;
}
else{
  $envio_rut = mysqli_query($conexion,"INSERT INTO `rut` (`numero_rut`) VALUES ('$rut');");
}


// se crea la sentencia SQL que inserta el dato.
$instruccion = "INSERT INTO `encuesta` (`edad`, `genero`, `horario`, `linea_1`, `linea_2`,
  `linea_3`, `linea_4`, `linea_5`, `linea_6`, `frecuencia`, `calidad`, `observaciones`,
  `fecha`, `hora`) VALUES ('$edad', '$genero', '$horario', '$linea1', '$linea2', '$linea3', '$linea4', '$linea5', '$linea6',
    '$frecuencia', '$calidad', '$observaciones', '$fecha', '$hora');";

//se ejecuta la $instruccion
$envio = mysqli_query($conexion,$instruccion);

//se verifica la correcta insercion en la base de datos.
if(!$envio){
  echo '<h4>No se pudo agregar la encuesta</h4>';
  exit;
}
else{echo '<h4>Datos almacenados correctamente!</h4>';
}


echo "<h1>Datos Almacenados</h1>";

// voy a buscar el registro del rut.
$trae_rut = mysqli_query($conexion,"SELECT * FROM rut WHERE numero_rut = '$rut';");
$resultado_rut = $trae_rut->fetch_array();


// voy a buscar el id del ultimo registro.
$maximo_id = mysqli_query($conexion, "SELECT MAX(`id_encuesta`) AS id FROM `encuesta`");
$id = $maximo_id->fetch_array();
$id_final=$id['id'];


// hago la consulta para recibir los datos .
$trae_datos = mysqli_query($conexion,"SELECT * FROM encuesta WHERE id_encuesta = '$id_final';");
$resultado_datos = $trae_datos->fetch_array();


//cerrar conexion.
mysqli_close($conexion);

 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Tarea semana 1</title>
      <link rel="stylesheet" href="miestilo.css"/>
     <title></title>
   </head>
   <body class="fondo_principal">
     <div>
       <img src="logoMetro.png" id="logo" width="120px" height="100px">
     </div>

     <table class="fondo_secundario" id="_resultados">
       <tr>
         <td>RUT</td>
         <td><?php echo $resultado_rut['numero_rut'] ?></td>
       </tr>
       <tr>
         <td>EDAD</td>
         <td><?php echo $resultado_datos['edad'] ?></td>
       </tr>
       <tr>
         <td>GENERO</td>
         <td><?php echo $resultado_datos['genero'] ?></td>
       </tr>
       <tr>
         <td>HORARIO</td>
         <td><?php echo $resultado_datos['horario'] ?></td>
       </tr>
       <tr>
         <td>FRECUENCIA DE USO</td>
         <td><?php echo $resultado_datos['frecuencia'] ?></td>
       </tr>
       <tr>
         <td>LINEA 1</td>
         <td><?php echo $resultado_datos['linea_1'] ?></td>
       </tr>
       <tr>
         <td>LINEA 2</td>
         <td><?php echo $resultado_datos['linea_2'] ?></td>
       </tr>
       <tr>
         <td>LINEA 3</td>
         <td><?php echo $resultado_datos['linea_3'] ?></td>
       </tr>
       <tr>
         <td>LINEA 4</td>
         <td><?php echo $resultado_datos['linea_4'] ?></td>
       </tr>
       <tr>
         <td>LINEA 5</td>
         <td><?php echo $resultado_datos['linea_5'] ?></td>
       </tr>
       <tr>
         <td>LINEA 6</td>
         <td><?php echo $resultado_datos['linea_6'] ?></td>
       </tr>
       <tr>
         <td>CALIDAD</td>
         <td><?php echo $resultado_datos['calidad'] ?></td>
       </tr>
       <tr>
         <td>OBSERVACIONES</td>
         <td><?php echo $resultado_datos['observaciones'] ?></td>
       </tr>
       <tr>
         <td>FECHA</td>
         <td><?php echo $resultado_datos['fecha'] ?></td>
       </tr>
       <tr>
         <td>HORA</td>
         <td><?php echo $resultado_datos['hora'] ?></td>
       </tr>

     </table>
     <div >
       <footer>
           <h3>Implementado por MERANA fono: 345654344</h3>
       </footer>

     </div>

   </body>
 </html>
