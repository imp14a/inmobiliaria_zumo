
<?php 

	echo $this->Html->css('zumo_components');
	echo $this->Html->css('zumo_search_results');
	echo $this->Html->script('scriptaculous/scriptaculous');
	echo $this->Html->script('zumo_components');

?>
<style>

.grid{

}
.grid .gridElement{
	width: 210px;
	height: 160px;
	float: left;
	margin-right: 15px;
	position: relative;
	display: inline-block;
}
.grid .gridElement .mainImage{
	width: 100%;
	height: 100%;
	position: absolute;
	top: 0;
	left: 0;
	z-index: 5;
	background-color: white;
}

.grid .gridElement .information{
	padding-left:10px;
	padding-top:20px;
	background-image: url(/inmobiliaria_zumo/app/webroot/css/img/grid_elements_background.png);
	width: 200px;
	height:140px;
}
.grid .gridElement span{
	display: block;
}

</style>

<div class="plainContent">

	<div class="grid">


                       <!-- rent = e.Property.available_for_rent?'Renta '+e.PropertyPaymentInformation.rent_price:'';
                        sell = e.Property.available_for_sell?'Venta '+e.PropertyPaymentInformation.sale_price:'';
                        contector = (rent && sell)?' ,<br />':''; 

                        var infoStrin = e.PropertyDescription.type+',  '+rent+contector+sell+

                        '<br />'+e.PropertyDescription.square_meters_of_construction+' m<sup>2</sup> of contruction';

                        linkMoreInfo = "<a href='"+
                        "<?php  $this->Html->url(array( "controller" => "property","action" => "view"));?>/"+
                        e.Property.id+"'>+info</a>  ";

                        var contentString = 
                            '<div id="marker_content" style="margin:0;padding: 10px;padding-bottom: 0;">'+
                                '<div id="siteNotice">'+'</div>'+
                                '<span class="firstHeading">'+e.Property.name+'</span>'+
                                '<div id="bodyContent">'+
                                    '<p>'+infoStrin+'</p>'
                                    +linkMoreInfo+
                                '</div>'+
                            '</div>';-->


		<?php foreach($found_properties as $property): ?>

		<div class="gridElement">
			<img class="mainImage" />
			<div class="information">
				<span><?php echo $property['Property']['name']; ?></span>
				<span><?php echo $property['PropertyDescription']['type']; ?></span>
				<?php if($property['Property']['available_for_rent']): ?>
					<span>Renta :<?php echo $this->Number->currency($property['PropertyPaymentInformation']['rent_price']); ?></span>
				<?php endif;?>
				<?php if($property['Property']['available_for_sell']): ?>
					<span>Venta :<?php echo $this->Number->currency($property['PropertyPaymentInformation']['sale_price']); ?></span>
				<?php endif;?>
				<span><?php echo $property['PropertyDescription']['square_meters_of_construction']; ?> m<sup>2</sup> de construcci&oacute;</span>
				<?php 
				echo $this->Html->link("+ info",array( "controller" => "property","action" => "view",$property['Property']['id'])); 
				?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>

<script>
$$('.gridElement').each(function(element){
	new ZumoGridElement(element);
});
</script>

</div>