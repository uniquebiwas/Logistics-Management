$( document ).ready(function() {

	// Search Toggle
	$(".search i").click(function(){
		$(".search-toggle").toggleClass('open');
	});


	// Mobile Nav
	$("#menu1").metisMenu();
	$(".toggle-btn, .close-btn").click(function(){
		$(".mobile-menu").toggleClass('open');
	});


// Carousal
$('.carousel').carousel({
	interval: 5000,
	margin:0,
})


// Accordian
$("#accordion").on("hide.bs.collapse show.bs.collapse", e => {
	$(e.target)
	.prev()
	.find("i:last-child")
	.toggleClass("fa-minus fa-plus");
});


// Scroll Top Js
$(function(){
		// Scroll Event
		$(window).on('scroll', function(){
			var scrolled = $(window).scrollTop();
			if (scrolled > 800) $('.go-top').addClass('active');
			if (scrolled < 800) $('.go-top').removeClass('active');
		});  
		// Click Event
		$('.go-top').on('click', function() {
			$("html, body").animate({ scrollTop: "0" },  500);
		});
	});

	// WOW Animation JS
	if($('.wow').length){
		var wow = new WOW({
			mobile: false
		});
		wow.init();
	}
// Scroll Top Js ENd


});