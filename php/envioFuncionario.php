<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Load .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

if (isset($_POST["enviar"])) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                        // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                    // Enable SMTP authentication
        $mail->Username   = $_ENV['SMTP_USERNAME'];          // SMTP username
        $mail->Password   = $_ENV['SMTP_PASSWORD'];                  // SMTP password (from .env file)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;             // Enable implicit TLS encryption
        $mail->Port       = 465;                                     // TCP port to connect to; use 587 if using STARTTLS

        // Set character encoding to UTF-8
        $mail->CharSet = 'UTF-8';                                    // Set charset to UTF-8


        // Recipients
        // Recipients
        $mail->setFrom($_ENV['SMTP_USERNAME'], 'Agência Baby Care');
        $mail->addAddress($_ENV['SMTP_USERNAME'], 'Agência Baby Care');
        $mail->addAddress('babycareagenciadebabas@gmail.com', 'CONTATO Agência Baby Care');
        $mail->addReplyTo($_ENV['SMTP_USERNAME'], 'Agência Baby Care');


        // Attachments
        if (isset($_FILES['curriculo']) && $_FILES['curriculo']['error'] === UPLOAD_ERR_OK) {
            // Check file type
            $fileType = mime_content_type($_FILES['curriculo']['tmp_name']);
            if ($fileType !== 'application/pdf') {
                echo "Por favor, envie um arquivo PDF.";
                exit;
            }
            $nomeArquivo = $_POST['nome'] . '-' . $_FILES['curriculo']['name'];  // Create unique filename
            $mail->addAttachment($_FILES['curriculo']['tmp_name'], $nomeArquivo); // Attach PDF file
        } else {
            echo "Erro ao enviar o arquivo PDF.";
            exit;
        }

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'CANDIDATOS - Agência Baby Care';

        $body = "
        <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        line-height: 1.6;
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
                        overflow: hidden;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    }
                    .email-header {
                        background-color: #007bff;
                        color: #fff;
                        padding: 20px;
                        text-align: center;
                        font-size: 1.5em;
                        font-weight: bold;
                    }
                    .email-body {
                        padding: 20px;
                    }
                    .email-footer {
                        background-color: #f1f1f1;
                        padding: 15px;
                        text-align: center;
                        font-size: 0.9em;
                        color: #666;
                    }
                    .field {
                        margin-bottom: 15px;
                    }
                    .field span {
                        font-weight: bold;
                        color: #007bff;
                    }
                </style>
            </head>
            <body>
                <div class='email-container'>
                    <div class='email-header'>
                        NOVO CANDIDATO
                    </div>
                    <div class='email-body'>
                        <p>Você recebeu uma nova candidatura de um candidato. Confira os detalhes abaixo::</p>
                        <div class='field'><span>Nome completo:</span> " . htmlspecialchars($_POST['nome']) . "</div>
                        <div class='field'><span>Telefone para contato:</span> " . htmlspecialchars($_POST['telefone']) . "</div>
                        <div class='field'><span>Email:</span> " . htmlspecialchars($_POST['email']) . "</div>
                        <div class='field'><span>Endereço completo:</span> " . htmlspecialchars($_POST['endereco']) . "</div>
                        <div class='field'><span>CEP:</span> " . htmlspecialchars($_POST['cep']) . "</div>
                        <div class='field'><span>Experiência como babá:</span> " . htmlspecialchars($_POST['experiencia']) . "</div>
                        <div class='field'><span>Disponibilidade para trabalhar nos horários:</span> " . htmlspecialchars(implode(', ', $_POST['disponibilidade'])) . "</div>
                    </div>
                    <div class='email-footer'>
                        <p>Mensagem enviada automaticamente pelo sistema.</p>
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
