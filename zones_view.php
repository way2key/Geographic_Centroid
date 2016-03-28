<?php
require"functions.php";
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
	<?php include"zones.php"; ?> 
	<input type='submit' value='Go!'><br> 
	</form> 
	</div> 
<?php include"barycentre.php"; ?> 
<div id="map"></div> 
<?php include"map.php"; ?> 
</body> 
</html> 
