<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->setLanguage('uk', 'phpmailer/language/');
    $mail->IsHTML(true);

    
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'userEmail@gmail.com';                     //SMTP username
    $mail->Password   = 'nkjwosrejruouxrd';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                 
    
    // From email
    $mail->setFrom('userEmail@gmail.com', 'НА вчора');

    // Recipient email
    $mail->addAddress('userEmail@gmail.com');

    // Email subject
    $mail->Subject = 'Увага!Заявка ПОЛІГРАФІЯ [http://www.liderm.lviv.ua/print/]';

    // Email body
    $body = '<h1>Заявка ПОЛІГРАФІЯ</h1>';
    $body .= '<p><strong>Ім\'я:</strong> ' . $_POST['name'] . '</p>';
    $body .= '<p><strong>Номер телефону:</strong> ' . $_POST['phone'] . '</p>';
    $body .= '<p><strong>Місто:</strong> ' . $_POST['city'] . '</p>';
    $body .= '<p><strong>Електронна пошта:</strong> ' . $_POST['email'] . '</p>';
    $body .= '<p><strong>Запит:</strong> ' . $_POST['request'] . '</p>';

    // Add the deadline field if it exists
    if (isset($_POST['deadline'])) {
        $body .= '<p><strong>Термін виконання:</strong> ' . $_POST['deadline'] . '</p>';
    }

    $mail->Body = $body;

    // File attachment
    if (!empty($_FILES['file']['tmp_name'])) {
        $filePath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $mail->addAttachment($filePath, $fileName);
    }

    // Sending email
    if (!$mail->send()) {
        $message = 'Помилка';
    } else {
        $message = 'Дані надіслані!';
    }

    // JSON response
    $response = ['message' => $message];
    header('Content-type: application/json');
    echo json_encode($response);
?>
