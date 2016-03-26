<?php 
//----------------------------Partie logique Zone------------------------------- 
require"database.php";

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
		
		//ferme la requête
		$q->closeCursor(); 
		echo"</div>"; 
	}
}
else{ 
	echo"Vous n'avez sélectionné aucune zone.<br>"; 
} 
//------------------------------------------------------------------------------ 
?> 
