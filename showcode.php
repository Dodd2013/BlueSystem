<?php 
session_start();
if(!isset($_SESSION['email'])){
    die("用户未登录!");
}
if($_GET){
	require_once 'DAO.php';
	require_once 'config.php';
	$db=new DB();
	if(!isset($_GET['email'])){
		$data['email'] = $_SESSION['email'];
		$judge['email'] = '=';
	}
	if(isset($_GET['pid'])){
		//查询
		$data['pid'] = $_GET['pid'];
		$judge['pid'] = '=';
	}
	list($conSql, $mapConData) = $db->FDFields($data, 'and', $judge);
	$mData = $db->fetch('select * from blueSySSubmit where ' . $conSql . ' order by `submit_id` desc', $mapConData);
	if($mData['ans']!=NULL){
		print($mData['ans']);
	}else{
		$data1['solution_id'] = $mData['solution_id'];
		$judge1['solution_id'] = '=';
		list($conSql1, $mapConData1) = $db->FDFields($data1, 'and', $judge1);
		$mData1 = $db->fetch('select * from source_code where ' . $conSql1, $mapConData1);
		print($mData1['source']);
	}
}
?>