<?php
/**
 * Created by PhpStorm.
 * User: 201250541
 * Date: 2015-12-14
 * Time: 11:03
 */

include_once "Function.php";
include_once "Layouts/Head.php";


if(isset($_POST['RmMe'])) {
    if (isset($_POST['RememberMe'])) {
        SetRememberMe($_SESSION['IDUsager'], 1);
        $demain = time() + (60 * 60 * 24);
        setcookie("ID", $_SESSION['IDUsager'], $demain);
    }
    else{
        SetRememberMe($_SESSION['IDUsager'], 0);
        setcookie("ID", null, -1);
    }
}

$Details = GetUserDetails($_SESSION['IDUsager']);
$Error="";

if(isset($_POST['password']) && isset($_POST['NouveauPassword']) && isset($_POST['NouveauPasswordConfirm']))
{
    if(IsExistingUser($Details['NomUsager'],$_POST['password']))
    {
        if($_POST['NouveauPassword'] == $_POST['NouveauPasswordConfirm'])
        {
            if(strlen($_POST['NouveauPassword'])>3)
            {
                if(strlen($_POST['NouveauPassword'])<128)
                {
                    ChangePwd($_SESSION['IDUsager'],$_POST['NouveauPassword']);
                }
                else
                {
                    $Error="Mot de passe trop long!!!";
                }
            }
            else
            {
                $Error="Mot de passe trop court!!!";
            }
        }
        else{
        $Error="Le nouveau mot de passe n'est pas le même que la confirmation!!!";
        }
    }
    else{
        $Error="Le mot de passe actuel n'est pas bon!!!";
    }
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
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <?php echo $Details['NomUsager']; ?>
            </div>
        </div>
        <div class="panel-body">
            <form method="post">
                <div class="form-group">
                    <label for="InputPassword">Mot de Passe Actuel :</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Mot de Passe">
                </div>
                <div class="form-group">
                    <label for="NouveauPassword">Nouveau Mot de Passe :</label>
                    <input type="password" class="form-control" name="NouveauPassword" id="NouveauPassword" placeholder="Nouveau Mot de Passe">
                </div>
                <div class="form-group">
                    <label for="NouveauPasswordConfirm">Confirmer Nouveau Mot de Passe :</label>
                    <input type="password" class="form-control" name="NouveauPasswordConfirm" id="NouveauPasswordConfirm" placeholder="Nouveau Mot de Passe">
                </div>

                <button type="submit" class="btn btn-default">Appliquer</button>
            </form>
            <hr/>
            <form method="post">
                <input class="hidden" name="RmMe" value="RmMe">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="RememberMe" <?php echo (($Details['RememberMe'])? "checked":""); ?> > Rester connecter
                    </label>
                </div>
                <button type="submit" class="btn btn-default">Appliquer</button>
            </form>
        </div>
    </div>
</div>

<?php
include_once "Layouts/Footer.php";
?>