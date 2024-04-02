<?php
namespace Cooker\models;

// CETTE CLASSE PERMET D'INSTANCIER DES OBJETS DE TYPE User
class User
{
    // DECLARATION DES ATTRIBUTS DE LA CLASSE
    private $user_id;
    private $user_name;
    private $user_email;
    private $user_password;

    // Méthode constructeur de la classe
    public function __construct()
    {
    } 

    // **************METHODES ACCESSEURS (GETTERS AND SETTERS************)

    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }

    public function setUser_name($user_name)
    {
        $this->user_name = $user_name;
    }

    public function getUser_name()
    {
        return $this->user_name;
    }

    public function setUser_email($user_email)
    {
        $this->user_email = $user_email;
    }

    public function getUser_email()
    {
        return $this->user_email;
    }

    public function setUser_password($user_password)
    {
        $this->user_password = $user_password;
    }

    public function getUser_password()
    {
        return $this->user_password;
    }

    function setSession($userId)
    {
        //return un object client en session
        $_SESSION["user"] = [
            "userId" => $userId,
            "userName" => $this->getUser_name(),
            "userEmail" => $this->getUser_email(),
        ];
    }
}
