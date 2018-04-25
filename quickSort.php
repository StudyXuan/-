<?php
$arr = array(0,3,8,6,2,5,7);

function paratition($l,$r){
  $less = $l-1;
  $most = $r;
  while ($l < $most) {
    if ($arr[$l] < $arr[$r]) {
      $less++;
      swap($arr[$less],$arr[$l]);
      $l++;
    }
    elseif ($arr[$l] > $arr[$r]) {
      swap($arr[$most],$arr[$l]);
      $most--;
    }
    else {
      $l++;
    }
  }
  return array($less+1,$most);
}

function quickSort(){
  $pvalue = rand($arr);
  $l = 0;
  $r = count($arr);

}

function swap($x,$y){
  $temp = $x;
  $x = $y;
  $y = $temp;
}
 ?>
