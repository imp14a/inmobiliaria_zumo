
<?php 

	echo $this->Html->script('scriptaculous/scriptaculous');
	echo $this->Html->css('zumo_components');
?>

<style>
div.autocomplete {
  position:absolute;
  width:500px;
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
div.autocomplete ul li.selected { background-color: #ffb;}

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
	<p class="semititle">Registro de inmuebles</p>
	<?php echo $this->Form->create('Register'); ?>

		<?php echo $this->Form->input('Property.name',array('label'=>'Nombre:')); ?>
		<h3>Direcci&oacute;n</h3>
		<?php echo $this->Form->input('PropertyAdress.postal_code',array('label'=>'Código Postal:')); ?>
		<span id="indicator1" style="display: none">
			<?php echo $this->Html->image('ajax-loader.gif',array('alt'=>'Espere ...')); ?>
		</span>
		<div id="autocomplete_choices" class="autocomplete"></div>
		<?php echo $this->Form->hidden('PropertyAdress.country',array('value'=>'México')); ?>
		<?php echo $this->Form->input('PropertyAdress.state',array('label'=>'Estado:')); ?>
		<?php echo $this->Form->input('PropertyAdress.city',array('label'=>'Ciudad:')); ?>
		<?php echo $this->Form->input('PropertyAdress.municipality',array('label'=>'Delegación o Municipio:')); ?>
		<?php echo $this->Form->input('PropertyAdress.quarter',array('label'=>'Colonia:')); ?>
		<?php echo $this->Form->input('PropertyAdress.street',array('label'=>'Calle:')); ?>
		<?php echo $this->Form->input('PropertyAdress.interior_number',array('label'=>'Número exterior:')); ?>
		<?php echo $this->Form->input('PropertyAdress.exterior_number',array('label'=>'Número interior:')); ?>

	<?php echo $this->Form->end(); ?>

</div>
<script>

	new Ajax.Autocompleter("PropertyAdressPostalCode", "autocomplete_choices", 
		"http://wowinteractive.com.mx/inmobiliaria_zumo/index.php/User/getPostalCode", {
		paramName: "cp",
		minChars: 4,
		indicator: 'indicator1',
		afterUpdateElement : getSelectionId
	});

	function getSelectionId(text, li) {
		$('PropertyAdressState').value = $(li).readAttribute('state');
		$('PropertyAdressCity').value = $(li).readAttribute('city');
		$('PropertyAdressMunicipality').value = $(li).readAttribute('municipality');
		$('PropertyAdressQuarter').value = $(li).readAttribute('quarter');
		$('PropertyAdressPostalCode').value = li.id;
	}
</script>