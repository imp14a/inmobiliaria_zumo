
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

var geocoder;
var map;
function initialize() {
  geocoder = new google.maps.Geocoder();
    var mapOptions = {
        zoom: 5,
        center: new google.maps.LatLng(22.913,-101.929),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}

google.maps.event.addDomListener(window, 'load', initialize);

function codeAddress() {
    var address = "Mexico, Estado de " + $('PropertySearchState').value + ',' 
                            + $('PropertySearchMunicipality').value + ',' 
                            + 'Colonia '+$('PropertySearchQuarter').value;

    var zoom =  6;
    if($('PropertyAddressMunicipality').value!=''){
        console.log("entro");
      zoom +=6;
    }
    //aplicamoz zoom
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            map.setZoom(zoom);
            /*var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });*/
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}
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

$('PropertySearchState').observe('change',codeAddress);
$('PropertySearchMunicipality').observe('change',codeAddress);
$('PropertySearchQuarter').observe('change',findNerbyProperties);


function findNerbyProperties(){
    codeAddress();
    new Ajax.Request(
            'http://wowinteractive.com.mx/inmobiliaria_zumo/index.php/Property/getPropertyByStateMunicipalityAndQuarter.json', {
                parameters: {
                    state: $('PropertySearchState').value,
                    municipality:$('PropertySearchMunicipality').value,
                    quarter: $('PropertySearchQuarter').value
                },
                onSuccess: function(response) {
                    obj = response.responseJSON;

                    $(obj).each(function(element){
                        position = new google.maps.LatLng(Number(element.PropertyLocation.latitud),
                                                          Number(element.PropertyLocation.longitud));
                        var marker = new google.maps.Marker({
                            map: map,
                            position: position,
                            animatio: google.maps.Animation.DROP
                        });

                        var contentString = '<div id="content" style="background-color:red; margin:0;">'+
                        '<div id="siteNotice">'+
                        '</div>'+
                        '<h1 id="firstHeading" class="firstHeading">Uluru</h1>'+
                        '<div id="bodyContent">'+
                        '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
                        '</p>'+
                        '<p>Attribution: Uluru, <a href="http://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">'+
                        'http://en.wikipedia.org/w/index.php?title=Uluru</a> '+
                        '(last visited June 22, 2009).</p>'+
                        '</div>'+
                        '</div>';

                        var infowindow = new google.maps.InfoWindow({
                            content: contentString
                        });

                        google.maps.event.addListener(marker, 'click', function() {
                            infowindow.open(map,marker);
                            $$('div.gm-style-iw').each(function(element){
                                $(element).setStyle({
                                    top:0,
                                    left:0
                                });
                            });
                        });
                    });
                }
            }
        );
}

</script>
