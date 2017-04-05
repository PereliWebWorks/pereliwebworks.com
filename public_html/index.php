<?php require_once __DIR__ . "/../resources/config.php"; ?>
<html>
<head>
	<title>Pereli Web Works</title>
	<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
  	<!-- jQuery ajax form -->
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.0/jquery.form.min.js" integrity="sha384-E4RHdVZeKSwHURtFU54q6xQyOpwAhqHxy2xl9NLW9TQIqdNrNh60QVClBRBkjeB8" crossorigin="anonymous"></script>
  	<!-- bootstrap -->
  	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  	<!-- Animation stuff -->
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/plugins/CSSPlugin.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/plugins/ScrollToPlugin.min.js"></script>
  	<script src="library/velocity.js"></script>
	<script src="library/ScrollMagic/ScrollMagic.js"></script>
	<script src="library/ScrollMagic/plugins/animation.gsap.js"></script>
	<script src="library/ScrollMagic/plugins/animation.velocity.js"></script>
	<script src="library/ScrollMagic/plugins/debug.addIndicators.js"></script>
	<script src="library/ScrollMagic/plugins/jquery.ScrollMagic.js"></script>
	<!-- Bttn.css-->
	<link href="css/bttn.min.css" type="text/css" rel="stylesheet" />
	<!-- Lettering.js -->
	<script src="library/lettering.js"></script>
	<!-- Custom -->
	<link href="css/global.css" type="text/css" rel="stylesheet" />
	<link href="css/navbar.css" type="text/css" rel="stylesheet" />
	<script>
		//Returns true or false depending on whether the browser supports rotation or not.
		function has3d() {
		    if (!window.getComputedStyle) {
		        return false;
		    }

		    var el = document.createElement('p'), 
		        has3d,
		        transforms = {
		            'webkitTransform':'-webkit-transform',
		            'OTransform':'-o-transform',
		            'msTransform':'-ms-transform',
		            'MozTransform':'-moz-transform',
		            'transform':'transform'
		        };

		    // Add it to the body to get the computed style.
		    document.body.insertBefore(el, null);

		    for (var t in transforms) {
		        if (el.style[t] !== undefined) {
		            el.style[t] = "translate3d(1px,1px,1px)";
		            has3d = window.getComputedStyle(el).getPropertyValue(transforms[t]);
		        }
		    }

		    document.body.removeChild(el);

		    return (has3d !== undefined && has3d.length > 0 && has3d !== "none");
		}

		$(function(){
			$(".lettering").each(function(_,e){
				var html = $(e).html().split("");
				html = html.reduce(function(acc, val){
					return acc + "<span class='char'>" + val + "</span>";
				}, "");
				$(e).html(html);
			});

			$(".wording").each(function(_,e){
				var html = $(e).html().split(" ");
				html = html = html.reduce(function(acc, val){
					return acc + "<span class='word'>" + val + "</span> ";
				}, "");
				$(e).html(html);
			});
			/*
			$(".lettering")
				.lettering();
			*/
		});
		$(window).on("load", function(){
			$("#loading_spinner_container").remove();
		});
	</script>
	<script src="js/animations.js"></script>
</head>
<body>
	<div id="loading_spinner_container">
		<img src="img/loading_spinner.gif"/>
	</div>
	<div id="container" class="">
		<div id="navbar" class="navbar navbar-default navbar-fixed-top" role="navigation">
		    <div class="container-fluid">
		        <div class="navbar-header"><a class="navbar-brand" href="#home">Pereli Web Works</a>
		            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
		            </button>
		        </div>
		        <div class="collapse navbar-collapse navbar-menubuilder">
		            <ul class="nav navbar-nav navbar-left">
		                <li class="dropdown" class="dropdown" class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">About <b class="caret"></b></a>
		                    <ul class="dropdown-menu" role="menu">
		                    	<li><a href="#about">About Me</a>
		                        </li>
		                        <li><a href="#work">My Work</a>
		                        </li>
		                        <li><a href="#resume">Resume</a>
		                        </li>
		                        <li><a href="#pricing">Pricing</a>
		                        </li>
		                    </ul>
		                </li>
		                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">Contact <b class="caret"></b></a>
		                    <ul class="dropdown-menu" role="menu">
		                    	<li><a href="#contact">Get in Touch</a>
		                        </li>
		                        <li><a href="#payment">Payment</a>
		                        </li>
		                    </ul>
		                </li>
		            </ul>
		        </div>
		    </div>
		</div>
		<span id="panels">
			<div class="panel" id="panel_1" data-p-num="1">
				<img src="https://static.pexels.com/photos/25926/pexels-photo-25926.jpg"/>
			</div>
			<div class="panel" id="panel_2" data-p-num="2">
				<img src="img/backgrounds/forest.jpg"/>
			</div>
			<div class="panel" id="panel_3" data-p-num="3">
				<img src="https://static.pexels.com/photos/33688/delicate-arch-night-stars-landscape.jpg"></div>
			</div>
		</span>
		<!-- 
			***********************
			***********************
			***********************
			This div is where all of the triggers and text are 
			***********************
			***********************
			***********************
		-->
		<div id="layout-container">
			<div class="panel-layout" id="panel-1-layout" data-layout-for="panel_1">
				<div id="home"></div><!-- Anchor for home section -->
				<div class="start-scroll-trigger"></div>
				<h1 id="main-header">
					Pereli Web Works
				</h1>
				<div class="medium-spacer"></div>
				<div id="main-header-disappear-trigger"></div>
				<div class="spacer"></div>
				<div id="about"></div>
				<div class="animate-container">
					<div class="animate-box">
						<h2><span class="lettering">Who I am</span></h2>
						<div>
							<span class="lettering">I'm a Madison based full stack freelance web developer and designer. I've been making websites for business, individuals, and other organizations for about a year now. I'm passionate about creating websites, and I feel incredibly lucky to be able to make a living off of it. </span><a href="#contact" class="lettering">Get in touch.</a>
						</div>
					</div>
					<div class="large-spacer"></div>
					<div class="large-spacer"></div>
				</div>
				<div class="animate-container">
					<div class="animate-box">
						<h2 class="lettering">What I Do</h2>
						<div>
							 <span class="lettering">I pride myself on creating websites that are first and foremost secure, user friendly, and mobile responsive. Feel free to check out </span>
							 <a href="#work" class="lettering">some of my work.</a>
						</div>
					</div>
					<div class="large-spacer"></div>
					<div class="large-spacer"></div>
				</div>
				<div id="site-example-trigger"></div>
				<div id="work"></div>
				<div id="site-examples">
					<h1 id="site-example-header">Sites I've Worked On</h1>
					<?php 
						$sites = array(
							array(
								"src"=>"state_street_brats",
								"url"=>"http://www.statestreetbrats.com",
							),
							array(
								"src"=>"paw_friendly_cat_furniture",
								"url"=>"http://www.statestreetbrats.com"
							),
							array(
								"src"=>"silver_cloud_society",
								"url"=>"http://www.statestreetbrats.com"
							),
							array(
								"src"=>"the_landing",
								"url"=>"http://www.statestreetbrats.com"
							),
							array(
								"src"=>"JCW_tax_and_accounting",
								"url"=>"http://www.statestreetbrats.com"
							),
							array(
								"src"=>"skin608",
								"url"=>"http://www.statestreetbrats.com"
							)
						); 
						$s = 0;
					?>
					<?php for ($i = 0 ; $i < 3 ; $i++) : ?>
						<div>
							<?php for ($j = 0 ; $j < 2 ; $j++) : ?>
								<a href="<?=$sites[$s]['url'];?>" target="_blank">
									<img class="site-example"
										src="img/example_sites/<?=$sites[$s]['src'];?>.jpg" />
								</a>
							<?php 
									$s++;
								endfor; 
							?>
						</div>
					<?php endfor; ?>
				</div>
				<div class="large-spacer"></div>
				<div class="medium-spacer"></div>
				<div id="panel-wipe-trigger-2" data-triggers="2" class="panel-wipe-trigger"></div>
				<div class="end-scroll-trigger"></div>
			</div>
			<div class="panel-layout" id="panel-2-layout" data-layout-for="panel_2">
				<div class="start-scroll-trigger"></div>
				<div class="spacer"></div>
				<div class="spacer"></div>
				<div class="spacer"></div>
				<div id="resume"></div>
				<div class="animate-container">
					<div class="animate-box">
						<h2>Resume</h2>
						<div>&nbsp;</div>
						<div class="text-center">
							<span class="resume-btn-container">
								<button class="bttn-fill bttn-lg bttn-primary" id="see-resume-btn">
									See my resume
								</button>
								<div>&nbsp;</div>
								<button class="bttn-fill bttn-lg bttn-primary" id="download-resume-btn">
									Download my resume
								</button>
							</span>
							<script>
								$("#see-resume-btn").click(function(){
									window.open("/resume", "_blank");
								});
								$("#download-resume-btn").click(function(){
									window.open("/download_resume");
								});
							</script>
						</div>
					</div>
					<div class="large-spacer"></div>
					<div class="large-spacer"></div>
				</div>
				<div id="pricing"></div>
				<div class="animate-container">
					<div class="animate-box">
						<h2>Pricing</h2>
						<div class="wording">
							My rate is negotiable, but I generally charge around $25 per hour. I'm also happy to work from a fixed-price contract. If you have a specific budget, I can give you an estimate of what I could do for you while staying within your price range.
						</div>
					</div>
					<div class="large-spacer"></div>
					<div class="large-spacer"></div>
				</div>
				<div id="panel-wipe-trigger-3" data-triggers="3" class="panel-wipe-trigger"></div>
				<div class="end-scroll-trigger"></div>
			</div>
			<div class="panel-layout" id="panel-3-layout" data-layout-for="panel_3">
				<div class="start-scroll-trigger"></div>
				<div class="large-spacer"></div>
				<div class="medium-spacer"></div>
				<div id="contact"></div>
				<div class="animate-container" id="contact-container">
					<div class="animate-box">
						<h2 class="rotate">Get in Touch</h2>
						<div class="smaller-font">
							<div class="rotate">
							Feel free to email me directly at drew@pereliwebworks.com.<br/>
							Or use this form to contact me.
							</div>
							<form id="contact-form" method="POST" action="contact.php">
								<div class="form-group">
									<input 
										name="name" 
										type="text" 
										placeholder="Name" 
										required/>
								</div>
								<div class="form-group">
									<input 
										name="email" 
										type="email" 
										placeholder="Email Address"
										required/>
								</div>
								<!--
								<div class="form-group">
									<input 
										name="subject" 
										placeholder="Subject"
										required/>
								</div>
								-->
								<div class="form-group">
									<textarea 
										name="message"
										placeholder="Message"
										rows="3" required></textarea>
								</div>
								<div class="form-group">
									<button class="bttn-fill bttn-sm bttn-primary submit-btn">Submit</button>
								</div>
							</form>
							<div class="response">
								<img src="img/spinner.gif" class="display-none"/>
								<div class="message display-none"></div>
							</div>
							<script>
								$("#contact-form").submit(function(e){
									e.preventDefault();
									$("#contact-form").parent().find(".response img").removeClass("display-none");
									$("#contact-form").ajaxSubmit(function(response){
										$("#contact-form").parent().find(".response img").addClass("display-none");
										if (response){
											$("#contact-form").parent().find(".response .message")
												.removeClass("display-none")
												.addClass("success-message")
												.html("Your message has been sent.");
										}
										else{
											$("#contact-form").parent().find(".response .message")
												.removeClass("display-none")
												.addClass("failure-message")
												.html("There was an error. Please try again later.");
										}
									});
									return false;
								});
							</script>
						</div>
					</div>
					<div class="large-spacer"></div>
					<div class="large-spacer"></div>
				</div>
				<div id="payment"></div>
				<div class="animate-container smaller-font">
					<div class="animate-box">
						<h2>Make a Payment</h2>
						<div>
							You can use the secure payment form bellow to make a payment. If you'd rather use PayPal, you can send a PayPal payment to drew@pereliwebworks.com.
							<script src="https://js.stripe.com/v3/"></script>
							<form action="/charge.php" method="post" id="payment-form">
								<div class="form-group">
									<input 
										name="name" 
										placeholder="Name" 
										required/>
								</div>
							    <div class="form-group">
							   		<div id="card-element"></div>
							   	</div>

							    <!-- Used to display form errors -->
							    <div id="card-errors"></div>

							    <div class="form-group">
							    	<span class="pre-input">$</span>
									<input 
										name="amount" 
										type="number" 
										placeholder="Amount" 
										required/>
								</div>

							  <button class="bttn-fill bttn-sm bttn-primary">Submit Payment</button>
							</form>
							<div class="response">
								<img src="img/spinner.gif" class="display-none"/>
								<div class="message display-none"></div>
							</div>
							<script>
								// Create a Stripe client
								var stripe = Stripe('pk_live_CNeiyiaWknkKKhcZ05jBA7OH');

								// Create an instance of Elements
								var elements = stripe.elements();

								// Custom styling can be passed to options when creating an Element.
								// (Note that this demo uses a wider set of styles than the guide below.)

								var style = {
								  base: {
								    color: '#ddd',
								    iconColor: '#fff'
								    //lineHeight: '24px',
								    //fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
								    //fontSmoothing: 'antialiased',
								    //fontSize: '16px',
								    //'::placeholder': {
								      //color: '#aab7c4'
								    //}
								  },
								  invalid: {
								    color: '#fa755a',
								    iconColor: '#fa755a'
								  }
								};

								// Create an instance of the card Element
								var card = elements.create('card', {style: style});

								// Add an instance of the card Element into the `card-element` <div>
								card.mount('#card-element');

								// Handle real-time validation errors from the card Element.
								card.addEventListener('change', function(event) {
								  var displayError = document.getElementById('card-errors');
								  if (event.error) {
								    displayError.textContent = event.error.message;
								  } else {
								    displayError.textContent = '';
								  }
								});

								// Handle form submission
								var form = document.getElementById('payment-form');
								form.addEventListener('submit', function(event) {
								  event.preventDefault();

								  $(form).parent().find(".response img").removeClass("display-none");

								  stripe.createToken(card).then(function(result) {
								    if (result.error) {
								      // Inform the user if there was an error
								      var errorElement = document.getElementById('card-errors');
								      errorElement.textContent = result.error.message;
								    } else {
								      // Send the token to your server
								      stripeTokenHandler(result.token);
								    }
								  });
								});

								function stripeTokenHandler(token) {
								  // Insert the token ID into the form so it gets submitted to the server
								  var form = document.getElementById('payment-form');
								  var hiddenInput = document.createElement('input');
								  hiddenInput.setAttribute('type', 'hidden');
								  hiddenInput.setAttribute('name', 'stripeToken');
								  hiddenInput.setAttribute('value', token.id);
								  form.appendChild(hiddenInput);

								  // Submit the form
								  $(form).ajaxSubmit(function(response){
								  	$(form).parent().find(".response .img").addClass("display-none")
								  	if (response){
								  		$(form).parent().find(".response .message")
								  			.removeClass("display-none")
											.addClass("success-message")
											.html("Your payment has been sent.");
								  	}
								  	else{
								  		$(form).parent().find(".response .message")
								  			.removeClass("display-none")
											.addClass("failure-message-message")
											.html("There was an error with your payment. Please try again later.");
								  	}
								  });
								}
							</script>
							<!--
							<form>
								<div>
									<input 
										id="cf-name" 
										name="name" 
										type="text" 
										placeholder="Your Name" />
								</div>
								<div>
									<input 
										id="cf-email" 
										name="email" 
										type="email" 
										placeholder="Your Email Address"/>
								</div>
								<div>
									<textarea 
										id="cf-message" 
										name="message"
										placeholder="Your Message"
										rows="5"></textarea>
								</div>
								<div>
									<button class="bttn-fill bttn-sm bttn-primary">Submit</button>
								</div>
							</form>
							-->
						</div>
					</div>
					<div class="large-spacer"></div>
					<div class="large-spacer"></div>
				</div>
				<div class="medium-spacer"></div>
				<div class="medium-spacer"></div>
				<div class="end-scroll-trigger"></div>
			</div>
		</div>
	</div>
</body>
</html>