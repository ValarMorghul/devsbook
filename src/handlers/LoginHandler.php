<?php
namespace src\handlers;

use \src\models\User;

class LoginHandler {

    public static function verifyEmail($email) {
        $data = User::select()->where(['email' => $email])->one();
        if($data > 0){
            return true;
        }else{
            return false;
        }
    }
    public static function create($name,$email,$password,$birthdate){
                User::insert(['name' => $name,'email' => $email,'password' => $password, 'birthdate' => $birthdate])
                ->execute();
    }
    public static function verifyLogin($email, $password){
        $data = User::select()->where(['email' => $email, 'password' => $password])->one();
        if($data > 0){
            $token = md5(time().rand(0, 1000));
            User::update()->set(['token' => $token])->where(['email' => $email])->execute();
            $_SESSION['token'] = $token;
            return true;
        }
        else{return false;}
    }
    public static function checkLogin(){
        $data = User::select()->where(['token' => $_SESSION['token']])->one();
        if ($data) {
             $loggedUser = new User();
             $loggedUser->id = $data['id'];
             $loggedUser->email = $data['email'];
             $loggedUser->name = $data['name'];
             $loggedUser->avatar = $data['avatar'];
             $loggedUser->cover = $data['cover'];

             return $loggedUser;
         }else{echo "erro no checkLogin";} 
    }

}