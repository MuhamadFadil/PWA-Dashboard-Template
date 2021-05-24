<?php
//date_default_timezone_set('America/New_York');
$spath = str_replace("\\","/",getcwd()).'/';
$servroot = rtrim($_SERVER['DOCUMENT_ROOT'],'/').'/';
if ( !empty( $_SERVER['HTTPS'] ) ) {
	$hostroot = 'https://'.$_SERVER['HTTP_HOST'].'/';
}else{
	$hostroot = 'http://'.$_SERVER['HTTP_HOST'].'/';
}
$hpath = str_replace($servroot, $hostroot, $spath);
$name = basename(__FILE__, '.php'); 
$fname = basename(__FILE__); 
$isdb = false;
if(is_file('DB.sqlite')){$isdb = true;}
try{
	$db = new PDO('sqlite:DB.sqlite');
}
catch(PDOException $e){
	 exit($e->getMessage());
}
if($isdb == false){
	$tables = array();
	$tables['subscribers'] = array('id'=>'INTEGER PRIMARY KEY AUTOINCREMENT','endpoint'=>'TEXT','auth'=>'TEXT','p256dh'=>'TEXT');
	foreach($tables as $ke => $val){

		$sql = "CREATE TABLE IF NOT EXISTS ".$ke." (";
		    foreach($val as $k => $v){
		 		$sql .= $k." ".$v.", ";
		 	}
		    $sql = rtrim($sql, ", ");
		    $sql .= ")";
			$db->exec($sql);
	}
}

$publickey = 'BPPhk9r4rKBUbrs2dDQeBVNxhXgaSUvUYS9OlGUegaGUSQvoumYTKEegIMEwpUDYh53X1z5ee1clfQh1-PjSMjI';
$privatekey = '4PsWeQ6YiW8FVMosiguy7GiX57tE9lb5_lQSZ6kYkpc';

$_POST = json_decode(file_get_contents('php://input'), true); //for php 7
if(isset($_POST['axn']) && $_POST['axn'] != NULL){
	$output = '';
	switch($_POST['axn']){
		case "subscribe":
			//filter out bad data
			$myQuery = "SELECT * FROM subscribers WHERE endpoint = ".$db->quote($_POST['endpoint']);
			try{
			    $result = $db->query($myQuery)->fetch(PDO::FETCH_ASSOC);
			    if($result['id'] == NULL || $result['id'] == ""){
					$my_query = "REPLACE INTO subscribers (endpoint, p256dh, auth) VALUES (".$db->quote($_POST['endpoint']).", ".$db->quote($_POST['key']).", ".$db->quote($_POST['token'])."); ";
					    echo $my_query.'<BR><BR>';
					    try {
					        $db->exec($my_query);
					        }
					    catch(PDOException $e)
					        {
					        echo $e->getMessage();
					        }
					    //$i++;
					    $output .= 'adding user <br>';
		   	    }else{
			        $output .= 'user exists in db :  <br>';
			        
			    }
			}
			catch(PDOException $e){
			     exit($e->getMessage());
			} 
			echo $output;
			exit;
			break;
		case "unsubscribe":
			$myQuery = "SELECT * FROM subscribers WHERE endpoint = ".$db->quote($_POST['endpoint']);
			try{
			    $result = $db->query($myQuery)->fetch(PDO::FETCH_ASSOC);
			    if($result['id'] != NULL){
					$my_query = "DELETE FROM subscribers WHERE endpoint = ".$db->quote($_POST['endpoint']);
					   // exit($my_query);
					    try {
					        $db->exec($my_query);
					        }
					    catch(PDOException $e)
					        {
					        echo $e->getMessage();
					        }
					    $output .= 'removing user <br>';
		   	    }else{
			        $output .= 'user does not exist in db :  <br>';
			        
			    }
			}
			catch(PDOException $e){
			     exit($e->getMessage());
			} 
			echo $output;
			exit;
			break;
		default:
	}
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Push Notification Example</title>
	<script>
		var aspkey = '<?php echo $publickey; ?>';
	</script>
</head>
<body>
<button class="pushtoglbtn" disabled >Enable Push Messaging</button><br>
<button class="sendpushbtn" >Send push notification</button><br>

<script src="scripts/main.js"></script>
</body>
</html>