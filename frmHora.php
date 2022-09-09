<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Ecokhemia</title>
        <link rel="stylesheet" href="css/EdicionAR.css"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    </head>
    <body>
        <script type="text/javascript">
           if (typeof navigator.geolocation == 'object'){
               navigator.geolocation.getCurrentPosition(mostrar_ubicacion);
           }

           function mostrar_ubicacion(p)
           {
               var posicion = p.coords.latitude+','+p.coords.longitude;
               document.getElementById("Ub").value = posicion;
           }
        </script>
        <form action="frmHora.php" class="form-box" method="POST"> 
            <p><img alt="" width="280" height="135" src="./image/Sinfondo.png"></p> 
            <h3 class="form-title">Registrar hora</h3>
            <input type="text" placeholder="Cedula" name="ced" id="ced" autofocus>
            <select id="lista" name="lista">
                <option selected disabled>Horario a establecer</option>
                <option name="Ingreso">Ingreso</option>
                <option name="Salida">Salida</option>
                <option name="Salida a Almuerzo">Salida a Almuerzo</option>
                <option name="Entrada despues del almuerzo">Entrada despues de Almuerzo</option>
            </select>
                           <!-- <input type="checkbox" name="00">
                           <p>¿Mantener sesion iniciada?</p>--> 
        <input type="submit" value="Enviar" name="btEnviar" id="btEnviar">
        <p>¿Ya has registrado la hora? <a class="" href="./">Volver atras</a></p>
        <input type="hidden" id="Ub" name="Ub" readonly>
    </form>
    <?php

try {




    echo '<script>console.log("Paso 1")</script>';




    if (isset($_POST['btEnviar'])) {
        echo '<script>console.log("Paso 2")</script>';
        require_once './config.php';
        echo '<script>console.log("Paso 4")</script>';
        require_once './class/FechaPerfil.php';
        echo '<script>console.log("Paso 5")</script>';
        $FechaPerfil = new FechaPerfil();
        $listR = $_POST["lista"];
        $cedula = ($_POST['ced']);
        $date = date("y-m-d");
        $ubicacion = $_POST['Ub'];
        $q = "SELECT COUNT(*) as contar from Fechaperfil where Cedula = '$cedula' AND Fecha = '$date'";
        $consulta = mysqli_query($conexion, $q);
        $array = mysqli_fetch_array($consulta);
            if ($array['contar'] == 0) {
            $FechaPerfil->setUser($cedula);
            $FechaPerfil->setDate($date);
            $FechaPerfil->setUbicacion($ubicacion);
            echo '<p>' . $FechaPerfil->insertarFechaPerfil() . '</p>';
            }
        echo '<script>console.log("Paso 3")</script>';
        if ($listR == "Ingreso") {
                date_default_timezone_set('America/Costa_Rica');
                $time = date("H:i");
                $cons = "SELECT COUNT(HoraIngreso) as contar from Fechaperfil where Cedula = '$cedula' AND Fecha = '$date'";
                $consulta = mysqli_query($conexion, $cons);
                $array = mysqli_fetch_array($consulta);
                if ($array['contar'] == 0) {
                $FechaPerfil->setIngreso($time);
                $FechaPerfil->setDate($date);
                $FechaPerfil->setUser($cedula);
                echo '<p>' . $FechaPerfil->insertarHoraIngreso(). '</p>';
                echo "<script>
            Swal.fire({
            icon: 'success',
            title: 'Enhorabuena...!',
            text: 'Hora de ingreso establecida..!',  
            })
            </script>";
                }else{
                    echo "<script>
            Swal.fire({
            icon: 'error',
            title: 'Oops...!',
            text: 'Ya ha enviado la hora de ingreso..!',  
            })
            </script>";
                }
        } else {
            if ($listR == "Salida") {
                date_default_timezone_set('America/Costa_Rica');
                $time = date("H:i");
                $cons = "SELECT COUNT(HoraSalida) as contar from Fechaperfil where Cedula = '$cedula' AND Fecha = '$date'";
                $consulta = mysqli_query($conexion, $cons);
                $array = mysqli_fetch_array($consulta);
                if ($array['contar'] > 0) {
                    echo "<script>
            Swal.fire({
            icon: 'error',
            title: 'Oops...!',
            text: 'Ya ha enviado la hora de salida..!',  
            })
            </script>";
                } else {
                    $FechaPerfil->setSalida($time);
                    $FechaPerfil->setDate($date);
                    $FechaPerfil->setUser($cedula);
                    echo '<p>' . $FechaPerfil->insertarHoraSalida() . '</p>';
                    echo "<script>
            Swal.fire({
            icon: 'success',
            title: 'Enhorabuena...!',
            text: 'Hora de salida establecida..!',  
            })
            </script>";
                }
            } else {
                if ($listR == "Salida a Almuerzo") {
                    date_default_timezone_set('America/Costa_Rica');
                    $time = date("H:i");
                    $cons = "SELECT COUNT(HoraSalidaAlmuerzo) as contar from Fechaperfil where Cedula = '$cedula' AND Fecha = '$date'";
                    $consulta = mysqli_query($conexion, $cons);
                    $array = mysqli_fetch_array($consulta);
                    if ($array['contar'] > 0) {
                        echo "<script>
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...!',
                    text: 'Ya ha enviado la hora de salida a almuerzo..!',  
                    })
                    </script>";
                    } else {
                        $FechaPerfil->setSalidaAlmuerzo($time);
                        $FechaPerfil->setDate($date);
                        $FechaPerfil->setUser($cedula);
                        echo '<p>' . $FechaPerfil->insertarHoraSalidaAlmuerzo() . '</p>';
                        echo "<script>
                    Swal.fire({
                    icon: 'success',
                    title: 'Enhorabuena...!',
                    text: 'Hora de salida a almuerzo establecida..!',  
                    })
                    </script>";
                    }
                } else {
                if ($listR == "Entrada despues de Almuerzo") {
                    date_default_timezone_set('America/Costa_Rica');
                    $time = date("H:i");
                    $cons = "SELECT COUNT(HoraEntradaAlmuerzo) as contar from Fechaperfil where Cedula = '$cedula' AND Fecha = '$date'";
                    $consulta = mysqli_query($conexion, $cons);
                    $array = mysqli_fetch_array($consulta);
                    if ($array['contar'] > 0) {
                        echo "<script>
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...!',
                        text: 'Ya ha enviado la hora de entrada del almuerzo..!',  
                        })
                        </script>";
                    } else {
                        $FechaPerfil->setEntradaAlmuerzo($time);
                        $FechaPerfil->setDate($date);
                        $FechaPerfil->setUser($cedula);
                        echo '<p>' . $FechaPerfil->insertarHoraEntradaAlmuerzo() . '</p>';
                        echo "<script>
                    Swal.fire({
                    icon: 'success',
                    title: 'Enhorabuena...!',
                    text: 'Hora de entrada del almuerzo establecida..!',  
                    })
                    </script>";
                    }
                } else {
                    if(empty($_POST['ced']) || $listR == ""){
                    echo "<script>
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...!',
                    text: 'Debe completar el formulario..!',  
                    })
                    </script>";    
                    }
                  }
               }
            }
        }
    }

} catch (Exception $e) {
    log_exception($e);
}

    ?>
</body>
</html>