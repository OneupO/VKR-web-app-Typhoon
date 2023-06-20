<?php
session_start();

if (isset($_SESSION['login'])) {
  echo '<style>#nav-btn-log, #nav-btn-reg{ display: none; }</style>';
  echo '<style>#nav-btn-logout { display: block; }</style>';
} else {
  echo '<style>#nav-btn-logout { display: none; }</style>';
}

$current_page = $_SERVER['REQUEST_URI'];

$servername = "localhost";  // Имя сервера базы данных
$username = "typhoomy_mybase";
$password = "gega536!";
$dbname = "typhoomy_mybase";  // Имя базы данных

$fack = new mysqli($servername, $username, $password, $dbname);

if ($fack->connect_error) {
  die("Connection failed: " . $fack->connect_error);
}

// Обработка отправки формы
if (isset($_POST['send-comment']) && isset($_SESSION['login'])) {
  $name = $fack->real_escape_string($_POST['name']);
  $comment = $fack->real_escape_string($_POST['comment']);

  if (!empty($name) && !empty($comment)) {
    $stmt = $fack->prepare("INSERT INTO comments (name, comment, datetime) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $name, $comment);

    if ($stmt->execute() === TRUE) {
      // Успешная запись в БД
      echo '<script>window.location.href = window.location.href;</script>';
      exit();
    } else {
      echo "Ошибка отправки в БД: " . $stmt->error;
    }
  } else {
    $error_message_full = "Сначала заполните все поля";
  }
}

// Получение всех отзывов из базы данных
$sql = "SELECT * FROM comments ORDER BY datetime DESC";
$result = $fack->query($sql);

$comments = [];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    array_push($comments, $row);
  }
}

$fack->close(); 

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
            <img class="m-0 display-4 display-4 font-weight-bold text-uppercase text-white" src="img\logofull.png" alt="ТАЙФУН" width="200" >
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav ml-auto p-4 bg-secondary">
            <a href="index.php" class="nav-item nav-link">Главная</a>
                    <a href="about.php" class="nav-item nav-link">О нас</a>
                    <a href="feature.php" class="nav-item nav-link <?php if($current_page=='/db/feature.php') echo 'active'; ?>">Отзывы</a>
                    <a href="class.php" class="nav-item nav-link">Занятия</a>
                    <a href="contact.php" class="nav-item nav-link">Обратная связь</a>

                </div>
                <a href="register.php" id="nav-btn-reg" class="nav-btn-style" class="nav-item nav-link">Регистрация</a>
                <a href="login.php"  id="nav-btn-log"  class="nav-btn-style" class="nav-item nav-link">Авторизация</a>
                <a href="#" id="nav-btn-logout" class="nav-btn-style" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выход (<?php echo $_SESSION["login"]; ?>)</a>
                <form id="logout-form" action="logout.php" method="POST">
                <input type="hidden" name="logout">
                
</form>
</div>
        </div>
    </nav>
</div>


    <!-- Вернуться -->
    <div class="container-fluid page-header mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h4 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase font-weight-bold">Отзывы</h4>
            <div class="d-inline-flex">
                <p class="m-0 text-white"><a class="text-white" href="index.php">Назад</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Отзывы</p>
            </div>
        </div>
    </div>

<?php if (isset($_SESSION['login'])) { ?>
  
<div class="container ">

  <div class="row justify-content-center log-top">
  <form action="" method="post" class="form-style" >
        <h1 class="text-center mb-3">Оставить свой отзыв</h1>
        <div class="mb-3">
        <h4 class="text-center mb-3 headers_color" class="text-primary font-weight-bold">Ваше имя:</h4>
        <input class="text-center mb-3" type="text" id="name" name="name"><br>
        </div>
        <div class="mb-3">
        <h4 class="text-center mb-3 headers_color">Ваш отзыв:</h4>
        <textarea id="comment" name="comment"></textarea><br>
        <button id="top-load" name="send-comment" type="submit">Отправить</button>
        </div>
        <?php if (isset($error_message_full)) {    ?>
        <div id="error_message" style="color: red;"><?php echo $error_message_full; ?></div>
        
        <?php } ?>
      </form>

  </div>
</div>
<?php } ?>
<div class="container ">

  <div class="row justify-content-center log-top">
<h2 id="comms" class="text-center mb-3">Отзывы:<br></h2>


<?php foreach ($comments as $comment) { ?>
  <div class="size_comm" >
    <div class="div_line_comm"><strong class="comment_user"><?php echo htmlspecialchars($comment['name'], ENT_QUOTES); ?></strong> <em class="date_comment"><?php echo date('Y-m-d H:i:s', strtotime($comment['datetime'])); ?></em></div>
    <div><?php echo htmlspecialchars($comment['comment'], ENT_QUOTES); ?></div>
  </div>
<?php } ?>

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
                    <img class="m-0 display-4 display-4 font-weight-bold text-uppercase text-white" src="img\logofull.png" alt="ТАЙФУН" width="200" >
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