<?php 
	echo $this->Html->script('zumo_components');
	echo $this->Html->css('zumo_components');
	echo $this->Html->css('inmobiliaria_zumo');
?>
<div class="plainContent">
	<h1>Datos de archivo:</h1>
	<?php 
	echo $this->Form->create('Downloadable', array('type' => 'file'));
	echo $this->Form->input('title', array('label'=>'Título:', 'class'=>'largeText'));
	echo $this->Form->input('description', array('label'=>'Descripción')); 
	echo $this->Form->input('file', array('label'=>'Archivo:', 'type'=>'file')); ?>

	<div class="submit"><a href="/inmobiliaria_zumo/index.php/downloadable" class="activeButton">CANCELAR</a><input type="submit" value="GUARDAR">
	<?php if($this->Session->check('Message')){ echo $this->Session->flash();} ?>
</div>
