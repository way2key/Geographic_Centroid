<?php 
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
?>