<?php

require 'vendor/autoload.php';

use App\Controller\ArticleController;
use App\Core\Router;


//include 'templates/header.php';
//on initialise get s'il n'existe pas pour ne pas avoir d'erreurs
if(!array_key_exists('url',$_GET)) {
    $_GET['url'] ='';
}
//initialisation de notre router
$router = new Router($_GET['url']);


//dump($router,$_SERVER);
//on ajoute les routes disponibles dans l'application.
$router->add("test",[new ArticleController(),"index"],'GET');

$router->add("article/:id",function(){},'GET');

$router->add("accueil",function(){echo 'Meh, try better, this is the accueil';echo '<br>';echo'<a href="?url=/EXPLOSION"><button>EXPLOSION</button></a>';},'GET');
$router->add("apropos",function(){echo 'Meh, try better, this is the apropos';echo '<br>';echo'<a href="?url=/EXPLOSION"><button>EXPLOSION</button></a>';},'GET');
$router->add("contact",function(){echo 'Meh, try better, this is the contact';echo '<br>';echo'<a href="?url=/EXPLOSION"><button>EXPLOSION</button></a>';},'GET');
$router->add("explosion",function(){echo 'wups u ded';},'GET');
//on lance notre application
try {
    $router->run();
} catch (\App\Exception\RouterException $e) {
    echo $e->getMessage();
}


//include 'templates/footer.php';