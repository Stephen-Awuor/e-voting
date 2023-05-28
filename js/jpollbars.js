$(function(){
	$("div[id^='bar-']").each(function(){
		var lbl = $(this).find('#label').val()
		var val = $(this).find('#value').val()
		var color = $(this).find('#barColor').val()
		$(this).jqbar({label: lbl, value:val, barColor:color});
	});
});
