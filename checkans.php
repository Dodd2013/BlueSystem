<?php 
if($_POST){
	require_once 'config.php';
	$current_time=time();
	session_start();
	if((strtotime($BEGIN_TIME)<$current_time&&$current_time<strtotime($END_TIME))&&$MODE==1&&$_SESSION['email']!='Dodd@Dodd2014.com'){die('wait');}
	require_once 'DAO.php';
	$db=new DB();
	$data['submit_id'] = $_POST['submit_id'];
	$judge['submit_id'] = '=';
	list($conSql, $mapConData) = $db->FDFields($data, 'and', $judge);
	$mData = $db->fetch('select * from blueSySSubmit where ' . $conSql, $mapConData);
	if($problemArray[$mData['pid']]['type']=='结果'){
		if($mData['ans']==$problemArray[$mData['pid']]['ans']){
			echo "AC";
			$upData = 100;
		}
		else {
			echo "WA";
			$upData = 0;
		}
		$row=$db->exec("update blueSySSubmit set score=".$upData." where submit_id=".$_POST['submit_id'].";");
		//echo "更新行数:$row";
	}else{
		$data1['solution_id'] = $mData['solution_id'];
		$judge1['solution_id'] = '=';
		list($conSql1, $mapConData1) = $db->FDFields($data1, 'and', $judge1);
		$solutionData = $db->fetch('select * from solution where ' . $conSql1, $mapConData1);
		$result=$solutionData['result'];
		if($result=='4'){
			echo "AC";
		}else if($result=='0'||$result=='2'){
			echo "panding";
		}else if($result=='6'){
			echo "WA".$solutionData['pass_rate'];
		}else if($result=='3'){
			echo "TLE";
		}else if($result=='11'){
			echo "CP";
		}else if($result=='7'){
			echo "MLE";
		}
	}
	//var_dump($mData);
}
?>