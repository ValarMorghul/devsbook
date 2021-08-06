<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;
class HomeController extends Controller {

    private $loggedUser;

    public function __construct(){
        $this->loggedUser = LoginHandler::checkLogin();
        if($this->loggedUser === false){
            echo "deu ruim";
        }

    }

    public function index() {
        if(!empty($_SESSION['token'])){
        $this->render('index' ,['loggedUser' => $this->loggedUser]);
        }else{$this->redirect('/login');}
    }
    public function perfil(){
        $this->render('perfil' ,['loggedUser' => $this->loggedUser]);
    }

}