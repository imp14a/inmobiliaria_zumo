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
        placeMarker(event.latLng, 'green');
    });

    codeAddress();
    var latlng = new google.maps.LatLng($('PropertyLatitude').value, $('PropertyLongitude').value, true);
    placeMarker(latlng, null);  
}

google.maps.event.addDomListener(window, 'load', initialize);

function placeMarker(location, color) {
	var marker = new google.maps.Marker({
	    position: location,
	    map: map,
        title: $('PropertyName').value
	});
    if(color){
        marker.setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png');
    }
}

function codeAddress() {
    var address = "Mexico, Estado de " + $('PropertyAddressState').value + ',' 
                            + $('PropertyAddressMunicipalityGoogle').value + ',' 
                            + 'Colonia '+$('PropertyAddressQuarterGoogle').value;
    var zoom =  16;
    //aplicamoz zoom
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            map.setZoom(zoom);
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}
</script>

<div class="plainContent">
	<h3>Registro de inmuebles</h3><br>	
	<?php echo $this->Form->create('Property'); ?>
    <?php echo $this->Form->hidden('Property.longitude'); ?>
    <?php echo $this->Form->hidden('Property.latitude'); ?>
    <?php echo $this->Form->hidden('Property.name'); ?>
	<?php echo $this->Form->hidden('PropertyAddress.municipality_google'); ?>
	<?php echo $this->Form->hidden('PropertyAddress.quarter_google'); ?>
	<?php echo $this->Form->hidden('PropertyAddress.state', array('value' => $state)); ?>
	<?php echo $this->Form->input('PropertyNearPlace.type', array('label' => 'Tipo del lugar:', 'class' => 'largeText')); ?>
	<?php echo $this->Form->input('PropertyNearPlace.name', array('label' => 'Nombre del lugar:', 'class' => 'largeText')); ?>
	<?php echo $this->Form->input('PropertyNearPlace.description', array('label' => 'Descripción del lugar:', 'type' => 'textarea')); ?>
    <br>    
    <p class="semiTitle">Ubicaci&oacute;n</p>
	<div id="map-canvas"></div>
	<?php echo $this->Form->end('GUARDAR'); ?>
</div>