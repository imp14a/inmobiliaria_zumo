<div style="padding-left: 30px;">
	<p class="semiTitle">Fecha, Hora</p>
    <div id="search_items"></div>
    <?php echo $this->Form->postLink(
        'BORRAR TODO',
        array('action' => 'delete_all'),     
        array('class' => 'activeButton'),
        'Desea eliminar todas las búsquedas?')?>
   	<?php if($this->Session->check('Message')){ echo $this->Session->flash();} ?>
</div>
<?php echo $this->Html->scriptBlock("setUserSearches($('search_items'),".$this->Session->read('Auth.User.id').")"); ?>