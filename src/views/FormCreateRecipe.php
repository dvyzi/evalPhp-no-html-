<?php include("Header.php"); ?>
<main>
    <section id='section'>
        <article id="slogan">
            <h2> Créer une nouvelle recette </h2>
        </article>
        <form action="/recipe/create" method="post" id="formCreate" enctype="multipart/form-data">
            <div class='formulaire'>
                 <div class="normal">
                    <label for="recipeTitleId">Nom de la recette</label>
                    <input type="text" name="recipeTitle"
                           value="<?php echo isset($_SESSION['POST']) ? $_SESSION['POST']['recipeTitle'] : ''; ?>"
                           required id="recipeTitleId">
                </div>
                <div class="normal">
                    <label for="recipeDescriptionId">Description de la recette</label>
                    <textarea name="recipeDescription" id="recipeDescriptionId" cols="30" rows="10"><?php echo isset($_SESSION['POST']) ?
                        $_SESSION['POST']['recipeDescription'] : ''; ?></textarea>
                </div>
                <div>
                    <label for="recipeImageId">Photo de la recette</label>

                    <input type="file" name="recipeImage" id="recipeImageId"/></div>

                <div class="normal">
                    <input type="submit" name="submitCreateRecipe" id="submit">
                </div>
            </div>
        </form>
    </section>
</main>
<?php

include("Footer.php"); ?>

