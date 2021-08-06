<?php
namespace src\handlers;

use \core\Controller;
use \src\models\Post;
use \src\handlers\LoginHandler;
class PostHandler {

    public static function postCreate($post){
        $loggedUser = LoginHandler::checkLogin();
        $id_user = $loggedUser->id;
        $text = 'text';
        $createdat = date('Y-m-d H:i:s');
        Post::insert(['id_user' => $id_user,'type' => $text, 'createdat' => $createdat, 'body' => $post])
        ->execute();

    }

}