<?php
$arr = array(3,2,7,5,1,8,6,0);
heapSort($arr);

function heapSort(array &$arr){
  for ($i=0; $i < count($arr); $i++) {
    heapInsert($arr,$i);
  }
  $size = count($arr);
  swap($arr,0,--$size);
  while ($size > 0) {
    heapify($arr,0,$size);
    swap($arr,0,--$size);
  }
}

function heapInsert(array &$arr,$index){
  while ($arr[$index] < $arr[($index - 1) / 2]) {
    swap($arr,$index,($index - 1) / 2);
    $index = ($index - 1) / 2;
  }
}

function heapify(array &$arr,$index,$size){
  $left = $index * 2 + 1;
  while ($left < $size) {
    $largest = $left + 1 < $size && $arr[$left + 1] > $arr[$left] ? $left + 1 : $left;
    $largest = $arr[$largest] > $arr[$index] ? $largest : $index;
    if ($largest == $index) {
      break;
    }
    swap($arr,$largest,$index);
    $index = $largest;
    $left = $index * 2 + 1;
  }
}

function swap(array &$arr,$x,$y){
  $temp = $arr[$x];
  $arr[$x] = $arr[$y];
  $arr[$y] = $temp;
}

for ($i=0; $i < count($arr); $i++) {
  echo $arr[$i]." ";
}
 ?>
