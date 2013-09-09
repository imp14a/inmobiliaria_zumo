
<?php 

	echo $this->Html->css('zumo_components');
	echo $this->Html->css('zumo_property_view');
	echo $this->Html->script('scriptaculous/scriptaculous');
	echo $this->Html->script('zumo_components');

?>
<style>
.paginator{
	display: block;
}
.paginator .pagesInfo{
	float: right;
}
.paginator .pagesControl{
	float: right;
	margin-left: 10px;
}
</style>
<div class="plainContent">
	<div class="paginator">
		<div class="pagesControl">
		<span> << </span>
		<span> ></span>
		</div>
		<div class="pagesInfo">
			
	    	Resultados Búsqueda:  <span id="imageIndex">1</span> | %pages
	    </div>
	</div>