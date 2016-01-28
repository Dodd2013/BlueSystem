<?php
if($_POST){
	header( 'Content-Type:text/html;charset=utf-8');
	require_once 'config.php';
	$current_time=time();
	session_start();
	require_once 'DAO.php';
	$msg;
	$db=new DB();
	$data['submit_id'] = $_POST['submit_id'];
	$judge['submit_id'] = '=';
	list($conSql, $mapConData) = $db->FDFields($data, 'and', $judge);
	$mData = $db->fetch('select * from blueSySSubmit where ' . $conSql, $mapConData);
	if((strtotime($BEGIN_TIME)<$current_time&&$current_time<strtotime($END_TIME))&&$MODE==1){}
		else if($mData['score']=='0'){
			die("WA");

		}else if($mData['score']=='100'){
			die("AC");
		}else if($mData['score']!=NULL){
			die("WA##".$mData['score']);
		}
	
	if($problemArray[$mData['pid']]['type']=='结果'){
		if($mData['ans']==$problemArray[$mData['pid']]['ans']){
			$msg = "AC";
			$upData = 100;
		}
		else {
			$msg = "WA";
			$upData = 0;
		}
		if($mData['score']==NULL)
		$row=$db->exec("update blueSySSubmit set score=".$upData." where submit_id=".$_POST['submit_id'].";");
		//$msg = "更新行数:$row";
	}else{
		$data1['solution_id'] = $mData['solution_id'];
		$judge1['solution_id'] = '=';
		list($conSql1, $mapConData1) = $db->FDFields($data1, 'and', $judge1);
		$solutionData = $db->fetch('select * from solution where ' . $conSql1, $mapConData1);
		$result=$solutionData['result'];
		if($result=='4'){
			$msg = "AC";
			if($mData['score']==NULL)
			$db->exec("update blueSySSubmit set score=100 where submit_id=".$_POST['submit_id'].";");
		}else if($result=='0'||$result=='2'){
			$msg = "panding";
		}else if($result=='6'){
			$msg = "WA".$solutionData['pass_rate'];
			$score=intval(substr($solutionData['pass_rate'],2));
			if($mData['score']==NULL)
			$db->exec("update blueSySSubmit set score=$score where submit_id=".$_POST['submit_id'].";");
		}else if($result=='3'){
			$msg = "TLE";
			if($mData['score']==NULL)
			$db->exec("update blueSySSubmit set score=0 where submit_id=".$_POST['submit_id'].";");
		}else if($result=='11'){
			$msg = "CP";
			if($mData['score']==NULL)
			$db->exec("update blueSySSubmit set score=0 where submit_id=".$_POST['submit_id'].";");
		}else if($result=='7'||$result=='8'){
			$msg = "MLE";
			if($mData['score']==NULL)
			$db->exec("update blueSySSubmit set score=0 where submit_id=".$_POST['submit_id'].";");
		}else{
			$db->exec("update blueSySSubmit set score=0 where submit_id=".$_POST['submit_id'].";");
		}
	}
	if($msg=='panding')die("panding");
	if((strtotime($BEGIN_TIME)<$current_time&&$current_time<strtotime($END_TIME))&&$MODE==1){die('wait');}
	else print($msg);
	//var_dump($mData);
}
?>