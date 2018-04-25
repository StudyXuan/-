<?php
$arr = array(1,46,543,23,2,3,4,65,12,1,4,3,41,34);
for($i = 0; $i < count($arr); $i++){
  for ($j = $i; $j > 0; $j--) {
    if ($arr[$j] < $arr[$j-1]) {
      $tmp = $arr[$j];
      $arr[$j] = $arr[$j-1];
      $arr[$j-1] = $tmp;
    }
  }
}

for ($i=0; $i < count($arr); $i++) {
  echo $arr[$i]." ";
}
 ?>
