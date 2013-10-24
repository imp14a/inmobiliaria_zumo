
  <?php 
    echo $this->Html->script('scriptaculous/scriptaculous');        
    echo $this->Html->css('zumo_components');    
  ?>


<div class="demo">
    <div id="slider" class="slider">
    <div class="handle"></div>
    <div class="handle"></div>
    <div id="id_range" class="range"></div>
</div>


<div class="plainContent">
	<p class="semititle">Registro de inmuebles</p>
	<input type="checkbox" id="chbx-compra" name="chbx-compra" value="">
	<label for="chbx-compra">Compra</label>
	<button class="activeButton">BUSCAR</button>
	<a class="activeButton" href="algo">ENTRAR</a>
	<br>
	<div class="selectZumo">
		<select class="selectZumo">
		    <option>one</option>
		    <option>two</option>
		    <option>something</option>
		    <option>4</option>
		    <option>5</option>
		</select>
	</div>
</div>

<?php echo $this->Html->script('zumo_components'); ?>