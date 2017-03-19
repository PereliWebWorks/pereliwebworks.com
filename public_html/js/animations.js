var messageWidth = 20; //In %
var controller = new ScrollMagic.Controller();


$(()=>{
	var swipeDuration = 1500;
	panelOffsets = [0, ...$(".panel-wipe-trigger").map(
				(i, e)=> {
					return $(e).offset().top + swipeDuration;
				}
			)];
	//console.log(panelOffsets);
	//Create wipe animation
	//Also add scroll animation
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
					.to($(e).find("img"), 2, {top: "-=500px", left: toLeft2, ease:Power1.easeIn});
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
		.staggerFromTo($(".site-example"), 1, 
					{left: "0", top: "100vH", opacity: 0},
					{left: "40%", top: "50vH", opacity: 1, ease: Elastic.easeOut.config(1, .75)},
				.2)
		.staggerTo($(".site-example"), 1, 
					{left: "100%", top: "100vH", opacity: 0, ease: Back.easeIn.config(1), delay: 4},
				.2);
		new ScrollMagic.Scene({
				triggerElement: $("#site-example-trigger"),
				triggerHook: "onEnter",
				duration: 2000
			})
			.setTween(animation)
			.addTo(controller);
	


	//Animate messages
	
	$(".animate-container").each((i,e)=>{
		var textElement = $(e).find(".animate-text");
		var fromX = i % 2 === 0 ? -messageWidth : 100;
		var toX = i % 2 === 0 ? 100 : -messageWidth;
		var animation = new TimelineMax()
			.fromTo(textElement, 1, 
				{left: fromX + "%", top: "100%", opacity: "0"},
				{left: (50-messageWidth/2)+"%", top: "50%", opacity: "1", ease: Power2.easeOut})
			.to(textElement, 1, 
				{left: toX + "%", top: "100%", opacity: "0", ease: Power2.easeIn});
		new ScrollMagic.Scene({
						triggerElement: $(e).find(".animate-trigger"),
						triggerHook: "onEnter",
						duration: 1300,
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
		duration: 1000
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




