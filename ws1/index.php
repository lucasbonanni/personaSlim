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

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new Slim\App();

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

$app->get('/usuarios[/]', function ($request, $response, $args) {
    $resultado = [];
    $resultado = Persona::TraerTodasLasPersonas();
    $response->write(json_encode($resultado));
    
    return $response;
});

$app->get('/usuario/{id}[/{name}]', function ($request, $response, $args) {
    $resultado = [];
    $resultado = Persona::TraerUnaPersona($args['id']);
    $response->write(json_encode($resultado));
    return $response;
});
/* POST: Para crear recursos */
$app->post('/usuario/{id}', function ($request, $response, $args) {
    //se parsea a un array
    $body = $request->getParsedBody();

     //Se parsea de un array a un json y del json a un objecto   
    $persona = json_decode(json_encode($body));
    //$body = json_decode($args['id']);

    //de decodifca del array al json
    $response = json_encode($body);
    //$response->write("Welcome to Slim!");
    var_dump($persona->nombre);
    //var_dump();
    return $response;
});

// /* PUT: Para editar recursos */
$app->put('/usuario/{id}', function ($request, $response, $args) {
    $response->write("Welcome to Slim!");
    var_dump($args);
    return $response;
});

// /* DELETE: Para eliminar recursos */
$app->delete('/usuario/{id}', function ($request, $response, $args) {
    $response->write("borrar !", $args->id);
    var_dump($args);
    return $response;
});
/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();

?>