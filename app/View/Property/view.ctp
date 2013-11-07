
<?php 

	echo $this->Html->css('zumo_components');
	echo $this->Html->css('zumo_property_view');
	echo $this->Html->css('inmibiliaria_zumo_property_add');
	echo $this->Html->script('zumo_components');
	echo $this->Html->script('carousel');

?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

<style>
.propertyImagesContainer{
	width: 100%;
	display: inline-block;
	position: relative;
	padding-top: 50%; /* "height" will be 3/4 of width */
}

</style>
<div class="plainContent" style="padding-top:0;">
	<div class="saveSearch" style="float: left;">
		<?php echo $is_in_favorites?$this->Html->link('QUITAR DE FAVORITOS',
		array('controller'=>'UserFavorites','action'=>'remove',$property['Property']['id']),array('class'=>'favoriteslink')):$this->Html->link('AGREGAR A FAVORITOS',
		array('controller'=>'UserFavorites','action'=>'add',$property['Property']['id']),array('class'=>'favoriteslink')); ?>
	</div>
	<div class="paginator">
		<div class="pagesControl">
			<a href="javascript:void(0);" class="carousel-control" rel="prev" id="next_image"> &lt; </a>
			<a href="javascript:void(0);" class="carousel-control"  rel="next" id="previously_image"> &gt; </a>
		</div>
		<div class="pagesInfo">
			<span id="imageIndex">1</span> | <span id="totalImages"><?php echo count($property['PropertyImage']); ?></span>
		</div>
	</div>
	
	<div style="text-align:center; display:inline-block; width:100%;">
		<div id="property_images">
			<div id="carousel-content">
		    	<?php foreach($property['PropertyImage'] as $image):?>
		        <div class="slide" ><img style="width: 100%; height: 100%;" src="<?php echo $image['image']; ?>" alt="img"></div>
		    	<?php endforeach;?>
		    </div>
		</div>
	</div>


	<div class="zumoTabs" id="zumoTabs">
		<div class="tabs">
			 <a for="property_information" class="tab" href="javascript:void(0);">INFORMAC&Iacute;ON</a>
			 <a for="property_nearby" class="tab" href="javascript:void(0);">
			 	¿QU&Eacute; HAY CERCA? <span class="expandInfo">1 km a la redonda</span>
			 </a>
			 <a for="property_plane" class="tab" href="javascript:void(0);">PLANTA ARQUITECTONICA</a>
		</div>
		<div class="tabContent" id="property_information">
			<span style="margin-left:30px; ">INFORMACI&Oacute;N</span>
			<div class="informationLine">
				<?php if($property['Property']['available_for_rent']): ?>
					<div class="informationCell">
						<label>Renta</label>
						<span> <?php echo $this->Number->currency($property['PropertyPaymentInformation']['rent_price'],'USD'); ?></span>
					</div>
				<?php endif;?>
				<?php if($property['Property']['available_for_sell']): ?>
					<div class="informationCell">
						<label>Venta</label>
						<span> <?php echo $this->Number->currency($property['PropertyPaymentInformation']['sale_price'],'USD'); ?></span>
					</div>
				<?php endif;?>
				<div class="informationCell" style="width: 80px;">
					<label>Cuota Mantenimiento</label>
					<span> <?php echo $this->Number->currency($property['PropertyPaymentInformation']['maintenance_price'],'USD'); ?></span>
				</div>
			</div>
			<div class="informationSeparator"></div>
			<div clas="informationLine">
				<div class="informationCell" style="width: 350px;">
					<label>Calle, N&uacute;mero</label>
					<span> <?php echo $property['PropertyAddress']['street'].', '.$property['PropertyAddress']['exterior_number'].' '.$property['PropertyAddress']['exterior_number']; ?></span>
				</div>
			</div>
			<div class="informationLine">
				<div class="informationCell" style="width: 350px;">
					<label>Estado, Delegacion o Municipio, Colonia</label>
					<span> <?php echo $property['PropertyAddress']['state'].', '.
					$property['PropertyAddress']['municipality'].', '.$property['PropertyAddress']['quarter']; ?></span>
				</div>
			</div>
			<div class="informationLine">
				<div class="informationCell" style="width: 80px;">
					<label>Tipo</label>
					<span> <?php echo $property['PropertyDescription']['type']; ?></span>
				</div>
				<div class="informationCell">
					<label>Antig&uuml;edad</label>
					<span> <?php echo $property['PropertyDescription']['antiquity']; ?></span>
				</div>
			</div>
			<div class="informationLine">
				<div class="informationCell">
					<label>Recamaras</label>
					<span> <?php echo $property['PropertyDescription']['number_of_rooms']; ?></span>
				</div>
				<div class="informationCell">
					<label>Ba&ntilde;os</label>
					<span> <?php echo $property['PropertyDescription']['number_of_bathrooms']; ?></span>
				</div>
				<div class="informationCell">
					<label>Estacionamientos</label>
					<span> <?php echo $property['PropertyDescription']['number_of_parkings']; ?></span>
				</div>
			</div>
			<div class="informationLine">
				<div class="informationCell" style="width: 80px;">
					<label>m<sup>2</sup> contrucci&oacute;n</label>
					<span> <?php echo $property['PropertyDescription']['square_meters_of_construction']; ?></span>
				</div>
				<div class="informationCell" style="width: 80px;">
					<label>m<sup>2</sup> terreno</label>
					<span> <?php echo $property['PropertyDescription']['square_meters_of_land']; ?></span>
				</div>
				<div class="informationCell">
					<label>Niveles</label>
					<span> <?php echo $property['PropertyDescription']['number_of_levels']; ?></span>
				</div>
			</div>
			<div class="informationLine">
				<label style="display:block;margin-left: 20px;">Otras Areas</label>
				<?php $i=1; foreach($property['PropertyArea'] as $area): ?>
					<?php if( $i==1 ): ?>
						<div class="informationCell" style="width: 50px; float:left;">
					<?php endif;?>
					<span> <?php echo $area['area_name']; ?></span>
					<?php if ($i==3): ?>
						</div>
					<?php $i=0; endif;?>
				<?php $i++; endforeach;?>
				<?php if($i<3): ?>
					</div>
				<?php endif;?>
			</div>
			<div class="informationSeparator" style="clear:left;"></div>
			<div class="informationLine" >
				<?php foreach($property['PropertyInformation'] as $category=>$elements):?>
				<div class="informationCell" style="width: 80px;">
					<label><?php echo $category; ?></label>
					<?php foreach($elements as $element): ?>
						<span> <?php echo $element['name']; ?></span>
					<?php endforeach; ?>
				</div>
				<?php endforeach;?>
			</div>
			<div class="informationSeparator" style="clear:left;"></div>
			<div class="informationLine" >
				<label style="display:block;margin-left: 20px;">Observaciones</label>
				<p><?php echo $property['PropertyDescription']['extra_description']; ?></p>
			</div>
		</div>
		<div class="tabContent" id="property_nearby">
			¿QU&Eacute; HAY CERCA? <span class="expandInfo">1 km a la redonda</span>
			<div id="property_location" lat="<?php echo $property['Property']['latitude']; ?>" 
				lon="<?php echo $property['Property']['longitude']; ?>" style="display:none;" ></div>
			<div id="map-canvas"></div>
			<div id="nearPlaces">
				<?php $i=1; foreach($property['PropertyNearPlace'] as $name=>$category): ?>
					<?php if( $i==1 ): ?>
						<div style="width: 100%; display:inline-block; margin-top:10px;">
					<?php endif;?>
					<div class="PlacesCategory">
						<a id="<?php echo Inflector::camelize( Inflector::slug($name) ); ?>" 
							class="expandButton" href="javascript:void(0);"><?php echo $name; ?> </a>
						<div class="expandCategory" id="expander<?php echo Inflector::camelize( Inflector::slug($name) ); ?>">
							<?php foreach($category as $place):?>
								<span class="NearPlace" lat="<?php echo $place['latitude']; ?>" lon="<?php echo $place['longitude']; ?>">
									<img alr="let" class="markerIcon" src="" /><?php echo $place['name']; ?>
								</span>
							<?php endforeach;?>
						</div>
					</div>
					<?php if ($i==3): ?>
						</div>
					<?php $i=0; endif;?>
				<?php $i++; endforeach;?>
				<?php if($i<3): ?>
					</div>
				<?php endif;?>
			</div>
			<div style="clear:left"></div>
		</div>
		<div class="tabContent" id="property_plane">
			<img alr="let" src="<?php echo $property['ArchitecturalPlant']['image']; ?>" />
		</div>
	</div>
	<script>
		google.maps.visualRefresh = true;
		var map;
		var markers = [];
		imageProportion = 0.5625;

		h = $('property_images').getWidth() * imageProportion;

		$('property_images').setStyle();

		new Carousel('property_images', $$('#carousel-content .slide'), $$('a.carousel-control'),{wheel:false});
		var totalPages = Number($('totalImages').innerHTML);
		$$('.carousel-control').each(function(control){
			$(control).observe('click',function(){
				newValue = Number($('imageIndex').innerHTML);
				if($(control).readAttribute('rel') == "prev")
					newValue -= 1;
				else
					newValue += 1;
				if( (newValue ) <= 0)
					newValue = 1;
				else if(newValue > totalPages)
					newValue = totalPages;
				$('imageIndex').update(newValue);
			});
		});
		var options=[];
		options["property_nearby"] = {
			response:function(){
				if(map!=null) return;
				latitude = $('property_location').readAttribute('lat');
				longitude = $('property_location').readAttribute('lon');
				position = new google.maps.LatLng(Number(latitude),Number(longitude));
			    var mapOptions = {
			        zoom: 14,
			        center: position,
			        mapTypeId: google.maps.MapTypeId.ROADMAP
			    };
			    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
				
			    map.setCenter(position);

			    var urlIconColor ="http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|FEEE69";
			    
				var pinImage = new google.maps.MarkerImage(urlIconColor,
			        new google.maps.Size(21, 34),
			        new google.maps.Point(0,0),
			        new google.maps.Point(10, 34)
			        );
			    var marker = new google.maps.Marker({
			        map: map,
			        position: position,
			        icon: pinImage,
			        animation: google.maps.Animation.DROP
			    });

			    markers.push(marker);


			    $$('.NearPlace').each(function(element,index){

			    	var let='ABCDEFGHIJKLMNOPQRSTUVWXYZ'.charAt(index);
			    	var urlIconletter ="http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld="+let+"|FE7569|000000";

			    	placeLat = $(element).readAttribute('lat');
			    	placeLon = $(element).readAttribute('lon');
			    	placePosition = new google.maps.LatLng(Number(placeLat),Number(placeLon));

			    	var pinImage = new google.maps.MarkerImage(urlIconletter,
			    		new google.maps.Size(21, 34),
				        new google.maps.Point(0,0),
				        new google.maps.Point(10, 34)
				        );
				    var marker = new google.maps.Marker({
				        map: map,
				        position: placePosition,
				        icon: pinImage,
				        animation: google.maps.Animation.DROP
				    });
				    $(element).select('.markerIcon').each(function(element){
				    	$(element).setAttribute('src',urlIconletter);
				    })

				    /*setStyle({
				    	'background-image':urlIconletter,
				    	'background-repeat':'no-repeat',
				    	'padding-left':'25px'}
				    );*/

				    markers.push(marker);
			    });
			 }
			};

		new ZumoTabComponent('zumoTabs',options);

		$$('.expandButton').each(function(element){
			new ZumoExpander(element,"expander"+element.id);
		});


	</script>
</div>