<?php 
if($_GET){
	require_once 'DAO.php';
	require_once 'config.php';
	$db=new DB();
	$data1['context_code'] = $_GET['context_code'];
	$judge1['context_code'] = '=';
	list($conSql1, $mapConData1) = $db->FDFields($data1, 'and', $judge1);
	$mData1 = $db->fetchALL('select * from blueSySSubmit where ' . $conSql1.'and score is null order by submit_id asc', $mapConData1,array(0,5000));
	require_once 'updateans.php';
	foreach ($mData1 as $key => $value) {
		updateans($value['submit_id']);
		//var_dump($value['submit_id']);
	}
	$data['context_code'] = $_GET['context_code'];
	$judge['context_code'] = '=';

	list($conSql, $mapConData) = $db->FDFields($data, 'and', $judge);
	$mData = $db->fetchALL('select b.nick,a.* from blueSySSubmit as a join blueSySusers as b on a.email=b.email  where a.' . $conSql.'and a.score is not null order by a.submit_id asc', $mapConData,array(0,5000));
	if($mData){
		//var_dump($mData);
		$table=array();
		foreach ($mData as $key1 => $value1) {
			$email=$value1['nick']."  (".$value1['email'].")";
			$pid=$value1['pid'];
			if(!isset($table[$email][$pid]['times'])){$table[$email][$pid]['times']=0;}
			if(!isset($table[$email][$pid]['score'])){$table[$email][$pid]['score']=0;}
			$table[$email][$pid]['score']=intval($value1['score']);
			$table[$email][$pid]['times']++;
		}
		// foreach ($table as $key => $value) {
		// 	foreach ($value as $key1 => $value1) {
		// 		var_dump('dfsa'.$key.'key1:'.$key1);
		// 		if(isset($table[$key]['sum']))$table[$key]['sum']+=$value1['score']*$problemArray[$key1]['score']/100;
		// 	else $table[$key]['sum']=0;
		// 	}
		// }
		//var_dump($table);
		uasort($table, function($a, $b) {
			$al = 0;
			$bl = 0;
			require 'config.php';
			foreach ($a as $key => $value) {
				$al+=$value['score']*$problemArray[$key]['score']/100;
			}
			foreach ($b as $key => $value) {
				$bl+=$value['score']*$problemArray[$key]['score']/100;
			}
            if ($al == $bl)
                return 0;
            return ($al > $bl) ? -1 : 1;
        });
		print("<table class ='am-table am-table-bordered am-table-striped am-table-centered am-table-hover'>");
		print("<tr>");
		print("<th>用户名</th>");
		$problemNum=count($problemArray)-1;
		for ($i=1; $i <= $problemNum; $i++) { 
			$scoresum=$problemArray[$i]['score'];
			print("<th>$i ($scoresum 分)</th>");
		}
		print("<th>总分</th>");
		print("</tr>");
		foreach ($table as $key => $value) {
			print("<tr>");
			print("<td>$key</td>");
			$sum=0;
			for ($i=1; $i <= $problemNum; $i++) { 
				if(isset($value[$i])){
					$score=$value[$i]['score'];
					$times=$value[$i]['times'];
					$sum+=$score*$problemArray[$i]['score']/100;
					print("<td>$score%($times)</td>");
				}else{
					print("<td>0%(0)</td>");
				}
			}
			print("<td>$sum</td>");
			print("</tr>");
		}
		print("</table>");
		//array(8) { ["submit_id"]=> string(1) "6" ["context_code"]=> string(4) "0001" ["pid"]=> string(1) "1" ["email"]=> string(17) "Dodd@Dodd2014.com" ["ans"]=> string(3) "123" ["solution_id"]=> NULL ["submit_time"]=> string(19) "2016-01-27 13:51:11" ["score"]=> string(3) "100" }
	}else{
		print("<h1>不存在该比赛！或者该比赛无人提交！</h1>");
	}
}
?>