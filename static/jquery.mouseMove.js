$(function($)
{
    $(window).mousemove(function(event) {
		var screenHeight = $(window).height();
		var screenWidth = $(window).width();
		var heighMin = 480;
		var heighMax = 1000;
		var widthMinAllowed = 750;
		var heighMinAllowed = 700;
    	console.log(screenHeight);
    	console.log(screenWidth);
		if(screenWidth <= widthMinAllowed || screenHeight <= heighMinAllowed) {
			console.log('brak efektu na małym ekranie');
			$('.oltarz').fadeOut();
			$('.korytarz').fadeOut();
			$('.organy').fadeOut();
		}
		else if((event.pageX > screenWidth/5) && (event.pageX < screenWidth/3 - 25)
			&& (event.pageY > heighMin) && (event.pageY < heighMax))  
		{
			console.log('oltarz widoczny');
			$('.korytarz').fadeOut();
			$('.organy').fadeOut();
			$('.oltarz').fadeIn();
		}
		else if((event.pageX > screenWidth/3 + 25) && (event.pageX < screenWidth/2 - 25)
			&& (event.pageY > heighMin) && (event.pageY < heighMax))
		{
			console.log('korytarz widoczny');
			$('.oltarz').fadeOut();
			$('.organy').fadeOut();
			$('.korytarz').fadeIn();
		}
		else if((event.pageX > screenWidth/2 + 25) && (event.pageX < screenWidth*2/3 - 25)
			&& (event.pageY > heighMin) && (event.pageY < heighMax))
		{
			console.log('organy widoczne');
			$('.oltarz').fadeOut();
			$('.korytarz').fadeOut();
			$('.organy').fadeIn();
		} else {
			console.log('zdjęcia niewidoczne');
			$('.oltarz').fadeOut();
			$('.korytarz').fadeOut();
			$('.organy').fadeOut();
		}
    });
});