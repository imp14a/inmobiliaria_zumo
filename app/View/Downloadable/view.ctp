<?php 
    echo $this->Html->css('zumo_components');
?>
<div class="plainContent">
	<div class="paginator">
		<div class="pagesControl">
		<?php
	    	echo $this->Html->link('<', array($back_id));
	    	echo $this->Html->link('>', array($next_id));
		?>
		</div>
		<div class="pagesInfo">
			Doc <?php echo $no_doc."|".$no_docs; ?>
	    </div>
	</div>
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
</div>