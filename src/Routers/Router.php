<?php
namespace Student\Routers;

class Router
{
    
    function __construct()
    {
       
    }
    public function getController($services)
    {
        $controllerName = $this->getControllerName();
        return new $controllerName($services);
    }

    public function getControllerName()
    {   
        if ( preg_match('/list/', $_SERVER['REQUEST_URI']) ) {
            $controllerName = 'ListController';
        }    
        elseif ( preg_match('/index/', $_SERVER['REQUEST_URI']) ) {
            $controllerName = 'FormController';
        }
        
        return $this->addNameSpace($controllerName);
    }

    public function getAction()
    {
        if ( ( preg_match('/index/', $_SERVER['REQUEST_URI'])) & ( preg_match( '/registred/', $_SERVER['REQUEST_URI']) ) ) {
            $actionName = 'register';
        }
        elseif ( preg_match('/list/', $_SERVER['REQUEST_URI']) ) {
            $actionName = 'sort';
        }
        elseif ( ( preg_match('/index/', $_SERVER['REQUEST_URI'])) & ( !preg_match('/registred/', $_SERVER['REQUEST_URI']) ) ) {
            $actionName = 'register';
        }

        return $actionName;
    }

    public function addNameSpace($controllerName)
    {
        return 'Student\Controllers\\'.$controllerName;
    }
    public function get404()
    {
        header('HTTP/1.0 404 Not Found');
        echo "<h1>404 Not Found</h1>";
        echo "The page that you have requested could not be found.";
    }    
}