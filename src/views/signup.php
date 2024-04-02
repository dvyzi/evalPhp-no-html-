<?php
$cssPath = "/css/signup.css";
include_once VIEWS . "header.php";
if (isset($_SESSION["user"])) {
    header("Location: /");
}
?>

<main>
    <section class="body__main__signup">
        <form action="/signup" method="post" class="body__main__signup__form">
            <div class="body__main__signup__form__name">
                <label for="inputNameId">Prénom</label>
                <input required type="text" id="inputNameId" name="inputName" maxlength="50" value="<?php if (isset($userNameValue)) echo $userNameValue ?>">
                <small><?php if (isset($userName)) echo $userName ?></small>
            </div>

            <div class="body__main__signup__form__surname">
                <label for="inputSurnameId">Nom</label>
                <input required type="text" id="inputSurnameId" name="inputSurname" maxlength="50" value="<?php if (isset($userSurnameValue)) echo $userSurnameValue ?>">
                <small><?php if (isset($userSurname)) echo $userSurname ?></small>
            </div>

            <div class="body__main__signup__form__email">
                <label for="inputEmailId">Adresse e-mail</label>
                <input required type="email" id="inputEmailId" name="inputEmail" maxlength="255" value="<?php if (isset($userEmailValue)) echo $userEmailValue ?>">
                <small><?php if (isset($userEmail)) echo $userEmail ?></small>
            </div>

            <div class="body__main__signup__form__password">
                <label for="inputPasswordId">Mot de passe</label>
                <input required type="password" id="inputPasswordId" name="inputPassword" maxlength="25" value="<?php if (isset($userPasswordValue)) echo $userPasswordValue ?>">
                <small><?php if (isset($userPassword)) echo $userPassword ?></small>
            </div>

            <div class="body__main__signup__form__password">
                <label for="inputRetypePasswordId">Retapez le mot de passe</label>
                <input required type="password" id="inputRetypePasswordId" name="inputRetypePassword" maxlength="25">
                <small><?php if (isset($userPasswordCorrespondance)) echo $userPasswordCorrespondance ?></small>
            </div>
            
            <input type="submit" value="M'inscrire">
        </form>
        <a href="/login" class="body__main__signup__account">Vous avez déjà un compte ? Connectez vous</a>
    </section>
</main>

<?php include_once VIEWS . "footer.php" ?>