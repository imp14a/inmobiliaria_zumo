
<?php 

	echo $this->Html->script('scriptaculous/scriptaculous');
	echo $this->Html->script('zumo_components');
	echo $this->Html->css('zumo_components');
?>

<style>
div.autocomplete {
  overflow: scroll;
  position:absolute;
  width:500px !important;
  background-color:white;
  border:1px solid #888;
  margin:0;
  padding:0;
}
div.autocomplete ul {
  list-style-type:none;
  margin:0;
  padding:0;
}
div.autocomplete ul li.selected { background-color: #FFCC00;}

div.autocomplete ul li {
  list-style-type:none;
  display:block;
  margin:0;
  padding:2px;
  height:32px;
  cursor:pointer;
}
</style>

<div class="plainContent">
	<h3>Registro de inmuebles</h3><br>	
	<?php echo $this->Form->create('Property'); ?>
		<label style="float: left; margin-top: 2px; margin-right: 10px;">Tipo de inmueble</label>
		<div class="selectZumo">
		<?php echo $this->Form->input('PropertyDescription.type',array('label' => '', 'options' => $types)) ?>
		</div>
		<?php echo $this->Form->input('name',array('label'=>'Nombre:', 'class'=>'largeText')); ?>
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
		<p class="semititle">Direcci&oacute;n</p>
		<?php echo $this->Form->input('PropertyAddress.postal_code',array('label'=>'Código Postal:', 'maxLength'=>5, 'class'=>'shortText')); ?>
		<span id="indicator1" style="display: none">
			<?php echo $this->Html->image('ajax-loader.gif',array('alt'=>'Espere ...')); ?>
		</span>
		<div id="autocomplete_choices" class="autocomplete"></div>
		<?php echo $this->Form->hidden('PropertyAddress.country',array('value'=>'México', 'class'=>'largeText')); ?>
		<?php echo $this->Form->input('PropertyAddress.state',array('label'=>'Estado:', 'class'=>'largeText')); ?>
		<?php echo $this->Form->input('PropertyAddress.city',array('label'=>'Ciudad:', 'class'=>'largeText')); ?>
		<?php echo $this->Form->input('PropertyAddress.municipality',array('label'=>'Delegación o Municipio:', 'class'=>'largeText')); ?>
		<?php echo $this->Form->input('PropertyAddress.quarter',array('label'=>'Colonia:', 'class'=>'largeText')); ?>
		<?php echo $this->Form->input('PropertyAddress.street',array('label'=>'Calle:', 'class'=>'largeText')); ?>
		<?php echo $this->Form->input('PropertyAddress.interior_number',array('label'=>'Número exterior:' , 'class'=>'shortText')); ?>
		<?php echo $this->Form->input('PropertyAddress.exterior_number',array('label'=>'Número interior:', 'class'=>'shortText')); ?>
		<p class="semititle">Descripción</p>
		<?php echo $this->Form->input('PropertyDescription.number_of_rooms',array('label'=>'Recámaras:', 'class'=>'shortText')); ?>
		<?php echo $this->Form->input('PropertyDescription.number_of_bathrooms',array('label'=>'Baños:', 'class'=>'shortText')); ?>
		<?php echo $this->Form->input('PropertyDescription.number_of_parkings',array('label'=>'Estacionamientos:', 'class'=>'shortText')); ?>
		<?php echo $this->Form->input('PropertyDescription.number_of_levels',array('label'=>'Niveles:', 'class'=>'shortText')); ?>
		<?php echo $this->Form->input('PropertyDescription.square_meters_of_construction',array('label'=>'Metros construcción:', 'class'=>'shortText')); ?>
		<?php echo $this->Form->input('PropertyDescription.square_meters_of_land',array('label'=>'Metros terreno:', 'class'=>'shortText')); ?>
		<?php echo $this->Form->input('PropertyDescription.extra_description',array('label'=>'Observaciones:')); ?>
		<!--<?php echo $this->Form->input('PropertyExtraArea.0.area_name',array('label'=>'area:')); ?>-->
		<p class="semititle">Otras &aacute;reas</p>
		<div id="addAreas"></div>
		<p class="semititle">Informaci&oacute;n adicional</p>
		<div id="addCategorias"></div>
		<?php echo $this->Form->end('GUARDAR'); ?>

</div>
<script>
	
	var model_area = [];
	var model_category = [];
	var model_category_name = [];
	model_area['name'] = 'PropertyExtraArea';
	model_area['field'] = 'area_name';
	setAdder($('addAreas'), 'Añadir áreas', model_area);

	/*model_category['name'] = 'PropertyExtraInformation';
	model_category['field'] = 'category';
	model_category['field2'] = 'name';
	model_category['number'] = 0;
	setAdder($('addCategorias'), 'Añadir categorías', model_category);*/

	new Ajax.Autocompleter("PropertyAddressPostalCode", "autocomplete_choices", 
		"http://wowinteractive.com.mx/inmobiliaria_zumo/index.php/User/getPostalCode", {
		paramName: "cp",
		minChars: 4,
		indicator: 'indicator1',
		afterUpdateElement : getSelectionId,
	});

	function getSelectionId(text, li) {
		$('PropertyAddressState').value = $(li).readAttribute('state');
		$('PropertyAddressCity').value = $(li).readAttribute('city');
		$('PropertyAddressMunicipality').value = $(li).readAttribute('municipality');
		$('PropertyAddressQuarter').value = $(li).readAttribute('quarter');
		$('PropertyAddressPostalCode').value = li.id;
	}
</script>