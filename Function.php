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