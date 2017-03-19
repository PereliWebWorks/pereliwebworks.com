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
	var currentPanel = 1; //Current panel we're looking at. Doesn't change until next panel is fully faded in
	$(".panel").each((i, e) => {
		var id = $(e).data("p-num");
		if (i === 0)
			return true;
		var fromX;
		var fromBSX;
		if (i % 2 === 1){
			fromX = "-100%";
			fromBSX = "50px";
		}
		else{
			fromX = "100%";
			fromBSX = "-50px"
		}
		var wipeAnimation = new TimelineMax().fromTo(e, 1, 
						{x: fromX, opacity: "0" /*boxShadow: fromBSX + " -50px 10px 5px rgba(0,0,0,.3);"*/}, 
						{x: "0%", opacity: "1", /*boxShadow: "0px 0px 10px 5px rgba(0,0,0,.3);",*/ ease: Power1.easeOut});
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
	});
	
	//Create background image motion animation
	/*
	var animation = new TimelineMax()
			.to("#panel_1", 1, {backgroundPositionY: "100px", ease: Linear.easeNone})

	new ScrollMagic.Scene({
						triggerElement: "#panel_1",
						triggerHook: "onLeave",
						duration: 2400
					})
					.setTween(animation)
					.addIndicators({name: "1"})
					.addTo(controller);
	*/
	var lastScrollPos = 0;
	var rate = 10;
	$(document).scroll((e)=>{
		if (!currentPanel)
			return;
		$p = $("#panel_" + currentPanel);
		var offset = panelOffsets[currentPanel-1];
		yOffset = -($(document).scrollTop() - offset) / 8;
		xOffset = -($(document).scrollTop() - offset) / 20;
		if (yOffset > 0)
			yOffset = 0;
		if (xOffset > 0)
			xOffset = 0;
		$p.css("background-position-y", yOffset + "px");
		$p.css("background-position-x", xOffset + "px");
	})
	


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
	
	
	// build scene
});




