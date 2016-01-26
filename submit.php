<?php 
	if($_POST){
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
				echo $_POST['ans'];
			}else{
				echo "未知错误！";
			}
		}else{
			echo "Time Out";
		}
	}
?>