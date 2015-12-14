<?php
/**
 * Created by PhpStorm.
 * User: 201250541
 * Date: 2015-11-23
 * Time: 19:00
 */

$user = 'Serveur';
$pass = 'Qwerty1234';

$ConnDB = new PDO('mysql:host=localhost;dbname=galerie', $user, $pass);

//**********************************************************************************************************************
//  SQL
//**********************************************************************************************************************

function IsExistingUser($Nom,$PassW)
{
    global $ConnDB;
    $SQL ="select IDUsager from Usager WHERE NomUsager = :Name AND PasswordUsager = :Pass";
    $PrStm = $ConnDB->prepare($SQL);



    $PrStm->bindParam(':Name',$Nom,PDO::PARAM_STR);
    $PrStm->bindParam(':Pass',$PassW,PDO::PARAM_STR);

    $PrStm->execute();

    $result = $PrStm->fetchAll();

    $PrStm->closeCursor();

    //print_r($result);

    if(count($result) == 1)
    {
        return $result[0]['IDUsager'];
    }
    else
        return false;


}

// Insertion dans la BD de la nouvelle image et de sont propriétaire
function RegisterImage($Id,$Titre,$Description,$URL)
{
    global $ConnDB;
    $SQL ="INSERT INTO image(IDUsager, Titre, Description, URL, DatePublication) VALUES (:UserId,:Titre,:Desc,:URL,:Date)";
    $PrStm = $ConnDB->prepare($SQL);

    $PrStm->bindParam(':UserId',$Id,PDO::PARAM_INT);
    $PrStm->bindParam(':Titre',$Titre,PDO::PARAM_STR);
    $PrStm->bindParam(':Desc',$Description,PDO::PARAM_STR);
    $PrStm->bindParam(':URL',$URL,PDO::PARAM_STR);
    $date = date("Y-m-d h:i:s");
    $PrStm->bindParam(':Date',$date,PDO::PARAM_STR);

    $PrStm->execute();
    $PrStm->closeCursor();
}

//Retourne l'ID de l'image selon l'URL
function GetimageID($URL)
{
    global $ConnDB;
    $SQL ="select IDImage from image WHERE URL = :Url";
    $PrStm = $ConnDB->prepare($SQL);
    $PrStm->bindParam(':Url',$PassW,PDO::PARAM_STR);
    $PrStm->execute();
    $result = $PrStm->fetchAll();

    $PrStm->closeCursor();

    return $result[0]['IDImage'];

}

// Retourne si le id passer est propriétaire de l'image
function IsImageOwner($id,$URL)
{
    global $ConnDB;
    $SQL ="select IDImage from image WHERE IDUsager = :IDU AND URL = :Url";
    $PrStm = $ConnDB->prepare($SQL);



    $PrStm->bindParam(':IDU',$id,PDO::PARAM_INT);
    $PrStm->bindParam(':Url',$URL,PDO::PARAM_STR);

    $PrStm->execute();
    $result = $PrStm->fetchAll();

    $PrStm->closeCursor();
    if(count($result) == 1)
    {
        return $result[0]['IDImage'];
    }
    else
    {
        return false;
    }
}

//Retourne les détails de l'image (Titre, Nom Proprio, Date, URL)
function getImageDetails($URL)
{
    global $ConnDB;
    $SQL ="select im.IDImage, us.NomUsager, im.Titre, im.DatePublication, im.URL from image im inner join usager us on im.IDUsager = us.IDUsager where im.URL = :URL";
    $PrStm = $ConnDB->prepare($SQL);

    $PrStm->bindParam(':URL',$URL,PDO::PARAM_STR);

    $PrStm->execute();
    $result = $PrStm->fetchAll();

    return $result[0];


}

//Retourne les Commentaire d'une image
function getImageComments($ImageID)
{
    global $ConnDB;
    $SQL ="select us.NomUsager, com.Commentaire, com.DatePublication from commentaires com inner join usager us on com.IDUsager = us.IDUsager where com.IDImage = :ImageID order by com.DatePublication desc";
    $PrStm = $ConnDB->prepare($SQL);

    $PrStm->bindParam(':ImageID',$ImageID,PDO::PARAM_INT);

    $PrStm->execute();
    $result = $PrStm->fetchAll();
    return $result;
}

function InsertComment($IDU,$IDImg,$Com)
{
    global $ConnDB;
    $SQL ="INSERT INTO commentaires(IDUsager, IDImage, Commentaire, DatePublication) VALUES (:IDU,:IDImg,:Com,:Date)";
    $PrStm = $ConnDB->prepare($SQL);

    $PrStm->bindParam(':IDU',$IDU,PDO::PARAM_INT);
    $PrStm->bindParam(':IDImg',$IDImg,PDO::PARAM_INT);
    $PrStm->bindParam(':Com',$Com,PDO::PARAM_STR);
    $date = date("Y-m-d h:i:s");
    $PrStm->bindParam(':Date',$date,PDO::PARAM_STR);

    $PrStm->execute();
    $PrStm->closeCursor();
}

// Vérifie si la personne existe dans la BD
Function IDExist($ID)
{
    if(is_numeric($ID))
    {
        global $ConnDB;
        $SQL ="select IDUsager from usager WHERE IDUsager = :IDU";
        $PrStm = $ConnDB->prepare($SQL);



        $PrStm->bindParam(':IDU',$ID,PDO::PARAM_INT);

        $PrStm->execute();
        $result = $PrStm->fetchAll();

        $PrStm->closeCursor();
        if(count($result) == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }

}

//Récupère les info de l'usager
Function GetUserDetails($ID)
{
    global $ConnDB;
    $SQL ="select NomUsager, RememberMe from usager WHERE IDUsager = :IDU";
    $PrStm = $ConnDB->prepare($SQL);



    $PrStm->bindParam(':IDU',$ID,PDO::PARAM_INT);

    $PrStm->execute();
    $result = $PrStm->fetchAll();

    $PrStm->closeCursor();

    return $result[0];

}

// Vérifie si l'usager veux rester connecter (Cookie)
Function UserWantsRememberMe($ID)
{
    if(is_numeric($ID))
    {
        global $ConnDB;
        $SQL ="select RememberMe from usager WHERE IDUsager = :IDU";
        $PrStm = $ConnDB->prepare($SQL);



        $PrStm->bindParam(':IDU',$ID,PDO::PARAM_INT);

        $PrStm->execute();
        $result = $PrStm->fetchAll();

        $PrStm->closeCursor();
        if(count($result) == 1)
        {
            return $result[0]['RememberMe'];
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }
}

//Change le mot de passe
function ChangePwd($IDU, $PWD)
{
    global $ConnDB;
    $SQL ="update usager set PasswordUsager = :PWD where IDUsager = :IDU";
    $PrStm = $ConnDB->prepare($SQL);

    $PrStm->bindParam(':IDU',$IDU,PDO::PARAM_INT);
    $PrStm->bindParam(':PWD',$PWD,PDO::PARAM_STR);

    $PrStm->execute();
    $PrStm->closeCursor();
}

function SetRememberMe($IDU, $Val)
{
    global $ConnDB;
    $SQL ="update usager set RememberMe = :Val where IDUsager = :IDU";
    $PrStm = $ConnDB->prepare($SQL);

    $PrStm->bindParam(':IDU',$IDU,PDO::PARAM_INT);
    $PrStm->bindParam(':Val',$Val,PDO::PARAM_BOOL);

    $PrStm->execute();
    $PrStm->closeCursor();
}

Function AddUser($Name,$Pwd)
{
    global $ConnDB;
    $SQL ="INSERT INTO usager(NomUsager, PasswordUsager, RememberMe) VALUES (:Name,:PWD,FALSE )";
    $PrStm = $ConnDB->prepare($SQL);

    $PrStm->bindParam(':Name',$Name,PDO::PARAM_STR);
    $PrStm->bindParam(':PWD',$Pwd,PDO::PARAM_STR);

    $PrStm->execute();
    $PrStm->closeCursor();
}

Function RemoveUser($ID)
{
    global $ConnDB;
    $SQL ="DELETE FROM usager WHERE IDUsager=:ID";
    $PrStm = $ConnDB->prepare($SQL);

    $PrStm->bindParam(':ID',$ID,PDO::PARAM_INT);

    $PrStm->execute();
    $PrStm->closeCursor();
}

Function ListUser()
{
    global $ConnDB;
    $SQL ="select * from usager ";
    $PrStm = $ConnDB->prepare($SQL);



    $PrStm->bindParam(':IDU',$ID,PDO::PARAM_INT);

    $PrStm->execute();
    $result = $PrStm->fetchAll();

    $PrStm->closeCursor();

    echo "<ul class=\"list-group\">";
    foreach($result as $User)
    {
        if($User["IDUsager"]!=0) {
            ?>

            <li class="list-group-item"><?php echo $User["NomUsager"];?>
                <form method="post">
                    <button class="btn btn-danger" name="RemID" value="<?php echo $User["IDUsager"] ?>">Suprimer</button>
                </form>
            </li>


        <?php
        }
    }
    echo "</ul>";

    return $result[0];
}

Function GetlastTen()
{

    global $ConnDB;
    $SQL ="SELECT * FROM usager order by LastConn desc limit 10";
    $PrStm = $ConnDB->prepare($SQL);



    $PrStm->bindParam(':IDU',$ID,PDO::PARAM_INT);

    $PrStm->execute();
    $result = $PrStm->fetchAll();

    $PrStm->closeCursor();

    echo "<ul class=\"list-group\">";
    foreach($result as $User)
    {
        if($User["IDUsager"]!=0) {
            ?>

            <li class="list-group-item">
                <?php echo $User["NomUsager"];?>,
                <?php echo $User["LastConn"];?>,
                <?php echo $User["LastIP"];?>

            </li>


        <?php
        }
    }
    echo "</ul>";

    return $result[0];
}

Function UserLogin($ID)
{
    global $ConnDB;
    $SQL ="update usager set LastConn = :Date, LastIP= :IP  where IDUsager = :IDU";
    $PrStm = $ConnDB->prepare($SQL);

    $PrStm->bindParam(':IDU',$ID,PDO::PARAM_INT);

    $date = date("Y-m-d h:i:s");
    $PrStm->bindParam(':Date',$date,PDO::PARAM_STR);

    $IP = $_SERVER['REMOTE_ADDR'];
    $PrStm->bindParam(':IP',$IP,PDO::PARAM_STR);


    $PrStm->execute();
    $PrStm->closeCursor();
}

//**********************************************************************************************************************
//Gestion Image
//**********************************************************************************************************************

Function AfficherImages()
{

    global $ConnDB;
    //$SQL ="select us.NomUsager, im.Titre, im.DatePublication, im.URL from image im inner join usager us on im.IDUsager = us.IDUsager order by  im.DatePublication desc";
    $SQL ="select im.IDImage, im.NomUsager, im.Titre, im.DatePublication, im.URL, count(cm.IDCommentaire) as CompteCom from commentaires cm right join ( select im.IDImage, us.NomUsager, im.Titre, im.DatePublication, im.URL from image im inner join usager us on im.IDUsager = us.IDUsager ) im on cm.IDImage=im.IDImage group by im.IDImage, im.NomUsager, im.Titre, im.DatePublication, im.URL order by im.DatePublication desc";
    $PrStm = $ConnDB->prepare($SQL);
    $PrStm->execute();
    $result = $PrStm->fetchAll();

    foreach($result as $item )
    {
        ?>

        <div class="thumbnail">
            <img class="MassImage" src="<?php echo "Images/".$item['URL'].".png"; ?>" alt="<?php echo $item['Titre']; ?>">
            <div class="caption">
                <h3><?php echo $item['Titre']; ?></h3>
                <h4><?php echo $item['NomUsager']; ?></h4>
                <h5><?php echo $item['DatePublication']; ?></h5>
                <h4>Commentaires(<?php echo $item['CompteCom']; ?>)</h4>
                <p><a href="gestimage.php?Image=<?php echo $item['URL']; ?>" class="btn btn-primary" role="button">Afficher</a>
            </div>
        </div>
    <?php

    }

    $PrStm->closeCursor();

}

function UploadImage()
{
   // echo isset($_POST["Titre"]);
    if(isset($_POST["Titre"])) {
        $rep = 'Images/';
        $Uniq = uniqid("", true);
        $fich = $rep . $Uniq . ".png";

        $type = $_FILES['Image']['type'];
        if (strpos($type, 'image') !== false) {
            if (move_uploaded_file($_FILES['Image']['tmp_name'], $fich)) {
                RegisterImage($_SESSION['IDUsager'],$_POST["Titre"],"",$Uniq);
        } else {
                echo "Problème lors du déplacement";

            }
        }
    }
}
