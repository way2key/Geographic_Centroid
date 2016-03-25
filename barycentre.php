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