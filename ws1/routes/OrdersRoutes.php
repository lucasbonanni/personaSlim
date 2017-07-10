<?php
require __DIR__ . '/../clases/Order.php';
/**
 *  Product routes
 */
class OrdersRoutes
{
    public $app;

    public function __construct($app) {
       $this->app = $app;
    }

    public function createRoutes() {
      // other routes, you may divide routes to class methods
      $this->app->group('/orders/{id}', function () {

        $this->map(['GET', 'DELETE', 'PUT'], '', function ($request, $response, $args) {
            // Find, delete, patch or replace user identified by $args['id']
                $method = $request->getMethod();
                switch ($method) {
                    case 'GET':
                        $id = $args['id'];
                        $product = order::GetProductById($id);
                        return $response->write(json_encode($product,JSON_UNESCAPED_SLASHES));
                        break;
                    case 'PUT':
                        $id = $args['id'];
                        $body = $request->getParsedBody();
                        //Se parsea de un array a un json y del json a un objecto   
                        // var_dump($body);
                        $product = json_decode(json_encode($body));
                        // var_dump($product);
                        $product = order::ProductUpdate($id,$product);
                        $body = $response->getBody();
                        $body->write(json_encode($product,JSON_UNESCAPED_SLASHES));
                        return $response;
                        break;
                    case 'DELETE':
                        $id = $args['id'];
                        order::ProductDelete($id);
                        return $response;
                        break;

                    default:
                        # code...
                        break;
                }
            });
        });

      $this->app->get('/orders[/]', function ($request, $response, $args) {
          $resultado = [];
          $resultado = order::GetAllProducts();
          $response->write(json_encode($resultado,JSON_UNESCAPED_SLASHES));

          return $response;
      });

      $this->app->post('/orders[/]', function ($request, $response, $args)
      {
          $body = $request->getParsedBody();
            //Se parsea de un array a un json y del json a un objecto   
            // var_dump($body);
            $product = json_decode(json_encode($body));
            // var_dump($product);
            $product = order::ProductCreate($product);
            $body = $response->getBody();
            $body->write(json_encode($product,JSON_UNESCAPED_SLASHES));
            return $response;
      });
  }

}



 ?>
