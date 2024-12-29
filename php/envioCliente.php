<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if (isset($_POST["enviar"])) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     // Enable verbose debug output
        $mail->isSMTP();                                              // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                         // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                     // Enable SMTP authentication
        $mail->Username   = $_ENV['SMTP_USERNAME'];          // SMTP username
        $mail->Password   = $_ENV['SMTP_PASSWORD'];                   // SMTP password (usando a variável de ambiente)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;              // Enable implicit TLS encryption
        $mail->Port       = 465;                                      // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // Set character encoding to UTF-8
        $mail->CharSet = 'UTF-8';                                    // Set charset to UTF-8

        // Recipients
        $mail->setFrom($_ENV['SMTP_USERNAME'], 'Agência Baby Care');
        $mail->addAddress($_ENV['SMTP_USERNAME'], 'Agência Baby Care');
        // $mail->addAddress('babycareagenciadebabas@gmail.com', 'CONTATO Agência Baby Care');
        $mail->addReplyTo($_ENV['SMTP_USERNAME'], 'Agência Baby Care');

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'CLIENTES - Agência Baby Care';

        $body = "
        <html>
            <head>
                <style>
                    body {
                        font-family: 'Arial', sans-serif;
                        color: #333;
                        background-color: #f9f9f9;
                        padding: 20px;
                    }
                    .email-container {
                        max-width: 600px;
                        margin: 0 auto;
                        background: #fff;
                        border: 1px solid #ddd;
                        border-radius: 8px;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    }
                    .email-header {
                        background-color: #28a745;
                        color: #fff;
                        text-align: center;
                        padding: 20px;
                        font-size: 1.6em;
                        font-weight: bold;
                    }
                    .email-body {
                        padding: 20px;
                    }
                    .email-body p {
                        font-size: 1em;
                        line-height: 1.6;
                        margin-bottom: 15px;
                    }
                    .field {
                        margin-bottom: 15px;
                    }
                    .field span {
                        font-weight: bold;
                        color: #28a745;
                    }
                    .email-footer {
                        background-color: #f1f1f1;
                        text-align: center;
                        padding: 15px;
                        font-size: 0.9em;
                        color: #666;
                    }
                </style>
            </head>
            <body>
                <div class='email-container'>
                    <div class='email-header'>
                        CLIENTES - SOLICITAÇÃO DE SERVIÇO
                    </div>
                    <div class='email-body'>
                        <p>Você recebeu uma nova solicitação de um cliente. Confira os detalhes abaixo:</p>
                        <div class='field'><span>Nome:</span> " . htmlspecialchars($_POST['nome']) . "</div>
                        <div class='field'><span>Email:</span> " . htmlspecialchars($_POST['email']) . "</div>
                        <div class='field'><span>Telefone:</span> " . htmlspecialchars($_POST['telefone']) . "</div>
                        <div class='field'><span>Endereço:</span> " . htmlspecialchars($_POST['endereco']) . "</div>
                        <div class='field'><span>CEP:</span> " . htmlspecialchars($_POST['cep']) . "</div>
                        <div class='field'><span>Mensagem:</span> " . htmlspecialchars($_POST['mensagem']) . "</div>
                    </div>
                    <div class='email-footer'>
                        <p>Esta mensagem foi gerada automaticamente pelo sistema.</p>
                        <p>Entre em contato com o cliente para prosseguir com a solicitação.</p>
                    </div>
                </div>
            </body>
        </html>
    ";


        $mail->Body    = $body;

        $mail->send();
        header("Location: ../thanksPage.html");
        exit;
    } catch (Exception $e) {
        echo "ERRO AO ENVIAR O EMAIL. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'Não foi possível enviar o email. ACESSO NÃO FOI POR FORMULÁRIO';
}
