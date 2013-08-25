
<?php


  echo $this->Html->css('zumo_components');
  echo $this->Html->css('simple_search');
  echo $this->Html->script('scriptaculous/scriptaculous');
  echo $this->Html->script('zumo_components');


?>

<style>

</style>

<div class="plainContent">

	<p class="semititle">Busqueda de inmuebles</p>
    <?php echo $this->Form->create('PropertySearch'); ?>
        <p class="semititle">Operaci&oacute;n</p>
        <div class="property_abalible_type">
            <?php 
                $options = array('buy' => 'Compra', 'rent' => 'Renta', 'both'=>'Cualquiera');
                $attributes = array('legend' => false);
                echo $this->Form->radio('abalible_type', $options,$attributes);
            ?>
        </div>
	   <p class="semititle">Ubicaci&oacute;n</p>
       <div class="input_select">
            <label>Estado</label>
            <?php echo $this->Form->select('state', $states,array('class' => 'selectZumo')); ?>
        </div>
        <div class="input_select">
            <label>Delegaci&oacute;n o Municipio</label>
            <?php $options = array();
                echo $this->Form->select('municipality', $options,array('class' => 'selectZumo'));
            ?>
        </div>
        <div class="input_select" style="margin-top: 10px;">
            <label>Colonia</label>
            <?php $options = array();
                echo $this->Form->select('quarter', $options,array('class' => 'selectZumo'));
            ?>
        </div>
        <div class='form_line'>
            <div class="chekbox_group">
                <p class="semititle">Tipo de propiedad</p>
                <?php echo $this->Form->checkbox('any',array('hiddenField' => false)); ?>
                <label>Cualquiera</label>
                <?php echo $this->Form->checkbox('home',array('hiddenField' => false)); ?>
                <label>Casa Sola</label>
                <?php echo $this->Form->checkbox('condominium',array('hiddenField' => false)); ?>
                <label>Condominio</label>
                <?php echo $this->Form->checkbox('department', array('hiddenField' => false)); ?>
                 <label>Departamento</label>
                <?php echo $this->Form->checkbox('villa', array('hiddenField' => false)); ?>
                 <label>Villa</label>
            </div>
            <div class="chekbox_group">
                <p class="semititle">Antig&uuml;edad</p>
                <?php echo $this->Form->checkbox('any',array('hiddenField' => false)); ?>
                <label>Cualquiera</label>
                <?php echo $this->Form->checkbox('used',array('hiddenField' => false)); ?>
                <label>Usado</label>
                <?php echo $this->Form->checkbox('new',array('hiddenField' => false)); ?>
                <label>Nuevo</label>
                <?php echo $this->Form->checkbox('presale', array('hiddenField' => false)); ?>
                 <label>Preventa</label>
            </div>
        </div>
                    

        <p class="semititle">Precio</p>
        <div class="slider_input">
            <div class="slider_container">
                <div id="slider" class="slider">
                    <div class="handle"></div>
                    <div class="handle"></div>
                    <div id="id_range" class="range"></div>
                </div>
            </div>
             <?php echo $this->Form->input('min_price', array('label' => 'Desde','value'=>'el menor precio')); ?>
             <?php echo $this->Form->input('max_price', array('label' => 'Hasta','value'=>'el mayor precio')); ?>
         </div>

    <?php   $options = array( 'label' => 'BUSCAR', 'class'=>'activeButton');
            echo $this->Form->end($options);
    ?>
</div>

<script>

var slider = createSlider($('slider'),{min:0,max:51,step:5},sliderChange);

function sliderChange(values){ 
    if(values.map(Math.round)[0]==0){
        $("PropertySearchMinPrice").value = "el menor precio";
    }else{
        $("PropertySearchMinPrice").value = format_money(values.map(Math.round)[0]);
    }

    if(values.map(Math.round)[1]==51){
        $("PropertySearchMaxPrice").value = "el mayor precio"
    }else{
        $("PropertySearchMaxPrice").value = format_money(values.map(Math.round)[1]);
    }
}

function format_money(value){
    //TODO poner las comas
    return "$ "+ value +",000.00";
}

$('PropertySearchState').observe('change',function(){
    new Ajax.Request(
        'http://wowinteractive.com.mx/inmobiliaria_zumo/index.php/PropertyAddress/getMunicipalityForState.json', {
            parameters: {state: $('PropertySearchState').value},
            onSuccess: function(response) {
                obj = response.responseJSON;
                $('PropertySearchMunicipality').update();
                $('PropertySearchQuarter').update();

                $('PropertySearchMunicipality').insert({
                    bottom: new Element('option', {value: ''}).update('')
                });

                $(obj).each(function(value){
                    console.log(value);
                    $('PropertySearchMunicipality').insert({
                        bottom: new Element('option', {value: value}).update(value)
                    });
                });
            }
        }
    );
});

$('PropertySearchMunicipality').observe('change',function(){
    new Ajax.Request(
        'http://wowinteractive.com.mx/inmobiliaria_zumo/index.php/PropertyAddress/getQuartersForMunicipality.json', {
            parameters: {municipality: $('PropertySearchMunicipality').value},
            onSuccess: function(response) {
                obj = response.responseJSON;
                $('PropertySearchQuarter').update();
                $('PropertySearchQuarter').insert({
                    bottom: new Element('option', {value: ''}).update('')
                });

                $(obj).each(function(value){
                    console.log(value);
                    $('PropertySearchQuarter').insert({
                        bottom: new Element('option', {value: value}).update(value)
                    });
                });
            }
        }
    );
});

</script>