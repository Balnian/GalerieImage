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
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="thumbnail">
                <img src="Images/<?php echo $image; ?>" alt="...">
                <div class="caption">
                    <h3><?php echo $Details['Titre'];?></h3>
                    <h4><?php echo $Details['NomUsager'];?></h4>
                    <h5><?php echo $Details['DatePublication'];?></h5>
                    <?php


                    ?>
                    <p>...</p>
                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                </div>
            </div>
            <div class="center-block">

                <img src="Images/<?php echo $image; ?>">
            </div>
        </div>
    </div>
    <?php

    ?>

</div>
<?php
include_once "Layouts/Footer.php";
?>