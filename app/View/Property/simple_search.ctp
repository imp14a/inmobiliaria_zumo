
<?php


  echo $this->Html->css('zumo_components');
  echo $this->Html->css('simple_search');
  echo $this->Html->script('scriptaculous/scriptaculous');
  echo $this->Html->script('zumo_components');


?>

<style>

</style>

<div class="plainContent">

    <?php echo $this->Form->create('PropertySearch',array( 'url' =>array('controller'=>'Property','action'=>'searchResult'))); ?>
        <p class="semititle">Operaci&oacute;n</p>
        <div class="property_abalible_type">
            <?php 
                $options = array('buy' => 'Compra', 'rent' => 'Renta', 'both'=>'Cualquiera');
                $attributes = array('legend' => false,'value'=>'both');
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
                <div style="width:auto; display:inline-block;">
                    <p class="semititle">Otras &Aacute;reas</p>
                     <div class="chekbox_group" style="width: 120px;">
                        <?php echo $this->Form->checkbox('AdvancedSearch.Areas.dining_room',array('hiddenField' => false)); ?>
                        <label for="AdvancedSearchAreasDiningRoom">Comedor</label>
                        <?php echo $this->Form->checkbox('AdvancedSearch.Areas.kitchen',array('hiddenField' => false)); ?>
                        <label for="AdvancedSearchAreasKitchen">Cocina</label>
                        <?php echo $this->Form->checkbox('AdvancedSearch.Areas.living_room',array('hiddenField' => false)); ?>
                        <label for="AdvancedSearchAreasLivingRoom">Estancia</label>
                        <?php echo $this->Form->checkbox('AdvancedSearch.Areas.tv_room', array('hiddenField' => false)); ?>
                         <label for="AdvancedSearchAreasTvRoom">Sala de TV</label>
                         <?php echo $this->Form->checkbox('AdvancedSearch.Areas.laundry', array('hiddenField' => false)); ?>
                         <label for="AdvancedSearchAreasLaundry">Cuarto de lavado</label>
                    </div>
                    <div class="chekbox_group" style="width: 140px;">
                        <?php echo $this->Form->checkbox('AdvancedSearch.Areas.service_room',array('hiddenField' => false)); ?>
                        <label for="AdvancedSearchAreasServiceRoom">Cuarto de servicio</label>
                        <?php echo $this->Form->checkbox('AdvancedSearch.Areas.study_room',array('hiddenField' => false)); ?>
                        <label for="AdvancedSearchAreasStudyRoom">Estudio</label>
                        <?php echo $this->Form->checkbox('AdvancedSearch.Areas.terrace',array('hiddenField' => false)); ?>
                        <label for="AdvancedSearchAreasTerrace">Terraza</label>
                        <?php echo $this->Form->checkbox('AdvancedSearch.Areas.gym',array('hiddenField' => false)); ?>
                        <label for="AdvancedSearchAreasGym">Gimnasio</label>
                        <?php echo $this->Form->checkbox('AdvancedSearch.Areas.other', array('hiddenField' => false)); ?>
                         <label for="AdvancedSearchAreasOther">Otro</label>
                    </div>
                </div>
                <div style="width:130px; display:inline-block;">
                    <p class="semititle">Servicios cercanos</p>
                     <div class="chekbox_group" style="width: 120px;">
                        <?php echo $this->Form->checkbox('AdvancedSearch.Services.school',array('hiddenField' => false)); ?>
                        <label for="AdvancedSearchServicesSchool">Escuela</label>
                        <?php echo $this->Form->checkbox('AdvancedSearch.Services.bank',array('hiddenField' => false)); ?>
                        <label for="AdvancedSearchServicesBank">Banco</label>
                        <?php echo $this->Form->checkbox('AdvancedSearch.Services.park',array('hiddenField' => false)); ?>
                        <label for="AdvancedSearchServicesPark">Parque</label>
                        <?php echo $this->Form->checkbox('AdvancedSearch.Services.supermarket',array('hiddenField' => false)); ?>
                        <label for="AdvancedSearchServicesSupermarket">Supermercado</label>
                        <?php echo $this->Form->checkbox('AdvancedSearch.Services.hospital', array('hiddenField' => false)); ?>
                         <label for="AdvancedSearchServicesHospital">Hospital</label>
                    </div>
                </div>
             </div>
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

createFirstCheckOnlyElement('type_checkboxes','PropertySearchTypeAny');

createFirstCheckOnlyElement('antiquity_checkboxes','PropertySearchAntiquityAny');

$$('.spiner').each(function(spiner){
    new ZumoSpiner(spiner);
});

createExpandElement('advancedSearch','expandElements',false,function(event){
   $('AdvancedSearchOn').value = event.expanded;
});

</script>