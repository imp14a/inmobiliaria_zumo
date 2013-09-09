
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
	setAddress(location.ob, location.pb);
}

function codeAddress() {
	$('PropertyAddressQuarter').value = '';
    $('PropertyAddressStreet').value = '';            
    $('PropertyAddressPostalCode').value = '';
    var address = "Mexico, Estado de " + $('PropertyAddressState').value + ',' 
                            + $('PropertyAddressMunicipality').value; /*+ ',' 
                            + 'Colonia '+$('PropertyAddressQuarter').value;*/
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

function setAddress(latitude, longitude){
	$('PropertyLatitude').value = latitude;
	$('PropertyLongitude').value = longitude;
	latlng = new google.maps.LatLng(latitude, longitude, true);
	geocoder.geocode({'location': latlng}, function(results, status){
	if (status == google.maps.GeocoderStatus.OK) {
			console.log(results);
			$('PropertyAddressQuarter').value = parseInt(results[0].address_components[0].long_name, 10) > 0 ? results[0].address_components[2].long_name : results[0].address_components[1].long_name;
			$('PropertyAddressQuarterGoogle').value = parseInt(results[0].address_components[0].long_name, 10) > 0 ? results[0].address_components[2].long_name : results[0].address_components[1].long_name;
			$('PropertyAddressMunicipalityGoogle').value = parseInt(results[0].address_components[0].long_name, 10) > 0 ? results[0].address_components[3].long_name : results[0].address_components[2].long_name;
            $('PropertyAddressStreet').value = parseInt(results[0].address_components[0].long_name, 10) > 0 ? results[0].address_components[1].long_name : results[0].address_components[0].long_name;            
            $('PropertyAddressPostalCode').value = parseInt(results[0].address_components[0].long_name, 10) > 0 ? results[0].address_components[7].long_name : results[0].address_components[5].long_name;            
            $('PropertyAddressInteriorNumber').value = parseInt(results[0].address_components[0].long_name, 10) > 0 ? results[0].address_components[0].long_name : '';            
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}
</script>

<div class="plainContent">
	<a class="activeButton" href="/inmobiliaria_zumo/index.php/property/index">CANCELAR</a>
	<p></p>
	<h3>Registro de inmuebles</h3><br>	
	<?php echo $this->Form->create('Property', array('type' => 'file')); ?>
		<label style="float: left; margin-top: 2px; margin-right: 10px;">Tipo de inmueble</label>
		<div class="selectZumo">
		<?php echo $this->Form->input('PropertyDescription.type',array('label' => '', 'options' => $types)) ?>
		</div>
		<?php echo $this->Form->input('name',array('label'=>'Nombre:', 'class'=>'largeText')); ?>
		<label>Disponible para:</label>
		<?php echo $this->Form->input('available_for_rent',array('label'=>'Renta')); ?>
		<?php echo $this->Form->input('available_for_sell',array('label'=>'Venta')); ?>
		<label style="float: left; margin-top: 2px; margin-right: 10px;">Antigüedad</label>
		<div class="selectZumo">
		<?php echo $this->Form->input('PropertyDescription.antiquity',array('label' => '', 'options' => $antiquities)) ?>
		</div>
		<br>
		<p class="semititle">Precios</p>
			<?php echo $this->Form->input('PropertyPaymentInformation.rent_price',array('label'=>'Precio de renta:', 'class'=>'mediumText')); ?>
			<?php echo $this->Form->input('PropertyPaymentInformation.sale_price',array('label'=>'Precio de compra:', 'class'=>'mediumText')); ?>
			<?php echo $this->Form->input('PropertyPaymentInformation.maintenance_price',array('label'=>'Cuota de mantenimiento:', 'class'=>'mediumText')); ?>
		<br>
		<p class="semititle">Ubicaci&oacute;n y Direcci&oacute;n</p>
		<?php echo $this->Form->hidden('PropertyAddress.country',array('value'=>'México', 'class'=>'largeText')); ?>
		<label style="float: left; margin-top: 2px; margin-right: 10px;">Estado</label>
		<div class="selectZumo">
			<?php echo $this->Form->input('PropertyAddress.state',array('label' => '', 'options' => $states)) ?>
		</div>		
		<label style="float: left; margin-top: 2px; margin-right: 10px;">Delegaci&oacute;n o Municipio:</label>
		<div class="selectZumo">
			<?php $options = array();
                echo $this->Form->select('PropertyAddress.municipality', $options);
            ?>      
		</div>
		<?php echo $this->Form->hidden('PropertyAddress.municipality_google', array('label' => 'municipality_google:')); ?>
		<?php echo $this->Form->hidden('PropertyAddress.quarter_google', array('label' => 'quarter_google:')); ?>			
		<?php echo $this->Form->input('PropertyAddress.quarter',array('label'=>'Colonia:', 'class'=>'largeText')); ?>
		<?php echo $this->Form->input('PropertyAddress.street',array('label'=>'Calle:', 'class'=>'largeText')); ?>		
		<?php echo $this->Form->input('PropertyAddress.postal_code',array('label'=>'Código Postal:', 'maxLength'=>5, 'class'=>'shortText')); ?>
		<?php echo $this->Form->input('PropertyAddress.interior_number',array('label'=>'Número exterior:' , 'class'=>'shortText')); ?>
		<?php echo $this->Form->input('PropertyAddress.exterior_number',array('label'=>'Número interior:', 'class'=>'shortText')); ?>
		<?php echo $this->Form->hidden('Property.latitude', array('label' => 'Latitud:', 'class' => 'largeText')); ?>
		<?php echo $this->Form->hidden('Property.longitude', array('label' => 'Longitud:', 'class' => 'largeText')); ?>
		<div id="map-canvas"></div>
		<p class="semititle">Descripción</p>
		<?php echo $this->Form->input('PropertyDescription.number_of_rooms',array('label'=>'Recámaras:', 'class'=>'shortText')); ?>
		<?php echo $this->Form->input('PropertyDescription.number_of_bathrooms',array('label'=>'Baños:', 'class'=>'shortText')); ?>
		<?php echo $this->Form->input('PropertyDescription.number_of_parkings',array('label'=>'Estacionamientos:', 'class'=>'shortText')); ?>
		<?php echo $this->Form->input('PropertyDescription.number_of_levels',array('label'=>'Niveles:', 'class'=>'shortText')); ?>
		<?php echo $this->Form->input('PropertyDescription.square_meters_of_construction',array('label'=>'Metros construcción:', 'class'=>'shortText')); ?>
		<?php echo $this->Form->input('PropertyDescription.square_meters_of_land',array('label'=>'Metros terreno:', 'class'=>'shortText')); ?>
		<?php echo $this->Form->input('PropertyDescription.extra_description',array('label'=>'Observaciones:')); ?>
		<p class="semititle">Otras &aacute;reas</p>
		<div id="autocomplete_areas" class="autocomplete"></div>
		<div id="addAreas"></div>
		<span id="indicator1" style="display: none">
	    <?php echo $this->Html->image('ajax-loader.gif',array('alt'=>'Espere ...')); ?>
    	</span>
		<p class="semititle">Im&aacute;genes</p>
		<div id="addImages"></div>
		<p class="semititle">Servicios</p>
		<div id="autocomplete_categories" class="autocomplete"></div>
		<span id="indicator2" style="display: none">
	    <?php echo $this->Html->image('ajax-loader.gif',array('alt'=>'Espere ...')); ?>
    	</span>
		<div id="addServices"></div>
		<?php echo $this->Form->end('GUARDAR'); ?>		
</div>
<script>
	var model_area = [];
	var model_category = [];
	var model_category_name = [];
	var model_images = [];
	model_area['name'] = 'PropertyArea';
	model_area['field'] = 'area_name';	
	model_area['placeholder'] = 'ingresa área';
	model_area['label'] = 'Añadir áreas';
	model_area['autocomplete_paramName'] = 'name';
	model_area['autocomplete_id'] = 'autocomplete_areas';
	model_area['autocomplete_indicator'] = 'indicator1';
	model_area['autocomplete_srv'] = 'PropertyArea/getPropertyAreas';
	setAdder($('addAreas'), model_area);	

	model_images['name'] = 'PropertyImage';
	model_images['field'] = 'image';
	model_images['field_type'] = 'file';
	model_images['class'] = 'upload';
	model_images['label'] = 'Añadir imágenes';
	setAdder($('addImages'), model_images);

	model_category['name'] = 'PropertyInformation';
	model_category['field'] = 'category';	
	model_category['placeholder'] = 'ingresa categoría';
	model_category['label'] = 'Añadir categorías';
	model_category['autocomplete_paramName'] = 'category';
	model_category['autocomplete_id'] = 'autocomplete_categories';
	model_category['autocomplete_indicator'] = 'indicator2';
	model_category['autocomplete_srv'] = 'PropertyInformation/getPropertyCategories';
	//Recursive
	model_category_name['name'] = 'PropertyInformation';
	model_category_name['field'] = 'name';	
	model_category_name['placeholder'] = 'ingresa elemento';
	model_category_name['label'] = 'Añadir elemento';
	model_category_name['class'] = 'addText child';
	model_category_name['autocomplete_indicator'] = 'indicator2';
	model_category_name['autocomplete_id'] = 'autocomplete_categories';
	model_category_name['autocomplete_paramName'] = 'name';
	model_category_name['autocomplete_srv'] = 'PropertyInformation/getPropertyElementsByCategory'
	model_category['child'] = model_category_name;
	setAdder($('addServices'), model_category);

	createUbicationAjaxSelects('PropertyAddressState', 'PropertyAddressMunicipality', null, true);
	$('PropertyAddressState').observe('change', codeAddress);
	$('PropertyAddressMunicipality').observe('change', codeAddress);

</script>