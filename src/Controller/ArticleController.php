<?php

namespace App\Controller;

use App\Core\Abstract\AbstractController;
use App\Entity\User;

class ArticleController extends AbstractController {

    public function index () {
        
        $user = new User('john','je','ddd','dd');
        $persister = $this->getPersister();
        $persister->persist($user);

        $this->render('articles/index.html',[]);
    }
}