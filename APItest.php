<?php
header("Content-Type:text/html;charset=utf-8");
$url = "http://api01.monyun.cn:7901/sms/v2/std/single_send";
$option = array(
    'apikey' => '2b3e866f4a497248278a0a27e7ccd615',
    'mobile' => '15942018176',
    'content' => '这是一条测试短信',
);

$postdata = http_build_query($option);

$options = array(
    'http' => array(
      'method' => 'POST',
      'header' => 'Content-type:application/x-www-form-urlencoded',
      'content' => $postdata,
      'timeout' => 15 * 60 // 超时时间（单位:s）
    )
  );

$context = stream_context_create($options);
$result = file_get_contents($url,false,$context);

print_r($result);



 ?>
