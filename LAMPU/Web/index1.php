<!DOCTYPE html>
<?php 
		session_start();
	if(isset($_POST['unset'])){
		unset($_SESSION['lampstatus']);
		unset($_SESSION['lamptimer']);
		unset($_SESSION['ctr']);
		session_destroy();
	}
	if(!isset($_SESSION['ctr'])) $_SESSION['ctr'] = 0;
	if(!isset($_SESSION['lampstatus'])) $_SESSION['lampstatus'] = 0;
//	if(!isset($_SESSION['ctr'])) $_SESSION['ctr'] = 0;
	if(isset($_POST['next'])){
		$ctr = $_SESSION['ctr'];
		$status = $_POST['status'];
		$revtimer = $_POST['settimer'];
		
		$lamptotal=9;
		$temp = "";
		
		for($l=0; $l<$lamptotal; $l++) $temp = $temp."0";
		foreach($status as $sta){
			$temp[$sta] = 1;
		}	

		for($i=0; $i<$ctr; $i++){
			$_SESSION['lamptimer'][$i] = $revtimer[$i];
		}
		
		if($_SESSION['lampstatus'][$ctr-1]!= $temp){
			$_SESSION['lamptimer'][$ctr] = $_POST['timer'];
			$_SESSION['lampstatus'][$ctr] = $temp;
			$lamp_status[$ctr] = $temp;
			$_SESSION['ctr']++;
		}
//		foreach($_SESSION['lampstatus'] as $ls)
//				echo "<br>$ls";
//		echo "<br><br>".$_SESSION['ctr'];
	}
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
							echo "<input type='checkbox' name='status[]' value='".$a."' id='".$a."'";
							if($_SESSION['lampstatus'][$_SESSION['ctr']-1][$a]) echo " checked";
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
				<div class="form-group row">
					<label for="timer" class="col-md-3 col-sm-4 col-xs-2 col-xs-offset-2 col-md-offset-1 control-label">Duration</label>
					<div class="col-md-3 col-sm-4 col-xs-6">
					<div class="input-group">
						<input class="form-control" type="number" name="timer" id="timer" min="1" max="60" value="4">
						<div class="input-group-addon">Second(s)</div>
					</div>
					</div>
				</div>				
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
			<div class="col-md-10">
<?php				
//					if(isset($_SESSION['lampstatus'])){
if (isset($_SESSION['lampstatus']) && is_array($_SESSION['lampstatus']) || is_object($_SESSION['lampstatus']))
{						$lms = 0;
						foreach($_SESSION['lampstatus'] as $lampstatus){
							echo "
								<div class='col-md-2 col-sm-3 col-xs-4' align='center'>
									<div class='row' align='center'> <font color='white'>
									Sequence ". $lms ."
									</div>
									<div class='row' align='center'>
									<table width='50%' ><tr>";
							for($a=0; $a<9; $a++){
								if($lampstatus[$a]) 
									echo "<td width='20%' bgcolor='yellow' style='
		border-radius: 50%;'>&nbsp;";
								else 
									echo "<td width='20%' bgcolor='grey' style='
		border-radius: 50%;'>&nbsp;";
								echo "</td>";						
								if($a % 3 == 2) echo "</tr><tr>";

							}
							echo "</tr></table>";
							echo "<div class='form-group'>
									<div class='col-md-8 col-md-offset-2' align='center'>
									<div class='input-group'>
										<input class='form-control input-sm' type='number' name='settimer[".$lms."]' id='settimer[".$lms."]' min='1' max='60' value='".$_SESSION['lamptimer'][$lms]."'>
										<div class='input-group-addon'>s</div>
									</div>
									</div>
								</div>";

// 							echo "<div class='row' align='center'> <font color='white'>
// 									". $_SESSION['lamptimer'][$lms] ." Second(s)
// 									</div>";
 							echo "<br>";
 							echo "</div></div>";
							$lms ++ ;
						}
					}
?>
			</div>
			<div class="col-md-2" align="right"> 
				<button class='btn-custom btn-custom1' name="submit" onclick="actionfrm('subm')">SUBMIT </button> <br>
				<button class='btn-custom btn-custom1' name="next" onclick="actionfrm('next')">NEXT </button> <br>
				<button class='btn-custom btn-danger' name="unset" onclick="actionfrm('unset')">RESET </button> 
				<br><br>
			</div>
<!-- 						-->
		</div>
	</div>		
</div>

	</form>
<br><br>
<script>
	function actionfrm(action) {
		if(action=="subm")
    	document.getElementById("myform").action = 'publish.php';
		else
    	document.getElementById("myform").action = 'index.php';			
		return true;
	}
</script>
</body>
</html>