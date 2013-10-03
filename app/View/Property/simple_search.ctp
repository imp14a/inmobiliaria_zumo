
<?php


  echo $this->Html->css('zumo_components');
  echo $this->Html->css('simple_search');
  echo $this->Html->script('zumo_components');


?>

<style>

</style>

<div class="plainContent" style="margin-left:10%; margin-left:0;">

    <?php echo $this->Form->create('PropertySearch',array( 'url' =>array('controller'=>'Property','action'=>'searchResult'))); ?>
        <p class="semititle">Operaci&oacute;n</p>
        <div class="property_abalible_type" id="property_abalible_type">
            <?php 
                $options = array('sale' => 'Compra', 'rent' => 'Renta');
                $attributes = array('legend' => false,'value'=>'rent');
                echo $this->Form->radio('PropertySearch.available_type', $options,$attributes);
            ?>
        </div>
        <p class="semititle">Ubicaci&oacute;n</p>
        <div class="input_select">
            <label>Estado</label>
            <div class="selectZumo">
                <label for="PropertySearchState"></label>
                <?php echo $this->Form->select('state', $states, array('class' => false)); ?>
            </div>
        </div>
        <div class="input_select">
            <label>Delegaci&oacute;n o Municipio</label>
            <div class="selectZumo">
                <label for="PropertySearchMunicipality"></label>
                <?php echo $this->Form->select('municipality', array(), array('div' => false)); ?>
            </div>
        </div>
        <div class="input_select" style="margin-top: 10px;">
            <label>Colonia</label>
            <div class="selectZumo">
                <label for="PropertySearchQuarter"></label>
                <?php echo $this->Form->select('quarter', array(), array('div' => false)); ?>
            </div>
        </div>
        <div class='form_line'>
            <div class="chekbox_group" id='type_checkboxes'>
                <p class="semititle">Tipo de propiedad</p>
                <?php echo $this->Form->checkbox('PropertySearch.Type.any',array('hiddenField' => false,'checked')); ?>
                <label for="PropertySearchTypeAny">Cualquiera</label>
                <?php echo $this->Form->checkbox('PropertySearch.Type.Casa_Sola',array('hiddenField' => false)); ?>
                <label for="PropertySearchTypeCasaSola">Casa Sola</label>
                <?php echo $this->Form->checkbox('PropertySearch.Type.Casa_Condominio',array('hiddenField' => false)); ?>
                <label for="PropertySearchTypeCasaCondominio">Casa Condominio</label>
                <?php echo $this->Form->checkbox('PropertySearch.Type.Departamento', array('hiddenField' => false)); ?>
                 <label for="PropertySearchTypeDepartamento">Departamento</label>
                <?php echo $this->Form->checkbox('PropertySearch.Type.Villa', array('hiddenField' => false)); ?>
                 <label for="PropertySearchTypeVilla">Villa</label>
            </div>
            <div class="chekbox_group" id='antiquity_checkboxes'>
                <p class="semititle">Antig&uuml;edad</p>
                <?php echo $this->Form->checkbox('PropertySearch.Antiquity.any',array('hiddenField' => false,'checked')); ?>
                <label for="PropertySearchAntiquityAny">Cualquiera</label>
                <?php echo $this->Form->checkbox('PropertySearch.Antiquity.Usado',array('hiddenField' => false)); ?>
                <label for="PropertySearchAntiquityUsado">Usado</label>
                <?php echo $this->Form->checkbox('PropertySearch.Antiquity.Nuevo',array('hiddenField' => false)); ?>
                <label for="PropertySearchAntiquityNuevo">Nuevo</label>
                <?php echo $this->Form->checkbox('PropertySearch.Antiquity.Preventa', array('hiddenField' => false)); ?>
                 <label for="PropertySearchAntiquityPreventa">Preventa</label>
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


         <a id="advancedSearch" class="expandButton" href="javascript:void(0);">B&Uacute;SQUEDA AVANZADA</a>
         <div id="expandElements">
            <?php echo $this->Form->hidden('AdvancedSearch.on', array('value'=>0)); ?>
            <div class="line">
                <div class="spinerContainer" >
                    <label class="spiner_title">Rec&aacute;maras</label>
                    <div class="spiner" id="spinerElement">
                        <?php echo $this->Form->input('AdvancedSearch.rooms_number', array('label' => false,'value'=>1,'div'=>false,'readonly')); ?>
                        <span> o m&aacute;s</span>
                        <a href="javascript:void(0);" class="spinerControl up"></a>
                        <a href="javascript:void(0);" class="spinerControl down"></a>
                    </div>
                </div>
                <div class="spinerContainer">
                    <label class="spiner_title">Ba&ntilde;os</label>
                    <div class="spiner">
                        <?php echo $this->Form->input('AdvancedSearch.bathrooms_number', array('label' => false,'value'=>1,'div'=>false,'readonly')); ?>
                        <span> o m&aacute;s</span>
                        <a href="javascript:void(0);" class="spinerControl up"></a>
                        <a href="javascript:void(0);" class="spinerControl down"></a>
                    </div>
                </div>
                <div class="spinerContainer">
                    <label class="spiner_title">Estacionamiento</label>
                    <div class="spiner">
                        <?php echo $this->Form->input('AdvancedSearch.parking_number', array('label' => false,'value'=>1,'div'=>false,'readonly')); ?>
                        <span> o m&aacute;s</span>
                        <a href="javascript:void(0);" class="spinerControl up"></a>
                        <a href="javascript:void(0);" class="spinerControl down"></a>
                    </div>
                </div>
                <div class="spinerContainer">
                    <label class="spiner_title">Niveles</label>
                    <div class="spiner">
                        <?php echo $this->Form->input('AdvancedSearch.levels_number', array('label' => false,'value'=>1,'div'=>false,'readonly')); ?>
                        <span> o m&aacute;s</span>
                        <a href="javascript:void(0);" class="spinerControl up"></a>
                        <a href="javascript:void(0);" class="spinerControl down"></a>
                    </div>
                </div>
             </div>
             <div class="line">
                <div class="spinerContainer">
                    <label class="spiner_title">m<sup>2</sup> de construcci&oacute;n</label>
                    <div class="spiner" step="10">
                        <?php echo $this->Form->input('AdvancedSearch.contruction_meters', array('label' => false,'value'=>10,'div'=>false,'readonly')); ?>
                        <span>m<sup>2</sup> o m&aacute;s</span>
                        <a href="javascript:void(0);" class="spinerControl up"></a>
                        <a href="javascript:void(0);" class="spinerControl down"></a>
                    </div>
                </div>
                <div class="spinerContainer">
                    <label class="spiner_title">m<sup>2</sup> de terreno</label>
                    <div class="spiner" step="10">
                        <?php echo $this->Form->input('AdvancedSearch.contruction_meters', array('label' => false,'value'=>10,'div'=>false,'readonly')); ?>
                        <span>m<sup>2</sup> o m&aacute;s</span>
                        <a href="javascript:void(0);" class="spinerControl up"></a>
                        <a href="javascript:void(0);" class="spinerControl down"></a>
                    </div>
                </div>
             </div>
             <div class="line">
                <div style="width:auto; display:inline-block; margin-right:10px;">
                    <p class="semititle">Otras &Aacute;reas</p>
                    <?php $i=0; foreach($areas as $area):?>
                        <?php if($i%5==0 ): $close_div = 0; ?>
                            <div class="chekbox_group" style="width: auto;">
                        <?php  endif;?>
                        <?php echo $this->Form->checkbox('AdvancedSearch.Areas.'
                            .Inflector::slug($area['PropertyArea']['area_name']),array('hiddenField' => false)); ?>
                            <label for="AdvancedSearchAreas<?php echo Inflector::camelize(
                                    Inflector::slug($area['PropertyArea']['area_name'])
                                ); ?>" > <?php echo $area['PropertyArea']['area_name'];?></label>
                        <?php if($close_div==4): ?>
                            </div>
                        <?php endif; $close_div++;?>
                    <?php $i++; endforeach;?>
                    <?php if($close_div<4): ?>
                        </div>
                    <?endif;?>
                </div>
                <div style="width:auto; display:inline-block;">
                    <p class="semititle">Servicios cercanos</p>
                    <?php $i=0; foreach($services as $service):?>
                        <?php if($i%5==0 ): $close_div = 0; ?>
                            <div class="chekbox_group" style="width: auto;">
                        <?php  endif;?>
                        <?php echo $this->Form->checkbox('AdvancedSearch.Services.'
                            .Inflector::slug($service['PropertyNearPlace']['type']),array('hiddenField' => false)); ?>
                            <label for="AdvancedSearchServices<?php echo Inflector::camelize(
                                    Inflector::slug($service['PropertyNearPlace']['type'])
                                ); ?>" > <?php echo $service['PropertyNearPlace']['type'];?></label>
                        <?php if($close_div==4): ?>
                            </div>
                        <?php endif; $close_div++;?>
                    <?php $i++; endforeach;?>
                    <?php if($close_div<4): ?>
                        </div>
                    <?endif;?>
                </div>
             </div>
        </div>

        <?php   $options = array( 'label' => 'BUSCAR', 'class'=>'activeButton');
        echo $this->Form->end($options);
    ?>
</div>

<script>

var slider = new ZumoSlider('slider',
                    [   'PropertySearchMinPrice',
                        'PropertySearchMaxPrice'
                    ],
                    {
                        rangeValues : [0,15,20,25,30,35,40,50,55],
                        minLabel : "el menor precio",
                        maxLabel : "el mayor precio",
                        concurrency : { coinSimbol: "$",sufijo: ",000.00"}
                    }
                );

createUbicationAjaxSelects('PropertySearchState','PropertySearchMunicipality','PropertySearchQuarter');

new ZumoFirstCheckOnlyElement('type_checkboxes','PropertySearchTypeAny');
new ZumoFirstCheckOnlyElement('antiquity_checkboxes','PropertySearchAntiquityAny');

$$('.spiner').each(function(spiner){
    new ZumoSpiner(spiner);
});

createExpandElement('advancedSearch','expandElements',false,function(event){
   $('AdvancedSearchOn').value = event.expanded;
});

$('property_abalible_type').select('input').each(function(radio){
    $(radio).observe('click',function(){
        if(radio.value == "sale"){
            slider.setRangeValues([0,2,4,5,10,15,20,30,100]);
            slider.setConcurrency({ coinSimbol: "$",sufijo: ",000,000.00"});
        }else{
            slider.setRangeValues([0,2,4,5,10,15,20,30,100]);
            slider.setConcurrency( { coinSimbol: "$",sufijo: ",000.00"});
        }
    });
});

$('PropertySearchSimpleSearchForm').observe('submit',function(event){
    if($('PropertySearchState').value == '' || $('PropertySearchMunicipality').value == ''){
        alert("Debes selecionar el estado y municipio de la búsqueda");
        event.preventDefault();
    }
});

</script>