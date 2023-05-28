$(function(){
	$('#chart li').each(function(){
		//animate Length
		var pc = $(this).attr('title');
		pc = pc > 100 ? 100 : pc;
		var ww = $(this).width();
		var len = parseInt(ww, 10)*parseInt(pc, 10)/100;
		$(this).children('.bar').animate({'width':len+'px'}, 2500);
		$(this).children('.percent').html(pc+'%');
		
		//put hover effect on percentages
		$(this).children('.percent').hover(
			function() {
			var votes = $(this).attr('title');
			var s = (votes==1)?"":"s";
			$(this).text(votes+" vote"+s);
			},
			function(){
			$(this).text(pc+'%');
		});
	});
});
