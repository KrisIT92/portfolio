<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Wymagane pliki PHPMailera
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    //$problem_description = $_POST["problem_description"];

    $to = 'kristof.zn.it@gmail.com'; // Poprawiony adres e-mail odbiorcy
    $subject = "Nowa wiadomość ze strony internetowej";

    $mail = new PHPMailer(true);
    $mail->CharSet = "UTF-8";

    try {
        // Konfiguracja serwera SMTP dla Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kristof.zn.it@gmail.com'; // Twój adres Gmail
        $mail->Password = 'gcaf fwnb pgul qgvr '; // Twoje hasło Gmail
        $mail->SMTPSecure = 'ssl'; // Użyj TLS
        
        $mail->Port = 465; // Port SMTP dla Gmail

        // Adres nadawcy i odbiorcy
        $mail->addReplyTo($email, $name);
        $mail->addAddress($to);
        //$mail->addReplyTo($email);

        // Treść wiadomości
        $mail->Subject = $subject;
       //$mail->Body = "$name\n";
      //$mail->Body .= "$email\n";
        $mail->Body .= "$message\n";
        //$mail->Body .= "$problem_description\n";

        // Wysłanie wiadomości
        $mail->send();

        header("Location: thanks.html");
        exit;
    } catch (Exception $e) {
        echo "Wystąpił problem podczas wysyłania wiadomości: {$mail->ErrorInfo}";
    }
}
?>
