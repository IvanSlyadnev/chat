<?
session_start();
include 'dbconnection.php';
include 'func.php';

deleteMessages($connect);
if ($_POST['message'] !== null) {
  if (check(getNameUsers($connect),$_POST['to'])) {
    if ($_POST['to'] !== $_SESSION['name']) {
      $_SESSION['mes'] = $_POST['message'];
      addMessage($connect, $_POST['to'], $_POST['message']);
      $_SESSION['to'] = $_POST['to'];
      $_SESSION['mis'] = false;
      $_SESSION['equal'] = false;
    }
    else $_SESSION['equal'] = true;
  }
  else $_SESSION['mis'] = true;
}
$mess = getOurMessages($connect, $_SESSION['name']);//Сообщения которые были отправлены нам
$send = getSendMessages($connect, $_SESSION['name']);//Сообщения которые отправили мы

$messages = array_merge($mess, $send);

$messages = sort_($messages);
if ($_SESSION['mis']) echo "<h1 style='color:red'>Такого пользователя нет</h1>";
if ($_SESSION['equal']) echo "<h1 style='color:red'>Нельзя отправлять самому себе</h1>";

$yes = false;
for ($i = 0; $i < count($messages); $i++) {
  if ($messages[$i]['time'] > getTime()) {
    if (!$yes) {
      echo "Вчерашние сообщения"."<br>";
      $yes = true;
    }
  }
  echo $messages[$i]['name'].":".$messages[$i]['text']." - ".$messages[$i]['date_']."<br>";

}


?>
