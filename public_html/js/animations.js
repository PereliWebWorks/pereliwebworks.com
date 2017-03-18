var messageWidth = 20; //In %

var controller = new ScrollMagic.Controller();

$(()=>{
	//Create wipe animation
	$(".panel").each((i, e) => {
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
						{x: fromX, boxShadow: fromBSX + " -50px 10px 5px rgba(0,0,0,.3);"}, 
						{x: "0%", boxShadow: "0px 0px 10px 5px rgba(0,0,0,.3);", ease: Power1.easeOut});
		new ScrollMagic.Scene({
				triggerElement: e,
				triggerHook: "onEnter",
				duration: "500"
			})
			.setTween(wipeAnimation)
			.addTo(controller);
	});
	
	//Create background image motion animation
	/*
	var animation = new TimelineMax()
			.to("#panel1", 1, {backgroundPosition: "-=200px -=300px", ease: Power1.easeOut})
			.to("#panel1", 1, {backgroundPosition: "+=200px -=300px", ease: Power1.easeIn})
			//.to("#body", 1, {backgroundPosition: "+=50px +=100px", ease: Power3.easeInOut})

	new ScrollMagic.Scene({
						triggerElement: "#panel1",
						triggerHook: "onLeave",
						duration: 2400
					})
					.setTween(animation)
					.addIndicators({name: "1"})
					.addTo(controller);
	*/
	

	//Animate messages
	/*
	$(".animate-container").each((i,e)=>{
		var textElement = $(e).find(".animate-text");
		var animation = new TimelineMax()
			.to(textElement, 1, 
				{left: (50-messageWidth/2)+"%", top: "50%", opacity: "1", ease: Power2.easeOut})
			.to(textElement, 1, 
				{left: "100%", top: "100%", opacity: "0", ease: Power2.easeIn});
		new ScrollMagic.Scene({
						triggerElement: $(e).find(".animate-trigger"),
						triggerHook: "onEnter",
						duration: 1000,
					})
					.setTween(animation) // trigger a TweenMax.to tween
					.addIndicators({name: "t" + i}) // add indicators (requires plugin)
					.addTo(controller);

	});
	*/
	
	// build scene
});




