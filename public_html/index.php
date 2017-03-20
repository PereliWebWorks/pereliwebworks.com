<html>
<head>
	<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/plugins/CSSPlugin.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/plugins/ScrollToPlugin.min.js"></script>
  	<script src="library/velocity.js"></script>
	<script src="library/ScrollMagic/ScrollMagic.js"></script>
	<script src="library/ScrollMagic/plugins/animation.gsap.js"></script>
	<script src="library/ScrollMagic/plugins/animation.velocity.js"></script>
	<script src="library/ScrollMagic/plugins/debug.addIndicators.js"></script>
	<script src="library/ScrollMagic/plugins/jquery.ScrollMagic.js"></script>

	<link href="css/global.css" type="text/css" rel="stylesheet" />
	<script src="js/animations.js"></script>
</head>
<body>
	<div id="container">
		<nav id="navbar">
			<a href="#home">Home</a>
			<a href="#about">About</a>
			<a href="#contact">Contact</a>
		</nav>
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
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<div class="animate-box">
						<h2>Who am I?</h2>
						<div>
							I'm a Madison based freelance web developer. Here's some more bullshit about me. blah blah blah, blah blah BLAH blah blah.
						</div>
					</div>
				</div>
				<div class="large-spacer"></div>
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<div class="animate-box">
						<h2>Looking for an affordable, quality website?</h2>
						<div>
							<a href="#contact">Get in touch.</a> Shoot me a message to discuss your project.
						</div>
					</div>
				</div>
				<div class="large-spacer"></div>
				<div id="site-example-trigger"></div>
				<div id="site-examples">
					<h1 id="site-example-header">Sites I've Worked On</h1>
					<?php for ($i = 0 ; $i < 3 ; $i++) : ?>
						<div>
							<?php for ($j = 0 ; $j < 3 ; $j++) : ?>
								<img class="site-example"
									src="http://www.smart-circle.org/smartcity/wp-content/uploads/sites/3/2017/01/Den-Haag-skyline-256x256.png" />
							<?php endfor; ?>
						</div>
					<?php endfor; ?>
				</div>
				<div class="large-spacer"></div>
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<h2 class="animate-text">Animate 4</h1>
				</div>
				<div class="large-spacer"></div>
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<h2 class="animate-text">Animate 5</h1>
				</div>
				<div class="large-spacer"></div>
				<div id="panel-wipe-trigger-2" data-triggers="2" class="panel-wipe-trigger"></div>
				<div class="end-scroll-trigger"></div>
			</div>
			<div class="panel-layout" id="panel-2-layout" data-layout-for="panel_2">
				<div class="start-scroll-trigger"></div>
				<div class="spacer"></div>
				<div class="spacer"></div>
				<div class="spacer"></div>
				<div id="about"></div>
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<h1 class="animate-text">Animate 1</h1>
				</div>
				<div class="medium-spacer"></div>
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<h1 class="animate-text">Animate 2</h1>
				</div>
				<div class="medium-spacer"></div>
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<h1 class="animate-text">Animate 3</h1>
				</div>
				<div class="medium-spacer"></div>
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<h1 class="animate-text">Animate 4</h1>
				</div>
				<div class="medium-spacer"></div>
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<h1 class="animate-text">Animate 5</h1>
				</div>
				<div class="medium-spacer"></div>
				<div id="panel-wipe-trigger-3" data-triggers="3" class="panel-wipe-trigger"></div>
				<div class="end-scroll-trigger"></div>
			</div>
			<div class="panel-layout" id="panel-3-layout" data-layout-for="panel_3">
				<div class="start-scroll-trigger"></div>
				<div class="spacer"></div>
				<div id="contact"></div>
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<h1 class="animate-text">Animate 1</h1>
				</div>
				<div class="medium-spacer"></div>
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<h1 class="animate-text">Animate 2</h1>
				</div>
				<div class="medium-spacer"></div>
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<h1 class="animate-text">Animate 3</h1>
				</div>
				<div class="medium-spacer"></div>
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<h1 class="animate-text">Animate 4</h1>
				</div>
				<div class="medium-spacer"></div>
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<h1 class="animate-text">Animate 5</h1>
				</div>
				<div class="medium-spacer"></div>
				<div class="end-scroll-trigger"></div>
			</div>
		</div>
	</div>
</body>
</html>