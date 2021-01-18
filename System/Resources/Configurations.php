<?php
	date_default_timezone_set("Europe/Rome");
	ini_set('session.gc_maxlifetime', 172800);
	session_set_cookie_params(172800);
	
	$db = array(
		"Host" => "localhost",
		"User" => "",
		"Passwd" => "",
		"DB_name" => "",
		"Format" => "Mysqli",
	);
	$settings = array(
        "Template" => "Default"
	);
	$advanced = array(
		"Folder_Application" => "App",
		"SiteKey_ReCaptcha" => "",
		"SecretKey_ReCaptcha" => "",
	);

	$email = array(
		"EMAIL_REGISTER" => "",
	);
	
	$rsa = array(
		"PublicKey" => ""
	);
?>