<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer;

class SendMail extends Controller
{
	public static function mail(array $datos,string $message, string $subject,int $id=null)
	{

		$text             = $message;
        $mail             = new PHPMailer\PHPMailer(); // create a n
        $mail->SMTPDebug  = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth   = true; // authentication enabled
        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host       = "smtp.gmail.com";
        $mail->Port       = 587; // or 587
        $mail->IsSMTP();
        $mail->IsHTML(true);
        $mail->Username = "theskinpower.ca@gmail.com";
        $mail->Password = "th35k1np0w3r";
        $mail->SetFrom("theskinpower.ca@gmail.com", 'The Skin Power');
        $mail->Subject = $subject;
        $mail->AddEmbeddedImage('../public/img/TheSkinPower1.jpg', 'logo');
        $mail->Body    = $text;
        $mail->AddAddress($datos['email'], "$datos[name] $datos[lastname]");
        if ($mail->Send()) {
        	return "exitooooooooooo";
        } else {
        	return "nooooooooooooo";
        }
    }
}
