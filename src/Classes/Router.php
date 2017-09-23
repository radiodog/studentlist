<?php
namespace Student\Classes;

class Router
{
    
    function __construct($url)
    {
    
        $methods = explode('/', $url['REQUEST_URI']);
        if ((!empty($methods[1])) & ($methods[1]=='index.php')){
            $controllerName = 'MainController';
        }
        if (!empty($methods[2])) {
            $actionName = $methods[2];
        }
        if (($methods[1]=='index.php') & empty($methods[2])){
        	$controllerName = 'MainController';
        	$actionName = 'register';
        }
        if (($methods[1]=='index.php') & (array_key_exists('2',$methods))){
            $submethods = explode('?', $methods[2]);
            if ($submethods[0]=='list'){
            $controllerName = 'PageController';
            $actionName = 'sort';
            }
        }
        $controllerName = 'Student\Classes'."\\".$controllerName;
        if (class_exists($controllerName) & method_exists($controllerName, $actionName)){
        $controller = new $controllerName();
        $controller->$actionName();
        }
        else{
            $this->get404();
        }
    }
    public function get404()
    {
        header('HTTP/1.0 404 Not Found');
        echo "<h1>404 Not Found</h1>";
        echo "The page that you have requested could not be found.";
        exit(); 
    }    
}