<?php 
	echo $this->Html->css('zumo_components');
	echo $this->Html->css('zumo_login');
  	echo $this->Html->script('zumo_components');
?>

<div class="loginContent">
	<div class="loginContainer">
		<?php echo $this->Session->flash('auth'); ?>
		<h3>INICIAR SESI&Oacute;N</h3>
		<?php echo $this->Form->create('User');?>
	        <label>Correo electrónico</label>
	        <div class="input email">
	        	<?php echo $this->Form->input('email',array('type'=>'email','label'=>false)); ?>
	        </div>
	        <label>Contraseña (mínimo 6 cacteres)</label>
	        <div class="input password">
	        	<?php echo $this->Form->input('password', array('label'=>false)); ?>
	        </div>
	        <div class="submit" style="margin-left: 10px;">
	            <input type="submit" class="activeButton" value="ENTRAR">
	            <input type="button" class="lightwindow_action activeButton" rel="deactivate" value="CANCELAR">
	        </div>
	    <?php echo $this->Form->end();?>
	    <?php if($this->Session->check('Message')){ echo $this->Session->flash();} ?>
	</div>
</div>