<?php
$cssPath = "account.css";
include_once VIEWS . "header.php";
if (!isset($_SESSION["user"])) {
    header("Location: /");
}
?>

<main>
    <section class="body__main__head">
        <div class="body__main__head__left">
            <h1>Mon compte</h1>
            <p>Bienvenue sur votre compte, <?php echo $_SESSION["user"]["userName"] ?></p>
        </div>
        <div class="body__main__head__rigth">
            <a href="/logout">Me déconnecter</a>
        </div>
    </section>
</main>

<?php include_once VIEWS . "footer.php" ?>