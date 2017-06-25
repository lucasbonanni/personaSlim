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
        $host = "http://".$_SERVER['HTTP_HOST'];
        $dirName = dirname($_SERVER['PHP_SELF']). '/..';
           if (isset($_FILES)){
                $imgs = array();
            	$file_ary = array();
            	$file_post = $_FILES['images'];
                $cnt = count($_FILES);
                $file_keys = array_keys($_FILES);
                $i=0;
               foreach($file_keys as $key) {
                   $keys = array_keys($_FILES[$key]);
                   foreach($keys as $filekey)
                   {
                       $file_ary[$i][$filekey] = $_FILES[$key][$filekey];
                   }
                   $i++;
               }
            for($i = 0 ; $i < $cnt ; $i++) {
                     $name = uniqid('img-'.date('Ymd').'-');
                       $tempPath = $file_ary[$i][ 'tmp_name' ];
                        $dir = realpath(__DIR__ . '/..');
                       $uploadPath = dirname( $dir ). DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $name . @'.' .pathinfo($file_ary[$i][ 'name' ], PATHINFO_EXTENSION);
                       if(move_uploaded_file($tempPath, $uploadPath) === true){
                        //    $imgs[] = array('url' =>@ $host . $dirName . '/uploads/' . $file_ary[$i][ 'name' ]);
                              $imgs[] = array(@ $host . $dirName . '/uploads/' . $name . @'.' .pathinfo($file_ary[$i][ 'name' ], PATHINFO_EXTENSION));
                        }
            }
               return $response->write(json_encode($imgs, JSON_UNESCAPED_SLASHES));
           }
            else{
                $newResponse = $response->withStatus(500);
                return $newResponse->write(json_encode(json_decode('{"Message":"Fail to upload"}')));
            }
        });
    }
    

}
?>