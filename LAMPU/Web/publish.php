<HTML>
<HEAD>
<!-- <META HTTP-EQUIV="refresh" CONTENT="3;URL=http://nyalainlampu.ga"> -->
</HEAD>
<BODY>
	Playing Sequence
<?php
//	$topic = $_POST['topic'];
//	$counter = $_POST['count'];
	session_start();
	foreach($_SESSION['lampstatus'] as $ls)
		echo $ls . '<br>';
	
	$usermqtt = $_POST['usermqtt'];
	$passmqtt = $_POST['passmqtt'];
	$hostname = "nyalainlampu.ga";
	$port = "8883";
	$topic = "inTopic";
	$lamptotal = 9;
	$idmsg = "ABCDE";
	$seq = 0;
	$pubmsg = "";
	for($lamp=0; $lamp<$lamptotal; $lamp++) $pubmsg = $pubmsg."0";	
if(ob_get_level() == 0) ob_start();
	foreach($_SESSION['lampstatus'] as $sta){
//		$pubmsg = $idmsg . " " . $seq . " " . $sta;
		$pubmsg = "xx".$sta." ".$seq;
		$command = "mosquitto_pub -h $hostname -t $topic -u $usermqtt -P $passmqtt -p $port -m \"$pubmsg ". date('Y-m-d H:i:s') ."\"";
		exec($command);
		echo $command . "<br>";
		ob_flush();
                flush();

		sleep($_SESSION['lamptimer'][$seq]);
		$seq++;
	}

	
			unset($_SESSION['lampstatus']);
		unset($_SESSION['lamptimer']);
		unset($_SESSION['ctr']);
		session_destroy();

		header('Location:nyalainlampu.ga');
		exit()
	//exec("mosquitto_pub -h $hostname -t $topic -u $usermqtt -P $passmqtt -p $port -m $pubmsg");
//	exec($command);

	
/*
	$client = new Mosquitto\Client();
	$client->onConnect('connect');
	$client->onDisconnect('disconnect');
	$client->onSubscribe('subscribe');
	$client->onMessage('message');
	$client->setCredentials($usermqtt, $passmqtt);
	$client->connect("localhost", 1883, 10);
	$client->subscribe('/test', 1);
	$mid = $client->publish("$topic", "Hello no $counter at $topic " . date('Y-m-d H:i:s'), 1, 0);
		$mid = $client->publish("inTopic", "$pubmsg  " . date('Y-m-d H:i:s'), 1, 0);
	$client->disconnect();
	unset($client);

	function connect($r) {
		echo "I got code {$r}\n";
	}
	function subscribe() {
		echo "Subscribed to a topic\n";
	}
	function message($message) {
		printf("Got a message ID %d on topic %s with payload:\n%s\n\n", $message->mid, $message->topic, $message->payload);
	}
	function disconnect() {
		echo "\nDisconnected cleanly\n";
	}
*/
?>


</BODY>
</HTML>
