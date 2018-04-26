<?php
$arr = array(2,3,1,7,9,5,8,3,4,6);
$l = 0;
$r = count($arr)-1;
mergeSort($arr,$l,$r);

function merge(array &$arr,$l,$m,$r){
  $help = array();
  $p1 = $l;
  $p2 = $m + 1;
  $i = 0;
  while ($p1 <= $m && $p2 <= $r) {
    if ($arr[$p1] < $arr[$p2])
      $help[$i++] = $arr[$p1++];
    else
      $help[$i++] = $arr[$p2++];
  }
  while ($p1 <= $m)
    $help[$i++] = $arr[$p1++];

  while ($p2 <= $r)
    $help[$i++] = $arr[$p2++];
    
  for ($i=0; $i < count($help); $i++)
    $arr[$l + $i] = $help[$i];
}

function mergeSort(array &$arr,$l,$r){
  if ($r > $l) {
    $mid = $l + (($r - $l)/2);
    mergeSort($arr,$l,$mid);
    mergeSort($arr,$mid+1,$r);
    merge($arr,$l,$mid,$r);
  }
}

for ($i=0; $i < count($arr); $i++) {
  echo $arr[$i]." ";
}
 ?>
