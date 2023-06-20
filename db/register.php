<?php

session_start();

header('Content-Type: text/html; charset=utf-8');
// Подключение к базе данных
$servername = "localhost";
$username = "typhoomy_mybase";
$password = "gega536!";
$dbname = "typhoomy_mybase";
$test = new mysqli($servername, $username, $password, $dbname);
if ($test->connect_error) {
    die("Не удалось подключиться к БД: " . $test->connect_error);
}

// Функция для проверки корректности ввода номера телефона
function validate_phone_number($phone) {
  if (preg_match("/^\+?[0-9]{11}$/", $phone)) {
    return true;
  } else {
    return false;
  }
}

// Функция для проверки корректности ввода адреса электронной почты
function validate_email($email) {
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return true;
  } else {
    return false;
  }
}

// Функция для проверки корректности ввода пароля
function validate_password($password) {
    if (preg_match("/^[A-Za-z0-9\-]{6,32}$/", $password)) {
      return true;
    } else {
      return false;
    }
}

// Обработка отправленной формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $email = $_POST["email"];
    $password = md5($_POST["password"]);
    $sex = isset($_POST["sex"]) ? $_POST["sex"] : null;
    $birth = $_POST["birth"];
    $number = $_POST["number"];

    if ($sex == null) {
        $error_message = "Вы не указали свой пол";
    } else {

        // Проверка наличия в базе данных пользователя с таким же логином или email или номером
        $stmt = $test->prepare("SELECT * FROM `tabledb` WHERE `login`=? OR `email`=? OR `number`=?");
        $stmt->bind_param("sss", $login, $email, $number);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0){
            $error_message = "Пользователь с таким же логином или почтой или номером уже существует";
        } else if (!validate_phone_number($number)) {
            $error_message = "Некорректный номер телефона";
        } else if (!validate_email($email)) {
            $error_message = "Некорректный адрес электронной почты";
        } else if (!validate_password($_POST["password"])) {
            $error_message = "Пароль должен содержать только латинские буквы, цифры и тире от 6 до 32 символов";
        } else {
            // Создание нового пользователя в базе данных
            $sql = "INSERT INTO `tabledb` (`login`, `email`, `password`, `sex`, `birth`, `number`) VALUES ('$login', '$email', '$password', '$sex', '$birth', '$number')";

            if ($test->query($sql) === TRUE){
                header("Location: login.php");
                exit();
            } else {
                $error_message = "Ошибка регистрации";
            }
        }
    }
}

$test->close(); 


?>
            
            <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Клуб бокса Тайфун</title>
</head>
<body>
<div class="container ">
<div class="row justify-content-center log-top">
<div class="col-lg-4 col-md-6 col-sm-8">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
<h1 class="text-center mb-3">Регистрация</h1>
<div class="mb-3">
<label for="login" class="form-label">Логин</label>
<input type="text" class="form-control" id="username" name="login" pattern="[A-Za-z0-9]{4,20}" title="Только латинские буквы и цифры от 4 до 20 символов" value="<?php echo isset($_POST['login']) ? $_POST['login'] : ''; ?>" required>
</div>
<div class="mb-3">
<label for="email" class="form-label">Почта</label>
<input type="email" class="form-control" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
</div>
<div class="mb-3">
<label for="number" class="form-label">Номер телефона</label>
<input type="text" class="form-control" id="number" name="number" maxlength="12" pattern="+7[0-9]{11}" title="Номер телефона должен начинаться с '+7' и содержать 11 цифр" value="<?php echo isset($_POST['number']) ? $_POST['number'] : '+7'; ?>" required>
</div>
<div class="mb-3">
<label for="birth" class="form-label">Дата рождения</label>
<input type="date" class="form-control" id="birth" name="birth" value="<?php echo isset($_POST['birth']) ? $_POST['birth'] : ''; ?>" required>
</div>
<div class="mb-3">
<label>Пол</label><br>
<label class="next_label" for="male">Мужской</label>
<input type="radio" id="male" name="sex" value="male"><br>
<label class="next_label" for="female">Женский</label>
<input type="radio" id="female" name="sex" value="female">
</div>
<div class="mb-3">
<label for="password" class="form-label">Пароль</label>
<input type="password" class="form-control" id="password" name="password" pattern="[A-Za-z0-9\-]{6,32}" title="Только латинские буквы, цифры и тире от 6 до 32 символов" required></div>
<?php if (isset($error_message)) { ?>
<div id="error_message" style="color: red;"><?php echo $error_message; ?></div>
<?php } ?>
<button type="submit" class="btn btn-primary w-100 mt-3">Зарегистрироваться</button>
<a href="index.php" id="btn-st">На главную</a>
</form>
</div>
</div>
</div>

</body>
</html>