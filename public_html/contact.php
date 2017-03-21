<?php
	require_once __DIR__ . "/../resources/config.php";
	$mailer->addAddress($_POST["email"], $_POST["name"]);
	$mailer->Subject = "Thanks for getting in touch with Pereli Web Works.";
	$mailer->Body = "Thanks for getting in touch. I've received your message and I'll get back to you as soon as possible. --Drew Pereli";
	if(!$mailer->send()) {
		die();
	} else {
		echo "1";
	}
	$mailer->ClearAllRecipients( );
	$mailer->addAddress("drew@pereliwebworks.com", "Drew Pereli");
	$mailer->addReplyTo($_POST["email"], $_POST["name"]);
	$mailer->isHTML(true);
	$mailer->Subject = "New message from your website.";
	$body = "<div>Name: " . $_POST['name'] . "</div>"
			. "<div>Email: ". $_POST['email'] . "</div>"
			. "<div>Subject: " . $_POST['subject'] . "</div>"
			. "<div>Message:</div>"
			. "<div>" . $_POST['message'] . "</div>";
	$mailer->Body = $body;
	if(!$mailer->send()) {
		die();
	} else {
		echo "1";
	}
?>