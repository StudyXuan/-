<?php
header('Content-type:text/html;charset=utf-8');
$number = htmlspecialchars($_POST['number']);
$name = htmlspecialchars($_POST['name']);
$sex = htmlspecialchars($_POST['sex']);
$academic = htmlspecialchars($_POST['academic']);
$class = htmlspecialchars($_POST['class']);
$competition = htmlspecialchars($_POST['competition']);
$ps = htmlspecialchars($_POST['ps']);
$video = htmlspecialchars($_POST['video']);
$html = htmlspecialchars($_POST['html']);
$phone = htmlspecialchars($_POST['phone']);
$qq = htmlspecialchars($_POST['qq']);
$learn = $ps.'、'.$video.'、'.$html;
if (!$sex) {
  echo "<script>alert('您未填写性别!');history.back();</script>";
  exit;
}
if (!$competition) {
  echo "<script>alert('请选择一个您要参加的比赛!');history.back();</script>";
  exit;
}
if (!$ps and !$video and !$html) {
  echo "<script>alert('请至少选择一个您想参加的培训项目!(可多选)');history.back();</script>";
  exit;
}
$db = new mysqli('localhost','root','8a1b6882bb','test');
if (mysqli_connect_errno()) {
  echo "<script>alert('数据库连接失败，请联系管理员!');history.back();</script>";
  exit;
}
$db->set_charset("utf8");
$db->select_db('enroll');

$check = "select * from enroll";
$result = $db->query($check);
while ($row = $result->fetch_array()) {
  if ($number == $row['number']) {
    echo "<script>alert('您已报名，请不要重复报名！');history.back();</script>";
    exit;
  }
}

$pattern1 = '/[0-9]{11}/';
$pattern2 = '/[0-9]{5,10}/';
$pattern3 = '/[0-9]{9}/';
preg_match($pattern1,$phone,$match1);
preg_match($pattern2,$qq,$match2);
preg_match($pattern3,$number,$match3);
if (!$match1) {
  echo "<script>alert('请输入正确的电话号!');history.back();</script>";
  exit;
}
elseif (!$match2) {
  echo "<script>alert('请输入正确的QQ号!');history.back();</script>";
  exit;
}
elseif (!$match3) {
  echo "<script>alert('请输入正确的学号!');history.back();</script>";
  exit;
}

$sql = "insert into enroll(number,name,enum,academic,class,competition,learn,phone,qq) values(?,?,?,?,?,?,?,?,?)";
$stmt = $db->prepare($sql);
$stmt->bind_param("sssssssss",$number,$name,$sex,$academic,$class,$competition,$learn,$phone,$qq);
$result = $stmt->execute();
if ($result) {
  echo "<script>alert('报名成功!');window.location.href='./qun/index.html'</script>";
}
else {
  echo "<script>alert('报名失败，请再次尝试!');history.back();</script>";
}
