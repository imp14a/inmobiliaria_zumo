<?php 
    echo $this->Html->css('zumo_components');
?>
<style>
.column p{
	font-size: 14px;
}
.column label{
	font-size: 14px;
	margin-top: 10px;
	width: 100%;
	display: inline-block;
}
.column. textarea{
	margin-bottom: 30px;
}
</style>
<div class="plainContent" style="padding-left:15%; width:90%;">
	<div class="column" style="width:350px;">
		<p><br>INFO<br>
		<br>Leibnitz 11, piso 3, Col. Anzures,<br/> M&eacute;xico D.F., 11590<br />c. 555 499 2741
		<br /><a href="mailto:contacto@zumoinmobiliaria.com.mx">contacto@zumoinmobiliaria.com.mx</a>
		<br /><a href="www.zumoinmobiliaria.com.mx ">www.zumoinmobiliaria.com.mx</a></p>


		<iframe width="300" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.mx/maps/ms?msa=0&amp;msid=215527590488288234464.0004e90b56578d69f3a9b&amp;ie=UTF8&amp;t=m&amp;ll=19.433248,-99.181137&amp;spn=0.097129,0.102997&amp;z=12&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com.mx/maps/ms?msa=0&amp;msid=215527590488288234464.0004e90b56578d69f3a9b&amp;ie=UTF8&amp;t=m&amp;ll=19.433248,-99.181137&amp;spn=0.097129,0.102997&amp;z=12&amp;source=embed" style="color:#0000FF;text-align:left">Ver en Google Maps </a></small>

	</div>
	<div class="column" style="width:400px; padding-top:30px;"><br>CONTACTO
		<?php echo $this->Form->create('ContactMessage'); ?>
		<br>
		<?php
			echo "<label>Nombre</label>";
			echo $this->Form->input('username', array('label'=>false,'div'=>false));
			echo "<label>Correo Electrónico</label>";
			echo $this->Form->input('email', array('label'=>false,'div'=>false));
			echo "<label>Mensaje</label>";
			echo $this->Form->textarea('message', array('label'=>false,"rows"=>"9"));
		?>
		<?php echo $this->Form->end("ENVIAR"); ?>
	</div>
</div>