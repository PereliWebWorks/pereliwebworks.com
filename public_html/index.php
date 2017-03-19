<html>
<head>
	<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
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
		<nav id="navbar">abcdsasd</nav>
		<div class="panel" id="panel_1" data-p-num="1"></div>
		<div class="panel" id="panel_2" data-p-num="2"></div>
		<div class="panel" id="panel_3" data-p-num="3"></div>
		<!-- This div is where all of the triggers and text are -->
		<div id="layout-container">
			<div class="panel-layout" id="panel-1-layout" data-layout-for="panel_1">
				<div class="spacer"></div>
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<h1 class="animate-text">Animate 1</h1>
				</div>
				<div class="large-spacer"></div>
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<h1 class="animate-text">Animate 2</h1>
				</div>
				<div class="large-spacer"></div>
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<h1 class="animate-text">Animate 3</h1>
				</div>
				<div class="large-spacer"></div>
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<h1 class="animate-text">Animate 4</h1>
				</div>
				<div class="large-spacer"></div>
				<div class="animate-container">
					<div class="animate-trigger"></div>
					<h1 class="animate-text">Animate 5</h1>
				</div>
				<div class="large-spacer"></div>
				<div id="panel-wipe-trigger-2" data-triggers="2" class="panel-wipe-trigger"></div>
			</div>
			<div class="panel-layout" id="panel-2-layout" data-layout-for="panel_2">
				<div class="spacer"></div>
				<div class="spacer"></div>
				<div class="spacer"></div>
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
			</div>
			<div class="panel-layout" id="panel-3-layout" data-layout-for="panel_3">
				<div class="spacer"></div>
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
			</div>
		</div>
	</div>
</body>
</html>