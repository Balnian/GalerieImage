<?php
/**
 * Created by PhpStorm.
 * User: 201250541
 * Date: 2015-12-14
 * Time: 10:35
 */
$_SESSION['IDUsager']=null;
setcookie("ID", null, -1);
HEADER("Location: Login.php");