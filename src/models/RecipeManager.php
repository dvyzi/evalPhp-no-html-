<?php
namespace Cooker\models;


/** Class RecipeManager **/
class RecipeManager
{
    private $connexion;

    public function __construct()
    {
        $this->connexion = new \PDO('mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8;', USER, PASSWORD);
        $this->connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /** Récupération de toutes les recettes **/
    public function getAll()
    {
        //REQUETE POUR RECUPERER TOUTES LES RECETTES
        $stmt = $this->connexion->prepare('SELECT * FROM recipes');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Recipe::class);
    }

    // Crée et stocker une nouvelle recette en base de donnée
    public function create($recipes)
    {
        $stmt = $this->connexion->prepare("INSERT INTO recipes (recipe_title, recipe_instructions_ingredients, recipe_picture) VALUES (?,?,?)");
        $stmt->execute(
            array(
                htmlspecialchars($recipes->getRecipeTitle()),
                $recipes->getRecipeInstructionsIngredients(),
                $recipes->getRecipePicture()
            )
        );
        return $this->connexion->lastInsertId();
    }

    // Fonction pour recuperer une recette en fonction de son id
    public function getRecipeById($recipeId)
    {
        $stmt = $this->connexion->prepare("SELECT * FROM recipes WHERE recipe_id = :recipe_id");
        $stmt->execute([
            "recipe_id" => $recipeId
        ]);
        return $stmt->fetchObject(Recipe::class);
    }
}
