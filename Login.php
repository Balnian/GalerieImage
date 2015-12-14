<?php
/**
 * Created by PhpStorm.
 * User: 201250541
 * Date: 2015-11-23
 * Time: 18:51
 */

include_once "Layouts/Head.php";
include_once "Function.php";

$Error = false;

if(isset($_POST['Nom']) && isset($_POST['password']))
{

    $out = IsExistingUser($_POST['Nom'],$_POST['password']);
    echo $out;
    if($out===false)
    {
        $Error = true;
    }
    else
    {
        /*if(session_status() == PHP_SESSION_NONE)
        {
            session_start();
            session_destroy();
        }
*/
        echo $out;
        $_SESSION['IDUsager']=$out;
        echo $_SESSION['IDUsager'];
        HEADER("Location: index.php");
        UserLogin($_SESSION['IDUsager']);
    }
}

?>

<div class="container">
<div class="col-md-offset-3 col-md-6 col-xs-12">
    <div class="panel panel-default">
        <div class="page-header">
            <div class="panel-title">
                <h1>Connection</h1>
            </div>
        </div>
            <div class="panel-body">
                <form method="post">
                    <div class="form-group">
                        <label for="Nom">Nom Usager :</label>
                        <input type="text" class="form-control" name="Nom" id="Nom" placeholder="Nom">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mot de Passe :</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Mot de Passe">
                    </div>
                    <button type="submit" class="btn btn-default">Connection</button>
                </form>
            </div>
        <?php
        if($Error)
        {
            ?>
            <div class="panel-footer">
                Les informations ne sont pas bonnes!!!!
            </div>
        <?php
        }
        ?>

    </div>

</div>

</div>

<?php
include_once "Layouts/Footer.php";
?>