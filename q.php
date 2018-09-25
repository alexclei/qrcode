<?php 
	require_once 'vendor/autoload.php';

	use Respect\Validation\Validator as v;
	use Endroid\QrCode\QrCode;

	$qrCode = new QrCode($_POST["name"]);
	header('Content-Type: '.$qrCode->getContentType());
	echo $qrCode->writeString();

	$n = v::stringType()->validate($_POST["name"]);
	$e = v::email()->validate($_POST["email"]);
	$d = v::date('Y-m-d')->validate($_POST["date"]);

	if ($n) {
		echo 'Nome valido<br>';
	}
	else
	{
		echo 'Nome invalido<br>';
	}
	if ($e) {
		echo 'Email valido<br>';
	}
	else
	{
		echo 'Email invalido<br>';
	}
	if ($d) {
		echo 'Data valido<br>';
	}
	else
	{
		echo 'Data invalido<br>';
	}
	