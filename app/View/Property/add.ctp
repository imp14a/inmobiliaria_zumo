
<?php 

	echo $this->Html->script('scriptaculous/scriptaculous');
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
	<?php echo $this->Form->create('Register'); ?>
		<label style="float: left; margin-top: 2px; margin-right: 10px;">Tipo de inmueble</label>
		<div class="selectZumo">
		<?php echo $this->Form->input('PropertyDescription.type',array('label' => '', 'options' => $types)) ?>
		</div>
		<?php echo $this->Form->input('Property.name',array('label'=>'Nombre:', 'class'=>'largeText')); ?>
		<label style="float: left; margin-top: 2px; margin-right: 10px;">Antigüedad</label>
		<div class="selectZumo">
		<?php echo $this->Form->input('PropertyDescription.antiquity',array('label' => '', 'options' => $antiquities)) ?>
		</div>
		<br>
		<p class="semititle">Direcci&oacute;n</p>
		<?php echo $this->Form->input('PropertyAdress.postal_code',array('label'=>'Código Postal:', 'maxLength'=>5, 'class'=>'shortText')); ?>
		<span id="indicator1" style="display: none">
			<?php echo $this->Html->image('ajax-loader.gif',array('alt'=>'Espere ...')); ?>
		</span>
		<div id="autocomplete_choices" class="autocomplete"></div>
		<?php echo $this->Form->hidden('PropertyAdress.country',array('value'=>'México', 'class'=>'largeText')); ?>
		<?php echo $this->Form->input('PropertyAdress.state',array('label'=>'Estado:', 'class'=>'largeText')); ?>
		<?php echo $this->Form->input('PropertyAdress.city',array('label'=>'Ciudad:', 'class'=>'largeText')); ?>
		<?php echo $this->Form->input('PropertyAdress.municipality',array('label'=>'Delegación o Municipio:', 'class'=>'largeText')); ?>
		<?php echo $this->Form->input('PropertyAdress.quarter',array('label'=>'Colonia:', 'class'=>'largeText')); ?>
		<?php echo $this->Form->input('PropertyAdress.street',array('label'=>'Calle:', 'class'=>'largeText')); ?>
		<?php echo $this->Form->input('PropertyAdress.interior_number',array('label'=>'Número exterior:' , 'class'=>'shortText')); ?>
		<?php echo $this->Form->input('PropertyAdress.exterior_number',array('label'=>'Número interior:', 'class'=>'shortText')); ?>
		<p class="semititle">Descripción</p>
		<?php echo $this->Form->input('PropertyDescription.number_of_rooms',array('label'=>'Recámaras:', 'class'=>'shortText')); ?>
		<?php echo $this->Form->input('PropertyDescription.number_of_bathrooms',array('label'=>'Baños:', 'class'=>'shortText')); ?>
		<?php echo $this->Form->input('PropertyDescription.number_of_parkings',array('label'=>'Estacionamientos:', 'class'=>'shortText')); ?>
		<?php echo $this->Form->input('PropertyDescription.number_of_levels',array('label'=>'Niveles:', 'class'=>'shortText')); ?>
		<?php echo $this->Form->input('PropertyDescription.square_meters_of_construction',array('label'=>'Metros construcción:', 'class'=>'shortText')); ?>
		<?php echo $this->Form->input('PropertyDescription.square_meters_of_land',array('label'=>'Metros terreno:', 'class'=>'shortText')); ?>
		<?php echo $this->Form->input('PropertyDescription.extra_description',array('label'=>'Observaciones:')); ?>
		<p class="semititle">Otras áreas</p>

		<?php echo $this->Form->end('GUARDAR'); ?>

</div>
<script>

	new Ajax.Autocompleter("PropertyAdressPostalCode", "autocomplete_choices", 
		"http://wowinteractive.com.mx/inmobiliaria_zumo/index.php/User/getPostalCode", {
		paramName: "cp",
		minChars: 4,
		indicator: 'indicator1',
		afterUpdateElement : getSelectionId,
	});

	function getSelectionId(text, li) {
		$('PropertyAdressState').value = $(li).readAttribute('state');
		$('PropertyAdressCity').value = $(li).readAttribute('city');
		$('PropertyAdressMunicipality').value = $(li).readAttribute('municipality');
		$('PropertyAdressQuarter').value = $(li).readAttribute('quarter');
		$('PropertyAdressPostalCode').value = li.id;
	}
</script>