
<?php


  echo $this->Html->css('zumo_components');
  echo $this->Html->css('simple_search');
  echo $this->Html->script('scriptaculous/scriptaculous');
  echo $this->Html->script('zumo_components');


?>
    <style>
      #map-canvas {
        margin: 0;
        padding: 0;
        height: 400px;
      }
    </style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script>
// Enable the visual refresh
google.maps.visualRefresh = true;

var map;
function initialize() {
  var mapOptions = {
    zoom: 8,
    center: new google.maps.LatLng(-34.397, 150.644),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
<div class="plainContent">
  <p class="semititle">Ubicaci&oacute;n</p>
       <div class="input_select" style='width:260px;'>
            <label>Estado</label>
            <?php echo $this->Form->select('PropertySearch.state', $states,array('class' => 'selectZumo')); ?>
        </div>
        <div class="input_select" style='width:260px;'>
            <label>Delegaci&oacute;n o Municipio</label>
            <?php $options = array();
                echo $this->Form->select('PropertySearch.municipality', $options,array('class' => 'selectZumo'));
            ?>
        </div>
        <div class="input_select" style='width:260px;'>
            <label>Colonia</label>
            <?php $options = array();
                echo $this->Form->select('PropertySearch.quarter', $options,array('class' => 'selectZumo'));
            ?>
        </div>
  <div class="property_abalible_type">
    <p class="semititle" style="margin-top: 10px;">Tipo de Operaci&oacute;n</p>
    <?php 
    $options = array('buy' => 'Compra', 'rent' => 'Renta', 'both'=>'Cualquiera');
    $attributes = array('legend' => false);
    echo $this->Form->radio('abalible_type', $options,$attributes);
    ?>
  </div>
  <div id="map-canvas"></div>
</div>
<script>
createUbicationAjaxSelects('PropertySearchState','PropertySearchMunicipality','PropertySearchQuarter');
</script>
