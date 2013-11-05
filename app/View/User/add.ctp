<?php 
	echo $this->Html->script('zumo_components');
	echo $this->Html->css('zumo_components');
	echo $this->Html->css('inmobiliaria_zumo');
?>
<div class="plainContent">
	<h1>Datos de usuario:</h1>
	<?php 
	echo $this->Form->create('User');
	echo $this->Form->input('username', array('label'=>'Usuario:', 'class'=>'largeText'));
	echo $this->Form->input('email', array('label'=>'Correo electrónico:', 'class'=>'largeText'));
	echo $this->Form->input('isAdmin', array('label'=>'Administrador')); ?>
	<div class="submit"><a href="/index.php/User" class="activeButton">CANCELAR</a><input type="submit" value="GUARDAR"></div>
	<?php if($this->Session->check('Message')){ echo $this->Session->flash();} ?>
</div>
