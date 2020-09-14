<?php
$host = 'localhost';
$user = 'root';
$password_ = 'Moscow2020';
//Az0opS4!!=QO3OC\
$baseName = 'chat';

$connect = mysqli_connect($host, $user, $password_, $baseName);


function compare($connect, $login, $password) {
  $result = mysqli_query(
    $connect,
    "select *from users where name = '$login'"
  );
	$row = mysqli_fetch_assoc($result);

  if ($row["password"] == $password && $row["name"] == $login) {
    $_SESSION['name'] = $row["name"];
    return true;
  }
  else return false;
}

function reg($connect, $login, $password) {
  if (strlen($password) > 5) {
    $result = mysqli_query(
      $connect,
      "insert into users (name , password) values('$login', '$password')"
    );
    $_SESSION['name'] = $login;
    return true;
  } else {
    return false;
  }
}

function addMessage ($connect, $login, $message) {
  $day = getdate()['mday'];
  $id = getUserId($connect, $login);
  $id_send = getUserId($connect, $_SESSION['name']);
  $date_ = date('H:i:s');
  $result = mysqli_query(
      $connect,
      "insert into messages (text, id_user, date_, id_send, day)
      values('$message', '$id', '$date_', '$id_send', '$day')"
    );
}

function getOurMessages ($connect, $login) {//Сообщения кторые мы получили
  $id = getUserId($connect, $login);
  $result = mysqli_query(
    $connect,
    "select * from messages where id_user = '$id'"
  );

  $mess = [];
  $c = 0;
  while ($row = mysqli_fetch_assoc($result)) {
    $mess[$c]['text'] = $row['text'];
    $mess[$c]['date_'] = $row['date_'];
    $mess[$c]['name'] = getUserForId($connect, $row['id_send']);
    $c++;
  }
  return $mess;
}

function getSendMessages ($connect, $login) {//Сообщения которые мы отправили
  $id = getUserId($connect,  $login);
  $result = mysqli_query(
    $connect,
    "SELECT * from messages where messages.id_send = '$id'"
  );
  $mess = [];
  $c = 0;
  while ($row = mysqli_fetch_assoc($result)) {
    $mess[$c]['text'] = $row['text'];
    $mess[$c]['date_'] = $row['date_'];
    $mess[$c]['name'] = $_SESSION['name'];
    $c++;
  }
  return $mess;
}

function getUserId($connect, $login) {
  $result = mysqli_query(
      $connect,
      "select id from users where name = '$login'"
    );
    $row = mysqli_fetch_assoc($result);
    return $row['id'];

}

function getUserForId($connect, $id) {
  $result = mysqli_query(
      $connect,
      "SELECT name from users where users.id = '$id'"
    );
    $row = mysqli_fetch_assoc($result);
    return $row['name'];
}

function getNameUsers ($connect) {
  $result = mysqli_query(
      $connect,
      "select name from users"
    );
    $names = [];
    while ($row = mysqli_fetch_assoc($result)) {
      array_push($names, $row['name']);
    }
    return $names;
}

function deleteMessages($connect) {
  $d = getdate()['mday'] - 2;
    $result = mysqli_query(
      $connect,
      "delete from messages where messages.day <= '$d'"
    );
}
?>
