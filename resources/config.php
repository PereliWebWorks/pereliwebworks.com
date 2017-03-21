<?php
	require_once __DIR__ . "/library/vendor/autoload.php";
	require_once "secrets.php";
	$mailer = new PHPMailer();
	$mailer->isSMTP();
    $mailer->Host = 'smtp.zoho.com';
    $mailer->SMTPAuth = true;
    $mailer->Username   = EMAIL_USER;
    $mailer->Password   = EMAIL_PASSWORD;
    $mailer->SMTPSecure = 'ssl';
    $mailer->Port = 465;
    $mailer->setFrom(EMAIL_USER, 'Pereli Web Works');
?>