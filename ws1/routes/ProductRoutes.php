<?php
require __DIR__ . '/../clases/Product.php';
/**
 *  Product routes
 */
class ProductRoutes
{
    public $app;

    public function __construct($app) {
       $this->app = $app;
    }

    public function createRoutes() {
      // other routes, you may divide routes to class methods
      $this->app->group('/products/{id}', function () {

        $this->map(['GET', 'DELETE', 'PUT'], '', function ($request, $response, $args) {
            // Find, delete, patch or replace user identified by $args['id']
                $method = $request->getMethod();
                switch ($method) {
                    case 'GET':
                        $id = $args['id'];
                        $product = product::GetProductById($id);
                        return $response->write(json_encode($product));
                        break;
                    case 'PUT':
                        # code...
                        break;
                    case 'DELETE':
                        # code...
                        break;

                    default:
                        # code...
                        break;
                }
            });
        });

      $this->app->get('/products[/]', function ($request, $response, $args) {
          $resultado = [];
          $resultado = product::GetAllProducts();
          $response->write(json_encode($resultado));

          return $response;
      });

      $this->app->post('/products[/]', function ($request, $response, $args)
      {
          # code...
      });
  }

}



 ?>
