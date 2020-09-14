<?php
include 'dbconnection.php';
session_start();
$Controller;


$_SESSION['show'] = false;
if (isset($_POST['show'])) {
  $names = getNameUsers($connect);
  $_SESSION['show'] = true;
}

if (isset($_POST['auth_'])) {
  if (compare($connect, $_POST['name'], $_POST['password'])){
    $_SESSION['avtor'] = true;
    $_SESSION['mA'] = false;
  } else {
    $_SESSION['mA'] = true;
  }
}

if (isset($_POST['log_'])) {
  if (reg($connect, $_POST['name'], $_POST['password'])) {
    $_SESSION['mL'] = false;
    $_SESSION['avtor'] = true;
  } else {
    $_SESSION['mL'] = true;
  }
}

if ($_POST['out']) {
  $_SESSION['to'] = null;
  $_SESSION['avtor'] = false;
}


?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="style.css">
<?php if (!$_SESSION['avtor']) echo "<h1>Для входа на сайт </h1>"; ?>


<?php if (!$_SESSION['avtor']) {?>
<form action="index.php" method="post">
  <ul>
    <li>
      <input type="submit" name="log" value="Регистрация" class="round green">
    </li>
    <br>
    <li>
      <input type="submit" name="auth" value="Авторизация" class="round red">
    </li>
  </ul>


</form>

<?php
}?>


<?php
$_SESSION['c'] = 0;
if ($_SESSION['mA']) {
  include 'auth.php';
  echo "<h1 style='color:red' class = 'mis' >Ошибка  </h1>";
}

if ($_SESSION['mL']) {
  include 'login.php';
  echo "<h1 style='color:red' class = 'mis'>Ошибка  </h1>";
}


if (isset($_POST['auth']) && !$_SESSION['avtor']) {
  $Controller = "A";
  if ($Controller == "A") include 'auth.php';
}

if (isset($_POST['log']) && !$_SESSION['avtor']) {
  $Controller = "L";
  if ($Controller == "L") include 'login.php';
}

if ($_SESSION['avtor']) {
  include 'main.php';
}

?>
