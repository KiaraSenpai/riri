<?php
$routes->set404Override('App\Errors::show404');
$routes->set404Override(static function () {
    echo view('404.json');
});

public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()){
            if ($exception instanceof ModelNotFoundException){
                return response([
                    'errors'=> 'Object Not Found'
                ], 404);
            }
            if ($exception instanceof NotFoundHttpException){
                return response([
                    'errors'=> 'Route Not Found'
                ], 404);
            }          
        }
        return parent::render($request, $exception);   
    }

?>
