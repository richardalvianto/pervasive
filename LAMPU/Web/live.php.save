<!DOCTYPE html>
<?php 
		session_start();
		$command="";
		$usermqtt = "testuser";
		$passmqtt = "testpassword";
		$hostname = "192.168.123.100";
		$port = "8883";
		$topic = "inTopic";

if(isset($_POST['unset'])){
		unset($_SESSION['lampstatus']);
		unset($_SESSION['lamptimer']);
		session_destroy();
	}
//	var_dump($_POST['status']);
	if(isset($_POST['status'])){
		$temp = $_POST['status'];
		
		$lamptotal=9;
		$status = "";

	//	$topic = $_POST['topicmqtt'];
		$idmsg = "ABCDE";
		$seq = 0;
		$pubmsg = "";

		for($l=0; $l<$lamptotal; $l++) $status = $status."0";
		foreach($temp as $sta){
			$status[$sta] = 1;
		}	


		for($lamp=0; $lamp<$lamptotal; $lamp++) $pubmsg = $pubmsg."0";
		$command = "mosquitto_pub -h $hostname -t $topic -u $usermqtt -P $passmqtt -p $port -m \"xx$status\"";
	}
//	echo "<h2>".$command."</h2>";
	shell_exec($command);

?>

<html>
<head>
	<title>Mau Nyalain Lampu Apa ?</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/img/icon.png" type="image/x-icon">
	<!-- CSS -->
	<link rel="stylesheet" href="assets/bootstrap/css/font-awesome.css">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="assets/bootstrap/css/madflash.css">
	
    <style>
    	body {
			background-color: #123;
    		background-size: cover;
			background-position: left top;
			background-repeat: no-repeat;
			background-attachment: fixed;
		} 
	</style>

	<!-- JavaScript -->
	<script type="text/javascript" src="assets/bootstrap/js/font-awesome.js"></script>
	<script type="text/javascript" src="assets/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="assets/bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="assets/bootstrap/js/madflash.js"></script>

<style>

	input[type=checkbox] {
		display:none;
	}
	input[type=checkbox] + label
	{
		background: url('assets/lampoff.png');
		background-size: cover;
		height: 100px;
		width: 120px;
		text-align: center;
		vertical-align: middle;
		cursor: pointer;
		border-radius: 10%;
	}

	input[type=checkbox]:checked + label
	{
		background: url('assets/lampon.png');
		background-size: cover;
		height: 100px;
		width: 120px;
		border-radius: 20%;
	}

</style>
</head>
<body>
<div class="row">
	<div class='col-md-6 col-md-offset-3'>
		<div class='container-fluid'>
			<div align='center'>
				<font  color='#eee'>
					<h1>LAMPU UMN</h1>
					<h3>MAU.NYALAINLAMPU.GA</h3>
				</font>
				<hr>
			</div>
		</div>
	</div>	
</div>

<div class="row">
<div class='col-md-12'>
	<form class="form-horizontal" method='POST' id="myform">
	<div class='col-md-4'>
		<div class='jumbotron jumbotron-fluid'>
			<div class="container-fluid" align='center'>
				<div class="row">
					<h3>
						Server Credentials
					</h3>
				</div>
				<div class="form-group row">
				  <label for="usermqtt" class="col-md-3 col-md-offset-1 control-label">Username</label>
				  <div class="col-md-7">
  				  <input class="form-control" type="text" name="usermqtt" id="usermqtt" value="testuser">
					</div>
				</div>
				<div class="form-group row">
				  <label for="usermqtt" class="col-md-3 col-md-offset-1 control-label">Password</label>
				  <div class="col-md-7">
  				  <input class="form-control" type="text" name="passmqtt" id="passmqtt" value="testpassword" >
  				</div> 
				</div>
			</div>
		</div>
	</div>
	<div class='col-md-8'>
		<div class='jumbotron'>
			<div class="row" align="center">
				<table width="70%">
					<tr>
					<?php 
					for($a=0; $a<9; $a++){
//						for($a=0; $a<=2; $a++) {
							echo "<td width='15%'>";
							echo "<input type='checkbox' name='status[]' value='".$a."' class='status' id='".$a."'";
							if(isset($status[$a]) && $status[$a]==1) echo " checked";
							echo "/><label for='".$a."'><font size='1'>".$a."</font></label>";
							echo "</td>";						
//						}
						if($a % 3 == 2) echo "</tr></tr>";
					}
 					?>
					</tr>

				</table>
			</div>
			<div class="row">
			<br>
			</div>
		</div>	
	</div>	
</div>
</div>
<div class="row">		
	<div class="col-md-12">
		<div class='container-fluid'>	
			<hr>

<!-- 						-->
		</div>
	</div>		
</div>

	</form>
<br><br>
<script>
	$('input[type="checkbox"]').on('change', function() {
//            $(this).closest('tr').find('input').not(this).prop('checked', true);
//            alert(this.value);
				document.getElementById('myform').submit();
        });

        /*	document.getElementsByClassName("status").onclick = function() {
	    if (this.checked) {
	//        document.getElementById('myform').submit();
			alert('checked');
	    }
	};*/
</script>
</body>
</html>
