<?php 

	echo $this->Html->script('scriptaculous/scriptaculous');
	echo $this->Html->script('zumo_components');
	echo $this->Html->css('zumo_components');
?>

<style>
  #map-canvas {
    margin: 0 auto;
    padding: 0;
    height: 400px;
    width: 80%;
  }
div.autocomplete {
    background-color: white;
    margin: 0;
    padding: 0;
    position: relative !important;
    height: 0;
    left: 340px !important;
    top: 10px !important;
    z-index: 1;
}
</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script>
// Enable the visual refresh
google.maps.visualRefresh = true;

var geocoder;
var map;
var markersArray = [];

function initialize() {
  geocoder = new google.maps.Geocoder();
    var mapOptions = {
        zoom: 5,
        center: new google.maps.LatLng(22.913,-101.929),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    
    google.maps.event.addListener(map, 'dblclick', function(event) {
        placeMarker(event.latLng, false);
    });

    codeAddress();
    var latlng = new google.maps.LatLng($('PropertyLatitude').value, $('PropertyLongitude').value, true);
    placeMarker(latlng, true);  
}

google.maps.event.addDomListener(window, 'load', initialize);

var nearPlaceNumber = 65; //Letra inicial A

function placeMarker(location, property) {
	var marker = new google.maps.Marker({
	    position: location,
	    map: map,
        title: $('PropertyName').value
	});
    if(!property){
        var icon = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' + 
            String.fromCharCode(nearPlaceNumber) + '|FFCC00|000000'
        marker.setIcon(icon);
        map.setZoom(16);
        $('text_place').setStyle({display: 'block'});
        var nearPlace = [];
        nearPlace['number'] = nearPlaceNumber - 65;
        nearPlace['image'] = icon;
        nearPlace['marker'] = marker;
        var i = 0;
        var latitude;
        var longitude;
        for(var propertyName in location) {
            if(i==0)
                latitude = location[propertyName];
            else if(i==1)
                longitude = location[propertyName];
            else
                break;
            i++;       
        }
        nearPlace['latitude'] = latitude;
        nearPlace['longitude'] = longitude;
        createNearPlace($('place_container'), nearPlace);
        nearPlaceNumber++;
    }
    else{
        var infowindow = new google.maps.InfoWindow({
            content: '<b>' + $('PropertyName').value +'</b>'
        });
        infowindow.open(map,marker);
    }
}

function codeAddress() {
    var zoom =  16;
    //aplicamoz zoom
    geocoder.geocode( { 'latLng': new google.maps.LatLng($('PropertyLatitude').value, $('PropertyLongitude').value) },
    function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setZoom(zoom);
            map.setCenter(results[0].geometry.location);
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}
</script>

<div class="plainContent">
	<h3>Registro de lugares cercanos</h3><br>	
	<?php echo $this->Form->create('Property'); ?>
    <?php echo $this->Form->hidden('Property.id'); ?>
    <?php echo $this->Form->hidden('Property.name'); ?>
    <?php echo $this->Form->hidden('Property.longitude'); ?>
    <?php echo $this->Form->hidden('Property.latitude'); ?>
    <p>Dar doble clic para agregar un lugar cercano.</p>
	<div id="map-canvas"></div>
    <br>
    <p id="text_place" class="semititle" style="display: none;">Lugares cercanos</p>
    <div id="autocomplete_types" class="autocomplete"></div>
    <span id="indicator1" style="display: none">
        <?php echo $this->Html->image('ajax-loader.gif',array('alt'=>'Espere ...')); ?>
    </span>
    <div id="place_container"></div> 
	<?php echo $this->Form->end('GUARDAR'); ?>
</div>