<?php

namespace Cooker\models;

// CETTE CLASSE PERMET D'INSTANCIER DES OBJETS DE TYPE Recipe
class Recipe
{
    // ATTRIBUTS PRIVÉS DE LA CLASSE
    private $recipe_id;
    private $recipe_title;
    private $recipe_instructions_ingredients;
    private $recipe_picture;

    // MÉTHODES SETTER
    public function setRecipeId($recipe_id)
    {
        $this->recipe_id = $recipe_id;
    }

    public function setRecipeTitle($recipe_title)
    {
        $this->recipe_title = $recipe_title;
    }

    public function setRecipeInstructionsIngredients($recipe_instructions_ingredients)
    {
        $this->recipe_instructions_ingredients = $recipe_instructions_ingredients;
    }

    public function setRecipePicture($recipe_picture)
    {
        $this->recipe_picture = $recipe_picture;
    }

    // MÉTHODES GETTER
    public function getRecipeId()
    {
        return $this->recipe_id;
    }

    public function getRecipeTitle()
    {
        return $this->recipe_title;
    }

    public function getRecipeInstructionsIngredients()
    {
        return $this->recipe_instructions_ingredients;
    }

    public function getRecipePicture()
    {
        return $this->recipe_picture;
    }

    // MÉTHODE CONSTRUCTEUR
    public function __construct()
    {
    }
}
