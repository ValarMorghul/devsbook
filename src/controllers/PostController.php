<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\PostHandler;
class PostController extends Controller {

    public function post(){
        $post = filter_input(INPUT_POST, 'post');
        if($post){
            PostHandler::postCreate($post);
        }else{echo "deu erro aqui no postcontroller";}
    }


}