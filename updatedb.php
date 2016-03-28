<?php 
//-----------------------Récupération de données------------------------------- 
//connexion à la base de données
include'database.php'; 
  
//détermine la taille de la bdd 
$q=$db->prepare('SELECT COUNT(*) AS TAILLE FROM ZONE'); 
$q->execute(); 
$data=$q->fetch(PDO::FETCH_OBJ); 
$taille=$data->TAILLE; 
$q->closeCursor(); 

//définition de l'url 
$base="https://maps.googleapis.com/maps/api/geocode/json?"; 
$address="address=1600+Amphitheatre+Parkway,+Mountain+View,+CA"; 
$language="&language=fr-FR"; 
$region="CH"; 
$key="&key="."YOUR_GEOCODE_API_KEY"; 
 
//boucle principale 
for($i=1;$i<$taille+1;$i++){ 
 
	//affiche l'indice d'itération 
	echo "<h2>$i</h2><br>"; 
	 
	//requête SQL qui récupère ADDRESSe,N_RUE,HABITANT 
	$q=$db->prepare("SELECT ADDRESSE,N_RUE,HABITANT from ZONE WHERE ID=$i "); 
	$q->execute(); 
	$data=$q->fetch(PDO::FETCH_OBJ); 
	$origins="address=".urlencode($data->ADDRESSE)."+".urlencode($data->N_RUE)."+Estavayer+le+lac"."+CH"; 
	$q->closeCursor(); 
	 
	//crée l'url personnalisé à l'id en fonction de l'indice d'itération 
	$url=$base.$origins.$language.$key; 
	 
	//affiche l'url 
	echo $url; 

	//requête chez google avec Curl 
	$ch = curl_init($url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	$data = curl_exec($ch); 
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
	$data=json_decode($data); 
	curl_close($ch); 
	 
	//enregistre la lattitude et la longitude retournée dans une variable 
	$lat=$data->{'results'}[0]->{'geometry'}->{'location'}->{'lat'}; 
	$lng=$data->{'results'}[0]->{'geometry'}->{'location'}->{'lng'}; 
	 
	//affiche $lat et $lng 
	echo "coordonnées:<br>",$lat," ",$lng; 
	 
	//requête sql permettant de mettre à jour la bdd 
	$q=$db->prepare("UPDATE ZONE SET LAT=$lat,LNG=$lng WHERE ID=$i"); 
	$q->execute(); 
	$q->closeCursor(); 
} 
//------------------------------------------------------------------------------ 

 
 
 
?> 
