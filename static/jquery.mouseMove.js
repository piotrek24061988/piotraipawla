var maxNumber = 5;
var number = 0;
var timer1 = 0;
var timer2 = 0;
var hidden = false;
var xDown = null;                                                        
var yDown = null;

//Scrolowanie lewo prawo na telefonie
window.addEventListener('touchstart', handleTouchStart, false);        
window.addEventListener('touchmove', handleTouchMove, false);

function getTouches(evt) {
  return evt.touches ||             // browser API
         evt.originalEvent.touches; // jQuery
}                                                     
                                                                         
function handleTouchStart(evt) {
    const firstTouch = getTouches(evt)[0];                                      
    xDown = firstTouch.clientX;                                      
    yDown = firstTouch.clientY;                                      
};                                                
                                                                         
function handleTouchMove(evt) {
    if ( ! xDown || ! yDown ) {
        return;
    }

    var xUp = evt.touches[0].clientX;                                    
    var yUp = evt.touches[0].clientY;

    var xDiff = xDown - xUp;
    var yDiff = yDown - yUp;
                                                                         
    if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {
        if ( xDiff > 0 ) {
			hideSlide();
			changeSlide();
        } else {
            hideSlide();
			changeSlideOposite();
        }                       
    } else {
        if ( yDiff > 0 ) {
            /* down swipe */ 
        } else { 
            /* up swipe */
        }                                                                 
    }
    /* reset values */
    xDown = null;
    yDown = null;                                             
};

//Przyciski lewo prawo na komputerze
window.addEventListener('keyup', (event) => {
  var name = event.key;
  var code = event.code;

  if(code == 'ArrowLeft') {
	 console.log('przycisk strzałki lewej'); 
	 hideSlide();
	 changeSlideOposite();
  } else if (code == 'ArrowRight') {
	  console.log('przycisk strzałki prawej');
	  hideSlide();
	  changeSlide();
  }
}, false);

window.onload = function() {
	changeSlide();
};

function resetTimers() {
    clearTimeout(timer1);
    clearTimeout(timer2);
    timer1 = setTimeout("hideSlide()", 5000);
    timer2 = setTimeout("changeSlide()", 8000);
}

function hideSlide() {
     $('.aktualnosc').fadeOut();
	hidden = true;
}

function changeSlide() {
    number++;
    if(number > maxNumber) number = 1;

    replaceSlide(number);
    resetTimers();
}

function changeSlideOposite() {
    number--;
    if(number == 0) number = maxNumber;

    replaceSlide(number);
    resetTimers();
}

function replaceSlide(slideNumber) {
	$('.oltarz').fadeOut();
	$('.korytarz').fadeOut();
	$('.organy').fadeOut();
	$("#aktualnosc" + number).fadeIn();
	hidden = false;	
}

//Poruszanie sie myszką po zdjęciu kościoła
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
			if(hidden){
				$('.oltarz').fadeIn();
				$('.aktualnosc').fadeOut();
			}
			resetTimers();
		}
		else if((event.pageX > screenWidth/3 + 25) && (event.pageX < screenWidth/2 - 25)
			&& (event.pageY > heighMin) && (event.pageY < heighMax))
		{
			console.log('korytarz widoczny');
			$('.oltarz').fadeOut();
			$('.organy').fadeOut();
			if(hidden){
				$('.korytarz').fadeIn();
				$('.aktualnosc').fadeOut();
			}
			resetTimers();
		}
		else if((event.pageX > screenWidth/2 + 25) && (event.pageX < screenWidth*2/3 - 25)
			&& (event.pageY > heighMin) && (event.pageY < heighMax))
		{
			console.log('organy widoczne');
			$('.oltarz').fadeOut();
			$('.korytarz').fadeOut();
			if(hidden){
				$('.organy').fadeIn();
				$('.aktualnosc').fadeOut();
			}
			resetTimers();
		} else {
			console.log('zdjęcia niewidoczne');
			$('.oltarz').fadeOut();
			$('.korytarz').fadeOut();
			$('.organy').fadeOut();
		}
    });
});