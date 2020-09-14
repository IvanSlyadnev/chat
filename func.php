<?php
function sort_($arr) {
  for ($i = 0; $i < count($arr); $i++) {
    $value = '';
    $time = 0;
    $c = 0;
    for ($j = 0; $j < strlen($arr[$i]['date_']); $j++) {
      if ($arr[$i]['date_'][$j] !== ':') $value = $value.$arr[$i]['date_'][$j];
      else {
        if ($c == 0) {
          $time += (int)$value*3600;
          $value = '';
        }
        else if ($c == 1) {
          $time += (int)$value*60;
          $value = '';
        }
        $c++;
      }
    }
    $time +=(int)$value;
    $arr[$i]['time'] = $time;
  }

  for ($i = 0; $i < count($arr); $i++) {
    for ($j = 0; $j < count($arr) - 1; $j++) {
      if ($arr[$j+1]['time'] < $arr[$j]['time']) {
        $temp = $arr[$j];
        $arr[$j] = $arr[$j+1];
        $arr[$j+1] = $temp;
      }
    }
  }

  return $arr;
}

function countTime($str) {

}

function check($mass, $el) {
  foreach ($mass as $value) {
    if ($value == $el) return true;
  }
  return false;
}

function getTime() {
   return getdate()['hours']*3600 + getdate()['minutes']*60 + getdate()['seconds'];
}


 ?>
