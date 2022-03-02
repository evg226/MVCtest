<?php
class Router{

    static function start(){

        // Из строки запроса получаем controller,action
        $routes=explode("/",$_SERVER['REQUEST_URI']);
        $start=1;
        if ($routes[1]==="api") {
            $asJSON=true;
            $start=2;
        }
        $controllerName=empty($routes[$start])?"main":$routes[$start];
        $action=empty($routes[$start+1])?"index":$routes[$start+1];

        //Загружаем model и controller
        $modelPath="./engine/models/".strtolower($controllerName).".php";
        $controllerPath="./engine/controllers/".strtolower($controllerName).".php";

        if(file_exists($modelPath)) {
            $modelClass="Modal". ucfirst($controllerName);
            include $modelPath;
        };

        if(file_exists($controllerPath)) {
            include $controllerPath;
            //создаем запускаем контроллер
            $controllerClass="Controller". ucfirst($controllerName);
            $controller=new $controllerClass;

            if (method_exists($controller,$action)){
                if($controllerName!="404") $controller->writeHistory($controllerName,$action);
                    $data=$controller->$action();
                    if (isset($asJSON)) {
                        echo json_encode($data);
                    } else {
                        $controller->view->render($data);
                    }

            } else {
                Router::errorPage404("Метод $action контроллера $controllerName не найден");
            }
        } else {
            Router::errorPage404("Контроллер $controllerName не найден");
        }
    }

    static function errorPage404($message){
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
//        header('HTTP/1.1 404 Not Found');
//        header("Status: 404 Not Found");
        header('Location: '.$host.'404');
    }
}