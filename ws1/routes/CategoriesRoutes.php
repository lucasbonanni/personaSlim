<?php
require __DIR__ . '/../clases/Categories.php';

class CategoriesRoutes{
    
    public $app;

    public function __construct($app) {
       $this->app = $app;
    }
    
    public function createRoutes() {
      // other routes, you may divide routes to class methods
      $this->app->group('/categories/{id}', function () {

        $this->map(['GET', 'DELETE', 'PUT'], '', function ($request, $response, $args) {
            // Find, delete, patch or replace user identified by $args['id']
                $method = $request->getMethod();
                $id = $args['id'];
                switch ($method) {
                    case 'GET':
                        $product = Categories::GetCategoryById($id);
                        return $response->write(json_encode($product));
                        break;
                    case 'PUT':
                        $product = Categories::Update($id);
                        return $response->write(json_encode($product));
                        break;
                    case 'DELETE':
                        $product = Categories::Delete($id);
                        return $response->write(json_encode($product));
                        break;

                    default:
                        # code...
                        break;
                }
            });
        });

      $this->app->get('/categories[/]', function ($request, $response, $args) {
          $resultado = [];
          $resultado = Categories::GetAllCategories();
          $response->write(json_encode($resultado));

          return $response;
      });

      $this->app->post('/categories[/]', function ($request, $response, $args)
      {
          # code...
      });
  }
}



?>