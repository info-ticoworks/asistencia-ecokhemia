<?php
echo '<script>console.log("Carga de archivo NotiWhats")</script>';
Class NotiWhats {

    function enviarNoti() {

        echo '<script>console.log("Paso 1 Notificacion")</script>';
        $request = new HttpRequest();
        $request->setUrl('http://51.222.14.197:3020/lead');
        $request->setMethod(HTTP_METH_POST);

        $request->setHeaders([
        'Content-Type' => 'application/json'
        ]);

        $request->setBody('{
        "message":"Hola de *nuevo*",
        "phone":"50683528129"
        }');

        try {
        $response = $request->send();

        echo $response->getBody();
        } catch (HttpException $ex) {
        echo $ex;
        }
        echo '<script>console.log("Paso 2 Notificacion")</script>';

    }

}