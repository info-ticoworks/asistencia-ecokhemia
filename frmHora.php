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
            <p><img alt="" width="280" height="135" src="image/Sinfondo.png"></p> 
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
        <p>¿Ya has registrado la hora? <a class="" href="http://51.222.14.197:81/asistencia-ecokhemia/">Volver atras</a></p>
        <input type="hidden" id="Ub" name="Ub" readonly>
    </form>
    <?php
 ?>
</body>
</html>