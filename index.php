<?php
include_once "Function.php";
include_once "Layouts/Head.php";

UploadImage();
?>
<div class="container">
    <?php
        AfficherImages();
    ?>
</div>
<div class="container">
    <form  method="post"
          enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="26214400">
        Fichier : <input name="Image" size="35" type="file">

        Titre: <input name="Titre" type="text">

        <input type="submit" value="Envoyer le fichier">
    </form>
</div>
<?php
include_once "Layouts/Footer.php";
?>

