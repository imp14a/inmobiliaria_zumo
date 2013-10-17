<?php 

    echo $this->Html->css('zumo_components');
    echo $this->Html->css('zumo_property_view');
    echo $this->Html->css('inmibiliaria_zumo_property_add');
    echo $this->Html->css('zumo_search_results');
    echo $this->Html->script('zumo_components');

?>
<div class="plainContent" >
    <div class="zumoTabs" id="zumoTabs">
        <div class="tabs" style="text-align: left; margin-left:30px;">
            <a for="user_favorites" class="tab" id="openFavorites" href="javascript:void(0);">FAVORITOS</a>
            <a for="user_searches" class="tab" id="openUserSearches" href="javascript:void(0);">BUSQUEDAS GUARDADAS</a>
        </div>
        <div class="tabContent" id="user_favorites" style="border:none;">
            <?php echo $this->element('user_favorites'); ?>
        </div>
        <div class="tabContent" id="user_searches" style="border:none;">
            <?php echo $this->element('user_searches'); ?>
        </div>
        <script>
        var options = [];
        options['closeButton'] = false;
        options['defaultOpen'] = 'openFavorites';
        new ZumoTabComponent('zumoTabs',options);
        </script>
</div>