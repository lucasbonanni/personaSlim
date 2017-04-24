<?php
require __DIR__ . '/../clases/Band.php';

class BandRoutes
{
    public $app;
    
    public function __construct($app) {
       $this->app = $app;
    }
    
    public function createRoutes() {
      // other routes, you may divide routes to class methods
      $this->app->group('/bands/{id}', function () {

        $this->map(['GET', 'DELETE', 'PUT'], '', function ($request, $response, $args) {
            // Find, delete, patch or replace user identified by $args['id']
                $method = $request->getMethod();
                $id = $args['id'];
                switch ($method) {
                    case 'GET':
                        $product = band::GetBandById($id);
                        return $response->write(json_encode($product));
                        break;
                    case 'PUT':
                        $product = band::BandUpdate($id);
                        return $response->write(json_encode($product));
                        break;
                    case 'DELETE':
                        $product = band::BandDelete($id);
                        break;

                    default:
                        # code...
                        break;
                }
            });
        });

      $this->app->get('/bands[/]', function ($request, $response, $args) {
          $resultado = [];
          $resultado = band::GetAllBands();
          $response->write(json_encode($resultado));

          return $response;
      });

      $this->app->post('/bands[/]', function ($request, $response, $args)
      {
          # code...
      });
    }
}

?>