<?php 
	if($_POST){
		session_start();
		require 'config.php';
		$current_time=time();
		usleep(rand(5000,2000000));
		if(strtotime($BEGIN_TIME)<$current_time&&$current_time<strtotime($END_TIME)){
			$pid=$_POST['pid'];
			if($problemArray[$pid]['type']=='结果'){
				if($problemArray[$pid]['ans']==$_POST['ans']){
					echo "AC";
				}else{
					echo "WA";
				}
			}else if ($problemArray[$pid]['type']=='代码') {
				echo $_POST['ans'];
			}else if ($problemArray[$pid]['type']=='编程'){
				require_once 'DAO.php';
				$db=new DB();
				$inData['problem_id'] = $problemArray[$pid]['ans'];
				$inData['user_id'] = $_SESSION['email'];
				$inData['in_date']=date('Y-m-d H:i:s',time());
				$inData['result']='0';
				$inData['language']='1';
				$inData['ip']=$_SERVER["REMOTE_ADDR"];
				$ret = $db->insert('solution', $inData,true);
				echo '插入' . ($ret ? '成功' : '失败') . '<br/>';
				$inData1['solution_id'] = $ret;
				$inData1['source'] = $_POST['ans'];
				$ret = $db->insert('source_code', $inData1);
				echo '插入' . ($ret ? '成功' : '失败') . '<br/>';
			}else{
				echo "未知错误！";
			}
		}else{
			echo "Time Out";
		}
	}
?>