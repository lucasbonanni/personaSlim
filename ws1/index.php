<?php
/*mb_internal_encoding("UTF-8");

var_dump(apache_get_version());*/

/**
 * Step 1: Require the Slim Framework using Composer's autoloader
 *
 * If you are not using Composer, you need to load Slim Framework with your own
 * PSR-4 autoloader.
 */
require 'vendor/autoload.php';
require 'clases/AccesoDatos.php';
require 'clases/Personas.php';
require 'clases/Productos.php';
use \Firebase\JWT\JWT;

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new Slim\App();

date_default_timezone_set ("America/Argentina/Buenos_Aires");
/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */
/**
* GET: Para consultar y leer recursos
* POST: Para crear recursos
* PUT: Para editar recursos
* DELETE: Para eliminar recursos
*
*  GET: Para consultar y leer recursos */

$app->get('/', function ($request, $response, $args) {
    $response->write("Welcome to Slim!");
    return $response;
});

/*
// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: *");
}
// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        //header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        //header("Access-Control-Allow-Headers: '*'");

}

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', 'localhost')
            ->withHeader('Access-Control-Allow-Headers', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});*/


/*
$app->map('/:x+', function($x) {
    http_response_code(200);
})->via('OPTIONS');
*/


/* POST: Para crear recursos */
$app->post('/login', function ($request, $response, $args) {
    $token = array();
    $ArrayConToken = array();

    $body = $request->getBody();
     
    $usuario = json_decode($body);
    
    $personaDb = new Persona();
    
    //Se va a buscar a la base el usuario
    $personaDb = Persona::BuscarPersona($usuario);
    
    
    if($usuario->mail == $personaDb->mail){

        $ClaveDeEncriptacion = "miClaveDeEncriptacion";
        $token["mail"] = $personaDb->mail;
        $token["apellido"] = $personaDb->apellido;
        $token["nombre"] = $personaDb->nombre;
        $token["perfil"] = $personaDb->perfil;
        $token["iat"] = time();
        $token["exp"] = time() +25;



        $jwt = JWT::encode($token, $ClaveDeEncriptacion);

        
        $ArrayConToken["MiTokenGeneradoEnPHP"] = $jwt;
    }
    else
    {
        $ArrayConToken["MiTokenGeneradoEnPHP"] = false;
        //$ArrayConToken["usuario"] = var_dump($usuario);
        //$ArrayConToken["persona"] = var_dump($personaDb);
    }

    //de decodifca del array al json
    $response = json_encode($ArrayConToken);

    //$response = var_dump($personaDb);
    return $response;
});

$app->get('/usuarios[/]', function ($request, $response, $args) {
    $resultado = [];
    $resultado = Persona::TraerTodasLasPersonas();
    $response->write(json_encode($resultado));
    
    return $response;
});

$app->get('/usuarios/{id}[/{name}]', function ($request, $response, $args) {
    $resultado = [];
    $resultado = Persona::TraerUnaPersona($args['id']);
    $response->write(json_encode($resultado));
    return $response;
});
/* POST: Para crear recursos */
$app->post('/usuarios', function ($request, $response, $args) {
    //se parsea a un array
    $body = $request->getParsedBody();

     //Se parsea de un array a un json y del json a un objecto   
    $persona = json_decode(json_encode($body));
    //$body = json_decode($args['id']);
    Persona::InsertarPersona($persona);
    //de decodifca del array al json
    $response ->write(json_encode($persona));
    //$response->write("Welcome to Slim!");
    //var_dump($persona->nombre);
    //var_dump();
    return $response;
});

// /* PUT: Para editar recursos */
$app->put('/usuarios[/{id}]', function ($request, $response, $args) {
    //$response->write("Welcome to Slim!");
    //var_dump($args);

    //se parsea a un array
    $body = $request->getParsedBody();

     //Se parsea de un array a un json y del json a un objecto   
    $persona = json_decode(json_encode($body));

    Persona::ModificarPersona($persona);
    //de decodifca del array al json
    $response ->write(json_encode($persona));
    return $response;
});

// /* DELETE: Para eliminar recursos */
$app->delete('/usuarios/{id}', function ($request, $response, $args) {
    Persona::BorrarPersona($args['id']);
    $response->write("borrar !", $args->id);
    return $response;
});
/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */

/* -----   Productos ------- */

$app->get('/productos[/]', function ($request, $response, $args) {
    $resultado = [];
    $resultado = Producto::TraerTodosLosProductos();
    $response->write(json_encode($resultado));
    
    return $response;
});

$app->get('/productos/{id}[/{name}]', function ($request, $response, $args) {
    $resultado = [];
    $resultado = Producto::TraerUnProducto($args['id']);
    $response->write(json_encode($resultado));
    return $response;
});


$app->post('/productos[/]', function ($request, $response, $args) {
    //se parsea a un array
    $body = $request->getParsedBody();

     //Se parsea de un array a un json y del json a un objecto   
    $producto = json_decode(json_encode($body));
    //$body = json_decode($args['id']);
    $resultado = [];
    $resultado = Producto::InsertarProducto($producto);
    //de decodifca del array al json
    $response->write(json_encode($resultado));
    //$response->write("Welcome to Slim!");
    //var_dump($persona->nombre);
    //var_dump();
    return $response;
});


$app->put('/productos[/]', function ($request, $response, $args) {
        //se parsea a un array
    $body = $request->getParsedBody();
    //echo var_dump($body);
     //Se parsea de un array a un json y del json a un objecto   
    $producto = json_decode(json_encode($body));
    //echo var_dump($producto);
    //$body = json_decode($args['id']);
    $resultado = [];
    $resultado = Producto::ModificarProducto($producto);
    //de decodifca del array al json
    //$response->write(json_encode($resultado));
    //$response->write("Welcome to Slim!");
    //var_dump($persona->nombre);
    //var_dump();
    $response->write(json_encode($resultado));
    return $response;
});

$app->delete('/productos/{id}', function ($request, $response, $args) {
    $resultado = [];
    $resultado = Producto::BorrarProducto($args['id']);
    $response->write(json_encode($resultado));
    return $response;
});





$app->run();

?>