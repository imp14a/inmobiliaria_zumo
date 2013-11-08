<?php 
    echo $this->Html->css('zumo_components');
?>
<div class="plainContent">
	<div class="paginator">
		<div class="pagesControl">
		<?php
	    	echo $this->Paginator->prev(' < ', array(), null, array('class' => 'prev disabled'));
        	echo $this->Paginator->next(' > ', array(), null, array('class' => 'next disabled'));
		?>
		</div>
		<div class="pagesInfo">
			<?php echo $this->Paginator->counter('Doc {:page} | {:pages}');?>
	    </div>
	</div>
	<?php foreach ($downloadables as $downloadable): ?>
	<div class="column" style="width:20%;">
		<?php echo $this->Html->link('DESCARGAR', array('controller' => 'downloadable', 'action' => 'download', $downloadable['Downloadable']['id']), array('class' => 'activeButton')); ?>
	</div>
	<div class="column" style="width: 80%;">
		<p> 
			<b><?php echo $downloadable['Downloadable']['title']; ?></b><br>
			<?php echo $downloadable['Downloadable']['description']; ?>
		</p>
	</div>
	<div class="document_view">
		<object type="application/pdf" data="/app/webroot/files/<?php echo $downloadable['Downloadable']['file_name'];?>#toolbar=1&amp;navpanes=0&amp; scrollbar=1" width="100%" height="400px">
		<param name="src" value="/app/webroot/files/<?php echo $downloadable['Downloadable']['file_name'];?>#toolbar=1&amp;navpanes=0&amp;scrollbar=1">
	</div>
	<?php endforeach; ?>
</div>