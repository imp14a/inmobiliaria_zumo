<?php 
    echo $this->Html->css('zumo_components');
?>
<div class="plainContent">
	<div class="column" style="width:400px;">
		<p><br>INFO<br>
		<br>T. (01722) 2326987 / 2310932
		<br>Hermenegildo Galeana 72, Metepec, Estado de México, México.</p>
		<img class="alliance" style="margin-left: 50px;" src=""></img>
	</div>
	<div class="column" style="width:400px;"><br>CONTACTO
		<?php echo $this->Form->create('ContactMessage'); ?>
		<br>
		<?php
			echo "<label>Nombre</label>";
			echo $this->Form->input('username', array('label'=>false));
			echo "<label>Email</label>";
			echo $this->Form->input('email', array('label'=>false));
			echo "<label>Mensaje</label>";
			echo $this->Form->input('message', array('label'=>false));
		?>
		<?php echo $this->Form->end("ENVIAR"); ?>
	</div>
</div>