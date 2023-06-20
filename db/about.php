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
                    <a href="about.php" class="nav-item nav-link <?php if($current_page=='/db/about.php') echo 'active'; ?>">О нас</a>
                    <a href="feature.php" class="nav-item nav-link">Отзывы</a>
                    <a href="class.php" class="nav-item nav-link">Занятия</a>
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
            <h4 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase font-weight-bold">О нас</h4>
            <div class="d-inline-flex">
                <p class="m-0 text-white"><a class="text-white" href="index.php">Назад</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">О нас</p>
            </div>
        </div>
    </div>
  


       <!-- О нас -->

       <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <img class="img-fluid mb-4 mb-lg-0" src="img/about.jpg" alt="Image">
            </div>
            <div class="col-lg-6">
                <h2 class="display-4 font-weight-bold mb-4">20 лет стажа</h2>
                <p>Мы ростим настоящих чемпионов!</p>
                <div class="row py-2">
                    <div class="col-sm-6">
                       
                        <h4 class="font-weight-bold">Наши ученики</h4>
                        <p>Чемпионы России и Европы</p>
                    </div>
                    <div class="col-sm-6">
                      
                        <h4 class="font-weight-bold">Клуб чемпионов</h4>
                        <p>Около 30 пристижных наград </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-lg-4 p-0">
                <div class="d-flex align-items-center bg-secondary text-white px-5" style="min-height: 300px;">
                   
                    <div class="">
                        <h2 class="text-white mb-3">Ежедневные тренировки</h2>
                        <p>Тренировки проходят каждый день! Расписание доступно на отдельной вкладке.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 p-0">
                <div class="d-flex align-items-center bg-primary text-white px-5" style="min-height: 300px;">
                   
                    <div class="">
                        <h2 class="text-white mb-3">Занятия с железом</h2>
                        <p>Поможем вам укрепить и нарастить мышечную массу. Стабилизируем ваша физическое состояние.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 p-0">
                <div class="d-flex align-items-center bg-secondary text-white px-5" style="min-height: 300px;">

                    <div class="">
                        <h2 class="text-white mb-3">Подбор режима питания</h2>
                        <p>Поможем подобрать индвидуальный режим питания и предоставим консультации по спортивным диетам, в зависимости от ваших целей.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
       <!-- Тр состав -->
       <div class="container pt-5 team">
  <div class="d-flex flex-column text-center mb-5">
    <h4 class="text-primary font-weight-bold">Тренерский состав</h4>
    <h4 class="display-4 font-weight-bold">Лучшие тренера клуба</h4>
  </div>
  <div class="row justify-content-center">
    <div class="col-lg-3 col-md-6 mb-5">
      <div class="card border-0 bg-secondary text-center text-white">
        <img class="card-img-top" src="img/t1.jpg" alt="">
        <div class="card-social d-flex align-items-center justify-content-center">
          <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 40px; height: 40px;" href="#"><i class="fab fa-telegram"></i></a>
          <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 40px; height: 40px;" href="#"><i class="fab fa-vk"></i></a>
          <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 40px; height: 40px;" href="#"><i class="fab fa-instagram"></i></a>
        </div>
        <div class="card-body bg-secondary">
          <h4 class="card-title text-primary">Первунин Алексей Анатольевич</h4>
          <p class="card-text">Тренер</p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-5">
      <div class="card border-0 bg-secondary text-center text-white">
        <img class="card-img-top" src="img/t2.jpg" alt="">
        <div class="card-social d-flex align-items-center justify-content-center">
          <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 40px; height: 40px;" href="#"><i class="fab fa-telegram"></i></a>
          <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 40px; height: 40px;" href="#"><i class="fab fa-vk"></i></a>
          <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 40px; height: 40px;" href="#"><i class="fab fa-instagram"></i></a>
        </div>
        <div class="card-body bg-secondary">
          <h4 class="card-title text-primary">Крупеников Дмитрий Михайлович</h4>
          <p class="card-text">Тренер</p>
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