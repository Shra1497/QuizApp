<?php
require_once 'load_data.php';
session_start();
date_default_timezone_set("Asia/Calcutta");
include 'db.php';

if (isset($_POST['login'])){
    $login = get_data("user_id,username,role_id", "usermaster where username='" . $_POST['user_name'] . "' and password='" . md5($_POST['password']) . "' order by user_id asc");
    if (isset($login)){
        while ($row = mysqli_fetch_array($login)){
			if($row['role_id']=='1'){
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['role_id'] = $row['role_id'];
				$response["status"]=true;
				$response['message']="Logged in successfully";
			}else{
				$response["status"]=false;
				$response['message']="You don't have access to user this site";
			}
        }
    }else{
        $response["status"]=false;
		$response['message']="Incorrect username or password..Please try again";
    }
	echo json_encode($response);
}

?>
