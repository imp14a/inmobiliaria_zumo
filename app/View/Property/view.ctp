
<?php 

	echo $this->Html->css('zumo_components');
	echo $this->Html->css('zumo_property_view');
	echo $this->Html->script('scriptaculous/scriptaculous');
	echo $this->Html->script('zumo_components');
	echo $this->Html->script('carousel');

?>
<style>
.paginator{
	display: block;
}
.paginator .pagesInfo{
	float: right;
}
.paginator .pagesControl{
	float: right;
	margin-left: 10px;
	width: 30px;
	display: block;
}
.paginator .pagesControl a{
	text-decoration:none;
}
.paginator .pagesControl a:hover{
	font-weight: bold;
}
#property_images {
    width: 670px;
    height: 400px;
    overflow: hidden;
}
#carousel-content {
    width: 10500px;
}
#carousel-content .slide {
    float: left;
    width: 670px;
    height: 400px;
}
/**
 *  View property CSS 
 */
.nformationLine{
	margin-top: 5px;
}

.informationCell{
	display: inline-block;
	width: 50px;
	margin-left: 20px;
}
.informationCell label{
	display: block;
}
.informationCell span{
	font-weight: bold;
}
.informationSeparator{
	width: 30px;
	display: block;
	height: 5px;
	border-bottom: 2px solid black;
	margin-left: 15px;
}
</style>
<div class="plainContent" style="padding-top:0;">
	<div class="paginator">
		<div class="pagesControl">
		<a href="javascript:void(0);" class="carousel-control" rel="prev" id="next_image"> &lt; </span>
		<a href="javascript:void(0);" class="carousel-control"  rel="next" id="previously_image"> &gt; </span>
		</div>
		<div class="pagesInfo">
			<span id="imageIndex">1</span> | <span id="totalImages"><?php echo count($property['PropertyImage']); ?></span>
	    </div>
	</div>
	<div style="text-align:center; display:inline-block; width:100%;">
		<div id="property_images" style="width: 100%;">
			<div id="carousel-content">
		    	<?php foreach($property['PropertyImage'] as $image):?>
		        <div class="slide"><img style="width: 100%; height: 100%;" src="<?php echo $image['image']; ?>" alt="img"></div>
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
			<span >INFORMACI&Oacute;N</span>
			<div clas="informationLine">
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
					<label>Cuota mensual</label>
					<span> <?php echo $this->Number->currency($property['PropertyPaymentInformation']['maintenance_price'],'USD'); ?></span>
				</div>
			</div>
			<div class="informationSeparator"></div>
			<div clas="informationLine">
				<div class="informationCell" style="width: 350px;">
					<label>Calle, N&uacute;mero</label>
					<span> <?php echo $property['PropertyAddress']['street'].', '.$property['PropertyAddress']['exterior_number']; ?></span>
				</div>
			</div>
			<div clas="informationLine">
				<div class="informationCell" style="width: 350px;">
					<label>Estado, Delegacion o Municipio, Colonia</label>
					<span> <?php echo $property['PropertyAddress']['state'].', '.
					$property['PropertyAddress']['municipality'].', '.$property['PropertyAddress']['quarter']; ?></span>
				</div>
			</div>
			<div clas="informationLine">
				<div class="informationCell" style="width: 80px;">
					<label>Tipo</label>
					<span> <?php echo $property['PropertyDescription']['type']; ?></span>
				</div>
				<div class="informationCell">
					<label>Antig&uuml;edad</label>
					<span> <?php echo $property['PropertyDescription']['antiquity']; ?></span>
				</div>
			</div>
			<div clas="informationLine">
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
			<div clas="informationLine">
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
			<div clas="informationLine">
				<div class="informationCell" style="width: 80px;">
					<label>Otras Areas</label>
					<!-- TODO dividir las areas en tres por tres -->
					<?php foreach($property['PropertyArea'] as $area):?>
						<span> <?php echo $area['area_name']; ?></span>
					<?php endforeach;?>
				</div>
			</div>
			<div class="informationSeparator"></div>
			<div clas="informationLine">
				<!-- TODO Organizar categoria -->
				<?php foreach($property['PropertyInformation'] as $information):?>
				<div class="informationCell" style="width: 80px;">
					<label><?php echo $information['category']; ?></label>
					
					<span> <?php echo $information['name']; ?></span>
				</div>
				<?php endforeach;?>
			</div>
		</div>
		<div class="tabContent" id="property_nearby">
			asdfjkasdfkashd
		</div>
		<div class="tabContent" id="property_plane">
			asdfadfjklhasdlf
		</div>
	</div>
	<script>

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

		new ZumoTabComponent('zumoTabs');
	</script>
</div>