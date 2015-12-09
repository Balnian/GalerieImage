<?php
/**
 * Created by PhpStorm.
 * User: 201250541
 * Date: 2015-12-03
 * Time: 12:09
 */
include_once "Function.php";
include_once "Layouts/Head.php";



$image="";
$IsOwner=false;
$Details = array();
if(isset($_GET['Image']))
{
    $image = $_GET['Image'].".png";

    $out = IsImageOwner($_SESSION['IDUsager'],$_GET['Image']);
    if($out !== false)
    {
        $IsOwner = true;
    }

    $Details = getImageDetails($_GET['Image']);
}
else
{
    HEADER("Location: index.php");
}

if(isset($_POST['Commentaire']) && isset($Details['IDImage']))
{
    $Len=strlen($_POST['Commentaire']);
    if($Len >0 && $Len<=150)
    {
        InsertComment($_SESSION['IDUsager'],$Details['IDImage'],$_POST['Commentaire']);
    }
}

?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="thumbnail">
                <img class="SingleImage" src="Images/<?php echo $image; ?>" alt="<?php echo $Details['Titre'];?>">
                <div class="caption">
                    <h3><?php echo $Details['Titre'];?></h3>
                    <h4><?php echo $Details['NomUsager'];?></h4>
                    <h5><?php echo $Details['DatePublication'];?></h5>
                    <?php


                    ?>
                    <p>...</p>
                    <p><a href="index.php" class="btn btn-primary" role="button">Retour</a>
                        <?php
                        if($IsOwner)
                        {
                        ?>
                            <a href="#" class="btn btn-danger" role="button">Supprimer</a></p>
                        <?php
                        }
                        ?>
                </div>
            </div>
            </div>
        </div>


    <?php
        foreach(getImageComments($Details['IDImage'])as $Comment) {
        ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="container-fluid">
                                <div class="col-xs-4">
                                    <h3><?php echo $Comment['NomUsager'] ?></h3>
                                    <h4><?php echo $Comment['DatePublication'] ?></h4>
                                    </div>
                                <div class="col-xs-8">
                                    <div class="well" style="word-wrap: break-word;">
                                        <?php echo $Comment['Commentaire'] ?>
                                    </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
        ?>
    <!-- Formulaire pour commentaire -->
    <div class="row">
        <hr/>
        <form method="post">
            <div class="col-xs-10">
                <textarea name="Commentaire" class="form-control" rows="3" maxlength="150"></textarea>
            </div>
            <div class="col-xs-2">

                <button type="submit" class="btn btn-primary center-block">Envoyer</button>
            </div>
        </form>

    </div>

</div>
<?php
include_once "Layouts/Footer.php";
?>