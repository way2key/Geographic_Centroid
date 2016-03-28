<?php 
$map_key="YOUR_MAP_API_KEY";
?>
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
<script src="https://maps.googleapis.com/maps/api/js?key=<?php $map_key?>&callback=initMap" async defer></script> 
