<?php 
    echo $this->Html->script('zumo_components');
    echo $this->Html->css('zumo_components');
?>
<div class="plainContent">
    <p class="semiTitle">Fecha, Hora</p>
    <div id="search_items"></div>
</div>
<?php echo $this->Html->scriptBlock("setUserSearches($('search_items'),".$this->Session->read('Auth.User.id').")"); ?>