<?php
namespace Cooker\models;


/** Class CommentManager **/
class CommentManager
{
    private $connexion;

    public function __construct()
    {
        $this->connexion = new \PDO('mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8;', USER, PASSWORD);
        $this->connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /** Récupération de toutes les commentaires **/
    public function getAll()
    {
        //REQUETE POUR RECUPERER TOUT LES COMMENTAIRES
        $stmt = $this->connexion->prepare('SELECT * FROM comments');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Comment::class);
    }


    // Crée et stocker un nouveau commentaire en base de donnée
    public function create($comments)
    {
        $stmt = $this->connexion->prepare("INSERT INTO comments (comment_content, recipe_id, user_id) VALUES (?,?,?)");
        $stmt->execute(
            array(
                $comments->getComment_content(),
                $comments->getRecipe_id(),
                $comments->getUser_id()
            )
        );
        return $this->connexion->lastInsertId();
    }

    // Fonction pour recuperer un commentaire en fonction de son id
    public function getCommentById($comment_id)
    {
        $stmt = $this->connexion->prepare("SELECT * FROM comments WHERE comment_id = :comment_id");
        $stmt->execute([
            "comment_id" => $comment_id
        ]);
        return $stmt->fetchObject(Comment::class);
    }
}
