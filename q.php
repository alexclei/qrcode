<?php 
	require_once 'vendor/autoload.php';

	use Respect\Validation\Validator as v;
	use Endroid\QrCode\QrCode;
	
	if(!v::email()->validate($_POST["email"])){
		header('Location:index.php');	
	}
	$qrCode = new QrCode($_POST["text"]);
	$qrCode->writeFile(__DIR__.'/qrcode.png');
	// Create the Transport
	$transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
		->setUsername('email')
		->setPassword($_POST["pass"]);

	// Create the Mailer using your created Transport
	$mailer = new Swift_Mailer($transport);
		
	// Create a message
	$message = (new Swift_Message('email teste'))
		->setFrom(['email' => 'Alex Rodrigues'])
		->setTo([$_POST["email"]])
		->setBody("b")
		->attach(Swift_Attachment::fromPath('qrcode.png'));
	// Send the message
	$result = $mailer->send($message);
	echo "Atividade Concluida!";