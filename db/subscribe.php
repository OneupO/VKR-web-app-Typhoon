<?php
if (isset($_POST['subscribe'])) {
    require_once('phpmailer/PHPMailerAutoload.php');
    $mail = new PHPMailer;
    $mail->CharSet = 'utf-8';

    $email = $_POST['user_email'];
    $return_url = $_SERVER['HTTP_REFERER'];
    $message = '';
    $message_class = '';

    // Валидация email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Некорректный email
        $message = 'Некорректный email.';
        $message_class = 'message-error';
    } else {
        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.mail.ru';                         // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'typhoon.box@mail.ru';              // Ваш логин от почты с которой будут отправляться письма
        $mail->Password = 'ej0KbnAYm4wsGbiswq2c';                     // Ваш пароль от почты с которой будут отправляться письма
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to / этот порт может отличаться у других провайдеров

        $mail->setFrom('typhoon.box@mail.ru');                // От кого будет уходить письмо?
        $mail->addAddress($email);                             // Кому будет уходить письмо

        $mail->isHTML(true);                                  // Формат HTML сообщения

        $mail->Subject = 'Подписка на рассылку';
        $mail->Body    = 'Вы успешно подписались на рассылку нашего клуба!'; // Текст письма

        // Остальной код обработки подписки и отправки уведомления

        if (!$mail->send()) {
            // Ошибка при отправке уведомления
            $message = 'Ошибка при отправке уведомления.';
            $message_class = 'message-error';
        } else {
            // Уведомление успешно отправлено
            $message = 'Вы подписались на рассылку.';
            $message_class = 'message-success';
        }
    }

    header('refresh:3;url=' . $return_url);
    ?>

    <!DOCTYPE html>
    <html lang="ru">

    <head>
        <meta charset="utf-8">
        <title>Клуб бокса Тайфун</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="css/style.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <style>
            .message {
                text-align: center;
                margin-top: 400px;
                font-size: 24px;
            }

            .message-error {
                color: red;
            }

            .message-success {
                color: green;
            }
        </style>
    </head>

    <body class="bg-white">
        <div class="message <?php echo $message_class; ?>">
            <?php echo $message; ?> Вы будете перенаправлены через 3 секунды...
        </div>
    </body>

    </html>

<?php
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <title>Клуб бокса Тайфун</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-white">

</body>

</html>
