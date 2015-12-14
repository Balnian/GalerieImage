<?php
/**
 * Created by PhpStorm.
 * User: 201250541
 * Date: 2015-12-14
 * Time: 13:39
 */

include_once "Function.php";
include_once "Layouts/Head.php";

//Si pas admin GTFO
if(isset($_SESSION['IDUsager']))
    if($_SESSION['IDUsager']!=0 )
    HEADER("Location: index.php");
$Error="";
//Suppression User
if(isset($_POST['RemID']))
    if($_SESSION['IDUsager']==0 )
        if($_POST['RemID'] != $_SESSION['IDUsager'])
            RemoveUser($_POST['RemID']);

//Ajout Usager
if(isset($_POST['Nom']) && isset($_POST['password']))
{
    if(strlen($_POST['password'])>0 && strlen($_POST['password'])<128)
    {
        if(strlen($_POST['Nom'])>0 &&strlen($_POST['Nom'])<65)
            AddUser($_POST['Nom'],$_POST['password']);
        else
            $Error="Le nom d'usager n'est pas de la bonne longueur!";
    }
    else
        $Error="Mot de passe pas valide!";


}


?>
<div class="container">
    <?php
    if(!empty($Error)) {
        ?>
        <div class="alert alert-danger" role="alert"><?php echo $Error; ?></div>
    <?php
    }
    ?>
    <div class="well">
    <form method="post" class="form-inline">

        <div class="form-group">
            <label for="Nom">Nom Usager :</label>
            <input type="text" class="form-control" name="Nom" id="Nom" placeholder="Nom">
        </div>
        <div class="form-group">
            <label for="password">Mot de Passe :</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Mot de Passe">
        </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
    </div>
<?php
ListUser();
?>
    <hr/>
    <?php
    GetlastTen();
    ?>

</div>
<?php
include_once "Layouts/Footer.php";
?>
