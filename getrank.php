<?php 
if($_GET){
	require_once 'DAO.php';
	require_once 'config.php';
	$db=new DB();
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
		//var_dump($table);
		uasort($table, function($a, $b) {
			$al = 0;
			$bl = 0;
			foreach ($a as $key => $value) {
				$al+=$value['score'];
			}
			foreach ($b as $key => $value) {
				$bl+=$value['score'];
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
			print("<th>$i</th>");
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
					$sum+=$score;
					print("<td>$score($times)</td>");
				}else{
					print("<td>0(0)</td>");
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