var messageWidth = 20; //In %
var animateBoxWidth = 80; //In %
var controller = new ScrollMagic.Controller();


$(function(){
	var swipeDuration = 1500;
	var btnDiff = $("#download-resume-btn").offset().top - $("#see-resume-btn").offset().top;
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


	//Animate header
	var animation = new TimelineMax().to($("#main-header"), 1, {opacity: 0});
	new ScrollMagic.Scene({
		triggerElement: $("#main-header-disappear-trigger"),
		triggerHook: "onLeave",
		duration: 600
	})
	.setTween(animation)
	.addTo(controller);
	



	


	//Animate base containers
	$(".animate-container").each((i,e)=>{
		var textElement = $(e).find(".animate-box");
		var baseClassList = textElement[0].className;
		//var fromX = i % 2 === 0 ? -animateBoxWidth : 100;
		//var toX = i % 2 === 0 ? 100 : -animateBoxWidth;
		//var toY = (100 - ($(textElement).height() / document.body.clientHeight * 100)) / 2;
		var baseRY = 42;
		var startRY = i % 2 === 0 ? -baseRY : baseRY;
		var startRX = -10;
		var vw = document.body.clientWidth;
		var vh = document.body.clientHeight;
		var rotationRadius = -1 * vw * 1.3 ;
		//Global animation settings
		if (i === 4){
			console.log((100 - ($(textElement).height() / document.body.clientHeight * 100)) / 2);
		}
		var animation = new TimelineMax()
			.set(textElement,
				{
					//left: (50-animateBoxWidth/2)+"%", 
					top: (100 - ($(textElement).height() / document.body.clientHeight * 100)) / 2 + "%", 
				}
			);
		switch(i){
			//***************
			//First box
			//***************
			case 0:
				animation
					.set(textElement,
						{
							rotationY: startRY,
							rotationX: startRX, 
							transformOrigin: "50% 50% " + rotationRadius,
							transformPerspective: 1000,
							opacity: 0,
							
						}
					)
					.to(textElement, 1, 
						{
							rotationY: 0, 
							rotationX: 0, 
							opacity: 1,
							ease: Power2.easeOut
						}
					);
					$(e).find(".lettering").each(function(i,el){
						animation.staggerTo($(el).children(), .1, {visibility: "initial"}, 0.01);
					});

					animation
					.add("highlight")
					.staggerTo($(e).find(".lettering").children(), .1, 
						{backgroundColor: "gray", delay: .5}, 
						0.01
					)
					.staggerTo($(e).find(".lettering").children(), .1, 
						{color: "white", delay: .5}, 
						0.01,
						"highlight"
					)
					.set($(e).find(".lettering").children(),
						{visibility: "hidden", delay: .5}
					)
					.set(textElement,
						{backgroundColor: "rgba(200,0,0,.85)"}
					)
					.add("delete")
					.to(textElement, .5,
						{
							backgroundColor: "rgba(0,0,0,.85)",
							ease: Power2.easeOut,
						}
					)
					.to(textElement, 1, 
						{
							scaleX: .05,
							delay: .5,
							ease: Power2.easeIn, 
						},
						"delete"
					)
					.to(textElement, 1, 
						{
							scaleY: 0,
							scaleY: 0,
							ease: Power2.easeIn
						}
					)
					;
				break;
			//***************
			//Second box
			//***************
			case 1:
				animation
					.set(textElement,
						{
							scaleX: 0,
							scaleY: 0,
							transformOrigin: "50% 50% " + rotationRadius,
							transformPerspective: 1000,
						}
					)
					//Bring in the element
					.to(textElement, 1, 
						{
							scaleY: .05
						}
					)
					.to(textElement, 1, 
						{
							scaleX: 1
						}
					)
					.to(textElement, 1, 
						{
							scaleY: 1
						}
					);
					//"type" the text
					$(e).find(".lettering").each(function(i,el){
						animation.staggerTo($(el).children(), .1, {visibility: "initial"}, 0.01);
					});
					//Make the rocket prepare to take off
					var newClassList = addClasses(baseClassList, "prepping-rocket");
					animation
					.to(textElement, 1, 
						{
							css: {
								className: newClassList
							}
						}
					);
					//Make the rocket launch
					newClassList = addClasses(baseClassList, "launching-rocket");
					animation
					.add("takeoff")
					.to(textElement, 1.5, 
						{
							css: {
								className: newClassList
							},
							ease: RoughEase.ease.config({ template:  Power0.easeNone, strength: 1.5, points: 20, taper: "none", randomize: true, clamp: true})
						},
						"takeoff"
					)
					.to(textElement, 1, 
						{
							rotationY: startRY,
							rotationX: -startRX, 
							ease: Power3.easeIn
						},
						"takeoff+=.5"
					)
					.set($(e).find(".lettering").children(),
						{
							clearProps: "visibility"
						}
					)
					;
				break;
			//***************
			//Third box
			//***************
			case 2:
				animation
					.set(textElement, 
						{
							scale: 0,
							opacity: 0
						}
					)
					.to(textElement, 1,
						{
							scale: 1,
							opacity: 1,
							ease: Back.easeOut.config(2)
						}
					)
					.add("orbit", "+=1")
					.to($("#see-resume-btn"), 1,
						{
							y: btnDiff
						},
						"orbit"
					)
					.to($("#download-resume-btn"), 1,
						{
							y: -btnDiff
						},
						"orbit"
					)
					.to($("#see-resume-btn"), .5,
						{
							scale: .8
						},
						"orbit"
					)
					.to($("#download-resume-btn"), .5,
						{
							scale: 1.2
						},
						"orbit"
					)
					.to($("#see-resume-btn"), .5,
						{
							scale: 1
						},
						"orbit+=.5"
					)
					.to($("#download-resume-btn"), .5,
						{
							scale: 1
						},
						"orbit+=.5"
					)
					.add("orbit2")
					.set($("#see-resume-btn"), {zIndex:2})
					.to($("#see-resume-btn"), 1,
						{
							y: 0
						},
						"orbit2"
					)
					.to($("#download-resume-btn"), 1,
						{
							y: 0
						},
						"orbit2"
					)
					.to($("#see-resume-btn"), .5,
						{
							scale: 1.2
						},
						"orbit2"
					)
					.to($("#download-resume-btn"), .5,
						{
							scale: .8
						},
						"orbit2"
					)
					.to($("#see-resume-btn"), .5,
						{
							scale: 1
						},
						"orbit2+=.5"
					)
					.to($("#download-resume-btn"), .5,
						{
							scale: 1
						},
						"orbit2+=.5"
					)
					.to(textElement, 2, {}); //Add a delay for the end
				break;
			//***************
			//Fourth box
			//***************
			case 3:
				//Get previous animation box for this
				var prev = $(".animate-container").eq(i-1).find(".animate-box");
				animation
					.set(textElement,
						{
							left: "100%"
						}
					)
					.to(textElement, 1,
						{
							left: 50 + animateBoxWidth / 2 + "%",
							ease: Linear.easeNone
						}
					)
					.add("gtfo")
					.to(textElement, 2,
						{
							left: 50 - animateBoxWidth / 2 + "%",
							ease: Linear.easeNone
						}
					)
					.to(prev, 1,
						{
							left: -animateBoxWidth - 10 + "%",
							ease: Linear.easeNone
						},
						"gtfo"
					)
					.staggerTo($(textElement).find("h2, .word"), .5,
						{
							scale: 3,
							opacity: 0,
							delay: 1
						},
						.1
					)
					.to(textElement, 1,
						{
							scale: 3,
							opacity: 0,
							delay: 1
						}
					)

				break;
			//***************
			//Five box
			//***************
			case 4:
				animation
				.set(textElement,
					{
						transformPerspective: 1000,
						transformOrigin: "50% top",
						rotationX: -90
					}
				)
				.set(textElement.find(".rotate, .form-group"),
					{
						transformOrigin: "left top",
					}
				)
				.to(textElement, 4, 
					{
						rotationX: 0,
						ease: Elastic.easeOut.config(2, 0.3)
					}
				)
				.staggerTo(textElement.find(".rotate, .form-group"), 2,
					{
						rotationZ: 80,
						delay: 1,
						ease: Elastic.easeOut.config(1.5, 0.3)
					},
					.1,
					2
				)
				.staggerTo(textElement.find(".rotate, .form-group"), 1,
					{
						y: vh
					},
					.2
				)
				.to(textElement, 1,
					{
						height: $(".animate-box").eq(i+1).height(),
						rotationX: 90
					}
				)
				break;
			//***************
			//Sixth box
			//***************
			case 5:
				animation
				.set(textElement,
					{
						transformPerspective: 3000,
						transformOrigin: "50% top",
						rotationX: 90
					}
				)
				.set(textElement.children(),
					{
						opacity: 0
					}
				)
				.add("swing")
				.to(textElement, 1,
					{
						rotationX: 360
					}
				)
				.to(textElement.children(), 1,
					{
						opacity: 1
					},
					"swing"
				)
				.set(textElement,
					{
						transformOrigin: "right bottom"
					}
				)
				.to(textElement, 1,
					{
						rotationY:180,
						delay: 1,
					}
				)
				.to(textElement, 1,
					{
						rotationX:540
					}
				)
				.set(textElement,
					{
						transformOrigin: "left bottom",
						left: 50 + 3 * animateBoxWidth/2 + "%",
						rotationY: -180
					}
				)
				.to(textElement, 1,
					{
						rotationY:0,
					}
				)
				break;
		}

		//Add animation to scene
		var s = new ScrollMagic.Scene({
						triggerElement: $(e),//.find(".animate-trigger"),
						triggerHook: "onEnter",
						duration: $(e).height(),
					})
					.setTween(animation) // trigger a TweenMax.to tween
					//.addIndicators({name: "t" + i}) // add indicators (requires plugin)
					.addTo(controller);

		//Show or hide the box depending on scroll direction
		s.on("start", function(e){
			if (e.scrollDirection === "FORWARD"){
				$(textElement).css("visibility", "visible");
			}
			else{
				$(textElement).css("visibility", "hidden");
			}
		});

		//Show or hide the box depending on scroll direction
		s.on("end", function(e){
			if (e.scrollDirection === "FORWARD"){
				//Box number 2 is a special case because it will be pushed away by box 3.
				if (i !== 2)
					$(textElement).css("visibility", "hidden");
			}
			else{
				$(textElement).css("visibility", "visible");
			}
		})
	});
	


	
	//Animate example sites
	var animation = new TimelineMax()
		.staggerFromTo($(".site-example, #site-example-header"), 1, 
					{left: "-100%", top: "100vH", opacity: 0, rotationY: -360},
					{left: "0", top: "12vH", opacity: 1, rotationY: 0, ease: Elastic.easeOut.config(1, .75)},
				.2)
		.staggerTo($(".site-example"), .2, 
					{scale: 1.2, filter: "grayscale(0)", yoyo: true, repeat: 1}, .2)
		.staggerTo($(".site-example, #site-example-header"), 1, 
					{left: "100%", top: "100vH", opacity: 0, rotationY: 90, ease: Back.easeIn.config(1)},
				.2);
	var s = new ScrollMagic.Scene({
				triggerElement: $("#site-example-trigger"),
				triggerHook: "onEnter",
				duration: 3000
			})
			.setTween(animation)
			.addTo(controller);
	//Add mouseover animation
	$(".site-example").mouseover(function(){
		TweenMax.to($(this), .3, {scale: 1.5, zIndex: 100, ease: Back.easeOut.config(3)});
	});
	$(".site-example").mouseout(function(){
		TweenMax.to($(this), .3, {scale: 1, zIndex: 1});
	});

	//Show or hide the box depending on scroll direction
	var textElement = $("#site-examples");
	s.on("start", function(e){
		if (e.scrollDirection === "FORWARD"){
			$(textElement).css("display", "initial");
		}
		else{
			$(textElement).css("display", "none");
		}
	});

	//Show or hide the box depending on scroll direction
	s.on("end", function(e){
		if (e.scrollDirection === "FORWARD"){
			$(textElement).css("display", "none");
		}
		else{
			$(textElement).css("display", "initial");
		}
	})
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



function changeClasses(classList, add, subtract){
	return removeClasses(addClasses(classList, add), subtract);
}

function removeClasses(classList, subtract){
	var c = classList.split(" ");
	var exclude = subtract.split(" ");
	c = c.filter(function(x){
		return exclude.indexOf(x) === -1;
	})
	return c.join(" ");
}

function addClasses(classList, add){
	return classList + " " + add;
}





