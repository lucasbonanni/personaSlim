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
// require 'clases/Personas.php';
// require 'clases/Productos.php';
// require 'clases/Order.php';
//require 'clases/Product.php';
require 'routes/UserRoutes.php';
require 'routes/ShopRoutes.php';
require 'routes/OrderDetailRoutes.php';
require 'routes/OrdersRoutes.php';
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


 $UserRoutes = new UserRoutes($app);
$UserRoutes->createRoutes();

 $ShopRoutes = new ShopRoutes($app);
$ShopRoutes->createRoutes();

$OrderDetailRoutes = new OrderDetailRoutes($app);
$OrderDetailRoutes->createRoutes();

$OrdersRoutes = new OrdersRoutes($app);
$OrdersRoutes->createRoutes();

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
*//*
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', 'localhost')
            ->withHeader('Access-Control-Allow-Headers', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});*/

/*habilito el CORS para todos*/
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            // ->withHeader('Access-Control-Allow-Origin', 'http://localhost:9000')
            ->withHeader('Access-Control-Allow-Headers', 'Accept,data, Accept-CH, Accept-Charset, Accept-Datetime, Accept-Encoding, Accept-Ext, Accept-Features, Accept-Language, Accept-Params, Accept-Ranges, Access-Control-Allow-Credentials, Access-Control-Allow-Headers, Access-Control-Allow-Methods, Access-Control-Allow-Origin, Access-Control-Expose-Headers, Access-Control-Max-Age, Access-Control-Request-Headers, Access-Control-Request-Method, Age, Allow, Alternates, Authentication-Info, Authorization, C-Ext, C-Man, C-Opt, C-PEP, C-PEP-Info, CONNECT, Cache-Control, Compliance, Connection, Content-Base, Content-Disposition, Content-Encoding, Content-ID, Content-Language, Content-Length, Content-Location, Content-MD5, Content-Range, Content-Script-Type, Content-Security-Policy, Content-Style-Type, Content-Transfer-Encoding, Content-Type, Content-Version, Cookie, Cost, DAV, DELETE, DNT, DPR, Date, Default-Style, Delta-Base, Depth, Derived-From, Destination, Differential-ID, Digest, ETag, Expect, Expires, Ext, From, GET, GetProfile, HEAD, HTTP-date, Host, IM, If, If-Match, If-Modified-Since, If-None-Match, If-Range, If-Unmodified-Since, Keep-Alive, Label, Last-Event-ID, Last-Modified, Link, Location, Lock-Token, MIME-Version, Man, Max-Forwards, Media-Range, Message-ID, Meter, Negotiate, Non-Compliance, OPTION, OPTIONS, OWS, Opt, Optional, Ordering-Type, Origin, Overwrite, P3P, PEP, PICS-Label, POST, PUT, Pep-Info, Permanent, Position, Pragma, ProfileObject, Protocol, Protocol-Query, Protocol-Request, Proxy-Authenticate, Proxy-Authentication-Info, Proxy-Authorization, Proxy-Features, Proxy-Instruction, Public, RWS, Range, Referer, Refresh, Resolution-Hint, Resolver-Location, Retry-After, Safe, Sec-Websocket-Extensions, Sec-Websocket-Key, Sec-Websocket-Origin, Sec-Websocket-Protocol, Sec-Websocket-Version, Security-Scheme, Server, Set-Cookie, Set-Cookie2, SetProfile, SoapAction, Status, Status-URI, Strict-Transport-Security, SubOK, Subst, Surrogate-Capability, Surrogate-Control, TCN, TE, TRACE, Timeout, Title, Trailer, Transfer-Encoding, UA-Color, UA-Media, UA-Pixels, UA-Resolution, UA-Windowpixels, URI, Upgrade, User-Agent, Variant-Vary, Vary, Version, Via, Viewport-Width, WWW-Authenticate, Want-Digest, Warning, Width, X-Content-Duration, X-Content-Security-Policy, X-Content-Type-Options, X-CustomHeader, X-DNSPrefetch-Control, X-Forwarded-For, X-Forwarded-Port, X-Forwarded-Proto, X-Frame-Options, X-Modified, X-OTHER, X-PING, X-PINGOTHER, X-Powered-By, X-Requested-With')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});


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

    $personaDb = new User();

    //Se va a buscar a la base el usuario
    $personaDb = UserRoutes::Find($usuario);


    if($usuario->email == $personaDb->email){

        $ClaveDeEncriptacion = "miClaveDeEncriptacion";
        $token["email"] = $personaDb->email;
        // $token["apellido"] = $personaDb->apellido;
        $token["name"] = $personaDb->name;
        $token["profile"] = $personaDb->profile;
        $token["iat"] = time();
        $token["exp"] = time() +10000;



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
