<?php
class Connect {

  public $connect = mysqli_connect('localhost', 'root', 'Moscow2020', 'testyii');

  public function getData ($connect) {
    $result = mysqli_query(
      $connect,
      "select * from list"
    );
    $arr = [];
    $c = 0;
    while($row = mysqli_fetch_assoc($result)) {
      $arr[$c]['id'] = $row['id'];
      $arr[$c]['title'] = $row['title'];
      $arr[$c]['text'];
      $c++;
    }
    return $arr;
  }

}
?>
