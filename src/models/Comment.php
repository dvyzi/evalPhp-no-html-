<?php

namespace Cooker\models;

class Comment
{
    // DECLARATION DES ATTRIBUTS DE LA CLASSE
    private $comment_id;
    private $comment_content;
    private $recipe_id;
    private $user_id;

    // Méthode constructeur de la classe
    public function __construct()
    {
    }

    // **************METHODES ACCESSEURS (GETTERS AND SETTERS************)

    public function setComment_id($comment_id)
    {
        $this->comment_id = $comment_id;
    }

    public function getComment_id()
    {
        return $this->comment_id;
    }

    public function setComment_content($comment_content)
    {
        $this->comment_content = $comment_content;
    }

    public function getComment_content()
    {
        return $this->comment_content;
    }

    public function setRecipe_id($recipe_id)
    {
        $this->recipe_id = $recipe_id;
    }

    public function getRecipe_id()
    {
        return $this->recipe_id;
    }

    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }
}
