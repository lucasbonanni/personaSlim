<?php
require __DIR__ . '/../clases/shop.php';
/**
 *  Product routes
 */
class ShopRoutes
{
    public $app;

    public function __construct($app) {
       $this->app = $app;
    }

    public function createRoutes() {
      // other routes, you may divide routes to class methods
      $this->app->group('/shops/{id}', function () {

        $this->map(['GET', 'DELETE', 'PUT'], '', function ($request, $response, $args) {
            // Find, delete, patch or replace user identified by $args['id']
                $method = $request->getMethod();
                switch ($method) {
                    case 'GET':
                        $id = $args['id'];
                        $shop = shop::GetShopById($id);
                        return $response->write(json_encode($shop,JSON_UNESCAPED_SLASHES));
                        break;
                    case 'PUT':
                        $id = $args['id'];
                        $body = $request->getParsedBody();
                        //Se parsea de un array a un json y del json a un objecto   
                        // var_dump($body);
                        $shop = json_decode(json_encode($body));
                        // var_dump($shop);
                        $shop = shop::ShopUpdate($id,$shop);
                        $body = $response->getBody();
                        $body->write(json_encode($shop,JSON_UNESCAPED_SLASHES));
                        return $response;
                        break;
                    case 'DELETE':
                        $id = $args['id'];
                        shop::ShopDelete($id);
                        return $response;
                        break;

                    default:
                        # code...
                        break;
                }
            });
        });

      $this->app->get('/shops[/]', function ($request, $response, $args) {
          $resultado = [];
          $resultado = shop::GetAllShops();
          $response->write(json_encode($resultado,JSON_UNESCAPED_SLASHES));

          return $response;
      });

      $this->app->post('/shops[/]', function ($request, $response, $args)
      {
          $body = $request->getParsedBody();
            //Se parsea de un array a un json y del json a un objecto   
            // var_dump($body);
            $shop = json_decode(json_encode($body));
            // var_dump($shop);
            $shop = shop::ShopCreate($shop);
            $body = $response->getBody();
            $body->write(json_encode($shop,JSON_UNESCAPED_SLASHES));
            return $response;
      });
  }

}



 ?>
