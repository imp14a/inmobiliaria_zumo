
<?php


  echo $this->Html->css('zumo_components');
  echo $this->Html->css('simple_search');
  echo $this->Html->script('scriptaculous/scriptaculous');
  echo $this->Html->script('zumo_components');


?>

<style>

</style>

<div class="plainContent">

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
            <div class="chekbox_group" id='type_checkboxes'>
                <p class="semititle">Tipo de propiedad</p>
                <?php echo $this->Form->checkbox('PropertySearch.Type.any',array('hiddenField' => false,'checked')); ?>
                <label for="PropertySearchTypeAny">Cualquiera</label>
                <?php echo $this->Form->checkbox('PropertySearch.Type.home',array('hiddenField' => false)); ?>
                <label for="PropertySearchTypeHome">Casa Sola</label>
                <?php echo $this->Form->checkbox('PropertySearch.Type.condominium',array('hiddenField' => false)); ?>
                <label for="PropertySearchTypeCondominium">Condominio</label>
                <?php echo $this->Form->checkbox('PropertySearch.Type.department', array('hiddenField' => false)); ?>
                 <label for="PropertySearchTypeDepartment">Departamento</label>
                <?php echo $this->Form->checkbox('PropertySearch.Type.villa', array('hiddenField' => false)); ?>
                 <label for="PropertySearchTypeVilla">Villa</label>
            </div>
            <div class="chekbox_group" id='antiquity_checkboxes'>
                <p class="semititle">Antig&uuml;edad</p>
                <?php echo $this->Form->checkbox('PropertySearch.Antiquity.any',array('hiddenField' => false,'checked')); ?>
                <label for="PropertySearchAntiquityAny">Cualquiera</label>
                <?php echo $this->Form->checkbox('PropertySearch.Antiquity.used',array('hiddenField' => false)); ?>
                <label for="PropertySearchAntiquityUsed">Usado</label>
                <?php echo $this->Form->checkbox('PropertySearch.Antiquity.new',array('hiddenField' => false)); ?>
                <label for="PropertySearchAntiquityNew">Nuevo</label>
                <?php echo $this->Form->checkbox('PropertySearch.Antiquity.presale', array('hiddenField' => false)); ?>
                 <label for="PropertySearchAntiquityPresale">Preventa</label>
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
             <?php echo $this->Form->input('min_price', array('label' => 'Desde','value'=>'el menor precio','readonly')); ?>
             <?php echo $this->Form->input('max_price', array('label' => 'Hasta','value'=>'el mayor precio','readonly')); ?>
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

createUbicationAjaxSelects('PropertySearchState','PropertySearchMunicipality','PropertySearchQuarter');

$('type_checkboxes').select('input').each(function(element){
    if(element.id!='PropertySearchTypeAny'){
        $(element).observe('change',function(){
            $('PropertySearchTypeAny').writeAttribute('checked','');
        });
    }
});

$('antiquity_checkboxes').select('input').each(function(element){
    if(element.id!='PropertySearchAntiquityAny'){
        $(element).observe('change',function(){
            $('PropertySearchAntiquityAny').writeAttribute('checked','');
        });
    }
});


$('PropertySearchTypeAny').observe('change',function(){
    if($(this).readAttribute('checked')){
        $(this).up().select("input").each(function(element){
            if(element.id!='PropertySearchTypeAny')
                $(element).writeAttribute('checked','');
        });
    }
});

$('PropertySearchAntiquityAny').observe('change',function(){
    if($(this).readAttribute('checked')){
        $(this).up().select("input").each(function(element){
            if(element.id!='PropertySearchAntiquityAny')
                $(element).writeAttribute('checked','');
        });
    }
});

</script>