/*
Animate scroll code and add offset for header
*/
if ( $(window).width() > 768) { 
	$('a').click(function(){
    	$('html, body').animate({
        	scrollTop: $( $.attr(this, 'href') ).offset().top -80
    	}, 500);
		event.preventDefault()
	});
}
else {
	$('a').click(function(){
    	$('html, body').animate({
        	scrollTop: $( $.attr(this, 'href') ).offset().top -82
    	}, 500);
		event.preventDefault()
	});
}
/*
End Animate scroll code and add offset for header
*/

/*
Fix to set selected nav option to class active
*/
$('.nav li a').on('click', function() {
    $(this).parent().parent().find('.active').removeClass('active');
    $(this).parent().addClass('active');
    $('.navbar-collapse').removeClass('in').addClass('collapse'); 
});/*
End Fix to set selected nav option to class active
*/

/*
initiate wow.js which is used to delay animate.css animations until on screen
*/
new WOW().init();

/*
This code is used to run the button that moves user back to top of screen when scrolling
*/
if ( ($(window).height() + 100) < $(document).height() ) {
    $('#top-link-block').removeClass('hidden').affix({
        // how far to scroll down before link "slides" into view
        offset: {top:100}
    });
}

/*
This code is used to enable carousel swiping. Not working!!
*/
 $(window).load(function(){
    $("#myCarousel").touchwipe({
        wipeLeft: function() { $("#myCarousel").carousel('next'); },
        wipeRight: function() { $("#myCarousel").carousel('prev'); }
    });
});
