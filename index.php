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
        <div class="panel panel-primary">
            <div class="panel-heading"><h2>Téléverser une image</h2></div>
            <div class="panel-body">

        <input type="hidden" name="MAX_FILE_SIZE" value="26214400">
        <div class="form-group">
            <label for="ImageUpload">Fichier :</label>
            <input name="Image" class="form-control" id="ImageUpload" size="35" type="file">
        </div>
        <div class="form-group">
            <label for="TitreUpload">Titre:</label>
            <input type="text" name="Titre" class="form-control" id="TitreUpload" placeholder="Titre">
        </div>
        <button type="submit" class="btn btn-primary">Envoyer le fichier</button>
            </div>
        </div>

    </form>
</div>
<?php
include_once "Layouts/Footer.php";
?>

