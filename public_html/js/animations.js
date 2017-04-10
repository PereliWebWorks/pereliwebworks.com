var messageWidth = 20; //In %
var animateBoxWidth = 80; //In %
var mobileBreakPoint = 1000; //In pixels
var controller = new ScrollMagic.Controller();
var scenes = [];
var currentScene = false;


$(function(){

	var vw = document.body.clientWidth;
	var vh = document.body.clientHeight;
	var isMobile = vw < mobileBreakPoint;
	var aspectRatioFraction = vh > vw;
	//isMobile = true;
	var noRotation = isMobile || !Modernizr.csstransforms3d;
	//noRotation = true;

	var secondBtnTop = "50%";
	var btnWidth = $("#download-resume-btn").width();
	var btnHeight = $("#download-resume-btn").height();
	var btnFontSize = $("#download-resume-btn").css("font-size").split("px")[0];





	var swipeDuration = 1500;
	//var btnDiff = $("#download-resume-btn").offset().top - $("#see-resume-btn").offset().top;
	//Create wipe animation and scroll animation
	var currentPanel = 1; //Current panel we're looking at. Doesn't change until next panel is fully faded in
	$(".panel").each((i, e) => {
		var id = $(e).data("p-num");
		var $layout = $("#panel-" + id + "-layout");
		//***************
		//Scroll animation
		//***************
		var img = $(e).find("img");
		var imgWidth = img.width();
		var imgLeft = (vw - imgWidth) / 2;
		//CSS hack that I hate
		img.css("left", imgLeft);
		if (!isMobile){
			var imgRemainderLeft = -imgLeft;
			var imgRemainderRight = imgLeft + imgWidth - vw;
			var imgRemainderBottom = img.height() - vh;
			var toLeft1;
			var toLeft2;
			if (i % 2 === 0){
				toLeft1 = "-=" + (imgRemainderRight - 10) + "px";
				toLeft2 = 0;
			}
			else{
				toLeft1 = 0;
				toLeft2 = "-=" + (imgRemainderRight - 10) + "px";
			}
			//Add scroll effects
			var animation = new TimelineMax()
						.to(img, 4, {top: -(imgRemainderBottom - 10)})
						.to(img, 2, {left: toLeft1, ease:Power1.easeOut}, 0)
						.to(img, 2, {left: toLeft2, ease:Power1.easeIn}, 2)
						//.set(img, {visibility: "hidden"})
						;
			new ScrollMagic.Scene({
				triggerElement: $layout.find(".start-scroll-trigger"),
				triggerHook: "onLeave",
				duration: $layout.find(".end-scroll-trigger").offset().top - $layout.find(".start-scroll-trigger").offset().top
			})
			.setTween(animation)
			.addTo(controller);
		}

		//***************
		//Whipe animation
		//***************
		if (i !== 0){ //Don't do swipe animation for first panel
			var fromX = "-100%";//Mobile values
			var toX = "0";
			if (!aspectRatioFraction)
			{
				if (i % 2 === 1){
					fromX = "-100%";
					//toX = "0%";
				}
				else{
					fromX = "0%";
					//toX = "-50%";
				}
			}

			var wipeAnimation = new TimelineMax().from(e, 1, 
							{x: fromX, opacity: 0 /*boxShadow: fromBSX + " -50px 10px 5px rgba(0,0,0,.3);"*/}
							//{x: toX, opacity: 1, /*boxShadow: "0px 0px 10px 5px rgba(0,0,0,.3);",*/ ease: Power1.easeOut}
							);
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
		var rotationRadius = -1 * vw * 1.3 ;
		//Global animation settings
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
							opacity: 0
						}
					)
				if (!noRotation){
					animation.set(textElement,
						{
							rotationY: startRY,
							rotationX: startRX, 
							transformOrigin: "50% 50% " + rotationRadius,
							transformPerspective: 1000,
							
						}
					);
				}
				else{
					animation.set(textElement,
						{
							left: -animateBoxWidth - 1 + "%"
						}
					);
				}
				if (!noRotation){
					animation
						.to(textElement, 1, 
							{
								rotationY: 0, 
								rotationX: 0, 
								opacity: 1,
								ease: Power2.easeOut
							}
						);
				}
				else{
					animation
						.to(textElement, 1, 
							{
								left: 50 - animateBoxWidth / 2 + "%",
								opacity: 1,
								ease: Power2.easeOut
							}
						);
				}

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
						animation.staggerTo($(el).children(), .1, {visibility: "visible"}, 0.01);
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
					);
					if (!noRotation){
						animation.to(textElement, 1, 
							{
								rotationY: startRY,
								rotationX: -startRX, 
								ease: Power3.easeIn
							},
							"takeoff+=.5"
						);
					}
					else{
						animation.to(textElement, 1, 
							{
								left: "100%",
								ease: Power3.easeIn
							},
							"takeoff+=.5"
						);
					}
					/*
					animation
					.set($(e).find(".lettering").children(),
						{
							clearProps: "visibility"
						}
					)
					;
					*/
				break;
			//***************
			//Third box
			//***************
			case 2:
				var scaleFactor = .8;
				animation
					.set(textElement, 
						{
							scale: 0,
							opacity: 0,
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
							top: secondBtnTop
						},
						"orbit"
					)
					.to($("#download-resume-btn"), 1,
						{
							top: 0
						},
						"orbit"
					);
					if (!isMobile){
						animation
						.to($("#see-resume-btn"), .5,
							{
								width: scaleFactor * btnWidth,
								height: scaleFactor * btnHeight,
								fontSize: scaleFactor * btnFontSize + "px"
							},
							"orbit"
						)
						.to($("#download-resume-btn"), .5,
							{
								width: 1 / scaleFactor * btnWidth,
								height: 1 / scaleFactor * btnHeight,
								fontSize: 1 / scaleFactor * btnFontSize + "px"
							},
							"orbit"
						)
						.to($("#see-resume-btn, #download-resume-btn"), .5,
							{
								width: btnWidth,
								height: btnHeight,
								fontSize: btnFontSize + "px"
							},
							"orbit+=.5"
						);
					}
					animation
					.add("orbit2")
					.set($("#see-resume-btn"), {zIndex: 3})
					.set($("#download-resume-btn"), {zIndex: 1})
					.to($("#see-resume-btn"), 1,
						{
							top: 0
						},
						"orbit2"
					)
					.to($("#download-resume-btn"), 1,
						{
							top: secondBtnTop
						},
						"orbit2"
					)
					if (!isMobile){
						animation
						.to($("#see-resume-btn"), .5,
							{
								width: 1 / scaleFactor * btnWidth,
								height: 1 / scaleFactor * btnHeight,
								fontSize: 1 / scaleFactor * btnFontSize + "px"
							},
							"orbit2"
						)
						.to($("#download-resume-btn"), .5,
							{
								width: scaleFactor * btnWidth,
								height: scaleFactor * btnHeight,
								fontSize: scaleFactor * btnFontSize + "px"
							},
							"orbit2"
						)
						.to($("#see-resume-btn, #download-resume-btn"), .5,
							{
								width: btnWidth,
								height: btnHeight,
								fontSize: btnFontSize + "px"
							},
							"orbit2+=.5"
						);
					}
					animation
					.to(textElement, 1, {}); //Add a delay for the end
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
			//Fifth box
			//***************
			case 4:
				if (!noRotation){
					animation
						.set(textElement,
							{
								transformPerspective: 1000,
								transformOrigin: "50% top",
								rotationX: -90
							}
						)
						.set(textElement.find(".anim"),
							{
								//transformOrigin: "left top",
							}
						)
						.to(textElement, 4, 
							{
								rotationX: 0,
								ease: Elastic.easeOut.config(2, 0.3)
							}
						)
						.to(textElement.find(".anim"), 2,
							{
								rotationX: 90,
								delay: 1
							},
							2
						)
						.to(textElement, 1,
							{
								height: $(".animate-box").eq(i+1).height(),
								rotationX: 90
							}
						)
				}
				else{
					animation
						.set(textElement,
							{
								top: "100%"
							}
						)
						.to(textElement, 1, 
							{
								top: (100 - ($(textElement).height() / document.body.clientHeight * 100)) / 2 + "%", 
							}
						)
						.to(textElement, 1, {})//Add second delay
						.staggerTo(textElement.find(".anim"), 1,
							{
								opacity: 0
							},
							.1
						)
						.to(textElement, 1,
							{
								//top: (100 - ($(".animate-box").eq(i+1).height() / document.body.clientHeight * 100)) / 2 + "%", 
								//height: "5%"
								opacity: 0
							}
						)

				}				
				break;
			//***************
			//Sixth box
			//***************
			case 5:
				if(!noRotation)
				{
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
				}
				else{
					//Get height
					var h = textElement.height();
					//textElement.html(h);
					animation
					.set(textElement.children(), 
						{
							opacity: 0
						}
					)
					.set(textElement, 
						{
							opacity: 0
						}
					)
					.to(textElement, 1,
						{
							//height: 460
							//minHeight: "50%"
							opacity: 1
						}
					)
					.staggerTo(textElement.children(), 1,
						{
							opacity: 1
						},
						.2
					)
					.to(textElement, 1,
						{
							top: "-200%",
							delay: 1
						}
					);
				}
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

		scenes.push(s);

		//Show or hide the box depending on scroll direction
		s.on("start", function(e){
			if (e.scrollDirection === "FORWARD"){
				currentScene = s;
				$(textElement).css("visibility", "visible");
			}
			else{
				currentScene = false;
				$(textElement).css("visibility", "hidden");
			}
		});

		//Show or hide the box depending on scroll direction
		s.on("end", function(e){
			if (e.scrollDirection === "FORWARD"){
				currentScene = false;
				//Box number 2 is a special case because it will be pushed away by box 3.
				if (i !== 2)
					$(textElement).css("visibility", "hidden");
			}
			else{
				currentScene = s;
				$(textElement).css("visibility", "visible");
			}
		})
	});
	


	
	//Animate example sites
	var animation = new TimelineMax()
		.to($("#site-examples .example-container"), 0, {display: "block"})
		.staggerFromTo($(".site-example, #site-example-header"), 1, 
					{left: "-100%", top: "100vH", opacity: 0},
					{left: "0", top: "12vH", opacity: 1, ease: Elastic.easeOut.config(1, .75)},
				.2)
		.staggerTo($(".site-example"), .2, 
					{scale: 1.2, filter: "grayscale(0)", yoyo: true, repeat: 1}, .2)
		.staggerTo($(".site-example, #site-example-header"), 1, 
					{left: "100%", top: "100vH", opacity: 0, ease: Back.easeIn.config(1)},
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
		console.log("stuff");
		TweenMax.to($(this), .3, {scale: 1.5, zIndex: 100, ease: Back.easeOut.config(3)});
	});
	$(".site-example").mouseout(function(){
		TweenMax.to($(this), .3, {scale: 1, zIndex: 1});
	});

	//Show or hide the box depending on scroll direction
	var examples = $(".site-example");
	s.on("start", function(e){
		if (e.scrollDirection === "FORWARD"){
			$(examples).css("display", "block");
		}
		else{
			$(examples).css("display", "none");
		}
	});

	//Show or hide the box depending on scroll direction
	s.on("end", function(e){
		if (e.scrollDirection === "FORWARD"){
			$(examples).css("display", "none");
		}
		else{
			$(examples).css("display", "block");
		}
	});






	//Animate buttons
	$(".btn").mouseover(function(){
		TweenMax.to($(this), .2, {className: "+=hover", color: "orange"});
	}).mouseout(function(){
		TweenMax.to($(this), .2, {className: "-=hover"});
	});










	if (!isMobile){
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





