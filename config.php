<?php 
 static $DB_NAME='jol';  //数据库名
 static $DB_IP='www.dodd2014.com';		//数据库地址
 static $DB_USER='root';		//数据库用户名
 static $DB_PORT='3306';
 static $DB_PASSWORD='woshicdx';	//数据库密码
 static $EMAIL_SERVER="";	//邮件服务器
 static $EMAIL_SIGN=0;		//是否邮件注册,0不使用邮箱注册 1使用
 static $EMAIL_LOGINID="";  //邮箱帐号
 static $EMAIL_PWD="";      //邮箱密码
 static $NUM_OF_PROBLEM_PAGE=10;//一页显示多少个问题
 static $MODE=1; //比赛模式为1，训练模式为0;
 static $BEGIN_TIME="2016-01-26 14:19:00";
 static $END_TIME="2016-01-30 15:19:00";
 static $CONTEXT_NAME="测试!";
 static $CONTEXT_CODE="1234";//请确保每次比赛的context_code不相同
 static $TIME_TO_GETANS=2000;
 static $PROBLEM_RAR='problem.zip';
 static $problemArray=array(array(),
  array('des'=>'骰子迷题','type'=>'结果','ans'=>'2 2 2 2 8 8'),
  array('des'=>'空白格式化','type'=>'代码','ans'=>'1001','replace'=>'2.cpp'),
  array('des'=>'约数倍数选卡片','type'=>'编程','ans'=>'1002'),
  //array('des'=>'生物芯片','type'=>'编程','ans'=>'1000')
  // array('des'=>'Log大侠','type'=>'编程','ans'=>'1000')
  );
?>