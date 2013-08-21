Event.observe(window, "load", function(){

	$$('.button').each(function(element){
		$(element).observe('mouseover',function(){
			$(this).select('.title')[0].addClassName('buttonOver'); 
		});
		$(element).observe('mouseout',function(){
			$(this).select('.title')[0].removeClassName('buttonOver'); 
		});
	});

});