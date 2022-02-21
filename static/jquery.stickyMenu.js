$(function($)
{
	var NavY = $('.topcontent').height();
	 
	var stickyNav = function(){
	var ScrollY = $(window).scrollTop();
		  
	if (ScrollY > NavY + 20) { 
		$('nav').addClass('fixed-top');
		console.log("scroled bellow");
	} 
	else if(ScrollY < NavY - 20) {
		$('nav').removeClass('fixed-top'); 
		console.log("scrolling above");
	}
	};
	 
	stickyNav();
	 
	$(window).scroll(function() {
		stickyNav();
	});
});