
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
    if($('PropertySearchMunicipality').value!=''){
        console.log("entro");
      zoom +=6;
    }
    //aplicamoz zoom
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            map.setZoom(zoom);
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
                    
                    $(obj).each(function(e){
                        position = new google.maps.LatLng(Number(e.Property.latitude),
                                                          Number(e.Property.longitude));
                        console.log(e);
                        console.log(position);
                        var marker = new google.maps.Marker({
                            map: map,
                            position: position,
                            animation: google.maps.Animation.DROP
                        });

                        rent = e.Property.available_for_rent?'Renta '+e.PropertyPaymentInformation.rent_price:'';
                        sell = e.Property.available_for_sell?'Venta '+e.PropertyPaymentInformation.sale_price:'';
                        contector = (rent && sell)?' ,<br />':''; 

                        var infoStrin = e.PropertyDescription.type+',  '+rent+contector+sell+

                        '<br />'+e.PropertyDescription.square_meters_of_construction+' m<sup>2</sup> of contruction';

                        linkMoreInfo = "<a href='"+
                        "<?php echo $this->Html->url(array( "controller" => "property","action" => "view"));?>/"+
                        e.Property.id+"'>+info</a>  ";

                        var contentString = 
                            '<div id="marker_content" style="margin:0;padding: 10px;padding-bottom: 0;">'+
                                '<div id="siteNotice">'+'</div>'+
                                '<span class="firstHeading">'+e.Property.name+'</span>'+
                                '<div id="bodyContent">'+
                                    '<p>'+infoStrin+'</p>'
                                    +linkMoreInfo+
                                '</div>'+
                            '</div>';

                        var infowindow = new google.maps.InfoWindow({
                            content: contentString,
                            maxWidth:300
                        });

                        google.maps.event.addDomListener(infowindow,'domready',function(){
                            $$('div.gm-style-iw').each(function(element){
                                $(element).setStyle({
                                    top:0,
                                    left:0,
                                    width: '100%',
                                    height: '100%',
                                    backgroundColor:'#FFCC00'
                                });
                            });
                        });

                        google.maps.event.addListener(marker, 'click', function() {
                            infowindow.open(map,marker);
                        });
                    });
                }
            }
        );
}

</script>
