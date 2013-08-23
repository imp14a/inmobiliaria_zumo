<script src="/inmobiliaria_zumo/app/webroot/js/scriptaculous/scriptaculous.js" type="text/javascript"></script>


<style type="text/css">
  div.slider { width:256px; margin:0px 0; background-color:#ccc; height:3px; position: relative; }
  div.slider div.handle { 
  	width:15px; height:15px; cursor:move; position: absolute; 
  	background: url('/inmobiliaria_zumo/app/webroot/css/img/level_slider.png') no-repeat;
  	top: -6px;
  }
  div.slider div.range {
	background-color: #FFCC00;
	height: 3px;
  }
</style>

<div class="demo">
    <div id="slider" class="slider">
    <div class="handle"></div>
    <div class="handle"></div>
  	<div id="id_range" class="range"></div>
</div>

<script type="text/javascript">
  (function() {
    var slider = $('slider');
    var id_range = $('id_range');
    var max;
    var min; 

    new Control.Slider(slider.select('.handle'), slider, {
      range: $R(0, 255),
      sliderValue: [0, 255],
      onSlide: function(values) {
      	max = values.map(Math.round)[1] >= values.map(Math.round)[0] ? values.map(Math.round)[1] : values.map(Math.round)[0];
      	min = values.map(Math.round)[1] <= values.map(Math.round)[0] ? values.map(Math.round)[1] : values.map(Math.round)[0];
		id_range.setStyle({
			'margin-left': min + 'px',
			'width': (max - min) + 'px'
		});
      },
      onChange: function(values) { 
      }
    });
  })();
</script>
<div class="plainContent">
	<p class="semititle">Registro de inmuebles</p>
	<input type="checkbox" id="chbx-compra" name="chbx-compra" value="">
	<label for="chbx-compra">Compra</label>
	<button class="activeButton">BUSCAR</button>
	<a class="activeButton">ENTRAR</a>
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

	<?php 
		
	?>

</div>