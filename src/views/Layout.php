<?php include("Header.php");
//***************  fichier qui affiche le html renvoyé par les controllers
?>
<?php
//***************  Si un contrôleur envoie un contenu, on l'affiche
if (isset($contenu)) {
    echo $contenu;
}
?>

<?php include("Footer.php"); ?>


