<?php require_once __DIR__ . "/../resources/config.php"; ?>
<html>
<head>
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
	<!-- Custom -->
	<link href="css/global.css" type="text/css" rel="stylesheet" />
	<link href="css/navbar.css" type="text/css" rel="stylesheet" />
	<script src="js/animations.js"></script>
</head>
<body>
	<div id="container">
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
		<!-- This div is where all of the triggers and text are -->
		<div id="layout-container">
			<div class="panel-layout" id="panel-1-layout" data-layout-for="panel_1">
				<div id="home"></div><!-- Anchor for home section -->
				<div class="start-scroll-trigger"></div>
				<h1 id="main-header">Pereli Web Works</h1>
				<div class="large-spacer"></div>
				<div id="main-header-disappear-trigger"></div>
				<div class="spacer"></div>
				<div id="about">
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<div class="animate-box">
						<h2>Who am I?</h2>
						<div>
							I'm a Madison based freelance web developer. Here's some more bullshit about me. blah blah blah, blah blah BLAH blah blah.
						</div>
					</div>
				</div>
				<div class="medium-spacer"></div>
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<div class="animate-box">
						<h2>Looking for an affordable, quality website?</h2>
						<div>
							<a href="#contact">Get in touch.</a> Shoot me a message to discuss your project.
						</div>
					</div>
				</div>
				<div class="medium-spacer"></div>
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
					<div class="animate-trigger"></div>
					<div class="animate-box">
						<h2>Resume</h2>
						<div>
							Click here to see my resume.
							Click here to download.
						</div>
					</div>
				</div>
				<div class="medium-spacer"></div>
				<div id="pricing"></div>
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<div class="animate-box">
						<h2>Pricing</h2>
						<div>
							My rate is negotiable, but I generally charge around $25 per hour. For a non-profit, I usually charge less. 
						</div>
					</div>
				</div>
				<div class="large-spacer"></div>
				<div id="panel-wipe-trigger-3" data-triggers="3" class="panel-wipe-trigger"></div>
				<div class="end-scroll-trigger"></div>
			</div>
			<div class="panel-layout" id="panel-3-layout" data-layout-for="panel_3">
				<div class="start-scroll-trigger"></div>
				<div class="large-spacer"></div>
				<div class="medium-spacer"></div>
				<div id="contact"></div>
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<div class="animate-box">
						<h2>Get in Touch</h2>
						<div>
							Feel free to email me directly at drew@pereliwebworks.com.<br/>
							Or use this form to contact me.
							<form id="contact-form" method="POST" action="contact.php">
								<div>
									<input 
										name="name" 
										type="text" 
										placeholder="Name" 
										required/>
								</div>
								<div>
									<input 
										name="email" 
										type="email" 
										placeholder="Email Address"
										required/>
								</div>
								<div>
									<input 
										name="subject" 
										placeholder="Subject"
										required/>
								</div>
								<div>
									<textarea 
										name="message"
										placeholder="Message"
										rows="5" required></textarea>
								</div>
								<div>
									<button class="bttn-fill bttn-sm bttn-primary">Submit</button>
								</div>
							</form>
							<div class="response message display-none"></div>
							<script>
								$("#contact-form").ajaxForm(function(response){
									if (response){
										$("#contact-form").parent().find(".response")
											.removeClass("display-none")
											.addClass("success-message")
											.html("Your message has been sent.");
									}
									else{
										$("#contact-form").parent().find(".response")
											.removeClass("display-none")
											.addClass("failure-message")
											.html("There was an error. Please try again later.");
									}
								})
							</script>
						</div>
					</div>
				</div>
				<div class="medium-spacer"></div>
				<div id="payment"></div>
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<div class="animate-box">
						<h2>Make a Payment</h2>
						<div>
							You can use the secure payment form bellow to make a payment. If you'd rather use PayPal, you can send a PayPal payment to drew@pereliwebworks.com.
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
						</div>
					</div>
				</div>
				<div class="medium-spacer"></div>
				<div class="medium-spacer"></div>
				<div class="end-scroll-trigger"></div>
			</div>
		</div>
	</div>
</body>
</html>