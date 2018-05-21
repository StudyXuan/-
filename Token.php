<?php
  session_start();
  $name = $_POST['name'];
  $password = $_POST['password'];
  $time = time();

  $finish = check($name,$password,$time);
  echo "您已登录，当前登录用户：{$finish}";

  function check($name,$password,$time){
    if (empty($_COOKIE["token"]) and empty($name) and empty($password)) {
      echo "<script>alert('您尚未登录，请先登录');window.location.href='http://localhost/playing/SSO.html';</script>";
    }
    elseif (empty($_COOKIE["token"]) and !empty($name) and !empty($password)) {
      $token = settoken($name,$time);
      $finish = insert($name,$password,$token);
    }
    elseif (!empty($_COOKIE["token"]) and !empty($name) and !empty($password)) {
      $token = settoken($name,$time);
      $finish = insert($name,$password,$token);
    }
    else{
      $finish = checktoken();
    }
    return $finish;
  }


  function insert($name,$password,$token){
    $db = new mysqli('localhost','root','root','test');
    $db->set_charset('utf8');
    $insert = "INSERT INTO user(name,password,token) values(?,?,?)";
    $stmt = $db->prepare($insert);
    $stmt->bind_param("sss",$name,$password,$token);
    $stmt->execute();
    return $name;
  }

  function settoken($name,$time){
    $tokenarr = array(
      'name' => $name,
      'time' => $time,
      'check' => '12aimiao'
    );
    $token = base64_encode(json_encode($tokenarr));

    setcookie("token",$token);
    return $token;
  }

  function checktoken(){
    $backtoken1 = base64_decode($_COOKIE["token"]);
    $tokenjson1 = json_decode($backtoken1);
    $tokenjson1 = (array)$tokenjson1;

    $db = new mysqli('localhost','root','root','test');
    $db->set_charset('utf8');
    $sql = "SELECT token FROM user where name='{$tokenjson1['name']}'";
    $query = $db->query($sql);
    $result = $query->fetch_assoc();

    $backtoken2 = base64_decode($result['token']);
    $tokenjson2 = json_decode($backtoken2);
    $tokenjson2 = (array)$tokenjson2;

    if ($tokenjson1['name'] == $tokenjson2['name'] && $tokenjson1['check'] == $tokenjson2['check']) {
      $_SESSION['name'] = $tokenjson1['name'];
    }
    else {
      echo "<script>alert('登录已过期');</script>";
      exit;
    }
    return $tokenjson1['name'];
  }
 ?>
