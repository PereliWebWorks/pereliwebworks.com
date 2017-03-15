var messageWidth = 20; //In %

var controller = new ScrollMagic.Controller();

$(()=>{
	//Create wipe animation
	/*
	var wipeAnimation = new TimelineMax()
			.fromTo("#panel2", 1, {x: "-100%"}, {x: "0%", ease: Linear.easeNone})
			.fromTo("#panel3", 1, {x:  "100%"}, {x: "0%", ease: Linear.easeNone})  
			.fromTo("#panel4", 1, {y: "-100%"}, {y: "0%", ease: Linear.easeNone});
	// create scene to pin and link animation
	new ScrollMagic.Scene({
			triggerElement: "#pinContainer",
			triggerHook: "onLeave",
			duration: "300%"
		})
		.setPin("#pinContainer")
		.setTween(wipeAnimation)
		//.addIndicators() // add indicators (requires plugin)
		.addTo(controller);
	*/
	

	$(".panel").each((i, e) => {
		if (i === 0)
			return true;
		var fromX;
		if (i % 2 === 1)
			fromX = "-100%";
		else
			fromX = "100%";
		var wipeAnimation = new TimelineMax().fromTo(e, 1, {x: fromX}, {x: "0%", ease: Power1.easeOut});
		new ScrollMagic.Scene({
				triggerElement: e,
				triggerHook: "onEnter",
				duration: "500"
			})
			.setTween(wipeAnimation)
			.addTo(controller);
	});
	
	//Create background image motion animation
	var animation = new TimelineMax()
			.to("#panel1", 1, {backgroundPosition: "-=200px -=0px", ease: Power3.easeOut})
			.to("#panel1", 1, {backgroundPosition: "+=200px -=0px", ease: Power3.easeInOut})
			//.to("#body", 1, {backgroundPosition: "+=50px +=100px", ease: Power3.easeInOut})

	new ScrollMagic.Scene({
						triggerElement: "#panel1",
						triggerHook: "onLeave",
						duration: 2400
					})
					.setTween(animation)
					.addIndicators({name: "1"})
					.addTo(controller);
	

	
	$(".animate-container").each((i,e)=>{
		var animation = new TimelineMax()
			.to($(e).find(".animate-text"), 1, 
				{left: (50-messageWidth/2)+"%", top: "-=100px", opacity: "1", ease: Power3.easeOut})
			.to($(e).find(".animate-text"), 1, 
				{left: "100%", top: "+=600px", opacity: "0"});
		new ScrollMagic.Scene({
						triggerElement: $(e).find(".animate-trigger"),
						triggerHook: "onEnter",
						duration: 1000,
					})
					//.setPin($(e).find(".animate-text"))
					.setTween(animation) // trigger a TweenMax.to tween
					//.addIndicators({name: "1"}) // add indicators (requires plugin)
					.addTo(controller);
		
	});
	
	// build scene
});




