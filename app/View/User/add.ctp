<?php 
	echo $this->Html->script('zumo_components');
	echo $this->Html->css('zumo_components');
?>
<div class="plainContent">
	<div class="loginContent">
		<h3>REGISTRARSE</h3><br>			
		<?php echo $this->Form->create('User', array('label' => '')); ?>		
		<label>Nombre Usuario</label>
		<?php echo $this->Form->input('username', array('label' => '')); ?>		
		<label>Correo electr&oacute;nico</label>
		<?php echo $this->Form->input('email', array('label' => '')); ?>				
		<label>Contraseña (m&iacute;nimo 6 cacteres)</label>
		<?php echo $this->Form->input('password', array('label' => '')); ?>
		<label>Confirmar Contraseña</label>
		<?php echo $this->Form->input('password', array('label' => '')); ?>
		<?php echo $this->Form->end('REGISTRARSE'); ?>		
	</div>	
	<br>
	<div class="loginContent">
		<h3>INICIAR SESI&Oacute;N</h3><br>			
		<?php echo $this->Form->create('User', array('label' => '')); ?>				
		<label>Correo electr&oacute;nico</label>
		<?php echo $this->Form->input('email', array('label' => '')); ?>				
		<label>Contraseña (m&iacute;nimo 6 cacteres)</label>
		<?php echo $this->Form->input('password', array('label' => '')); ?>		
		<?php echo $this->Form->end('ENTRAR'); ?>		
	</div>	
</div>
