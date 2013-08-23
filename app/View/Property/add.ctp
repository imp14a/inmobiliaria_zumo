
<?php

echo $this->Html->script('scriptaculous/scriptaculous');
//echo $this->Html->script('scriptaculous/controls');
//echo $this->Html->script('scriptaculous/effects');

?>

<style>
div.autocomplete {
  position:absolute;
  width:250px;
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
	<input type="checkbox" id="chbx-compra" name="chbx-compra" value="">
	<label for="chbx-compra">Compra</label>

	<br>
	<div class="selectZumo">
		<select class="selectZumo">
		    <option>one</option>
		    <option>two</option>
		    <option>something</option>
		    <option>4</option>
		    <option>5</option>
		</select>
	</div>

	<?php echo $this->Form->create('Property'); ?>

		<div>
			<h3>Registro de propiedad</h3>

			<?php echo $this->Form->input('Property.name', array('label' => 'Nombre :'));?>
			<h4>Direccion</h4>
			<?php echo $this->Form->input('PropertyDirection.postal_code', array('label' => 'Codigo Postal: '));?>
			<span id="indicator1" style="display: none">
				<?php echo $this->Html->image("ajax-loader.gif",array("alt" => "Working ..."));  ?>
			</span>

			<div id="autocomplete_choices" class="autocomplete"></div>
			<?php echo $this->Form->hidden('PropertyDirection.country', array('value' => 'Mexico: '));?>
			<?php echo $this->Form->input('PropertyDirection.state', array('label' => 'Estado: '));?>
			<?php echo $this->Form->input('PropertyDirection.municipality', array('label' => 'Delegacion o Municipio: '));?>
			<?php echo $this->Form->input('PropertyDirection.city', array('label' => 'Ciudad: '));?>
			<?php echo $this->Form->input('PropertyDirection.quarter', array('label' => 'Colonia: '));?>
			<?php echo $this->Form->input('PropertyDirection.street', array('label' => 'Calle: '));?>
			<?php echo $this->Form->input('PropertyDirection.interior_number', array('label' => 'Numero interior: '));?>
			<?php echo $this->Form->input('PropertyDirection.exterior_number', array('label' => 'numero exterior: '));?>
		</div>

	<?php echo $this->Form->end(array('label'=>'Guardar')); ?>

</div>

<script>
	
	new Ajax.Autocompleter("PropertyDirectionPostalCode", "autocomplete_choices", 
		"http://wowinteractive.com.mx/inmobiliaria_zumo/index.php/User/get_Postal_Code.json", 
		{
			paramName: "cp", 
			minChars: 3, 
			indicator:"indicator1",
			afterUpdateElement : getSelectionId,
			updateElement : updateElement1,
			onSuccess : respuesta
		});

	function getSelectionId(text, li) {
		alert (li.id);
	}

	function updateElement1(data){
		console.log(data);
		console.log("termino");
	}

	function respuesta(data){
		console.log(data)
	}
</script>