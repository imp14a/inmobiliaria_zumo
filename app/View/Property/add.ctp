
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
<script type="text/javascript" src="https://www.dropbox.com/static/api/1/dropins.js" id="dropboxjs" data-app-key="ss5b8kwknnoyi10"></script>
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
    	if($('PropertyAddressState').value==''){
			alert('Selecciona un estado');
			return;
		}else{
    		placeMarker(event.latLng);
    	}
	});    
    <?php if($property_edit_id === NULL) echo 'codeAddress();'?>
    <?php if($property_edit_id != NULL){
		echo "latlng = new google.maps.LatLng(".$latitude.", ".$longitude.", true);";
		echo "placeMarker(latlng);";				
	}?>
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
	setAddress(location);
}

var valueMunicipality = "";
var isFired = false;

function codeAddress() {
	if(isFired){
		valueMunicipality = $('PropertyAddressMunicipalityGoogle').value.toString();
		return;
	}
	if($('PropertyAddressQuarter').value.length == 0) $('PropertyAddressQuarter').value = '';
    if($('PropertyAddressStreet').value.length == 0) $('PropertyAddressStreet').value = '';            
    if($('PropertyAddressPostalCode').value.length == 0) $('PropertyAddressPostalCode').value = '';
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

function setAddress(location){
	var latitude;
	var longitude;
	var i = 0;
	for(var propertyName in location) {
		if(i==0)
			latitude = location[propertyName];
		else if(i==1)
			longitude = location[propertyName];
		else
			break;
		i++;	   
	}
	$('PropertyLatitude').value = latitude;
	$('PropertyLongitude').value = longitude;
	latlng = new google.maps.LatLng(latitude, longitude, true);
	geocoder.geocode({'location': latlng}, function(results, status){
	if (status == google.maps.GeocoderStatus.OK) {
		    var options = $$('select#PropertyAddressState option');
			var len = options.length;
			var selectedValue = parseInt(results[0].address_components[0].long_name) > 0 ? results[0].address_components[3].long_name : results[0].address_components[5].long_name;		
			$('PropertyAddressMunicipalityGoogle').value = parseInt(results[0].address_components[0].long_name, 10) > 0 ? results[0].address_components[3].long_name : results[0].address_components[2].long_name;
		    isFired = true;
			oEvent = document.createEvent('HTMLEvents');
            oEvent.initEvent('change',false, false);
            element = $('PropertyAddressState');
            element.dispatchEvent(oEvent);           			
			$('PropertyAddressQuarter').value = parseInt(results[0].address_components[0].long_name, 10) > 0 ? results[0].address_components[2].long_name : results[0].address_components[1].long_name;
			$('PropertyAddressQuarterGoogle').value = parseInt(results[0].address_components[0].long_name, 10) > 0 ? results[0].address_components[2].long_name : results[0].address_components[1].long_name;
            $('PropertyAddressStreet').value = parseInt(results[0].address_components[0].long_name, 10) > 0 ? results[0].address_components[1].long_name : results[0].address_components[0].long_name;            
            $('PropertyAddressPostalCode').value = parseInt(results[0].address_components[0].long_name, 10) > 0 ? results[0].address_components[7].long_name : results[0].address_components[5].long_name;            
            $('PropertyAddressInteriorNumber').value = parseInt(results[0].address_components[0].long_name, 10) > 0 ? results[0].address_components[0].long_name : '';
            map.setCenter(results[0].geometry.location);
            var zoom =  6;
            zoom+=10;
            map.setZoom(zoom);
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}
</script>

<div class="plainContent">
	<a class="activeButton" href="/index.php/Property/index">CANCELAR</a>
	<?php if($property_edit_id!=null){?>
	<a class="activeButton" href="/index.php/Property/addnearplaces/<?php echo $property_edit_id;?>">EDITAR LUGARES CERCANOS</a>
	<?php }	?>
	<p></p>
	<?php if($this->Session->check('Message')){ echo $this->Session->flash();} ?>  
	<br>
	<h3>Registro de inmuebles</h3><br>	
	<?php echo $this->Form->create('Property', array('type' => 'file')); ?>
		<label style="float: left; margin-top: 2px; margin-right: 10px;">Tipo de inmueble</label>
		<div class="selectZumo">
		<?php echo $this->Form->input('PropertyDescription.id',array('type'=>'hidden')); ?>
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
			<?php echo $this->Form->input('PropertyPaymentInformation.id',array('type'=>'hidden')); ?>
			<?php echo $this->Form->input('PropertyPaymentInformation.rent_price',array('label'=>'Precio de renta:', 'class'=>'mediumText')); ?>
			<?php echo $this->Form->input('PropertyPaymentInformation.sale_price',array('label'=>'Precio de compra:', 'class'=>'mediumText')); ?>
			<?php echo $this->Form->input('PropertyPaymentInformation.maintenance_price',array('label'=>'Cuota de mantenimiento:', 'class'=>'mediumText')); ?>
		<br>
		<p class="semititle">Ubicaci&oacute;n y Direcci&oacute;n</p>
		<?php echo $this->Form->input('PropertyAddress.id',array('type'=>'hidden')); ?>
		<?php echo $this->Form->hidden('PropertyAddress.country',array('value'=>'México', 'class'=>'largeText')); ?>
		<label style="float: left; margin-top: 2px; margin-right: 10px;">Estado</label>
		<div class="selectZumo">
			<?php echo $this->Form->input('PropertyAddress.state',array('label' => '', 'options' => $states, 'empty' => '(Seleccionar estado)')) ?>
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
		<?php $no = 0; foreach ($property_areas as $area): ?>
		<?php echo "<div class= \"addText\" style=\"height: 27px;\">";?>
		<?php echo $this->Form->input('PropertyArea.'.$no.'.id',array('type'=>'hidden'));?>
		<?php echo $this->Form->input('PropertyArea.'.$no.'.area_name',array('label'=>false,'div' => false)); ?>
		<?php echo $this->Html->link('.',
        	array('controller'=>'PropertyArea','action'=>'delete',$area['PropertyArea']['id']),array('class'=>'delete', 'style'=>'left: 232px;top: -30px;'));
        ?>
		<?php echo "</div>";?>
		<?php $no++;?>
		<?php endforeach; ?>
		<span id="indicator1" style="display: none">
	    <?php echo $this->Html->image('ajax-loader.gif',array('alt'=>'Espere ...')); ?>
    	</span>
		<p class="semititle">Im&aacute;genes de la propiedad</p>
		<?php echo $this->Form->input('user_id_dropbox',array('type' => 'hidden', 'value'=>$dropbox_id));?>
		<p class="semititle">Im&aacute;gen default de la propiedad</p>
		<?php echo $this->Form->input('DefaultImage.id', array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('DefaultImage.type', array('type'=>'hidden', '
		value'=>'default')); ?>
		<div class="upload"><input value="<?php echo $imageDefault;?>" type="text" name="" id="PropertyImage0ImageimageDefault" placeholder="" bro_id="" parent_id=""><a id="aImgDefault" href="#" class="dropbox-dropin-btn dropbox-dropin-default" style="position: absolute; top: 0px; width: 86px; font-weight: 100;"><span class="dropin-btn-status"></span>Seleccionar</a><?php echo $this->Form->input('DefaultImage.image', array('type'=>'hidden')); ?></div>
		<p class="semititle">Im&aacute;gen de planta arquitect&oacute;nica de la propiedad</p>
		<?php echo $this->Form->input('ArchitecturalPlant.id', array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('ArchitecturalPlant.type', array('type'=>'hidden', '
		value'=>'planta')); ?>
		<div class="upload"><input value="<?php echo $imagePlanta;?>"  type="text" name="" id="PropertyImage1ImageimagePlanta" placeholder="" bro_id="" parent_id=""><a id="aImgPlanta" href="#" class="dropbox-dropin-btn dropbox-dropin-default" style="position: absolute; top: 0px; width: 86px; font-weight: 100;"><span class="dropin-btn-status"></span>Seleccionar</a><?php echo $this->Form->input('ArchitecturalPlant.image', array('type'=>'hidden')); ?></div>
		<div id="addImages"><p class="semititle">Im&aacute;genes para vista de resultado</p></div>
		<?php $no = 2; foreach ($property_images as $image): ?>
		<?php echo $this->Form->input('PropertyImage.'.$no.'.id', array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('PropertyImage.'.$no.'.property_id', array('type'=>'hidden')); ?>
		<div class="upload">
		<?php list($thrash, $image_name) = split(Configure::read('Dropbox.ID')."/", $image['PropertyImage']['image'], 2);?>
		<input type="text" value="<?php echo $image_name;?>"name="" id="PropertyImage<?php echo $no;?>ImageimageName" placeholder="" bro_id="" parent_id="">
		<a id="aImg<?php echo $no;?>" href="#" class="dropbox-dropin-btn dropbox-dropin-default" style="position: absolute; top: 0px; width: 86px; font-weight: 100;"><span class="dropin-btn-status"></span>Seleccionar</a>
		<?php echo $this->Form->input('PropertyImage.'.$no.'.image', array('type'=>'hidden')); ?>
		<?php echo $this->Html->link('.',
        	array('controller'=>'PropertyImage','action'=>'delete',$image['PropertyImage']['id']),array('class'=>'delete', 'style'=>'left: 350px;top: 2px;'));
        ?>
		<?php echo "</div>";?>
		<?php $no++;?>
		<?php endforeach; ?>
		<p class="semititle">Servicios</p>		
		<div id="autocomplete_categories" class="autocomplete"></div>	
		<?php $no = 0; foreach ($property_informations as $information): ?>
		<div class="addText" style="height: 30px;position: relative;top: -40px;">
		<?php echo $this->Form->input('PropertyInformation.'.$no.'.id', array('type'=>'hidden'));?>
		<?php echo $this->Form->input('PropertyInformation.'.$no.'.property_id', array('type'=>'hidden'));?>
		<table class="non-style">
			<tr class="non-style">
			<td class="non-style"><?php echo $this->Form->input('PropertyInformation.'.$no.'.category', array('label'=>false, 'div'=>false));?></td>
			<td class="non-style"><?php echo $this->Form->input('PropertyInformation.'.$no.'.name', array('label'=>false, 'div'=>false));?>	</td>
			<?php echo $this->Html->link('.', 
				array('controller'=>'PropertyInformation','action'=>'delete', $information['PropertyInformation']['id']),array('class'=>'delete', 'style'=>'left: 462px;top: 25px;'));?>
		</tr>
		</table>
		</div>
		<?php $no++;?>
		<?php endforeach; ?>			
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
	setAdder($('addAreas'), model_area, <?php echo count($property_areas);?>);	

	model_images['name'] = 'PropertyImage';
	model_images['field'] = 'image';
	model_images['class'] = 'upload';
	model_images['label'] = 'Añadir imágenes';
	setAdder($('addImages'), model_images, <?php echo (2 + count($property_images));?>);

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
	setAdder($('addServices'), model_category, <?php echo (count($property_informations));?>);

	createUbicationAjaxSelects('PropertyAddressState', 'PropertyAddressMunicipality', null, true);
	$('PropertyAddressState').observe('change', codeAddress);
	$('PropertyAddressMunicipality').observe('change', codeAddress);

    setDropBox('aImgDefault', 'DefaultImageImage', 'PropertyImage0ImageimageDefault');
   	setDropBox('aImgPlanta', 'ArchitecturalPlantImage', 'PropertyImage1ImageimagePlanta');

	<?php $no = 2; foreach ($property_images as $image): ?>
	<?php echo 'setDropBox(aImg'.$no.',PropertyImage'.$no.'Image, PropertyImage'.$no.'ImageimageName);';?>
	<?php $no++;?>
	<?php endforeach; ?>
    function setDropBox(element, name, alias){
    	$(element).observe('click', function(){
			var options = {
            success: function(files) {                            
                $(name).value = 'https://dl.dropboxusercontent.com/u/'+$('PropertyUserIdDropbox').value+'/'+files[0].link.split("/Public/")[1];
                $(alias).value = files[0].link.split("/Public/")[1];             
            },
            linkType: "direct",
            multiselect: false,
            extensions: ['.bmp', '.cr2', '.gif', '.ico', '.ithmb', '.jpeg', '.jpg', '.nef', '.png', '.raw', '.svg', '.tif', '.tiff', '.wbmp', '.webp']
	        };
	        Dropbox.choose(options);
    	}).update("Seleccionar").insert({ 
        	top: new Element('span',{
            class: "dropin-btn-status"
        })
    });

    }
</script>