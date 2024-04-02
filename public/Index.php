<?php
session_start();

require '../src/config/Config.php';
require '../vendor/autoload.php';
//On instancie un Router en utilisant la classe Router.php
$router = new Cooker\Router($_SERVER['REQUEST_URI']);

//Route appelée pour arriver à la Home page
$router->get('/', "MainController@index");


//ROUTES EN POST
//*******************************

// Route pour voir les differentes recettes
$router->get('/recipes', "RecipeController@getAll");
// Voir les details d'une recette 
$router->get('/recipe/detail/:recipe_id', "RecipeController@showRecipe");
// Submit commentaire d'une recette 
$router->post('/recipe/comment', "CommentController@subComment");


// Root recette

//Route pour stocker une nouvelle recette dans la base de données
$router->get('/recipe/create', "RecipeController@showCreate");
$router->post('/recipe/create', "RecipeController@create");


// Root client

$router->get('/account', "UserController@showAccount");
// Route deconnection
$router->get('/logout', "UserController@logout");
// Root connexion
$router->get('/login', "UserController@showLogin");
$router->post('/login', "UserController@login");
// Route inscription
$router->get('/signup', "UserController@showSignup");
$router->post('/signup', "UserController@signup");

$router->run();
