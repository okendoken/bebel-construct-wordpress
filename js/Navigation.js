(function($) {

	$.fn.spasticNav = function(options) {
	
		options = $.extend({
			overlap : 20,
			speed : 500,
			reset : 300,
			color : '#0b2b61',
			easing : 'easeOutExpo'
		}, options);
	
		return this.each(function() {


	 		$('#nav ul li ul li').removeClass('current-menu-item');
	 		$('#nav ul li ul li').removeClass('current-menu-parent');

		 	if ($('#nav ul li').hasClass('current-menu-item')){
		 	}else{
		 		$("#nav ul li").addClass("notcurrent");
		 	}
		 	if ($('#nav ul li').hasClass('current-menu-parent')){
		 		$("#nav ul li").removeClass("notcurrent");
		 	}
	 		
		 	if ($('#nav ul li').hasClass('current-menu-item') || $('#nav ul li').hasClass('current-menu-parent')){

		 	var nav = $(this),
		 		currentPageItem = $('.current-menu-item a,.current-menu-parent a'),
		 		blob,
		 		reset;
		 	
		 	$('<li id="blob"></li>').css({
		 		width : currentPageItem.outerWidth(),
		 		height : currentPageItem.outerHeight() + options.overlap,
		 		left : currentPageItem.position().left,
		 		top : currentPageItem.position().top - options.overlap / 2,
		 		backgroundColor : options.color
		 	}).appendTo(this);

	 		$('#nav ul li ul #blob').remove();
		 	
		 	blob = $('#blob', nav);
				reset = setTimeout(function() {
					blob.animate({
						width : currentPageItem.outerWidth(),
						left : currentPageItem.position().left
					}, options.speed)
				}, options.reset);
					 	
			$('li:last-child').prev("li").addClass("slide-last");
					 	
			$('li:not(#blob)', nav).hover(function() {
				// mouse over
				$("#nav ul").find(".current-menu-item").addClass("afterslide");
				$("#nav ul").find(".current-menu-parent").addClass("afterslide");
				clearTimeout(reset);
				blob.animate(
					{
						left : $(this).position().left,
						width : $(this).width()
					},
					{
						duration : options.speed,
						easing : options.easing,
						queue : false
					}
				);
			}, function() {
				// mouse out
				reset = setTimeout(function() {
					blob.animate({
						width : currentPageItem.outerWidth(),
						left : currentPageItem.position().left
					}, options.speed);
					$("#nav ul").find(".current-menu-item").removeClass("afterslide");
					$("#nav ul").find(".current-menu-parent").removeClass("afterslide");
				}, options.reset);
			});
					 	
			$('li:not(#blob)', "#nav ul li ul").hover(function() {
				
				var palef = $(this).parent().parent().position().left;
				var pawid = $(this).parent().parent().width();
				
				// mouse over
				clearTimeout(reset);
				blob.animate(
					{
						left : palef,
						width : pawid
					},
					{
						duration : options.speed,
						easing : options.easing,
						queue : false
					}
				);
			});
					 	
			$('li:not(#blob)', "#nav ul li ul li ul").hover(function() {
				
				var palef = $(this).parent().parent().parent().parent().position().left;
				var pawid = $(this).parent().parent().parent().parent().width();
				
				// mouse over
				clearTimeout(reset);
				blob.animate(
					{
						left : palef,
						width : pawid
					},
					{
						duration : options.speed,
						easing : options.easing,
						queue : false
					}
				);
			});
	 	}
		}); // end each
	
	};

					 	
			$("#nav > div > ul > li > ul").prepend('<li class="arrow-up"></li>');
			$("#nav > div > ul > li > ul").prepend('<li class="firstsub"></li>');

			$( "#nav > div > ul > li > ul" ).each(function() {
				var ulwidth = $(this).outerWidth();
				var liwidth = $(this).parent().outerWidth();
				var mulwidth = ((ulwidth/2)-(liwidth/2))+7;
				$(this).css({"margin-left":-mulwidth});
			});
})(jQuery);