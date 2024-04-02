<?php
$cssPath = "/css/login.css";
include_once VIEWS . "header.php";
if (isset($_SESSION["user"])) {
    header("Location: /");
}
?>

<main>
    <section class="body__main__login">
        <form action="/login" method="post" class="body__main__login__form">
            <?php
            if(isset($signinError)) echo '
            <div class="body__main__login__form__error">
                L\'adresse e-mail ou le mot de passe invalide
            </div>
            '
            ?>
            <div class="body__main__login__form__email">
                <label for="inputEmailId">Adresse e-mail</label>
                <input type="email" id="inputEmailId" name="inputEmail" maxlength="255" value="<?php if (isset($userEmailValue)) echo $userEmailValue ?>">
            </div>

            <div class="body__main__login__form__password">
                <label for="inputPasswordId">Mot de passe</label>
                <input type="password" id="inputPasswordId" name="inputPassword" maxlength="25">
            </div>
            
            <input type="submit" value="Me connecter">
        </form>
        <a href="/signup" class="body__main__login__anyAccount">Vous avez pas de compte ? Inscrivez vous</a>
    </section>
</main>

<?php include_once VIEWS . "footer.php" ?>