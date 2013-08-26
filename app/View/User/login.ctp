<?php 
	echo $this->Html->css('zumo_components');
  	echo $this->Html->script('zumo_components');
?>
<div class="plainText">
	<?php echo $this->Session->flash('auth'); ?>
	<?php echo $this->Form->create('User'); ?>
	<p class="title">Por favor ingresa tu usuario y contraseña</p>
	<?php echo $this->Form->input('username', array('label' => 'Usuario'));
	echo $this->Form->input('password', array('label' => 'Contraseña')); ?>
	<?php echo $this->Form->end('INGRESAR'); ?>
</div>