$(function() {
	$(window).resize(function() {
		var wh = $(window).height();
		var ww = $(window).width();
		$('.abahsoft_layer').css({height:wh,width:ww});
		$('.abahsoft_status_layer').css({top:((wh/2)-($('.abahsoft_status_layer').outerHeight()/2)-10)});
		$('.abahsoft_center_layer').css({left:((ww/2)-225)});
	});
	$(window).resize();
});