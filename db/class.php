<?php
session_start();

// ... Дальнейший код страницы ...


$current_page = $_SERVER['REQUEST_URI'];


function logout() {
  session_destroy();
  header("Location: index.php");
  exit;
}

if (isset($_POST['logout'])) {
  logout();
}

// проверяем, авторизован ли пользователь
if (isset($_SESSION['login'])) {
  // если пользователь авторизован, скрываем кнопки регистрации и авторизации
  echo '<style>#nav-btn-log, #nav-btn-reg{ display: none; }</style>';
  // отображаем кнопку выхода
  echo '<style>#nav-btn-logout { display: block; }</style>';
} else {
    // если пользователь не авторизован, скрываем кнопку выхода
    echo '<style>#nav-btn-logout { display: none; }</style>';
  }

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Клуб бокса Тайфун</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="css/style.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
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
                    <a href="feature.php" class="nav-item nav-link">Отзывы</a>
                    <a href="class.php" class="nav-item nav-link <?php if($current_page=='/db/class.php') echo 'active'; ?>">Занятия</a>
                    <a href="contact.php" class="nav-item nav-link">Обратная связь</a>

                </div>
                <a href="register.php" id="nav-btn-reg" class="nav-btn-style" class="nav-item nav-link">Регистрация</a>
                <a href="login.php"  id="nav-btn-log"  class="nav-btn-style" class="nav-item nav-link">Авторизация</a>
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
            <h4 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase font-weight-bold">Занятия</h4>
            <div class="d-inline-flex">
                <p class="m-0 text-white"><a class="text-white" href="index.php">Назад</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Занятия</p>
            </div>
        </div>
    </div>


    <div class="container info_blok py-4">
    <div class="">
      <h2 class="py-4">РАСПИСАНИЕ ЗАНЯТИЙ В КЛУБЕ</h2>
      <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed fw-bold" type="button" data-toggle="collapse" data-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
              <h2 class="name_style">Тренер: Первунин Алексей Анатольевич</h2>
            </button>
          </h2>
          <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
            data-parent="#accordionFlushExample">
            <div class="accordion-body">
              <b class="b_style">Группа № 1</b>
              Возраст: 8 лет и младше<br>
              Вторник: с 17:00 до 18:00<br>
              Четверг: с 17:00 до 18:00<br>
              Воскресенье: с 16:00 до 17:00<br>
              <br>
              <br>
              <b class="b_style">Группа № 2</b>
              Возраст: c 9 лет до 14 лет <br>
              Вторник: с 18:00 до 19:00<br>
              Четверг: с 18:00 до 19:00<br>
              Воскресенье: с 17:00 до 18:00<br>
              <br>
              <br>
              <b class="b_style">Группа № 3</b>
              Возраст: 16 лет и старше<br>
              Вторник: с 19:00 до 21:00<br>
              Четверг: с 19:00 до 21:00<br>
              Воскресенье: с 18:00 до 20:00<br>
              <br>
              <b class="b_style">Индивидуальные тренировки</b><br>
              Каждый день: с 9:00 до 16:00<br>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingTwo">
            <button class="accordion-button collapsed fw-bold" type="button" data-toggle="collapse" data-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
              <h2 class="name_style">Тренер: Крупеников Дмитрий Михайлович</h2>
            </button>
          </h2>
          <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
            data-parent="#accordionFlushExample">
            <div class="accordion-body">
              <b class="b_style">Группа № 1</b>
              Возраст: 8 лет и младше<br>
              Понедельник: с 17:00 до 18:00<br>
              Среда: с 17:00 до 18:00<br>
              Суббота: с 16:00 до 17:00<br>
              <br>
              <br>
              <b class="b_style">Группа № 2</b>
              Возраст: c 9 лет до 14 лет <br>
              Понедельник: с 18:00 до 19:00<br>
              Среда: с 18:00 до 19:00<br>
              Суббота: с 17:00 до 18:00<br>
              <br>
              <br>
              <b class="b_style">Группа № 3</b>
              Возраст: 15 лет и старше<br>
              Понедельник: с 19:00 до 21:00<br>
              Среда: с 19:00 до 21:00<br>
              Суббота: с 18:00 до 20:00<br>
              <br>
              <b>Индивидуальные тренировки</b><br>
              Каждый день: с 9:00 до 16:00<br>
            </div>
          </div>
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
                <a class="text-white mb-2" href="index.php"><i class="fa fa-angle-right mr-2"></i>Главная</a>
                <a class="text-white mb-2" href="about.php"><i class="fa fa-angle-right mr-2"></i>О нас</a>
                <a class="text-white mb-2" href="feature.php"><i class="fa fa-angle-right mr-2"></i>Отзывы</a>
                <a class="text-white mb-2" href="class.php"><i class="fa fa-angle-right mr-2"></i>Занятия</a>
                <a class="text-white" href="contact.php"><i class="fa fa-angle-right mr-2"></i>Контакты</a>
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