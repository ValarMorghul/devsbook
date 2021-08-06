<?php
namespace src\controllers;

use \core\Controller;
use \src\models\User;
use \src\handlers\LoginHandler;

class UserController extends Controller {

    public function login() {
        $this->render('login');
    }
    public function loginAction() {
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        if($email && $password){
            $data = LoginHandler::verifyLogin($email, $password);
            if($data === true){
                $this->redirect('/');
            }
            else{echo "Erro no loginAction";}
        }else{echo "Email e/ou password estão incorretos.";}
    }

    public function cadastro() {
        $this->render('cadastro');
    }

    public function cadastroAction() {
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $birthdate = filter_input(INPUT_POST, 'birthdate');
        if($name && $email && $password && $birthdate){
            $data = LoginHandler::verifyEmail($email);
            if($data === false){
                LoginHandler::create($name,$email,$password,$birthdate);
                $this->redirect('/');
            }else{echo "Conta existente";}
        } else{echo "Dado não preenchido";}
    }
    public function logout() {
        $data = User::select()->where(['token' => $_SESSION['token']])->one();
        if($data){
            $token = '';
            User::update()->set(['token' => $token])->where(['email' => $data['email']])->execute();
            $_SESSION['token'] = $token;
            $this->redirect('/login');
        }
    }

}