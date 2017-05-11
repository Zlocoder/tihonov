//initialisation for functions down 
$(window).on('load', function(){
    
	preloader();
	new WOW().init();
});

//найти, что это такое
var aaSnowConfig = {snowflakes: '200'};

$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });

// Initialize collapse button
  $(".button-collapse").sideNav();
  // Initialize collapsible (uncomment the line below if you use the dropdown variation)
  //$('.collapsible').collapsible();

//on load preloader effect
function preloader(){
	var $preloader = $('#page-preloader'),
	    $orders = $('.orders-more-activator'),
        $spinner   = $preloader.find('.spinner');

	    $preloader.delay(1500).fadeOut('slow');
}
