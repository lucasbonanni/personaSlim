<?php

class FileUploadRoute{
    

    public $app;

    public function __construct($app) {
       $this->app = $app;
    }

    public function createRoutes(){
        $this->app->group('/images/{id}',function(){
            
            $this->map(['GET','DELETE','PUT'],'', function($request,$response,$args){
                
            });
        });
        
        $this->app->post('/images[/]', function($request, $response, $args){
           if (!empty($_FILES)){
               $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
               $uploadPath = dirname( __DIR__ . '/../../ ') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ];
               
               move_uploaded_file($tempPath, $uploadPath);
               
               return $response;

           }
            else{
                $newResponse = $response->withStatus(500);
                return $newResponse->write(json_encode(json_decode('{"Message":"Fail to upload"}')));
            }
        });
    }
}
?>