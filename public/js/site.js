// JavaScript Document
$(document).ready(function(){
	$('#nav').affix({
		  offset: {
			top: $('header').height()
		  }
	});	
	
	$('#sidebar').affix({
		  offset: {
			top: 280
		  }
	});
	
	<!--Control navigation menu - Drop down on small screen-->
	$('<select class="dropdown"/>').appendTo(".navigation nav div#navigation");
	// Create default option
	$("<option/>", {
		"selected": "selected",
		"value"   : "",
		"text"	: "Go to.."
	}).appendTo("nav select");
		//Populate dropdowns with the first menu items
		$(".navigation nav li a").each(function() {
			var el = $(this);
			$("<option/>", {
				"value"   : el.attr("href"), 
				"text"	:  el.text()  
			}).appendTo("nav select");
		});
	

	
});
