
<?php 

	echo $this->Html->css('zumo_components');
	echo $this->Html->css('zumo_search_results');
	echo $this->Html->script('zumo_components');

?>
<div class="plainContent" >
	<div class="saveSearch" style="float: left;">
		<?php 
			if(!$isUserSearch){
				echo $this->Form->create('UserSearch', array( 'url' =>array('controller'=>'UserSearch','action'=>'save_search'), 'style' => 'position: relative;
					top: -10px;'));
				echo $this->Form->input('description', array('type' => 'hidden', 'value' => $search_description));
				echo $this->Form->input('algo', array('type' => 'hidden', 'value' => $options_db));
				echo $this->Form->input('date', array('type' => 'hidden', 'value' => date('d-m-Y | H:i')));
				$this->Form->end("GUARDAR BÚSQUEDA"); 
			}
		?>		
	</div>
	<div class="paginator">
		<div class="pagesControl">
		<?php
	    	echo $this->paginator->prev('< ', null, null, array('class' => 'disabled'));
	    	echo $this->paginator->next(' >', null, null, array('class' => 'disabled'));
		?>
		</div>
		<div class="pagesInfo">
			<?php echo $this->paginator->counter(array(
	    		'format' => 'Resultados Búsqueda: %count%  página %page% | %pages%')); ?>
	    </div>
	</div>
	<div class="grid">
		<div class="gridContainer">
		<?php foreach($found_properties as $property): ?>
		<div class="gridElement">
			<img class="mainImage" width="100%" height="auto" src="<?php echo $property['DefaultImage']['image']; ?>" />
			<div class="information">
				<span style="font-family: HouschkaPro-DemiBold;font-size: 16px; margin-top:15px;">
				<?php echo $property['Property']['name']; ?>
 				<?php echo $this->Form->input('Property.id', array('type' => 'hidden', 'value' => $property['Property']['id'])); ?>
				</span>
				<span style=""><?php echo $property['PropertyDescription']['type']; ?></span>
				<?php if($property['Property']['available_for_rent']): ?>
					<span>Renta :<?php echo $this->Number->currency($property['PropertyPaymentInformation']['rent_price']); ?></span>
				<?php endif;?>
				<?php if($property['Property']['available_for_sell']): ?>
					<span>Venta :<?php echo $this->Number->currency($property['PropertyPaymentInformation']['sale_price']); ?></span>
				<?php endif;?>
				<span><?php echo $property['PropertyDescription']['square_meters_of_construction']; ?> m<sup>2</sup> de construcci&oacute;</span>
				<?php 
				echo $this->Html->link("+ info",array( "controller" => "property","action" => "view",$property['Property']['id']),array('style'=>"font-family: HouschkaPro-Medium; font-style: italic; text-decoration: none; margin-left:10px;margin-top:10px; display: block;")); 
				?>
			</div>
		</div>
		<?php endforeach; ?>
		</div>
	</div>

<script>
// Generamos el alto preciso para el ancho que se tiene
$$('.gridElement').each(function(element){
	new ZumoGridElement(element);
});


</script>

</div>