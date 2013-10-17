<?php 
    echo $this->Html->css('zumo_components');
?>
<div class="plainContent">
	<h1>Panel de administraci&oacute;n</h1>
	<table>
		<?php echo $this->Html->tableHeaders(array('Listado', 'Ver')); ?>

		<?php echo $this->Html->tableCells(array(
	    array('Propiedades', $this->Html->link('ver', array('controller' => 'property', 'action' => 'index'))),
	    array('Usuarios', $this->Html->link('ver', array('controller' => 'user', 'action' => 'index'))),
	    array('Descargables', $this->Html->link('ver', array('controller' => 'files', 'action' => 'index')))
		)); ?>
</table>
</div>