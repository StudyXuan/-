<?php
$arr = array(1,46,543,23,2,3,4,65,12,1,4,3,41,34);
for ($i = 0; $i < count($arr)-1; $i++) {
    $min = $i;
    for ($j = $i+1; $j < count($arr); $j++) {
      if ($arr[$j] < $arr[$min]) {
        $min = $j;
      }
    }
    $tmp = $arr[$min];
    $arr[$min] = $arr[$i];
    $arr[$i] = $tmp;
}
for ($i=0; $i < count($arr); $i++) {
  echo $arr[$i]." ";
}

 ?>
