<?php 
 static $DB_NAME='blueSysDB';  //数据库名
 static $DB_IP='127.0.0.1';		//数据库地址
 static $DB_USER='root';		//数据库用户名
 static $DB_PORT='3306';
 static $DB_PASSWORD='';	//数据库密码
 static $EMAIL_SERVER="";	//邮件服务器
 static $EMAIL_SIGN=0;		//是否邮件注册,0不使用邮箱注册 1使用
 static $EMAIL_LOGINID="";  //邮箱帐号
 static $EMAIL_PWD="";      //邮箱密码
 static $NUM_OF_PROBLEM_PAGE=10;//一页显示多少个问题
 static $MODE=0; //比赛模式为1，训练模式为0;
 static $BEGIN_TIME="2016-01-26 14:19:00";
 static $END_TIME="2016-01-27 15:19:00";
 static $CONTEXT_NAME="测试!";
 static $problemArray=array(array(),
  array('des'=>'问题1','type'=>'结果','ans'=>'123'),
  array('des'=>'问题2','type'=>'结果','ans'=>'1234'),
  array('des'=>'问题3','type'=>'代码','ans'=>'1001'),
  array('des'=>'问题4','type'=>'代码','ans'=>'1002'),
  array('des'=>'问题5','type'=>'编程','ans'=>'1003'),
  array('des'=>'问题6','type'=>'编程','ans'=>'1000'));
?>