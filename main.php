<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <div class="container">
      	<div class="page-header">
          <h1><?='Welcome '.$_SESSION['name'];?></h1>
          <form action="index.php" method="post">
            <input type="submit" name="out" value="Выйти" class="input">
          </form>
          <form action="index.php" method="post">
            <input type="submit" name="show" value="Увидеть список пользователей" class="input">
          </form>
          <?php if ($_SESSION['show']) {?>
            <?php foreach ($names as $value){?>
                <h3><?=$value;?></h3>
              <?php
              }?>
          <?php
          }?>

      </div>

      <div class='chat'>
      <div class="to">
        <label>Кому хотите отправить сообщение</label>
        <input type="text" id = 'name' placeholder="Имя получателя" class="input">
      </div>
    	<div class='chat-messages'>
    		<div class='chat-messages__content' id='messages'>
    			Загрузка...
    		</div>
    	</div>
    	<div class='chat-input' id = 'chat-form'>
    		<form method='post'>

          <!--<input type='submit' class='chat-form__submit'  value='=>' >-->
            <input type='text' id='message' class='chat-form__input input' placeholder='Введите сообщение'>
            <input type='submit' class='button'  value='=>' >
    		</form>
    	</div>
</div>
    </div>
    <h1 id = "h"></h1>
  </body>
  <script type="text/javascript">

  var messages = document.getElementById('messages');
  var sendForm = document.getElementById('chat-form');
  var el;
  function sendrequest (name, message) {
    $.post('chat.php', {
      to : name,
      message : message
    }).done(function(data) {
      messages.innerHTML = data;
    });
  }

  sendForm.onsubmit = function () {
    sendrequest(document.getElementById('name').value, document.getElementById('message').value);

  }
  setInterval(sendrequest, 2000);

  </script>

</html>
