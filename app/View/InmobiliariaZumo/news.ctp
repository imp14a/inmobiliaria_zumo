

<style>
.twitter-timeline{
	width:90%;
	margin-left: 5%;
}
</style>
<div class="plainContent" id="timelineContainer" >
	<?php 
	echo $this->Html->link(
		$this->Html->image("twitter_logo.png", array("alt" => "Twitter")),"https://twitter.com/ZumoOficial",
		array("style"=>"margin-left:5%;",'escape' => false) ); ?>
	<a class="twitter-timeline" id="timeline" data-dnt="true" href="https://twitter.com/ZumoOficial" data-widget-id="391309325060173825" data-tweet-limit="5" data-chrome="nofooter noheader noborders" >Tweets by @ZumoOficial</a>
	<script>

	//$('timeline').writeAttribute('width',$('timelineContainer').getWidth());
	//console.log($('timelineContainer').getWidth());

	
	!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
	</script>

</div>

<a class="twitter-timeline" >Tweets by @ZumoOficial</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
