<?php
require 'vendor/autoload.php';
require 'conexion.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$c = new \Slim\Container();
$c['errorHandler']=function ($c){
    return function ($request, $response, $excepcion) use ($c){
        $error =array('error' => $excepcion->getMessage());
        return $c['response']->withStatus(500)
                             ->withHeader('Content-Type','application/json')
                             ->write(json_encode($error));
    };
};

$app = new \Slim\App($c);

//CRUD para la tabla businnes 

//Insertar una nueva empresa
$app->post('/empresa/create',function(Request $request, Response $response, $args){
    $datos = $request->getParsedBody();
    $Empresa = new Empresa();
    $Empresa->Nombre = $datos['Nombre'];
    $Empresa->Direccion = $datos['Direccion'];
    $Empresa->rfc = $datos['rfc'];
    $Empresa->cp = $datos['cp'];
    $Empresa->id_active = $datos['id_active'];
    $Empresa->save();
});

//Consultar los registros de la tabla businnes
$app->get('/empresa/read',function(Request $request, Response $response, $args){
    $Empresas = Empresa::get();
    return sendOkResponse($Empresas->toJson(),$response);
});
//Fin del CRUD de la tabla businnes

$app->post('/nuevoInvernadero',function(Request $request, Response $response, $args){
$datos= $request->getParsedBody();
$Invernadero=new Invernadero();
$Invernadero->idinvernadero=$datos['idinvernadero'];
$Invernadero->name=$datos['name'];
$Invernadero->iduser=$datos['iduser'];
$Invernadero->save();
});

$app->get('/mostrarInvernaderos',function(Request $request, Response $response,$args){
$Invernaderos= Invernadero::get();
return sendOkResponse($Invernaderos->toJson(), $response);

});

$app->get('/mostrarporid/{id}',function(Request $request, Response $response,$args){
$Invernaderos = Invernadero::where('idinvernadero','=',$args['id'])->get();
return sendOkResponse($Invernaderos->toJson(),$response);
}
);

$app->put('/update/{id}',function(Request $request,Response $response,$args){
$datos = $request->getParsedBody();
$Invernadero = Invernadero::find($args['id']);
$Invernadero->name=$datos['name'];
$Invernadero->save();
return sendOkResponse($Invernadero->toJson(),$response);
});

$app->delete('/delete/{id}',function(Request $request,Response $response,$args){
$Invernadero = Invernadero::find($args['id']);
$Invernadero->delete();
return sendOkResponse($Invernadero->tojson(),$response);
});

function sendOkResponse($message, $response){
$newResponse = $response->withStatus(200)->withHeader('Content-Type','application/json');
$newResponse->getBody()->write($message);
return $newResponse;
}
$app->run();
?>       