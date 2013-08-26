<?php 
	echo $this->Html->script('zumo_components');
	echo $this->Html->css('zumo_components');
?>
<div class="plainContent">
	<h3>Registro de usuarios</h3><br>	
	<p class="semititle">Información de usuario</p>
	<?php echo $this->Form->create('User'); ?>
	<?php echo $this->Form->input('first_name', array('label' => 'Nombre:', 'class' => 'largeText')); ?>
	<?php echo $this->Form->input('last_name', array('label' => 'Apellidos:', 'class' => 'largeText')); ?>
	<?php echo $this->Form->input('isAdmin', array('label' => 'Administrador')); ?>	
	<p class="semititle">Accesos</p>
	<?php echo $this->Form->input('username', array('label' => 'Usuario:')); ?>
	<?php echo $this->Form->input('password', array('label' => 'Contraseña:')); ?>
	<?php echo $this->Form->end('GUARDAR'); ?>
	<a class="activeButton" href="/inmobiliaria_zumo/index.php/user/index">CANCELAR</a>
</div>
