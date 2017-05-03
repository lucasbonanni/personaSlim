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
//require 'clases/Product.php';
require 'routes/ProductRoutes.php';
require 'routes/BandRoutes.php';
require 'routes/CategoriesRoutes.php';
require 'routes/FileUploadRoute.php';
use \Firebase\JWT\JWT;

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */

 //Enable this setting to debug and show errors
    
 $config = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];


$app = new Slim\App($config);

/*  Default time zone */
date_default_timezone_set ("America/Argentina/Buenos_Aires");
/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */


$ProductRoutes = new ProductRoutes($app);
$ProductRoutes->createRoutes();

$BandRoutes = new BandRoutes($app);
$BandRoutes->createRoutes();

$categoriesRoutes = new CategoriesRoutes($app);
$categoriesRoutes->createRoutes();

$fileUploadRoute = new FileUploadRoute($app);
$fileUploadRoute->createRoutes();

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



/*
    Ejemplo para ordenar por parametro
*/
$app->get('/buscar', function ($request, $response, $args) {
    $resultado = [];
    $key = 'orderBy';
    $order = $request->getParam('orderBy');
    $ordena = explode(',',$order,0);
    $resultado = Producto::BuscarProductos($ordena);
    $response->write(json_encode($resultado));
    return $response;
});





$app->run();

?>
