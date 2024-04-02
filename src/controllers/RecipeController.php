<?php

namespace Cooker\controllers;

use Cooker\models\CommentManager;
use Cooker\models\Recipe;
use Cooker\models\RecipeManager;
use Cooker\models\UserManager;


// CETTE CLASSE REGROUPE TOUTES LES FONCTIONALITES CONCERNANT LES RECETTES
class RecipeController
{
    //on déclare un attribut de type RecipeManager
    private $RecipeManager;

    //Méthode constructeur de la classe
    public function __construct()
    {
        $this->RecipeManager = new RecipeManager();
    }

    public function showCreate()
    {
        if (!isset($_SESSION["user"])) require VIEWS . "404.php";
        else require VIEWS . "FormCreateRecipe.php";
    }


    public function create()
    {

        //On met les informations du formulaire en SESSION
        $_SESSION['POST'] = $_POST;

        //On instancie un objet Recipe en appelant le constructeur
        $recipe = new Recipe();


        //On set les attributs de l'objet Recipe avec les valeurs postées par le formulaire
        $recipe->setRecipeTitle(htmlspecialchars($_POST['recipeTitle']));
        $recipe->setRecipeInstructionsIngredients(htmlspecialchars($_POST['recipeDescription']));
        $recipe->setRecipePicture('default.png');


        if (strlen($_POST["recipeDescription"]) === 0) require VIEWS . 'FormCreateRecipe.php';

        //téléchargement de l'image dans le dossier assets/img/
        if ($_FILES['recipeImage']['error'] !== UPLOAD_ERR_NO_FILE) {
            $uploaddir = 'img/';
            $uploadfile = $uploaddir . basename($_FILES['recipeImage']['name']);
            move_uploaded_file($_FILES['recipeImage']['tmp_name'], $uploadfile);
            $recipe->setRecipePicture($_FILES['recipeImage']['name']);
        }

        //On appelle la fonction du Manager qui va insérer la recette en base de données

        //Cette fonction renvoie le dernier Id inséré
        $recipeId = $this->RecipeManager->create($recipe);

        //On set l'id da la nouvelle recette et on l'affiche
        $recipe = $this->RecipeManager->getRecipeById($recipeId);
        require VIEWS . 'Layout.php';
    }

    //cette fonction renvoie la liste de toutes les recettes
    public function getAll()
    {
        $allRecipes = $this->RecipeManager->getAll();
        if (count($allRecipes) > 0) {
            $contenu = "";
            foreach ($allRecipes as $recipe) {
                $idOfRecipe = $recipe->getRecipeId();
                $nameOfRecipe = $recipe->getRecipeTitle();
                $descriptionOfRecipe = $recipe->getRecipeInstructionsIngredients();
                $pictureOfRecipe = $recipe->getRecipePicture();
                $contenu .= "

                <a href='recipe/detail/$idOfRecipe'> 
                <div id='cardRecipe'>
                <p>Nom de la recette : <br> $nameOfRecipe</p>
                <p>Photo de la recette : <br> <img src='/img/$pictureOfRecipe'></p>
                </div>
                </a>
                ";
            }
            require VIEWS . 'Layout.php';
        } else echo "Pas de recette";
    }


    //  Cette fonction affiche la recette en fonction de son id
    public function showRecipe($recipe_id)
    {
        $userManager = new UserManager();
        $getRecipe = $this->RecipeManager->getRecipeById($recipe_id);
        $idOfRecipe = $getRecipe->getRecipeId();
        $nameOfRecipe = $getRecipe->getRecipeTitle();
        $descriptionOfRecipe = $getRecipe->getRecipeInstructionsIngredients();
        $pictureOfRecipe = $getRecipe->getRecipePicture();
        if (!isset($getRecipe)) return require VIEWS . "404.php";
        $userId = $_SESSION["user"]["userId"];
        $contenu = "
        <div id='cardRecipeDetail'>
        <p>Nom de la recette : <br> $nameOfRecipe</p>
        <p>Photo de la recette : <br> <img src='/img/$pictureOfRecipe'></p>
        <p>Description de la recette : <br> $descriptionOfRecipe</p>
        </div>
        ";
        if (isset($_SESSION["user"])) $contenu .= "
            <form action='/recipe/comment' method='post' id='formCreate' enctype='multipart/form-data'>
            <div class='formulaire'>
                 <div class='normal'>
                    <label for='recipeComment'>Laissez un commentaire :</label>
                    <textarea name='recipeComment' id='recipeCommentId' cols='0' rows='3' value=''></textarea>
                    <input type='hidden' name='userId' value='$userId'>
                    <input type='hidden' name='recipe_id' value='$recipe_id'>
                    <input type='submit' name='submitComment' id='submit'>
                </div>
        </form>
        <p>Commentaires: </p>
        
        ";

        $CommentManager = new CommentManager();
        $allComments = $CommentManager->getAll();
        if (count($allComments) > 0) {
            $allComments = array_filter($allComments, function ($item) use ($idOfRecipe) {
                return $item->getRecipe_id() === $idOfRecipe;
            });
            foreach ($allComments as $comments) {
                $getUserName = ($userManager->getUserByUserId($comments->getUser_id()))->getUser_name();
                $contentOfComment = $comments->getComment_content();
                $contenu .= "
        <p>$getUserName : $contentOfComment</p>
        ";
            }
        }
        require VIEWS . 'Layout.php';
    }
}
