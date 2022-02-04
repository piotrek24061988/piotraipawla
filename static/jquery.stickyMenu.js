$(function($)
{
	var NavY = $('.topcontent').height();
	 
	var stickyNav = function(){
	var ScrollY = $(window).scrollTop();
		  
	if (ScrollY > NavY) { 
		$('nav').addClass('fixed-top');
		console.log("scroled bellow");
	} 
	else {
		$('nav').removeClass('fixed-top'); 
		console.log("scrolling above");
	}
	};
	 
	stickyNav();
	 
	$(window).scroll(function() {
		stickyNav();
	});
});