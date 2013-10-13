
<?php


  echo $this->Html->css('zumo_components');
  echo $this->Html->css('simple_search');
  echo $this->Html->script('zumo_components');


?>
<style>

</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script>
// Enable the visual refresh
google.maps.visualRefresh = true;

var geocoder;
var map;
var markers = [];
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
      zoom +=6;
    }
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            map.setZoom(zoom);
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
    if( $('PropertySearchQuarter').value == '' ) return false;
    return true;
}
</script>
<div class="plainContent">
  <p class="semititle">Ubicaci&oacute;n</p>
       <div class="input_select" style='width:260px;'>
            <label>Estado</label>
              <div class="selectZumo">
                <label for="PropertySearchState"></label>
                <?php echo $this->Form->select('PropertySearch.state', $states,array('div' => false)); ?>
            </div>
        </div>
        <div class="input_select" style='width:260px;'>
            <label>Delegaci&oacute;n o Municipio</label>
              <div class="selectZumo">
                <label for="PropertySearchMunicipality"></label>
                <?php echo $this->Form->select('PropertySearch.municipality', array(),array('div' => false)); ?>
            </div>
        </div>
        <div class="input_select" style='width:260px;'>
            <label>Colonia</label>
              <div class="selectZumo">
                <label for="PropertySearchQuarter"></label>
                <?php echo $this->Form->select('PropertySearch.quarter', array(),array('div' => false)); ?>
            </div>
        </div>
  <div class="property_abalible_type">
    <p class="semititle" style="margin-top: 10px;">Tipo de Operaci&oacute;n</p>
    <?php
    echo $this->Form->hidden('PropertySearch.abalible_type');
    $options = array('sell' => 'Compra', 'rent' => 'Renta', 'both'=>'Cualquiera');
    $attributes = array('legend' => false,'value'=>'both');
    echo $this->Form->radio('PropertySearch.abalible_type', $options,$attributes);
    ?>
  </div>
  <div id="map-canvas" style="height: 500px;"></div>
</div>
<script>
createUbicationAjaxSelects('PropertySearchState','PropertySearchMunicipality','PropertySearchQuarter');

$('PropertySearchState').observe('change',findNerbyProperties);
$('PropertySearchMunicipality').observe('change',findNerbyProperties);
$('PropertySearchQuarter').observe('change',findNerbyProperties);

$('PropertySearchAbalibleTypeRent').observe('change',updateType);
$('PropertySearchAbalibleTypeSell').observe('change',updateType);
$('PropertySearchAbalibleTypeBoth').observe('change',updateType);

function updateType(element){
    $('PropertySearchAbalibleType').value = $(element.srcElement).value;
    findNerbyProperties();
}

function clearMarkers(){
    while(markers.length>0){
        var m = markers.pop();
        m.setMap(null);
    }
}

function findNerbyProperties(){
    clearMarkers();
    if(!codeAddress())return;
    new Ajax.Request(
            'http://wowinteractive.com.mx/inmobiliaria_zumo/index.php/Property/getPropertyByStateMunicipalityAndQuarter.json', {
                parameters: {
                    state: $('PropertySearchState').value,
                    municipality:$('PropertySearchMunicipality').value,
                    quarter: $('PropertySearchQuarter').value,
                    available_type: $('PropertySearchAbalibleType').value
                },
                onSuccess: function(response) {
                    obj = response.responseJSON;
                    
                    $(obj).each(function(e){
                        position = new google.maps.LatLng(Number(e.Property.latitude),
                                                          Number(e.Property.longitude));
                        var marker = new google.maps.Marker({
                            map: map,
                            position: position,
                            animation: google.maps.Animation.DROP
                        });

                        markers.push(marker);

                        rent_price = formatNumer(e.PropertyPaymentInformation.rent_price);
                        sell_price = formatNumer(e.PropertyPaymentInformation.sale_price);

                        rent = e.Property.available_for_rent?'Renta $ ' + rent_price:'';
                        sell = e.Property.available_for_sell?'Venta $ ' + sell_price:'';
                        
                        contector = (rent!='' && sell!='')?' ,<br />':''; 
                        var infoStrin = e.PropertyDescription.type+'<br />'+rent+contector+sell+
                        '<br />'+e.PropertyDescription.square_meters_of_construction+' m<sup>2</sup> of contruction';

                        linkMoreInfo = "<a href='"+
                        "<?php echo $this->Html->url(array( "controller" => "property","action" => "view"));?>/"+
                        e.Property.id+"' style='font-family: HouschkaPro-Medium; font-style: italic; text-decoration: none;'>+ info</a>  ";

                        var contentString = 
                            '<div id="marker_content" style="margin:0;padding: 10px;padding-bottom: 0;">'+
                                '<div id="siteNotice">'+'</div>'+
                                '<span style="font-family: HouschkaPro-DemiBold;font-size: 16px;">'
                                    +e.Property.name+
                                '</span>'+
                                '<div id="bodyContent">'+
                                    '<p style="font-family: HouschkaPro-Medium;">'+infoStrin+'</p>'
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

    function formatNumer(c){
        var n = Number(c);
       return n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
    }
}

</script>
