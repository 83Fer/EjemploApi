<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


$app = new \Slim\App;

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});



//Obtener todos los clientes
$app->get('/clientes', function(Request $request, Response $response){
    
    $consulta = 'SELECT * FROM cliente';

    try{
        //Instanciamos Base de datos
        $db = new db();

        //conexion
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $clientes = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        //Exportar y mostrar en JSON
        echo json_encode($clientes);


    }catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


//Trae un cliente
$app->get('/clientes/{id}', function(Request $request, Response $response){

    $id = $request->getAttribute('id');
    
    $consulta = "SELECT * FROM cliente WHERE id=$id";

    try{
        //Instanciamos Base de datos
        $db = new db();

        //conexion
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $cliente = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        //Exportar y mostrar en JSON
        echo json_encode($cliente);


    }catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

//Agrega un cliente
$app->post('/clientes/alta', function(Request $request, Response $response){

    $nomApell = $request->getParam('nomApell');
    $telefono = $request->getParam('telefono');
    $email = $request->getParam('email');
    $sexo = $request->getParam('sexo');
    $fecIngreso = $request->getParam('fecIngreso');
    $foto = $request->getParam('foto');
    $direccion = $request->getParam('direccion');
    $localidad = $request->getParam('localidad');
    
    $consulta = "INSERT INTO cliente (nomApell, telefono, email, sexo, fecIngreso, foto,
                direccion, localidad) VALUES (:nomApell, :telefono, :email, :sexo, :fecIngreso,
                :foto, :direccion, :localidad)";

    try{
        //Instanciamos Base de datos
        $db = new db();

        //conexion
        $db = $db->conectar();
        $inserta = $db->prepare($consulta);
        $inserta->bindParam(':nomApell', $nomApell);
        $inserta->bindParam(':telefono', $telefono);
        $inserta->bindParam(':email', $email);
        $inserta->bindParam(':sexo', $sexo);
        $inserta->bindParam(':fecIngreso', $fecIngreso);
        $inserta->bindParam(':foto', $foto);
        $inserta->bindParam(':direccion', $direccion);
        $inserta->bindParam(':localidad', $localidad);
        $inserta->execute();

        echo '{"Notificacion": {"text": "Cliente agregado"}';
        

    }catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

//Actualiza un cliente
$app->put('/clientes/actualizar/{id}', function(Request $request, Response $response){

    $id = $request->getAttribute('id');

    $nomApell = $request->getParam('nomApell');
    $telefono = $request->getParam('telefono');
    $email = $request->getParam('email');
    $sexo = $request->getParam('sexo');
    $fecIngreso = $request->getParam('fecIngreso');
    $foto = $request->getParam('foto');
    $direccion = $request->getParam('direccion');
    $localidad = $request->getParam('localidad');
    
    $consulta = "UPDATE cliente SET 
                nomApell = :nomApell,
                telefono = :telefono,
                email = :email,
                sexo = :sexo,
                fecIngreso = :fecIngreso,
                foto = :foto,
                direccion = :direccion,
                localidad = :localidad   
                WHERE id = $id";
    try{
        //Instanciamos Base de datos
        $db = new db();

        //conexion
        $db = $db->conectar();
        $inserta = $db->prepare($consulta);
        $inserta->bindParam(':nomApell', $nomApell);
        $inserta->bindParam(':telefono', $telefono);
        $inserta->bindParam(':email', $email);
        $inserta->bindParam(':sexo', $sexo);
        $inserta->bindParam(':fecIngreso', $fecIngreso);
        $inserta->bindParam(':foto', $foto);
        $inserta->bindParam(':direccion', $direccion);
        $inserta->bindParam(':localidad', $localidad);
        $inserta->execute();

        echo '{"Notificacion": {"text": "Cliente actualizado"}';
        

    }catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

//Borra un cliente
$app->delete('/clientes/borrar/{id}', function(Request $request, Response $response){

    $id = $request->getAttribute('id');
    
    $consulta = "DELETE FROM cliente WHERE id=$id";

    try{
        //Instanciamos Base de datos
        $db = new db();

        //conexion
        $db = $db->conectar();
        $ejecutar = $db->prepare($consulta);
        $ejecutar->execute();
        $db = null;

        echo '{"Notificacion": {"text": "Cliente Borrado"}';

    }catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});