<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

$app = new \Slim\App;

$app->add(function ($req, $res, $next)
 { $response = $next($req, $res); return $response 
 ->withHeader('Access-Control-Allow-Origin', 'http://mysite') 
 ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization') 
->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS'); });

//Debe tener autorizacion
// $app->add(new \Slim\Middleware\HttpBasicAuthentication([
//     "path" => "/token",
//     "users" => [
//         "test" => "test"
//     ]
// ]));

$app->add(new \Slim\Middleware\JwtAuthentication([
    "secret" => "supersecretkeyyoushouldnotcommittogithub",
    "rules" => [
        new \Slim\Middleware\JwtAuthentication\RequestPathRule([
            "path" => "/",
            "passthrough" => ["/token"]
        ]),
        new \Slim\Middleware\JwtAuthentication\RequestMethodRule([
            "passthrough" => ["OPTIONS"]
        ])
    ]
]));

$app->post("/token", function ($request, $response, $arguments) {

    $now = new DateTime();
    $future = new DateTime("now +2 hours");
    $server = $request->getServerParams();

    $payload = [
        "iat" => $now->getTimeStamp(),
        "exp" => $future->getTimeStamp(),
        "sub" => "USER",
    ];
    $secret = "supersecretkeyyoushouldnotcommittogithub";
    $token = JWT::encode($payload, $secret, "HS256");
    $data["status"] = "ok";
    $data["token"] = $token;

    return $response->withStatus(201)
        ->withHeader("Content-Type", "application/json")
        ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});

//Obtener todos los Usuarios por tipo
$app->get('/usuario/{tipo}', function(Request $request, Response $response){
   
    $tipo = $request->getAttribute('tipo');

   Usuario::TraerTodosLosUsuarios($tipo);
});


//Trae un usuario
$app->get('/usuario/id/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    Usuario::TraerUnUsuario( $id);
});

//Agrega un cliente
$app->post('/usuario', function(Request $request, Response $response){
    
    $usuario = new Usuario;


    $usuario->nomApell = $request->getParam('nomApell');
    $usuario->telefono = $request->getParam('telefono');
    $usuario->email = $request->getParam('email');
    $usuario->clave = $request->getParam('clave');
    $usuario->sexo = $request->getParam('sexo');
    $usuario->fecIngreso = $request->getParam('fecIngreso');
    $usuario->foto = $request->getParam('foto');
    $usuario->direccion = $request->getParam('direccion');
    $usuario->localidad = $request->getParam('localidad');
    $usuario->estado = $request->getParam('estado');
    $usuario->tipo = $request->getParam('tipo');
    

    Usuario::IngresarUsuario($usuario);
    
});

//Actualiza un cliente
$app->put('/usuario/{id}', function(Request $request, Response $response){

    $id = $request->getAttribute('id');

    $usuario = new Usuario;


    $usuario->nomApell = $request->getParam('nomApell');
    $usuario->telefono = $request->getParam('telefono');
    $usuario->email = $request->getParam('email');
    $usuario->clave = $request->getParam('clave');
    $usuario->sexo = $request->getParam('sexo');
    //$usuario->fecIngreso = $request->getParam('fecIngreso');
    //$usuario->foto = $request->getParam('foto');
    $usuario->direccion = $request->getParam('direccion');
    $usuario->localidad = $request->getParam('localidad');
    //$usuario->estado = $request->getParam('estado');
    $usuario->tipo = $request->getParam('tipo');
    

    Usuario::ModificaUsuario($usuario, $id);
    
});

//Borra un cliente
$app->delete('/usuario/{id}', function(Request $request, Response $response){

    $id = $request->getAttribute('id');
    
    Usuario::EliminaUsuario($id);
});

?>