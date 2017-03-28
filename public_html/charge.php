<?php
	require_once __DIR__ . "/../resources/config.php";
	// Set your secret key: remember to change this to your live secret key in production
	// See your keys here: https://dashboard.stripe.com/account/apikeys
	\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

	// Token is created using Stripe.js or Checkout!
	// Get the payment token submitted by the form:
	$token = $_POST['stripeToken'];
	$amount = $_POST['amount'];
	$name = $_POST['name'];
	if (empty($token) || empty($amount) || empty($name))
		return;
	$amount = (int)$amount * 100;
	// Charge the user's card:
	$charge = \Stripe\Charge::create(array(
	  "amount" => $amount,
	  "currency" => "usd",
	  "description" => "Payment from $name",
	  "source" => $token,
	));

	if ($charge->paid){
		echo "success";
	}
?>