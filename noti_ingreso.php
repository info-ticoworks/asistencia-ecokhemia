<?php

Class noti {

    function enviarNoti() {

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

    }

}