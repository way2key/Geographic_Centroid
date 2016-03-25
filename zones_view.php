<?php
include"functions.php";
require"zones.php";
require"barycentre.php";
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
	<input type='submit' value='Go!'><br> 
	</form> 
	</div> 

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
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script> 
</body> 
</html> 
