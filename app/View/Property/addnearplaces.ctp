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
/*<?php $no = 0; $number = 65; foreach ($near_places as $place): ?>
    <?php echo $this->Form->input('PropertyNearPlace.'.$no.'.type', array('label'=>false));?>
    <div class="nearPlace">
        <img src="http://chart.apis.google.com/chart?chst=d_map_pin_letter&amp;chld=<?php echo chr($number);?>|FFCC00|000000" style="position: relative;">        
        <input type="text" placeholder="Ingrese el tipo de lugar" name="data[PropertyNearPlace][2][type]" id="PropertyNearPlace2Type" class="largeText" autocomplete="off" style="left:-3px; top: -30px; position: relative;">
        <input type="text" placeholder="Ingrese el nombre de lugar" name="data[PropertyNearPlace][2][name]" id="PropertyNearPlace2Name" class="largeText" style="position: relative; left: -318px; top: -10px;">
        <textarea type="text" placeholder="Ingrese alguna descripción" name="data[PropertyNearPlace][2][description]" id="PropertyNearPlace2Description" class="largeText" style="position: relative; left: 31px; top: -14px; height: 50px;"></textarea>
        <img src="/app/webroot/css/img/close_delete.png" style="position: relative; left: 340px; top: -108px; cursor: pointer;">
        <input type="hidden" name="data[PropertyNearPlace][2][latitude]" id="PropertyNearPlace2Latitude" value="19.43245883429453">
        <input type="hidden" name="data[PropertyNearPlace][2][longitude]" id="PropertyNearPlace2Longitude" value="-99.20543320477009">
    </div>
    <?php $no++; $number++; endforeach; ?> */

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
        placeMarker(event.latLng, false, true);
    });

    codeAddress();
    var latlng = new google.maps.LatLng($('PropertyLatitude').value, $('PropertyLongitude').value, true);
    placeMarker(latlng, true); 
    <?php foreach ($near_places as $place): ?>
    <?php $latitude = $place['PropertyNearPlace']['latitude'];
    $longitude = $place['PropertyNearPlace']['longitude'];
    echo 'latlng = new google.maps.LatLng('.$latitude.', '.$longitude.', true);';
    ?>
    <?php echo 'placeMarker(latlng, false, false);' ?>
    <?php endforeach; ?> 
}

google.maps.event.addDomListener(window, 'load', initialize);

var nearPlaceNumber = 65; //Letra inicial A

function placeMarker(location, property, newPlace) {
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
        if(newPlace) createNearPlace($('place_container'), nearPlace);
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
	<h3>Registro de lugares cercanos</h3>
    <?php if($this->Session->check('Message')){ echo $this->Session->flash();} ?>
    <br>	
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
    <div id="place_container">
        <?php $no = 0; $number = 65; foreach ($near_places as $place): ?>   
    <div class="nearPlace">        
        <img src="http://chart.apis.google.com/chart?chst=d_map_pin_letter&amp;chld=<?php echo chr($number);?>|FFCC00|000000" style="position: relative;">                
        <?php echo $this->Form->input('PropertyNearPlace.'.$no.'.type', array('label'=>false,'div'=>false, 'class'=>'largeText', 'style'=>'left:-3px; top: -30px; position: relative;'));?>
        <?php echo $this->Form->input('PropertyNearPlace.'.$no.'.name', array('label'=>false,'div'=>false, 'class'=>'largeText', 'style'=>'position: relative; left: -318px; top: -10px'));?>        
        <?php echo $this->Form->input('PropertyNearPlace.'.$no.'.description', array('label'=>false,'div'=>false, 'class'=>'largeText', 'style'=>'position: relative; left: 31px; top: -18px; height: 50px;'));?>        
        <?php echo $this->Form->input('PropertyNearPlace.'.$no.'.id', array('type'=>'hidden'));?>   
        <?php echo $this->Form->input('PropertyNearPlace.'.$no.'.property_id', array('type'=>'hidden'));?>
        <?php echo $this->Form->input('PropertyNearPlace.'.$no.'.latitude', array('type'=>'hidden'));?>   
        <?php echo $this->Form->input('PropertyNearPlace.'.$no.'.longitude', array('type'=>'hidden'));?>   
        <?php echo $this->Html->link('.', array('controller'=>'PropertyNearPlace', 'action'=>'delete', $place['PropertyNearPlace']['id']), array('class'=>'delete', 'style'=>'top: -109px;left: 335px;'));?>          
    </div>
    <?php $no++; $number++; endforeach; ?> 
    </div> 
	<?php echo $this->Form->end('GUARDAR'); ?>
</div>