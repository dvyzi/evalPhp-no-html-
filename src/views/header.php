<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/header.css">
    <title></title>
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/style.css">
    <script type="text/javascript" src="/js/jquery.js"></script>
  </head>
<body>

<header>

    <nav>
        <div class="contentImg">
            <a href="/"> <img class="logo" src="/img/0ccfebc22a1562d8798a98ed7b332ca4.jpg" alt="le logo de Cooker"></a>
        </div>
        <ul>
            <li>
                <a href='/recipes'>Recettes</a>
            </li>
            <?php
            if (isset($_SESSION["user"])) {
                echo '
                <li>
                <a href="/recipe/create">Créer une Recette</a>
                </li>
                ';
            } 
            ?>
            <li>
            <?php
        if (isset($_SESSION["user"])) {
            echo '
            <a href="/account" class="body__header__connect">
            <i class="fa-solid fa-user"></i>
            Mon compte
            </a>
            ';
        } else {
            echo '
            <a href="/login" class="body__header__connect">
            <i class="fa-solid fa-user"></i>
            Se connecter
            </a>
            ';
        }
        ?>
            </li>
        </ul>
    </nav>
</header>
<main>