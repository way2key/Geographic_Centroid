<?php
define('DB_HOST','localhost');
define('DB_NAME','TM_MOB');
define('DB_USERNAME','YOUR_DATABASE_USRNAME');
define('DB_PASSWORD','PASSWORD');
try{
$db=new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8",DB_USERNAME,DB_PASSWORD);
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
die(' Une erreur est survenue: '.$e->getMessage());
}
?>
