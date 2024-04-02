<?php
namespace Cooker\controllers;

use Cooker\models\Comment;
use Cooker\models\CommentManager;
use Cooker\controllers\RecipeController;

// CETTE CLASSE REGROUPE TOUTES LES FONCTIONALITES CONCERNANT LES COMMENTAIRES
class CommentController
{
    //on déclare un attribut de type CommentManager
    private $CommentManager;

    //Méthode constructeur de la classe
    public function __construct()
    {
        $this->CommentManager = new CommentManager();
    }

    public function subComment(){

        //On met les informations du formulaire en SESSION
        $_SESSION['POST'] = $_POST;

        //On instancie un objet Comment en appelant le constructeur
        $comment = new Comment();

        //On set les attributs de l'objet Comment avec les valeurs postées par le formulaire
        $comment->setComment_content($_POST['recipeComment']);
        $comment->setUser_id($_POST['userId']);
        $comment->setRecipe_id($_POST['recipe_id']);
        
        //Cette fonction renvoie le dernier Id inséré
        $commentId = $this->CommentManager->create($comment);

        //On set l'id du nouveau commentaire et on l'affiche
        $comment = $this->CommentManager->getCommentById($commentId);

        (new RecipeController())->showRecipe($_POST['recipe_id']);
    }
}