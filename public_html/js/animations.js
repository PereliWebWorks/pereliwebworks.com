var messageWidth = 20; //In %
var animateBoxWidth = 40; //In %
var controller = new ScrollMagic.Controller();


$(()=>{
	var swipeDuration = 1500;
	//Create wipe animation and scroll animation
	var currentPanel = 1; //Current panel we're looking at. Doesn't change until next panel is fully faded in
	$(".panel").each((i, e) => {
		var id = $(e).data("p-num");
		$layout = $("#panel-" + id + "-layout");
		if (i !== 0){ //Don't do swipe animation for first panel
			var fromX;
			var fromBSX;
			if (i % 2 === 1){
				fromX = "-100%";
				toX = "0%";
				fromBSX = "50px";
			}
			else{
				fromX = "0%";
				toX = "-50%";
				fromBSX = "-50px"
			}
			var wipeAnimation = new TimelineMax().fromTo(e, 1, 
							{x: fromX, opacity: 0 /*boxShadow: fromBSX + " -50px 10px 5px rgba(0,0,0,.3);"*/}, 
							{x: toX, opacity: 1, /*boxShadow: "0px 0px 10px 5px rgba(0,0,0,.3);",*/ ease: Power1.easeOut});
			var wipeScene = new ScrollMagic.Scene({
					triggerElement: $("#panel-wipe-trigger-" + id),
					triggerHook: "onLeave",
					duration: swipeDuration
				})
				.setTween(wipeAnimation)
				.addTo(controller);
			/*
				These events help control the paralx effect.
				The parallax scroll event listener checks to see which panel is the "current panel",
				and only applies the effect to that panel.
				During the wipe animation, there is no current panel.
				After the wipe animation completes, the current panel is set to whichever panel is now visible.
			*/
			wipeScene.on("start", (event)=>{
				if (event.scrollDirection === "FORWARD"){
					currentPanel = false;
					return;
				}
				var triggered = $(event.target.triggerElement()).data("triggers") - 1; //the panel triggered by the event
				currentPanel = triggered;
			});
			wipeScene.on("end", (event)=>{
				if (event.scrollDirection === "REVERSE"){
					currentPanel = false;
					return;
				}
				var triggered = $(event.target.triggerElement()).data("triggers"); //the panel triggered by the event
				currentPanel = triggered;
			});
		}
		var toLeft1;
		var toLeft2;
		if (i % 2 === 0){
			toLeft1 = "-=200px";
			toLeft2 = "+=200px";
		}
		else{
			toLeft1 = "+=200px";
			toLeft2 = "-=200px";
		}
		//Add scroll effects
		var animation = new TimelineMax()
					.to($(e).find("img"), 2, {top: "-=500px", left: toLeft1, ease:Power1.easeOut})
					.to($(e).find("img"), 2, {top: "-=500px", left: toLeft2, ease:Power1.easeInOut});
		new ScrollMagic.Scene({
			triggerElement: $layout.find(".start-scroll-trigger"),
			triggerHook: "onLeave",
			duration: $layout.find(".end-scroll-trigger").offset().top - $layout.find(".start-scroll-trigger").offset().top
		})
		.setTween(animation)
		.addTo(controller);
	});


	


	//Animate example sites
	var animation = new TimelineMax()
		.staggerFromTo($(".site-example, #site-example-header"), 1, 
					{left: "-100%", top: "100vH", opacity: 0},
					{left: "0", top: "12vH", opacity: 1, ease: Elastic.easeOut.config(1, .75)},
				.2)
		.staggerTo($(".site-example"), .2, 
					{scale: 1.1, yoyo: true, repeat: 1}, .2)
		/*
		.staggerTo($(".site-example"), .2, 
					{scale: 1, ease: Elastic.easeInOut}, .5)
		.staggerTo($(".site-example"), .2, 
					{scale: 1.1, ease: Elastic.easeInOut}, .5)
		.staggerTo($(".site-example"), .2, 
					{scale: 1, ease: Elastic.easeInOut}, .5)
		*/
		.staggerTo($(".site-example, #site-example-header"), 1, 
					{left: "100%", top: "100vH", opacity: 0, ease: Back.easeIn.config(1)},
				.2);
		new ScrollMagic.Scene({
				triggerElement: $("#site-example-trigger"),
				triggerHook: "onEnter",
				duration: 3000
			})
			.setTween(animation)
			.addTo(controller);
	//Add mouseover animation
	$(".site-example").mouseover(function(){
		TweenMax.to($(this), .3, {scale: 2, zIndex: 100});
	});
	$(".site-example").mouseout(function(){
		TweenMax.to($(this), .3, {scale: 1, zIndex: 1});
	});
	


	//Animate messages
	$(".animate-container").each((i,e)=>{
		var textElement = $(e).find(".animate-box");
		var fromX = i % 2 === 0 ? -animateBoxWidth : 100;
		var toX = i % 2 === 0 ? 100 : -animateBoxWidth;
		var animation = new TimelineMax()
			.fromTo(textElement, 1, 
				{left: fromX + "%", top: "100%", opacity: "0"},
				{left: (50-animateBoxWidth/2)+"%", top: "30%", opacity: "1", ease: Power2.easeOut})
			.to(textElement, 1, 
				{left: toX + "%", top: "100%", opacity: "0", ease: Power2.easeIn, delay: .5});
		new ScrollMagic.Scene({
						triggerElement: $(e).find(".animate-trigger"),
						triggerHook: "onEnter",
						duration: 1500,
					})
					.setTween(animation) // trigger a TweenMax.to tween
					.addIndicators({name: "t" + i}) // add indicators (requires plugin)
					.addTo(controller);

	});
	

	//Animate header
	var animation = new TimelineMax().to($("#main-header"), 1, {opacity: 0});
	new ScrollMagic.Scene({
		triggerElement: $("#main-header-disappear-trigger"),
		triggerHook: "onEnter",
		duration: 600
	})
	.setTween(animation)
	.addTo(controller);
	
	// build scene
});

//Add nice scrolling
	// change behaviour of controller to animate scroll instead of jump
	controller.scrollTo(function (newpos) {
		TweenMax.to(window, 2, {scrollTo: {y: newpos}});
	});

	//  bind scroll to anchor links
	$(document).on("click", "a[href^='#']", function (e) {
		var id = $(this).attr("href");
		if ($(id).length > 0) {
			e.preventDefault();

			// trigger scroll
			controller.scrollTo(id);

				// if supported by the browser we can even update the URL.
			if (window.history && window.history.pushState) {
				history.pushState("", document.title, id);
			}
		}
	});







