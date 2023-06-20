<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('phpmailer/PHPMailerAutoload.php');
    $mail = new PHPMailer;
    $mail->CharSet = 'utf-8';

    $name = $_POST['user_name'];
    $header_name = $_POST['user_header'];
    $email = $_POST['user_email'];
    $message = $_POST['user_message'];

    $mail->isSMTP();
    $mail->Host = 'smtp.mail.ru';
    $mail->SMTPAuth = true;
    $mail->Username = 'typhoon.box@mail.ru';
    $mail->Password = 'ej0KbnAYm4wsGbiswq2c';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('typhoon.box@mail.ru');
    $mail->addAddress('gorka__1@bk.ru');

    $mail->isHTML(true);

    $mail->Subject = 'Пользователь оставил заявку';
    $mail->Body = $name . ' оставил заявку,<br>' . $header_name . '<br>Почта: ' . $email . '<br>Сообщение: ' . $message;
    $mail->AltBody = '';

    $success_message = 'Заявка успешно отправлена.';
    $error_message = 'Не удалось отправить заявку. Попробуйте снова.';
    $email_error_message = 'Некорректный email. Пожалуйста, введите корректный email.';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = $email_error_message;
        $message_color = 'red';
    } elseif (!$mail->send()) {
        $message = $error_message;
        $message_color = 'red';
    } else {
        $message = $success_message;
        $message_color = 'green';
    }

    $return_url = $_SERVER['HTTP_REFERER'];

    header("refresh:3;url=$return_url");
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
                color: <?php echo $message_color; ?>;
                text-align: center;
                padding-top: 400px;
                font-size: 24px;
            }
        </style>
    </head>

    <body>
        <div class="message">
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
