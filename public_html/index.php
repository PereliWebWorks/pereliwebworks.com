<?php require_once __DIR__ . "/../resources/config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="description" content="My name is Drew Pereli. I'm a Madison-based freelance full-stack web developer and designer. I've been making websites for business, individuals, and other organizations for about a year now. I'm passionate about creating websites, and I feel incredibly lucky to be able to make a living off of it.">
	<title>Pereli Web Works</title>
	<!-- jQuery -->
	<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
  	<!-- jQuery ajax form -->
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.0/jquery.form.min.js" integrity="sha384-E4RHdVZeKSwHURtFU54q6xQyOpwAhqHxy2xl9NLW9TQIqdNrNh60QVClBRBkjeB8" crossorigin="anonymous"></script>
  	<!-- bootstrap -->
  	<link href="library/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
  	<script src="library/bootstrap/js/bootstrap.min.js"></script>
  	<!-- Animation stuff -->
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/plugins/CSSPlugin.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/plugins/ScrollToPlugin.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.5.0/velocity.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.velocity.min.js"></script>
	<!--<script src="library/ScrollMagic/plugins/debug.addIndicators.js"></script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/jquery.ScrollMagic.min.js"></script>
	<!-- Modernizr -->
	<script src="library/modernizr.js"></script>
	<!-- Stripe -->
	<script src="https://js.stripe.com/v3/"></script>
	<!-- Custom -->
	<link href="css/global.css" type="text/css" rel="stylesheet" />
	<script src="js/animations.js"></script>
	<script>
		$(function(){
			var currentScrollPosition;
			$(".open-modal-btn").click(function(){
				currentScrollPosition = controller.scrollPos();
				$("body")
					.css("position", "fixed")
					.css("overflow", "hidden");
				$(".modal-background-box").css("display", "block");
			});
			$(".close-modal-btn").click(function(){
				$("body")
					.css("position", "initial")
					.css("overflow", "initial");
				$(".modal-background-box").css("display", "none");
				$(document).scrollTop(currentScrollPosition);
			})

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
			initializeAnimations();
			$("#loading_spinner_container").remove();
			//Animate in header and other stuff if we're at the top of the page
			if ($(document).scrollTop() === 0 && document.body.clientWidth > 1000){
				new TimelineMax()
					.from($("#container"), 1, {opacity: 0})
					.staggerFrom($("#main-header span"), .5, {opacity: 0}, .02, .5)
					.from($("#scroll-for-more"), .5, {opacity: 0}, 1);
			}

		});
	</script>
</head>
<body>
	<div id="loading_spinner_container">
		<img src="img/loading_spinner.gif" alt="page loading spinner"/>
	</div>
	<!-- Modals -->
	<div class="modal fade" id="contact-modal" tabindex="-1" role="dialog" aria-labelledby="contact-modal-label" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h2 class="modal-title" id="contact-modal-label">Get in Touch</h2>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
				<div class="smaller-font">
					<div>
					Feel free to email me directly at 
					<a href="mailto:drew@pereliwebworks.com">drew@pereliwebworks.com</a>.
					<br/>
					Or use this form to contact me.
					</div>
					<form id="mobile-contact-form" method="POST" action="contact.php">
						<div class="form-group">
							<input 
								name="name" 
								type="text" 
								placeholder="Name" 
								title="Name"
								required/>
						</div>
						<div class="form-group">
							<input 
								id="email-input"
								name="email" 
								type="email" 
								placeholder="Email Address"
								title="Email Address"
								required/>
						</div>
						<div class="form-group">
							<textarea 
								name="message"
								placeholder="Message"
								title="Message"
								rows="3" required></textarea>
						</div>
						<div class="form-group">
							<button class="btn submit-btn">Submit</button>
						</div>
					</form>
					<div class="response">
						<img src="img/spinner.gif" class="display-none" alt="waiting spinner"/>
						<div class="message display-none"></div>
					</div>
					<script>
						$("#mobile-contact-form").submit(function(e){
							e.preventDefault();
							$("#mobile-contact-form").parent().find(".response img").removeClass("display-none");
							$("#mobile-contact-form").ajaxSubmit(function(response){
								$("#mobile-contact-form").parent().find(".response img").addClass("display-none");
								if (response){
									$("#mobile-contact-form").parent().find(".response .message")
										.removeClass("display-none")
										.addClass("success-message")
										.html("Your message has been sent.");
								}
								else{
									$("#mobile-contact-form").parent().find(".response .message")
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
	      <div class="modal-footer">
	        <button type="button" class="btn btn-white close-modal-btn" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="modal fade" id="payment-modal" tabindex="-1" role="dialog" aria-labelledby="payment-modla-label" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h2 class="modal-title" id="payment-modla-label">Make a Payment</h2>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			<div>
				<form action="/charge.php" method="post" id="mobile-payment-form">
					<div class="form-group">
						<input 
							name="name" 
							placeholder="Name" 
							title="Name"
							required/>
					</div>
				    <div class="form-group">
				   		<div id="mobile-card-element"></div>
				   	</div>

				    <!-- Used to display form errors -->
				    <div id="mobile-card-errors"></div>

				    <div class="form-group">
				    	<span class="pre-input">$</span>
						<input 
							name="amount" 
							type="number" 
							placeholder="Amount" 
							title="Amount"
							required/>
					</div>

				  <button class="btn">Submit Payment</button>
				</form>
				<div class="response">

					<img src="img/spinner.gif" class="display-none" alt="waiting spinner"/>
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
					    iconColor: '#fff',
					    lineHeight: "57px",
					    fontSize: "40px"
					    //fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
					    //fontSmoothing: 'antialiased',
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
					card.mount('#mobile-card-element');

					// Handle real-time validation errors from the card Element.
					card.addEventListener('change', function(event) {
					  var displayError = document.getElementById('mobile-card-errors');
					  if (event.error) {
					    displayError.textContent = event.error.message;
					  } else {
					    displayError.textContent = '';
					  }
					});

					// Handle form submission
					var form = document.getElementById('mobile-payment-form');
					form.addEventListener('submit', function(event) {
					  event.preventDefault();

					  $(form).parent().find(".response img").removeClass("display-none");

					  stripe.createToken(card).then(function(result) {
					    if (result.error) {
					      // Inform the user if there was an error
					      var errorElement = document.getElementById('mobile-card-errors');
					      errorElement.textContent = result.error.message;
					    } else {
					      // Send the token to your server
					      stripeTokenHandler(result.token);
					    }
					  });
					});

					function stripeTokenHandler(token) {
					  // Insert the token ID into the form so it gets submitted to the server
					  var form = document.getElementById('mobile-payment-form');
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
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-white close-modal-btn" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="modal-background-box">
	</div>
	<!-- /Modals -->
	<div id="container" class="navbar-container">
		<div id="navbar" class="navbar navbar-default navbar-fixed-top hidden-mobile" role="navigation">
		    <div class="container-fluid">
		        <div class="navbar-header"><a class="navbar-brand" href="#home">Pereli Web Works</a>
		            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
		            </button>
		        </div>
		        <div class="collapse navbar-collapse navbar-menubuilder">
		            <ul class="nav navbar-nav navbar-left">
		                <li class="dropdown">
		                	<a class="dropdown-toggle" data-toggle="dropdown">
		                		About <b class="caret"></b>
		                	</a>
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
		                <li class="dropdown">
		                	<a class="dropdown-toggle" data-toggle="dropdown">
		                		Contact <b class="caret"></b>
		                	</a>
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
		<div id="mobile-navbar" class="visible-mobile">
			<div>
				<a href="#home">Home</a>
			</div>
			<div>
				<a href="#about">
				About
				</a>
			</div>
			<div>
				<a href="#contact">
				Contact
				</a>
			</div>
		</div>
		<div id="panels">
			<div class="panel" id="panel_1" data-p-num="1">
				<img 
					src="img/backgrounds/capital.jpg"
					alt="Madison Capital"
				/>
			</div>
			<div class="panel" id="panel_2" data-p-num="2">
				<img 
					src="img/backgrounds/bascom.jpg"
					alt="University of Wisconsin Madison Bascom Hall"
				/>
			</div>
			<div class="panel" id="panel_3" data-p-num="3">
				<img 
					src="img/backgrounds/sunset.jpg"
					alt="Madison Sunset"
				/>
			</div>
		</div>
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
				<h1 id="main-header" class="lettering">
					Pereli Web Works
				</h1>
				<div id="main-header-disappear-trigger"></div>
				<div id="scroll-for-more" class="text-center">
					<span>&#8681;&#8681;&#8681;&#8681;&#8681;</span>
				</div>
				<div class="large-spacer"></div>
				<div id="about"></div>
				<div class="animate-container">
					<div class="animate-box">
						<h2><span class="lettering">Who I am</span></h2>
						<div>
							<div class="lettering">My name is Drew Pereli. I'm a Madison-based full-stack freelance web developer and designer. I've been making websites for business, individuals, and other organizations for about a year now. I'm passionate about creating websites, and I feel incredibly lucky to be able to make a living off of it. </div>
							<div>&nbsp;</div>
							<div class="text-center">
								<a href="#contact" class="lettering btn hidden-mobile">
									Get in touch
								</a>
								<span class="lettering btn visible-mobile"
										data-toggle="modal" 
										data-target="#contact-modal">
									Get in touch
								</span>
								<div>&nbsp;</div>
								<a href="#work" class="lettering btn hidden-mobile">
									See my work
								</a>
							</div>
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

					<h1 id="site-example-header">My Work</h1>
					<div class="example-images">
						<?php 
							$sites = array(
								array(
									"src"=>"state_street_brats",
									"url"=>"http://www.statestreetbrats.com",
									"alt"=>"State Street Brats"
								),
								array(
									"src"=>"paw_friendly_cat_furniture",
									"url"=>"http://pawfriendlyfurniture.com/",
									"alt"=>"Paw Friendly Cat Furniture"
								),
								array(
									"src"=>"silver_cloud_society",
									"url"=>"https://silvercloudsociety.com/",
									"alt"=>"Silver Cloud Society"
								),
								array(
									"src"=>"the_landing",
									"url"=>"http://www.thelandingmadison.com/",
									"alt"=>"The Landing"
								),
								array(
									"src"=>"JCW_tax_and_accounting",
									"url"=>"http://www.jcwtaxaccounting.com/",
									"alt"=>"JCW Tax and Accounting"
								),
								array(
									"src"=>"skin608",
									"url"=>"http://skin608.com/",
									"alt"=>"Skin608"
								)
							); 
							$s = 0;
						?>
						<?php for ($i = 0 ; $i < 3 ; $i++) : ?>
							<div class="example-row">
								<?php for ($j = 0 ; $j < 2 ; $j++) : ?>
									<div class="example-container">
										<a href="<?=$sites[$s]['url'];?>" target="_blank" class="site-example">
											<img 
												src="img/example_sites/<?=$sites[$s]['src'];?>.jpg" 
												alt="<?=$sites[$s]['alt'];?>"
											/>
										</a>
									</div>
								<?php 
										$s++;
									endfor; 
								?>
							</div>
						<?php endfor; ?>
					</div>
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
								<button class="btn" id="see-resume-btn">
									See my resume
								</button>
								<div>&nbsp;</div>
								<button class="btn" id="download-resume-btn">
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
							My rate is negotiable, but I generally charge around $25 per hour. I'm also happy to work from a fixed-price contract. If you have a specific budget, I can give you an estimate of what I can do for you while staying within your price range.
						</div>
					</div>
					<div class="large-spacer"></div>
					<!--<div class="large-spacer"></div>-->
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
					<div class="animate-box" id="contact-box">
						<h2 class="anim">Get in Touch</h2>
						<div class="smaller-font">
							<div class="anim">
								Feel free to email me directly at <a href="mailto:drew@pereliwebworks.com">drew@pereliwebworks.com</a>.
								<span class="hidden-mobile">Or use this form to contact me.</span>
								<span class="visible-mobile">Or click the button bellow to fill out a contact form.</span>
							</div>
							<span class="hidden-mobile">
								<form id="contact-form" method="POST" action="contact.php">
									<div class="form-group anim">
										<input 
											name="name" 
											type="text" 
											placeholder="Name" 
											title="Name"
											required/>
									</div>
									<div class="form-group anim">
										<input 
											name="email" 
											type="email" 
											placeholder="Email Address"
											title="Email Address"
											required/>
									</div>
									<div class="form-group anim">
										<textarea 
											name="message"
											placeholder="Message"
											title="Message"
											rows="3" required></textarea>
									</div>
									<div class="form-group anim">
										<button class="btn submit-btn">Submit</button>
									</div>
								</form>
								<div class="response anim">
									<img src="img/spinner.gif" class="display-none" alt="waiting spinner"/>
									<div class="message display-none"></div>
								</div>
							</span>
							<div>&nbsp;</div>
							<div class="anim text-center">
								<button type="button" 
										class="btn open-modal-btn visible-mobile" 
										data-toggle="modal" 
										data-target="#contact-modal">
											Get in Touch
								</button>
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
						<div class="hidden-mobile">
							You can use the secure payment form bellow to make a payment. If you'd rather use PayPal, you can send a PayPal payment to drew@pereliwebworks.com.
							<form action="/charge.php" method="post" id="payment-form">
								<div class="form-group">
									<input 
										name="name" 
										placeholder="Name" 
										title="Name"
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
										title="Amount"
										required/>
								</div>
							  <button class="btn">Submit Payment</button>
							</form>
							<div class="response">
								<img src="img/spinner.gif" class="display-none" alt="waiting spinner"/>
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
								    iconColor: '#fff',
								    lineHeight: $("#payment-form input").height() + "px",
								    fontSize: $("#payment-form input").css("font-size")
								    //fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
								    //fontSmoothing: 'antialiased',
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
						</div>
						<div class="visible-mobile">
							<div>
							Click the button bellow to access a secure payment form. If you'd rather use paypal, send a paypal payment to drew@pereliwebworks.com.
							</div>
							<div>&nbsp;</div>
							<div class="text-center">
								<button type="button"
										class="btn"
										data-toggle="modal" 
										data-target="#payment-modal">
									Make a Payment
								</button>
							</div>
						</div>
					</div>
					<div class="large-spacer"></div>
					<div class="large-spacer"></div>
				</div>
				<div class="medium-spacer"></div>
				<div id="footer-animation-trigger"></div>
				<div id="footer" class="text-center">
					<span>
						&copy; <script>document.write(new Date().getFullYear())</script> Drew Pereli, Pereli Web Works
					</span>
				</div>
				<div class="medium-spacer"></div>
				<div class="end-scroll-trigger"></div>
			</div>
		</div>
	</div>
</body>
</html>