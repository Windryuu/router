<?php

namespace App\Core;
use App\Exception\RouterException;
use App\Core\Route;

class Router
{
    private string $url; //Contient les infos du $_GET pour le router
    private array $routes = []; // contient l'ensemble des routes disponibles

    public function __construct($url)
    {
        $this->url = $url;
    }

    //Créer et ajoute une route dans le tableau de la propriété route du router.

    public function add($path,$callable,string $method):Route
    {
        $route = new Route($path,$callable);
        $this->routes[$method][] = $route;
        return $route;
    }

    //Lance l'application en essayant de matcher le paramètre url avec la propriété path d'un objet route.
    //Si le math est avéré alors la fonction de l'objet route est éxécutée.
    public function run(){
        foreach($this->routes[$_SERVER['REQUEST_METHOD']]as $route) {
            if($route->match($this->url)){
                return $route->call();
            }
        }
    throw new RouterException("Aucune route trouvée pour cette URL");
    }

}