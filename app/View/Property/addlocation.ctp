
<?php 

	echo $this->Html->script('scriptaculous/scriptaculous');
	echo $this->Html->script('zumo_components');
	echo $this->Html->css('zumo_components');
?>
<style>
  #map-canvas {
    margin: 0;
    padding: 0;
    height: 400px;
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
    	placeMarker(event.latLng);
	});

    codeAddress();
}

google.maps.event.addDomListener(window, 'load', initialize);

function deleteOverlays() {
	if (markersArray.length >= 1) {
		markersArray[0].setMap(null);
		markersArray.length = 0;
  	}
}

function placeMarker(location) {
	deleteOverlays();
	var marker = new google.maps.Marker({
	    position: location,
	    map: map
	});
	markersArray.push(marker);
	markersArray[0].setMap(map);
	$('PropertyLatitude').value = location.ob;
	$('PropertyLongitude').value = location.pb;
}

function codeAddress() {
    var address = "Mexico, Estado de " + $('PropertyAddressState').value + ',' 
                            + $('PropertyAddressMunicipality').value + ',' 
                            + 'Colonia '+$('PropertyAddressQuarter').value;
    console.log(address);
    var zoom =  6;
    if($('PropertyAddressMunicipality').value!=''){
      zoom +=6;
    }
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
	<h3>Registro de ubicación</h3><br>
	<?php echo $this->Form->create('Property'); ?>
	<?php echo $this->Form->input('Property.name', array('label' => 'Nombre de inmueble:', 'readonly' => 'true', 'class' => 'largeText')); ?>	
	<p class="semititle">Ubicaci&oacute;n</p>
	<?php echo $this->Form->hidden('PropertyAddress.state', array('label' => 'Estado:', 'class' => 'largeText')); ?>
	<?php echo $this->Form->hidden('PropertyAddress.municipality', array('label' => 'Municipio:', 'class' => 'largeText')); ?>
	<?php echo $this->Form->hidden('PropertyAddress.quarter', array('label' => 'Colonia:', 'class' => 'largeText')); ?>
	<?php echo $this->Form->hidden('Property.latitude', array('label' => 'Latitud:', 'class' => 'largeText')); ?>
	<?php echo $this->Form->hidden('Property.longitude', array('label' => 'Longitud:', 'class' => 'largeText')); ?>
	<?php echo $this->Form->end('GUARDAR'); ?>
  <div id="map-canvas"></div>
</div>