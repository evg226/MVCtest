<?php
class Router{

    static function start(){

        // Из строки запроса получаем controller,action
        $routes=explode("/",$_SERVER['REQUEST_URI']);
        $controllerName=empty($routes[1])?"main":$routes[1];
        $action=empty($routes[2])?"index":$routes[2];

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
                if($controllerName!="404")
                    $controller->writeHistory($controllerName,$action);
                $controller->$action();
            } else {
                Router::errorPage404("Метод $action контроллера $controllerName не найден");
            }
        } else {
            Router::errorPage404("Контроллер $controllerName не найден");
        }

    }

    static function errorPage404($message){
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
//        die ("11111");
        header('Location: '.$host.'404');
    }
}