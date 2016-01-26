<?php session_start(); ?>
<?php 
  if(!isset($_SESSION['email'])){
    header('Location: login.php');
  }
?>
<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>登陆页</title>
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
<header class="am-topbar admin-header">
  <div class="am-topbar-brand">
    <strong>BuleSystem</strong> <small>在线训练系统</small>
  </div>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

    <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
      <!-- <li><a href="javascript:;"><span class="am-icon-envelope-o"></span> 收件箱 <span class="am-badge am-badge-warning">5</span></a></li> -->
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          <span class="am-icon-users"></span> <?php print($_SESSION['nick']); ?> <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
          <!-- <li><a href="#"><span class="am-icon-user"></span> 资料</a></li> -->
          <!-- <li><a href="#"><span class="am-icon-cog"></span> 设置</a></li> -->
          <li><a href="logout.php"><span class="am-icon-power-off"></span> 退出</a></li>
        </ul>
      </li>
      <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
    </ul>
  </div>
</header>
  <div class="am-g">
    <h1 style="text-align:center; margin:0;"><?php require_once 'config.php'; print($CONTEXT_NAME); ?></h1>
  </div>
  <div class="am-g">
    <h4 style="text-align:center; margin:0; color:red;"><?php require_once 'config.php'; print($BEGIN_TIME.'——'.$END_TIME); ?></h4>
  </div>
  <hr  />
  <div class="am-g">
    <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
    <table class="am-table am-table-bordered am-table-radius am-table-centered">
      <?php require_once 'config.php';?>
      <?php 
        foreach ($problemArray as $key => $value) {
          if($key!='0'){
            $des=$value['des'];
            print("<tr><td>$key.$des</td><td><button class='am-btn am-btn-primary' onclick='showSubmit(this,$key);'>提 交</button></td>");
          }
        }
      ?>
    </table>
    </div>
  </div>
<div class="am-g">
<hr>
<p style="text-align:center;">© 2015 Dodd.</p>
</div>

<div class="am-modal am-modal-prompt" tabindex="-1" id="my-prompt">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">Amaze UI</div>
    <div class="am-modal-bd">
      <p style="color:red;">结果填空或只需要填结果和挖空代码，请不要有多余的空格。</p>
      <textarea id="ansarea" cols ="65" rows = "5"></textarea>
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
      <span class="am-modal-btn" data-am-modal-confirm>提交</span>
    </div>
  </div>
</div>
<script type="text/javascript">
function showSubmit (thix,x) {
  var xmlhttp;
  if (window.XMLHttpRequest){
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  }
  else{
    // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function(){
    if (xmlhttp.readyState==4 && xmlhttp.status==200){
      $(thix).html(xmlhttp.responseText);
      if(xmlhttp.responseText=='AC'){
        $(thix).attr("class", "am-btn am-btn-success");
        $(thix).attr("disabled", "disabled");
      }
      if(xmlhttp.responseText=='WA')$(thix).attr("class", "am-btn am-btn-danger");
      //alert('返回的是：' + xmlhttp.responseText || '');
      $.AMUI.progress.done();
    }
  }
  $('#my-prompt').modal();
  $(function() {
    var $prompt = $('#my-prompt');
    var $confirmBtn = $prompt.find('[data-am-modal-confirm]');
    var $cancelBtn = $prompt.find('[data-am-modal-cancel]');
    $confirmBtn.unbind("click");
    $confirmBtn.on('click', function(e) {
      // do something
        xmlhttp.open("POST",'submit.php',true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        //alert(encodeURIComponent($("#ansarea").val()));
        xmlhttp.send("pid="+x+"&ans="+encodeURIComponent($("#ansarea").val()));
        $("#ansarea").val("");
        $.AMUI.progress.start();
    });

    //$cancelBtn.off('click.cancel.modal.amui').on('click', function() {
      // do something
   // });
  });
}
</script>
<!--[if (gte IE 9)|!(IE)]><!-->
<script src="assets/js/jquery.min.js"></script>
<!--<![endif]-->
<script src="assets/js/amazeui.min.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html>
