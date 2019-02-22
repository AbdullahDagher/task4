
$(document).ready(function(){

	//BACK TO TOP
	var offset = 800,
	//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
	offset_opacity = 1200,
	//duration of the top scrolling animation (in ms)
	scroll_top_duration = 700,
	//grab the "back to top" link
	$back_to_top = $('.cd-top');

	//hide or show the "back to top" link
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('cd-fade-out');
		}
	});

	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});

	//loader
	$(window).on("load", function(){
		setTimeout(function(){
			$("#loader").css("display", "none")
		}, 1000);

	});


	//top margin
	var headerH = $("#header").outerHeight(true);
	$(".goUnderHeader").css("marginTop", "-" + headerH + "px");
	$(window).on("resize", function(){
		var headerH = $("#header").outerHeight(true);
		$(".goUnderHeader").css("marginTop", "-" + headerH + "px");
	});
	//afix
	$('.myAffix').affix({
	  offset: {
	    top: 29,
	  }
	});
	
	$('.myAffix').on('affix.bs.affix', function() {
		$("#repHeader").css("height", $('.myAffix').outerHeight(true) + "px");
	});

	//NAV ICON
	$("#IeeeLinksNavIcon").click(function(){
		$("#IeeeLinksNavIcon .navIcon, #ieeeLinksWrap").toggleClass('open');
		if(!$(".ieeeLogo").hasClass("open")){
			setTimeout(function(){
				$(".ieeeLogo").addClass("open");
			}, 500);

			$("#ieeeLinks li").each(function(i){
				var that = $(this);
				
				var t = setTimeout(function(){
					that.addClass("open");
				}, 700 + 400*i - 200 * ((i)? 1 : 0) );
				console.log(i + this);
			});
		}else
			$(".ieeeLogo, #ieeeLinks li").removeClass("open");
		
/*
		for (var i = 0; i < $("#ieeeLinks li").length; i++) {
			setTimeout(function(){
				$("#ieeeLinks li")[i].toggleClass('open');
			}, 500 + 400*(i) - 100)
		};
*/
	});


	//menu
	$("#topNavMenuIcon").click(function(){
		$("#topNav").slideToggle();
	});
	$("#topNav > ul .ddIcon").click(function(event){
		if($(window).width() < 1200){
			event.preventDefault();
			$(this).parent().find("ul").slideToggle();
		}
	});

	$(window).on("resize", function(){
		if($(window).width() >= 1200){
			$("#topNav, #topNav .dropdowmMenu").css("display", "inline-block");
		}else {
			$("#topNav, #topNav .dropdowmMenu").css("display", "none");
			
		}
	});

});

