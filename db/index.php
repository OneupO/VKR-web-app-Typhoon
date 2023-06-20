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

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $fack->real_escape_string($_POST['login']);
    $password = $fack->real_escape_string($_POST['password']);
  
    // Проверяем, есть ли пользователь с таким логином и паролем в базе данных
    $sql = "SELECT * FROM users WHERE login = '$login' AND password = '$password'";
    $result = $fack->query($sql);
  
    if ($result->num_rows == 1) { // Если пользователь найден
      $_SESSION['login'] = true; // Установка переменной сессии
      header("Location: index.php"); // Перенаправление на главную страницу
      exit();
    }
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
                    <a href="index.php" class="nav-item nav-link <?php if($current_page=='/db/index.php') echo 'active'; ?>">Главная</a>
                    <a href="about.php" class="nav-item nav-link">О нас</a>
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

    <!-- Слайдер -->
    <div class="container-fluid p-0">
        <div id="blog-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/bg.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h3 class="text-primary text-capitalize m-0">Превосходный бокс -</h3>
                        <h2 class="display-2 m-0 mt-2 mt-md-4 text-white font-weight-bold ">
                            Путь к Красоте и Силе</h2>
                        <a href="contact.php" class="btn btn-lg btn-outline-light mt-3 mt-md-5 py-md-3 px-md-5">Записаться</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/bg2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h3 class="text-primary text-capitalize m-0">Превосходный бокс -</h3>
                        <h2 class="display-2 m-0 mt-2 mt-md-4 text-white font-weight-bold">Путь к Красоте и Силе</h2>
                        <a href="contact.php" class="btn btn-lg btn-outline-light mt-3 mt-md-5 py-md-3 px-md-5">Записаться</a>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#blog-carousel" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#blog-carousel" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>

    <!-- Офферы 1-->
    <div class="container gym-class mb-5">
        <div class="row px-3">
            <div class="col-md-6 p-0">
                <div class="gym-class-box d-flex flex-column align-items-end justify-content-center bg-primary text-right text-white py-5 px-5">
                    <h3 class="display-4 mb-3 text-white font-weight-bold">Групповые занятия</h3>
                    <p>
                        Присоединяйтесь к групповым занятиям боксом и получите мощнейшую тренировку всего тела,
                        улучшите свою физическую форму и научитесь техникам бокса. Запишитесь сегодня и получите
                        первое занятие бесплатно!
                    </p>
                    <a href="contact.php" class="btn btn-lg btn-outline-light mt-4 px-4">Записаться</a>
                </div>
            </div>
            <div class="col-md-6 p-0">
                <div class="gym-class-box d-flex flex-column align-items-start justify-content-center bg-secondary text-left text-white py-5 px-5">
                    <h3 class="display-4 mb-3 text-white font-weight-bold">Индвидуальные занятия</h3>
                    <p>
                        Получите персональную тренировку,
                        настроенную на ваши индивидуальные потребности и цели.
                        Наши инструкторы бокса помогут вам усовершенствовать технику, повысить физическую подготовку. 
                    </p>
                    <a href="contact.php" class="btn btn-lg btn-outline-light mt-4 px-4">Записаться</a>
                </div>
            </div>
        </div>
    </div>



    <!-- Офферы +-->

    <div class="container feature pt-5">
        <div class="d-flex flex-column text-center mb-5">
            <h4 class="text-primary font-weight-bold">Почемы мы?</h4>
            <h4 class="display-4 font-weight-bold">Преимущество нашего клуба</h4>
        </div>
        <div class="row">
            <div class="col-md-6 mb-5">
                <div class="row align-items-center">
                    <div class="col-sm-5">
                        <img class="img-fluid mb-3 mb-sm-0" src="img/f1.jpg" alt="Image">

                    </div>
                    <div class="col-sm-7">
                        <h4 class="font-weight-bold">Огромные знания в сфере бокса</h4>
                        <p>С нами вы станете настоящими профессионалами бокса! Наши тренеры имеют огромный опыт и знания в этой области.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-5">
                <div class="row align-items-center">
                    <div class="col-sm-5">
                        <img class="img-fluid mb-3 mb-sm-0" src="img/f2.jpg" alt="Image">
                      
                    </div>
                    <div class="col-sm-7">
                        <h4 class="font-weight-bold">Постоянный график тренировок</h4>
                        <p>Выбирайте удобное время для занятий! У нас постоянный график тренировок.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-5">
                <div class="row align-items-center">
                    <div class="col-sm-5">
                        <img class="img-fluid mb-3 mb-sm-0" src="img/f5.png" alt="Image">

                    </div>
                    <div class="col-sm-7">
                        <h4 class="font-weight-bold">Наличие квалифицированных докторов</h4>
                        <p>Безопасность превыше всего! У нас работают только профессиональные врачи с многолетним опытом.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-5">
                <div class="row align-items-center">
                    <div class="col-sm-5">
                        <img class="img-fluid mb-3 mb-sm-0" src="img/f4.jpg" alt="Image">

                    </div>
                    <div class="col-sm-7">
                        <h4 class="font-weight-bold">Тёплый климат в коллективе</h4>
                        <p>Присоединяйтесь к нашей большой дружной семье! Мы ждем вас!</p>
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