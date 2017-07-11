<?php
require __DIR__ . '/../clases/User.php';
/**
 *  Product routes
 */
class UserRoutes
{
    public $app;

    public function __construct($app) {
       $this->app = $app;
    }

    public function createRoutes() {
      // other routes, you may divide routes to class methods
      $this->app->group('/users/{id}', function () {

        $this->map(['GET', 'DELETE', 'PUT'], '', function ($request, $response, $args) {
            // Find, delete, patch or replace user identified by $args['id']
                $method = $request->getMethod();
                switch ($method) {
                    case 'GET':
                        $id = $args['id'];
                        $product = User::GetUserById($id);
                        return $response->write(json_encode($product,JSON_UNESCAPED_SLASHES));
                        break;
                    case 'PUT':
                        $id = $args['id'];
                        $body = $request->getParsedBody();
                        //Se parsea de un array a un json y del json a un objecto   
                        // var_dump($body);
                        $product = json_decode(json_encode($body));
                        // var_dump($product);
                        $product = User::UserUpdate($id,$product);
                        $body = $response->getBody();
                        $body->write(json_encode($product,JSON_UNESCAPED_SLASHES));
                        return $response;
                        break;
                    case 'DELETE':
                        $id = $args['id'];
                        User::UserDelete($id);
                        return $response;
                        break;

                    default:
                        # code...
                        break;
                }
            });
        });

      $this->app->get('/users/profile/{profile}', function ($request, $response, $args) {
          $resultado = [];
          $profile = $args['profile'];
          $resultado = User::GetAllUsers($profile);
          $response->write(json_encode($resultado,JSON_UNESCAPED_SLASHES));

          return $response;
      });

      $this->app->post('/users[/]', function ($request, $response, $args)
      {
          $body = $request->getParsedBody();
            //Se parsea de un array a un json y del json a un objecto   
            // var_dump($body);
            $product = json_decode(json_encode($body));
            // var_dump($product);
            $product = User::UserCreate($product);
            $body = $response->getBody();
            $body->write(json_encode($product,JSON_UNESCAPED_SLASHES));
            return $response;
      });
  }

}



 ?>
