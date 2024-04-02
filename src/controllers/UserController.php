<?php

namespace Cooker\controllers;


use Cooker\models\UserManager;
use Cooker\models\User;




// CETTE CLASSE REGROUPE TOUTES LES FONCTIONALITES CONCERNANT UN OBJET DE TYPE User
class UserController
{
    public function __construct()
    {
    }

    /** HomePage **/
    public function showLogin() {
        require VIEWS . "login.php";
    }

    public function showSignup() {
        require VIEWS . "signup.php";
    }

    public function showAccount() {
        require VIEWS . "account.php";
    }


    // // Fonction pour l'inscription de l'utilisateur
    function signup() {
        $userNameValue = $_POST["inputName"];
        $userEmailValue = $_POST["inputEmail"];
        $userPasswordValue = $_POST["inputPassword"];
        $userPasswordCorrespondanceValue = $_POST["inputRetypePassword"];
        $error = false;

        if(strlen($userNameValue) > 50) {
            $userName = "Le prénom ne doit pas dépasser 50 caractères";
            $error = true;
        }

        if(!filter_var($userEmailValue, FILTER_VALIDATE_EMAIL)){
            $userEmail = "L'adresse mail n'est pas valide";
            $error = true;
        }

        if(strlen($userPasswordValue) < 8) {
            $userPassword = "Le mot de passe doit contenir au moins 8 caractères";
            $error = true;
        }

        if(!preg_match("#[0-9]+#", $userPasswordValue)) {
            $userPassword = "Le mot de passe doit contenir au moins un chiffre";
            $error = true;
        }

        if(!preg_match("#[a-zA-Z]+#", $userPasswordValue)) {
            $userPassword = "Le mot de passe doit contenir au moins une lettre";
            $error = true;
        }

        if(!preg_match("#[\W]+#", $userPasswordValue)) {
            $userPassword = "Le mot de passe doit contenir au moins un caractère spécial (ex: !@#$%^&*)";
            $error = true;
        }

        if(!preg_match("#[A-Z]+#", $userPasswordValue)) {
            $userPassword = "Le mot de passe doit contenir au moins une majuscule";
            $error = true;
        }


        if($userPasswordValue != $userPasswordCorrespondanceValue) {
            $userPasswordCorrespondance = "Les mots de passe ne correspondent pas";
            $error = true;
        }

        if(strlen($_POST["inputName"]) === 0 || strlen($_POST["inputSurname"]) === 0 || strlen($_POST["inputEmail"]) === 0 || strlen($_POST["inputPassword"]) === 0 || strlen($_POST["inputRetypePassword"]) === 0) {
            $signupError = true;
            $error = true;
        }

        if($error) {
            require VIEWS . "signup.php";
            return;
        }
        $user = new User();
        $user->setUser_name($_POST["inputName"]);
        $user->setUser_email($_POST["inputEmail"]);
        $user->setUser_password(password_hash($_POST["inputPassword"], PASSWORD_DEFAULT));
        $userManager = new UserManager();
        if($userManager->getUserByEmail($user->getUser_email())) {
            $userMail = "L'adresse mail est déjà utilisée";
            require VIEWS . "signup.php";
            return;
        }
        $getUserId = $userManager->create($user);
        $user->setSession($getUserId);
        header("Location: /");
    }

    // Fonction pour la connexion de l'utilisateur
    function login(){
        $userManager = new UserManager();
        $user = $userManager->connectUser($_POST["inputEmail"], $_POST["inputPassword"]);
        if($user === false) {
            $userEmailValue = $_POST["inputEmail"];
            $signinError = true;
            require VIEWS . "login.php";
            return;
        }else{
            $user->setSession($user->getUser_id());
            header("Location: /");
        }
    }
    
    // Fonction pour la deconnexion de l'utilisateur
    function logout() {
        session_destroy();
        header("Location: /");
    }
}
