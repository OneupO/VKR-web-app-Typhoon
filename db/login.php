<?php
session_start();


//Подключепние к БД
$servername = "localhost";
$username = "typhoomy_mybase";
$password = "gega536!";
$dbname = "typhoomy_mybase";
$fack = new mysqli($servername, $username, $password, $dbname);
if ($fack->connect_error) {
    die("Не смог подключиться к БД: " . $fack->connect_error);
}

//Обработка формы 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $password = md5($_POST["password"]);

    // echo $password;

    $sql = "SELECT * FROM `tabledb` WHERE `login`='$login' AND `password`='$password'";
    $result = $fack->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION["login"] = $login;
        header("Location: index.php");
        exit();
    } else {
        $error_message = "Неправильный пароль или логин";
    }
}

$fack->close();
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
      <form action="" method="post" >
        <h1 class="text-center mb-3">Авторизация</h1>
        <div class="mb-3">
          <label for="login" class="form-label">Логин</label>
          <input type="text" class="form-control" id="username" name="login" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Пароль</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <?php if (isset($error_message)) {    ?>
        <div id="error_message" style="color: red;"><?php echo $error_message; ?></div>
        <?php } ?>
        <button type="submit" class="btn btn-primary w-100 mt-3">Войти</button>
        <a href="index.php" id="btn-st">На главную</a>
      </form>
      
  </div>
  
</div>

</body>

</html>