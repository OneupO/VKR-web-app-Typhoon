<?php
session_start();

// ... Rest of the page code ...

// Check if form was submitted

    // Form data processing

    // Data validation


$current_page = $_SERVER['REQUEST_URI'];

// Database connection
$servername = "localhost";
$username = "typhoomy_mybase";
$password = "gega536!";
$dbname = "typhoomy_mybase";
$connection = new mysqli($servername, $username, $password, $dbname);
if ($connection->connect_error) {
    die("Не смог подключиться к БД: " . $connection->connect_error);
}

function logout()
{
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}

function saveApplication($name, $email, $subject, $message)
{
    global $connection;

    $sql = "INSERT INTO applications (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST['logout'])) {
    logout();
}

// Check if user is logged in
if (isset($_SESSION['login'])) {
    // Hide registration and login buttons
    echo '<style>#nav-btn-log, #nav-btn-reg{ display: none; }</style>';
    // Show logout button
    echo '<style>#nav-btn-logout { display: block; }</style>';
} else {
    // Hide logout button
    echo '<style>#nav-btn-logout { display: none; }</style>';
}

// Close database connection
$connection->close();
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
    <!-- Меню -->
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="" class="navbar-brand">
                <img class="m-0 display-4 display-4 font-weight-bold text-uppercase text-white" src="img\logofull.png" alt="ТАЙФУН" width="200">
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4 bg-secondary">
                    <a href="index.php" class="nav-item nav-link">Главная</a>
                    <a href="about.php" class="nav-item nav-link">О нас</a>
                    <a href="feature.php" class="nav-item nav-link">Отзывы</a>
                    <a href="class.php" class="nav-item nav-link">Занятия</a>
                    <a href="contact.php" class="nav-item nav-link <?php if($current_page=='/db/contact.php') echo 'active'; ?>">Обратная связь</a>

                </div>
                <a href="register.php" id="nav-btn-reg" class="nav-btn-style" class="nav-item nav-link">Регистрация</a>
                <a href="login.php" id="nav-btn-log" class="nav-btn-style" class="nav-item nav-link">Авторизация</a>
                <a href="#" id="nav-btn-logout" class="nav-btn-style" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выход (<?php echo $_SESSION["login"]; ?>)</a>
                <form id="logout-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <input type="hidden" name="logout">
                </form>
            </div>
    </div>
    </nav>
    </div>

    <!-- Вернуться -->
    <div class="container-fluid page-header mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h4 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase font-weight-bold">Обратная связь</h4>
            <div class="d-inline-flex">
                <p class="m-0 text-white"><a class="text-white" href="index.php">Назад</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Обратная связь</p>
            </div>
        </div>
    </div>


    <!-- Контакты -->
    <div class="container pt-5">
        <div class="d-flex flex-column text-center mb-5">
            <h4 class="text-primary font-weight-bold">Всегда на связи</h4>
            <h4 class="display-4 font-weight-bold">Открыты для вас</h4>
        </div>
        <div class="row px-3 pb-2">
            <div class="col-sm-4 text-center mb-3">
                <i class="fa fa-2x fa-map-marker-alt mb-3 text-primary"></i>
                <h4 class="font-weight-bold">Адрес</h4>
                <p>ул. Ярославская, 7, Вологда, Россия</p>
            </div>
            <div class="col-sm-4 text-center mb-3">
                <i class="fa fa-2x fa-phone-alt mb-3 text-primary"></i>
                <h4 class="font-weight-bold">Телефон</h4>
                <p>+7 (999)888-19-87</p>
            </div>
            <div class="col-sm-4 text-center mb-3">
                <i class="far fa-2x fa-envelope mb-3 text-primary"></i>
                <h4 class="font-weight-bold">Эл почта</h4>
                <p>typhoon.box@mail.ru</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 pb-5">
                <iframe style="width: 100%; height: 392px;" src="https://maps.google.com/maps?q=59.206611900975865,%2039.84903371723723&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
<!-- ЗАЯВКА -->
<div class="col-md-6 pb-5">
    <div class="contact-form">
        <div id="success"></div>
        <form action="mail.php" method="POST">
            <div class="control-group">
                <input type="text" class="form-control" name="user_name" type="text" id="name" placeholder="Имя" required="required" data-validation-required-message="Введите имя" />
                <p class="help-block text-danger"></p>
            </div>
            <div class="control-group">
                <input type="email" class="form-control" id="email" name="user_email" placeholder="Ваша электронная почта" required="required" data-validation-required-message="Введите эл. почту" />
                <p class="help-block text-danger"></p>
            </div>
            <div class="control-group">
                <input type="text" class="form-control" id="subject" name="user_header" type="text" placeholder="Заголовок" required="required" data-validation-required-message="Введите заголовок" />
                <p class="help-block text-danger"></p>
            </div>
            <div class="control-group">
                <textarea class="form-control" rows="6" id="message" name="user_message" placeholder="Сообщение" required="required" data-validation-required-message="Введите сообщение"></textarea>
                <p class="help-block text-danger"></p>
            </div>

            <?php if (isset($_SESSION['message_error'])) { ?>
                <div id="error_message" style="color: red;"><?php echo $_SESSION['message_error']; ?></div>
            <?php } ?>

            <?php if (isset($_SESSION['message_success'])) { ?>
                <div id="success_message" style="color: green;"><?php echo $_SESSION['message_success']; ?></div>
            <?php } ?>

            <div>
                <div>
                    <button class="btn btn-outline-primary" type="submit" id="sendMessageButton">Отправить</button>
                </div>
            </div>
        </form>
    </div>
</div>


    </div>
    </div>

    <!-- Подвал-->
    <div class="footer container-fluid mt-5 py-5 px-sm-3 px-md-3 text-white">
        <div class="row pt-5 ">
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-primary mb-4">Всегда на связи</h4>
                <p><i class="fa fa-map-marker-alt mr-2"></i> ул. Ярославская, 7, Вологда</p>
                <p><i class="fa fa-phone-alt mr-2"></i>+7 (999)888-19-87</p>
                <p><i class="fa fa-envelope mr-2"></i>typhoon.box@mail.ru</p>
                <div class="d-flex justify-content-start mt-4">
                    <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 40px; height: 40px;" href="#"><i class="fab fa-telegram"></i></a>
                    <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 40px; height: 40px;" href="#"><i class="fab fa-vk"></i></a>
                    <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 40px; height: 40px;" href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 mb-5">
                <h4 class="text-primary mb-4">Карта сайта</h4>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Главная</a>
                    <a class="text-white mb-2" href="about.html"><i class="fa fa-angle-right mr-2"></i>О нас</a>
                    <a class="text-white mb-2" href="feature.html"><i class="fa fa-angle-right mr-2"></i>Новости</a>
                    <a class="text-white mb-2" href="class.html"><i class="fa fa-angle-right mr-2"></i>Занятия</a>
                    <a class="text-white" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Контакты</a>
                </div>
            </div>

            <!-- РАССЫЛКА -->
            <div class="col-lg-4 col-md-6 mb-5">
                <h4 class="display-7 text-white font-weight-bold mt-5 mb-3">Подписаться на рассылку</h4>
                <p class="text-white mb-4">Узнавайте о всех событиях нашего клуба первыми!</p>
                <form class="form-inline justify-content-start mb-5" action="subscribe.php" method="POST">
                    <div class="input-group">
                        <input type="email" class="form-control-lg" placeholder="Ваш Email" name="user_email">
                        <input type="hidden" name="return_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" name="subscribe">Подписаться</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-3 col-md-6 mb-5">
                <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
                    <a href="" class="navbar-brand">
                        <img class="m-0 display-4 display-4 font-weight-bold text-uppercase text-white" src="img\logofull.png" alt="ТАЙФУН" width="200">
                    </a>
            </div>

        </div>
        <div class="container border-top border-dark pt-5">
            <p class="m-0 text-center text-white">
                &copy; <a class="text-white font-weight-bold" href="#">typhoon.com</a>. Все права защищены
            </p>
        </div>
    </div>


    <!-- Кнопка наверх -->
    <a href="#" class="btn btn-outline-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- Js  -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        function logout() {
            window.location.href = "logout.php";
        }
    </script>
</body>

</html>