<?php
namespace Cooker\models;

/** Class UserManager **/
class UserManager
{
    private $connexion;

    public function __construct()
    {
        $this->connexion = new \PDO('mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8;', USER, PASSWORD);
        $this->connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }


    // Crée et stocker un nouveau user en base de donnée
    public function create($users)
    {
        $stmt = $this->connexion->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?,?,?)");
        $stmt->execute(
            array(
                htmlspecialchars($users->getUser_name()),
                $users->getUser_email(),
                $users->getUser_password()
            )
        );
        return $this->connexion->lastInsertId();
    }

    // Fonction pour recuperer un utilisateur en fonction de son email
    public function getUserByEmail($userEmail)
    {
        $query = $this->connexion->prepare("SELECT * FROM users WHERE user_email = :user_email");
        $query->execute([
            "user_email" => $userEmail
        ]);
        return $query->fetchObject(User::class);
    }

    // Fonction pour recuperer un utilisateur en fonction de son id
    public function getUserByUserId($userId)
    {
        $stmt = $this->connexion->prepare("SELECT * FROM users WHERE user_id = :user_id");
        $stmt->execute([
            "user_id" => $userId
        ]);
        return $stmt->fetchObject(User::class);
    }

    // Fonction pour sécurité du mot de passe
    public function connectUser($user_email, $user_password) {
        
        $user = $this->getUserByEmail($user_email);

        if(password_verify($user_password, $user->getUser_password())){
            return $user;
        }else{
            return false;
        }
    }
}
