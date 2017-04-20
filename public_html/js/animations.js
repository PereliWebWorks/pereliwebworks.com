//var messageWidth = 20; //In %
var mobileBreakPoint = 1000; //In pixels
var controller = new ScrollMagic.Controller();
var scenes = [];
var currentScene = false;


function initializeAnimations(){

	var vw = document.body.clientWidth;
	var vh = document.body.clientHeight;
	var isMobile = vw < mobileBreakPoint;
	var aspectRatioFraction = vh > vw;
	var noRotation = isMobile || !Modernizr.csstransforms3d;

	//var animateBoxWidth = isMobile ? 100 : 80;
	//var animateBoxWidth = 80;
	var animateBoxWidth = 100 * $(".animate-box").outerWidth() / vw; //In %
	//console.log($(".animate-box").eq(2).width() / vw);
	var secondBtnTop = "50%";
	//var btnWidth = $("#download-resume-btn").width();
	//var btnHeight = $("#download-resume-btn").height();
	//var btnFontSize = $("#download-resume-btn").css("font-size").split("px")[0];





	var swipeDuration = 1500;
	//var btnDiff = $("#download-resume-btn").offset().top - $("#see-resume-btn").offset().top;
	//Create wipe animation and scroll animation
	var currentPanel = 1; //Current panel we're looking at. Doesn't change until next panel is fully faded in



	//Parallax
	$(".parallax-box").each(function(i,e){
		var animation = new TimelineMax()
			.to(this, 1, {backgroundPosition: "center 0px", ease:Linear.easeNone});
		new ScrollMagic.Scene({
			triggerElement: this,
			triggerHook: "onEnter",
			duration: 2 * vh
		})
		.setTween(animation)
		.addTo(controller);
	});




	//Animate header
	var animation = new TimelineMax().staggerTo($("#main-header, #scroll-for-more"), 1, {opacity: 0}, .5);
	new ScrollMagic.Scene({
		triggerElement: $("#main-header-disappear-trigger"),
		triggerHook: "onLeave",
		duration: .5 * vh
	})
	.setTween(animation)
	.addTo(controller);
	



	

	
	//Animate base containers
	$(".animate-container").each(function(i,e){
		var textElement = $(e).find(".animate-box");
		var tEID = $(textElement).attr("id");
		var baseClassList = textElement[0].className;
		//var fromX = i % 2 === 0 ? -animateBoxWidth : 100;
		//var toX = i % 2 === 0 ? 100 : -animateBoxWidth;
		//var toY = (100 - ($(textElement).height() / document.body.clientHeight * 100)) / 2;
		var baseRY = 42;
		var startRY = i % 2 === 0 ? -baseRY : baseRY;
		var startRX = -10;
		var rotationRadius = -1 * vw * 1.3 ;

		var h = textElement.find("h2");
		var s1 = textElement.find(".section-1");
		//Global animation settings
		var animation = new TimelineMax()
			.set(textElement,
				{
					//left: (50-animateBoxWidth/2)+"%", 
					//top: (100 - ($(textElement).height() / document.body.clientHeight * 100)) / 2 + "%", 
				}
			);
		
		if (tEID === "who-i-am"){
			/*
			var h2X = textElement.find("h2").offset().left;
			var s1X = textElement.find(".section-1").offset().left;
			var s2X = textElement.find(".section-2").offset().left;
			*/
			var s2 = textElement.find(".section-2");

			var hTop = h.offset().top - $(document).scrollTop();
			var hFontSize = ~~h.css("font-size").split("px")[0]; //In pixels
			var hTextBottom = hTop + hFontSize;

			var s1BoopOffsetLeft = s2.offset().left - s1.outerWidth();
			
			animation
				.from(h, 1, {left: "-100%"})
				.from(s1, 1, {left: "-100%"})
				.from(s2, 1, {left: "100%"})
				.to(h, 1, {}) //Delay
				/*
				.add("boop1")
				//.to(s1, 1, {top: hTextBottom, ease: Linear.easeNone, repeat: 1, yoyo:true})
				//.to(h, 2, {top: -h.height(), ease: Linear.easeNone}, "boop1+=1")
				.add("boop2")
				.to(s1, 1, {left: s1BoopOffsetLeft, ease: Linear.easeNone, repeat: 1, yoyo:true})
				.to(s2, 2, {left: "100%"}, "boop2+=1");
				*/

		}
		else if (tEID = "what-i-do"){
			var s1BoopOffsetLeft = $("#who-i-am .section-1").offset().left + $("#who-i-am .section-1").outerWidth();
			animation
				.from(h, 1, {left: -h.outerWidth()})
				.fromTo(s1, 1, 
					{
						left: "100%"
					},
					{
						left: "60%"
					},
					0
				)
				.add("boop1")
				.to(s1, 1, {left: "10%"})
				.to(h, 1, {}) //Delay
				.add("end")
				.to(h, 1, {left: "100%"})
				.to(s1, 1, {left: "-50%"}, "end");
		}
		else{
			animation
				.from(textElement, 1, {opacity: 0})
				.to(textElement, 1, {opacity: 0, delay: 2});
		}
		

		//Add animation to scene
		var s = new ScrollMagic.Scene({
						triggerElement: e,//.find(".animate-trigger"),
						triggerHook: "onEnter",
						duration: $(e).height() / 2,
					})
					.setTween(animation) // trigger a TweenMax.to tween
					//.addIndicators({name: "t" + i}) // add indicators (requires plugin)
					.addTo(controller);

		scenes.push(s);

		//Show or hide the box depending on scroll direction
		/*
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
				//First box is a special case
				if (tEID !== "who-i-am")
					$(textElement).css("visibility", "hidden");
			}
			else{
				currentScene = s;
				$(textElement).css("visibility", "visible");
			}
		})
		*/
	});
	


	
	//Animate example sites
	var examples = $(".example-container");
	var animation = new TimelineMax()
		.set(examples, 
			{
				transformPerspective: 1000,
				transformOrigin: "50% 50% " + (-vw) + "px",
				rotationY: "-60deg"
			}
		)
		.add("flying")
		.staggerTo(examples, 2, 
			{
				rotationY: "60deg",
				ease: Linear.easeNone
			}, .5
		)

	var s = new ScrollMagic.Scene({
				triggerElement: $("#site-example-trigger"),
				triggerHook: "onLeave",
				duration: 1000
			})
			.setTween(animation)
			.addTo(controller);
	//Add mouseover animation
	$(".example-container").mouseover(function(){
		TweenMax.to($(this), .3, {scale: 1.5, zIndex: 100, ease: Back.easeOut.config(3)});
	});
	$(".example-container").mouseout(function(){
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





	//Animate footer
	animation = new TimelineMax()
				.set($("#footer"),{
					display: "flex",
					opacity: 0
				})
				.to($("#footer"), 1, {opacity: 1});
	new ScrollMagic.Scene({
		triggerElement: $("#footer-animation-trigger"),
		triggerHook: "onEnter",
		duration: 500
	})
	.setTween(animation)
	.addTo(controller);





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
}

	



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





