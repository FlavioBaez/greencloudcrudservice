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

//Modificar un registro de la tabla businnes
$app->put('/empresa/update/{id}',function(Request $request, Response $response, $args){
    $datos = $request->getParsedBody();
    $Empresa = Empresa::find($args['id']);

    $Empresa->Nombre = $datos['Nombre'];
    $Empresa->Direccion = $datos['Direccion'];
    $Empresa->rfc = $datos['rfc'];
    $Empresa->cp = $datos['cp'];
    $Empresa->id_active = $datos['id_active'];
    $Empresa->save();
    return sendOkResponse($Empresa->toJson(),$response);
    
});


//Fin del CRUD de la tabla businnes

//CRUD para tabla user

//Insertar un usuario nuevo
$app->post('/usuario/create',function(Request $request, Response $response, $args){
    $datos = $request->getParsedBody();
    $Usuario = new Usuario();
    $Usuario->username = $datos['username'];
    $Usuario->password = $datos['password'];
    $Usuario->email = $datos['email'];
    $Usuario->user_type = $datos['user_type'];
    $Usuario->id_bussines = $datos['id_bussines'];
    $usuario->id_active = $datos['id_active'];
    $Usuario->save();

});

//Consultar todos los registros de la tabla usuarios
$app->get('/usuario/read',function(Request $request, Response $response, $args){
    $Usuarios = Usuario::get();
    return sendOkResponse($Usuarios->toJson(),$response);
});

//Modificar un registro de la tabla ususarios

    $app->put('/usuario/update/{id}',function(Request $request, Response $response, $args){
    $datos = $request->getParsedBody();
    $Usuario =  Usuario::find($args['id']);
    $Usuario->username = $datos['username'];
    $Usuario->password = $datos['password'];
    $Usuario->email = $datos['email'];
    $Usuario->user_type = $datos['user_type'];
    $Usuario->id_bussines = $datos['id_bussines'];
    $usuario->id_active = $datos['id_active'];
    $Usuario->save();
return sendOkResponse($Usuario->toJson(),$response);
});


//fin del CRUD de la tabla user


//CRUD de la tabla Invernadero

//agregar nuevo invernadero
$app->post('/invernadero/create',function(Request $request, Response $response, $args){
$datos= $request->getParsedBody();
$Invernadero = new Invernadero();
$Invernadero->idinvernadero = $datos['idinvernadero'];
$Invernadero->name = $datos['name'];
$Invernadero->iduser = $datos['iduser'];
$Invernadero->descripcion = $datos['descripcion'];
$Invernadero->id_active = $datos['id_active'];
$Invernadero->save();
});

//mostrar todos los registros de la tabla invernadero
$app->get('/invernadero/read',function(Request $request, Response $response,$args){
$Invernaderos = Invernadero::get();
return sendOkResponse($Invernaderos->toJson(), $response);

});

//mostrar invernaderos por id
$app->get('/invernadero/read/id/{id}',function(Request $request, Response $response,$args){
$Invernaderos = Invernadero::where('idinvernadero','=',$args['id'])->get();
return sendOkResponse($Invernaderos->toJson(),$response);
}
);

//modificar un invernadero
$app->put('/invernadero/update/{id}',function(Request $request,Response $response,$args){
$datos = $request->getParsedBody();
$Invernadero = Invernadero::find($args['id']);
$Invernadero->idinvernadero = $datos['idinvernadero'];
$Invernadero->name = $datos['name'];
$Invernadero->iduser = $datos['iduser'];
$Invernadero->descripcion = $datos['descripcion'];
$Invernadero->id_active = $datos['id_active'];
$Invernadero->save();
return sendOkResponse($Invernadero->toJson(),$response);
});

//eliminar un invernadero
$app->delete('/delete/{id}',function(Request $request,Response $response,$args){
$Invernadero = Invernadero::find($args['id']);
$Invernadero->delete();
return sendOkResponse($Invernadero->tojson(),$response);
});

//////////
//fin del CRUD de la tabla inveraderos

//CRUD de la tabla tipo_cultivo

//insertar un nuevo registro en la tabla tipo_cultivo
$app->post('/tipoCultivo/create',function(Request $request, Response $response, $args){
$datos = $request->getParsedBody();
$Tipo_Cultivo = new Tipo_Cultivo();
$Tipo_Cultivo->nombre = $datos['nombre'];
$Tipo_Cultivo->descripcion = $datos['descripcion'];
$Tipo_Cultivo->id_invernadero = $datos['id_invernadero'];
$Tipo_Cultivo->save();
return sendOkResponse($Invernadero->toJson(),$response);
});

//mostar todos los datos de la tabla tipo_cultivo
$app->get('/tipoCultivo/read',function(Request $request, Response $response, $args){
    $Tipos_Cultivos = Tipo_Cultivo::get();
    return sendOkResponse($Tipos_Cultivos->toJson(),$response);
});

//modificar un registro de la tabla tipo_cultivo
$app->put('/tipoCultivo/update/{id}',function(Request $request, Response $response, $args){
    $datos = $request->getPersedBody();
    $Tipo_Cultivo = Tipo_Cultivo::find($args['id']);
    $Tipo_Cultivo->nombre = $datos['nombre'];
    $Tipo_Cultivo->descripcion = $datos['descripcion'];
    $Tipo_Cultivo->id_invernadero = $datos['id_invernadero'];
    $Tipo_Cultivo->save();
    return sendOkResponse($Invernadero->toJson(),$response);
});
///////////////////////
//fin del CRUD de la tabla tipo_cultivo

//CRUD de la tabla minimos_maximos

//Insercion de un nuevo registro 
$app->post('/minimoMaximo/create',function(Request $request, Response $response, $args){
    $datos = $request->getParseBody();
    $Minimos_Maximo = new Minimos_Maximo();
    $Minimos_Maximo->maxima = $datos['maxima'];
    $Minimos_Maximo->minima = $datos['minima'];
    $Minimos_Maximo->id_invernadero = $datos['id_invernadero'];
    $Minimos_Maximo->id_variable = $datos['id_variable'];
    $Minimos_Maximo->save();
    return sendOkResponse($Minimos_Maximo->toJson(),$response);
});

//Mostrar todos los registros de la tabla minimos_maximos
$app->get('/minimoMaximo/read',function(Request $request, Response $response, $args){
    $Minimos_Maximos = Minimos_Maximo::get();
    return sendOkResponse($Minimos_Maximos->toJson(),$response);
});

//modificar un registro de la tabla minimos_maximos
$app->put('/minimoMaximo/update/{id}',function(Request $request, Response $response, $args){
    $datos = $request->getParsedBody();
    $Minimos_Maximo = Minimos_Maximo::find($args['id']);
    $Minimos_Maximo->maxima = $datos['maxima'];
    $Minimos_Maximo->minima = $datos['minima'];
    $Minimos_Maximo->id_invernadero = $datos['id_invernadero'];
    $Minimos_Maximo->id_variable = $datos['id_variable'];
    $Minimos_Maximo->save();
    return sendOkResponse ($Minimos_Maximo->toJson(),$response);
});
///////////////////////
//fin del CRUD de la tabla minimos_maximos

//CRUD de la tabla sector
///////////////////////
//fin del CRUD de la tabla sector

//CRUD de la tabla tipo_variable

//agregar un nuevo registro a la tabla tipo_variable
$app->post('/tipoVariable/create',function(Request $request, Response $response, $args){
    $datos = $request->getParsedBody();
    $Tipo_Variable = new Tipo_Variable();
    $Tipo_Variable->nombre = $datos['nombre'];
    $Tipo_Variable->descripcion = $datos['descripcion'];
    $Tipo_Variable->save();
    return sendOkResponse($Tipo_Variable->toJson(),$response);
});

//mostrar todos los registros de la tabla tipo_variables
$app->get('tipoVariable/read',function(Request $request, Response $response, $args){
    $Tipo_Variables = Tipo_Variable::get();
    return sendOkResponse($Tipo_Variables->toJson(),$response);
});

//Modificar un registro de la tabla tipo_variable


///////////////////////
//fin del CRUD de la tabla tipo_variable






function sendOkResponse($message, $response){
$newResponse = $response->withStatus(200)->withHeader('Content-Type','application/json');
$newResponse->getBody()->write($message);
return $newResponse;
}
$app->run();
?>       