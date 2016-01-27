<?php 
require_once 'DAO.php';
  if($_POST){
    if($_POST['email']==""){
      //kong
    }else if($_POST['pswd']!=""){
      $db=new DB();
      $inData['nick'] = $_POST['nick'];
      $inData['email'] = $_POST['email'];
      $inData['pswd'] = $_POST['pswd'];
      $ret = $db->insert('blueSySusers', $inData);
      if($ret){
        print("注册成功，点击<a href='login.php'>这里</a>去登录啦！");
      }
    }
  }
?>
<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>注册页</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="alternate icon" type="image/png" href="assets/i/favicon.png">
  <link rel="stylesheet" href="assets/css/amazeui.min.css"/>
  <style>
    .header {
      text-align: center;
    }
    .header h1 {
      font-size: 200%;
      color: #333;
      margin-top: 30px;
    }
    .header p {
      font-size: 14px;
    }
  </style>
</head>
<body>
<div class="header">
  <div class="am-g">
    <h1>注册</h1>
  </div>
  <hr />
</div>
<div class="am-g">
  <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
    <form method="post" class="am-form" action="sign.php">
      <label for="email">昵称:</label>
      <input type="text" name="nick" id="nick" value="">
      <br>
      <label for="email">邮箱:</label>
      <input type="email" name="email" id="email" value="">
      <br>
      <label for="password">密码:</label>
      <input type="password" name="pswd" id="password" value="">
      <br>
      <br />
      <div class="am-cf">
        <input type="submit" name="" value="提 交" class="am-btn am-btn-primary am-btn-sm am-fl">
      </div>
    </form>
    <hr>
    <p>© 2015 Dodd.</p>
  </div>
</div>
</body>
</html>
