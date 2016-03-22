<?php
include'database.php';

//détermine la taille de la bdd
$q=$db->prepare('SELECT COUNT(*) AS TAILLE FROM ESTAVAYER');
$q->execute();
$data=$q->fetch(PDO::FETCH_OBJ);
$taille=$data->TAILLE;
$q->closeCursor();

//définition de l'url
$base="https://maps.googleapis.com/maps/api/geocode/json?";
$address="address=1600+Amphitheatre+Parkway,+Mountain+View,+CA";
$language="&language=fr-FR";
$region="CH";
$key="&key="."YOUR_API_KEY";

//--------------------------Définition de fonctions-----------------------------
$pi=pi();
$add="";

//fonction qui transforme une coordonnée sphérique en carthésienne x 
function stocx($lat,$lng) {
$lat=deg2rad($lat);
$lng=deg2rad($lng);
$p=6370;
$x=$p*cos($pi/2-$lat)*cos($lng);
$y=$p*cos($pi/2-$lat)*sin($lng);
//echo "x-> ",$x,"<br>y-> ",$y,"<br>";
return $x;
}
//fonction qui transforme une coordonnée sphérique en carthésienne y 
function stocy($lat,$lng) {
$lat=deg2rad($lat);
$lng=deg2rad($lng);
$p=6370;
$x=$p*cos($pi/2-$lat)*cos($lng);
$y=$p*cos($pi/2-$lat)*sin($lng);
//echo "x-> ",$x,"<br>y-> ",$y,"<br>";
return $y;
}
//fonction qui transforme une coordonnée carthésienne en coordonnée sphérique  
function ctolng($x,$y) {
$lng=rad2deg(atan($y/$x));
return $lng;
}
//fonction qui transforme une coordonnée carthésienne en coordonnée sphérique  
function ctolat($x,$y) {
$lat=rad2deg(acos($x/(cos(atan($y/$x))*6370)));
return $lat;
}

/*
//-----------------------Récupération de données-------------------------------
//boucle principale
for($i=1079;$i<$taille;$i++){

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
*/


//HTML
?>
<html>
<head>
	<title>Barycentre géographique</title>
	<script src="case.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    
</head>

<body>
<div class="titre">
	<h1>Calcul du barycentre géographique à Estavayer-le-lac</h1>
</div>

<div class="img">
	<img src="Estavayer.png">
</div>

<div class="description">
	<h2>Sélection de zones</h2>
	<p>Veuillez sélectionner une zone et définir les quartiers concernés. La	 requête affichera les coordonées géographique du barycentre.</p>
</div>

<div class="zone">
	<form method="post" action="#">
		<input type="checkbox" value="A" name="zone[]" <?php if(in_array('A', $_POST['zone'] )){echo "checked";}?>>Zone A<br>
		<input type="checkbox" value="B" name="zone[]" <?php if(in_array('B', $_POST['zone'] )){echo "checked";}?>>Zone B<br>
		<input type="checkbox" value="C" name="zone[]" <?php if(in_array('C', $_POST['zone'] )){echo "checked";}?>>Zone C<br>
		<input type="checkbox" value="D" name="zone[]" <?php if(in_array('D', $_POST['zone'] )){echo "checked";}?>>Zone D<br>
		<input type="checkbox" value="E" name="zone[]" <?php if(in_array('E', $_POST['zone'] )){echo "checked";}?>>Zone E<br>
		<input type="checkbox" value="F" name="zone[]" <?php if(in_array('F', $_POST['zone'] )){echo "checked";}?>>Zone F<br>
		<input type="checkbox" value="G" name="zone[]" <?php if(in_array('G', $_POST['zone'] )){echo "checked";}?>>Zone G<br>

<input type="submit" value="Choisir une Zone" align="right"><br><br>


<?php
//----------------------------Partie logique Zone-------------------------------

$zone=$_POST['zone'];
if(!empty($zone)){
//compteur du nombre de zones sélectionnées
$nbrz= count($zone);

//bouton pour tout sélectionner
echo "<h1><center><input onclick=\"CocheTout(this, 'add[]');\" type=\"checkbox\">Tout sélectionner<br/></center></h1>";

//boucle qui affiche les addresses pour chaque zones sélectionnées
for($i=0;$i<$nbrz;$i++){

//Indice qui détermine quelle zone est sélectionnée
$a=$zone[$i];

//requête SQL qui récupère les ADDRESSE de la zone sélectionnée
$q=$db->query("SELECT DISTINCT ADDRESSE FROM `ZONE` WHERE ZONE='$a' GROUP BY ADDRESSE");
// affiche le titre de la zone
echo "<div id='$a'>","<h3>$a</h3></br>";



//code qui affiche les nouvelles boxes

while($row =$q->fetch()){
$b=$row['ADDRESSE'];
echo "<input type='checkbox' value=\"$b\" name='add[]'";
echo (in_array("$b", $_POST['add'] ))?"checked":"";
echo ">",htmlentities($row['ADDRESSE']),"<br>";
}
$q->closeCursor();
echo"</div>";
}//fin de l'affichage des addresses

}else{
echo"Vous n'avez sélectionné aucune zone.<br>";
}
//------------------------------------------------------------------------------
?>
<input type='submit' value='Go!'><br>
</form>
</div>

<?php
//----------------------------Calcul du barycentre------------------------------
$add=$_POST['add'];
$nbradd= count($add);

for($j=0;$j<$nbradd;$j++){
$c=$add[$j];

$q=$db->query("SELECT * FROM `ZONE` WHERE ADDRESSE=\"$c\" ");
while($row =$q->fetch()){
$hab=$row['HABITANT'];
$n_rue=$row['N_RUE'];
$addresse=$row['ADDRESSE'];
$lat=$row['LAT'];
$lng=$row['LNG'];

$numx=$numx+(stocx($lat,$lng)*$hab);
$numy=$numy+(stocy($lat,$lng)*$hab);
$den=$den+$hab;
$x=$numx/$den;
$y=$numy/$den;
echo $c," ",$n_rue," (",$hab," habitant";
echo ($hab>1)?"s":"";
echo") est situé: ";
echo "<table border='3'><tr>";
echo "<td>latitude||x</td>";
echo "<td>",$lat,"</td>";
echo "<td>",$x,"</td>";
echo "</tr><tr>";
echo "<td>longitude||y</td>";
echo "<td>",$lng,"</td>";
echo "<td>",$y,"</td>";
echo "</tr>";
echo "</table><br>";
}
$q->closeCursor();
}
if(!empty($zone)&&!empty($add)){
$lat=ctolat($x,$y);
$lng=ctolng($x,$y);
echo "<br><b>le barycentre se trouve:</b><br>","<center><h1>",$lat," et ",$lng,"</h1></center>";
}


//------------------------------------------------------------------------------
?>
<div id="map"></div>
<script>
    var lat=<?php echo $lat;?>;
    var lng=<?php echo $lng;?>;
    var myLatlng = {lat: lat, lng: lng};

    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: myLatlng,
            zoom: 14
        });
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title:"Hello World!"
        });



    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"
        async defer></script>
</body>
</html>
