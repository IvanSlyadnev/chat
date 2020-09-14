<?php
session_start();

?>

<div class="log_auth">
  <h1>Авторизация</h1>
  <form action="index.php" method="post">
    <input type="text" name="name" placeholder="Введите имя" class="in">
    <br>
    <input type="password" name="password" placeholder="Введите пароль" class="in">
    <br>
    <input type="submit" name="auth_" value="Войти" class="in">
  </form>
</div>
