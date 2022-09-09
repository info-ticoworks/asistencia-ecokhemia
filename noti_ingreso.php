<?php
echo '<script>console.log("Carga de archivo NotiWhats")</script>';
Class NotiWhats {

    function enviarNoti() {

        $client = new http\Client;
        $request = new http\Client\Request;
        
        $body = new http\Message\Body;
        $body->append('{
          "message":"Hola de *nuevo*",
          "phone":"50683528129"
        }');
        
        $request->setRequestUrl('http://51.222.14.197:3020/lead');
        $request->setRequestMethod('POST');
        $request->setBody($body);
        
        $request->setHeaders([
          'Content-Type' => 'application/json'
        ]);
        
        $client->enqueue($request)->send();
        $response = $client->getResponse();
        
        echo $response->getBody();
        
        echo '<script>console.log("Paso 2 Notificacion")</script>';

    }

}