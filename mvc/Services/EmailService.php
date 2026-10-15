<?php

namespace mvc\Services;

use PHPMailer\PHPMailer\PHPMailer;

class EmailService
{
    public static function configure(PHPMailer $mail): void
    {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'projGuiar@gmail.com';
        $mail->Password = 'jjuj ysee xhvs fnji';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
    }
}
