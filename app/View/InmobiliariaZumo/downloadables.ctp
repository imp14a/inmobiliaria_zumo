<?php 
    echo $this->Html->css('zumo_components');
?>
<div class="plainContent">
	<div class="paginator">
		<div class="pagesControl">
		<?php
	    	echo $this->paginator->prev('< ', null, null, array('class' => 'disabled'));
	    	echo $this->paginator->next(' >', null, null, array('class' => 'disabled'));
		?>
		</div>
		<div class="pagesInfo">
			<?php echo $this->paginator->counter(array(
	    		'format' => 'Doc %count% %page% | %pages%')); ?>
	    </div>
	</div>
	<div class="document_view">
	</div>
	<div class="column" style="width:150px;">
		<?php echo $this->Html->link('DESCARGAR', array('controller' => 'Document', 'action' => 'download', 1), array('class' => 'activeButton')); ?>
	</div>
	<p class="column" style="margin-right: 15px;">
		<b>T&Iacute;TULO DOCUMENTO</b><br>
		(Breve descripción documento) Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In posuere felis nec tortor. Pellentesque faucibus. Ut accumsan ultricies elit. sit amet, egestas placerate.
	</p>
	<p class="column"><br>
		(Breve descripción documento) Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In posuere felis nec tortor. Pellentesque faucibus. Ut accumsan ultricies elit. sit amet, egestas placerate.
	</p>
</div>