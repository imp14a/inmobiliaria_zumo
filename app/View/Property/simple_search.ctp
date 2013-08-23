
<?


  echo $this->Html->css('zumo_components');
  echo $this->Html->script('scriptaculous/scriptaculous');
  echo $this->Html->script('zumo_components');


?>

<style>
.property_abalible_type{
  margin-bottom: 20px;
}
.property_abalible_type label{
  margin-right: 20px;
}
.input_select{
    width: 300px;
    display: inline-block;
}
.input_select label{
    font-size: 10px;
    font-style: italic;
    display: block;
}
.chekbox_group{
    width: 300px;
    display: inline-block;
}
.form_line{
    margin-top: 10px;
    margin-bottom: 10px;
    display: block;
}
.slider_input{
    margin-bottom: 20px;
}
.slider_input .slider_container{
    margin-bottom: 20px;
}

.slider_input label{
    width: 40px;
    display: inline-block;
    font-style: italic;
    font-size: 11px;
}
.slider_input input{
    border:0;
    background-color: white;
}
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
            <?php $options = array('México' => 'México', 'Distrito Federal' => 'Distrito Federal');
                echo $this->Form->select('state', $options,array('class' => 'selectZumo'));
            ?>
        </div>
        <div class="input_select">
            <label>Delegaci&oacute;n o Municipio</label>
            <?php $options = array('México' => 'México', 'Distrito Federal' => 'Distrito Federal');
                echo $this->Form->select('state', $options,array('class' => 'selectZumo'));
            ?>
        </div>
        <div class="input_select" style="margin-top: 10px;">
            <label>Colonia</label>
            <?php $options = array('México' => 'México', 'Distrito Federal' => 'Distrito Federal');
                echo $this->Form->select('state', $options,array('class' => 'selectZumo'));
            ?>
        </div>
        <div class='form_line'>
            <div class="chekbox_group">
                <p class="semititle">Tipo de propiedad</p>
                <?php echo $this->Form->checkbox('any',array('hiddenField' => false)); ?>
                <label>Cualquiera</label><br />
                <?php echo $this->Form->checkbox('home',array('hiddenField' => false)); ?>
                <label>Casa Sola</label><br />
                <?php echo $this->Form->checkbox('condominium',array('hiddenField' => false)); ?>
                <label>Condominio</label><br />
                <?php echo $this->Form->checkbox('department', array('hiddenField' => false)); ?>
                 <label>Departamento</label><br />
                <?php echo $this->Form->checkbox('villa', array('hiddenField' => false)); ?>
                 <label>Villa</label><br />
            </div>
            <div class="chekbox_group">
                <p class="semititle">Antig&uuml;edad</p>
                <?php echo $this->Form->checkbox('any',array('hiddenField' => false)); ?>
                <label>Cualquiera</label><br />
                <?php echo $this->Form->checkbox('used',array('hiddenField' => false)); ?>
                <label>Usado</label><br />
                <?php echo $this->Form->checkbox('new',array('hiddenField' => false)); ?>
                <label>Nuevo</label><br />
                <?php echo $this->Form->checkbox('presale', array('hiddenField' => false)); ?>
                 <label>Preventa</label><br />
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
             <?php echo $this->Form->input('min_price', array('label' => 'Desde')); ?>
             <?php echo $this->Form->input('min_price', array('label' => 'Hasta')); ?>
         </div>

    <?php   $options = array( 'label' => 'BUSCAR', 'class'=>'activeButton');
            echo $this->Form->end($options);
    ?>
</div>

<script>

var slider = createSlider($('slider'),{min:15,max:50,step:5},sliderChange);

function sliderChange(value){

}

</script>