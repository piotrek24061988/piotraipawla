$(function($)
{
	var NavY = $('.topcontent').height();
	 
	var stickyNav = function(){
	var ScrollY = $(window).scrollTop();
	var widthMinAllowed = 750;
	var screenWidth = $(window).width();
		  
	if (ScrollY > NavY) { 
		$('nav').addClass('fixed-top');
		if(screenWidth <= widthMinAllowed) {
			$('nav').addClass('ml-3 mr-3');
		}
		console.log("scroled bellow");
	} 
	else if(ScrollY <= NavY) {
		$('nav').removeClass('fixed-top'); 
		if(screenWidth <= widthMinAllowed) {
			$('nav').removeClass('ml-3 mr-3');
		}
		console.log("scrolling above");
	}
	};
	 
	stickyNav();
	 
	$(window).scroll(function() {
		stickyNav();
	});
});