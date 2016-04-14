<?php
	// Textlocal account details
	
	
	// Message details
	function send_text($sendto,$sms)
	{
		$username = 'shiv@stageshastra.com';
		$hash = 'Stash123';
		$reciepients=$sendto;
		//var_dump($sendto);
		//echo $reciepients;
		$numbers = explode(",",$reciepients);
		$sender = urlencode('STGSHS');
		$premessage = "Dear Actor, ";
		$message = rawurlencode($sms);
		$postmessage = "\nPowered By: StageShastra"; 
		$message=$premessage.$message.$postmessage;
		$len=strlen($message);
		//echo $message." ";
		echo $len;
		//var_dump($numbers);
		$numbers = num_implode($numbers);
		echo $numbers;
		$data = array('username' => $username, 'password' => $hash, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
		$ch = curl_init('http://api.textlocal.in/send/');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		
		// Process your response here
		return $response;

	}
	function num_implode($num)
	{
		$str="";
		//echo count($num);
		for($i=0;$i<count($num);$i++)
		{
			$str=$str.(string)$num[$i];
			//echo $i;
			//echo "and count is ".$count;
			if(count($num)-$i!=1)
			{
			    //echo "iamcalled";
				$str=$str.",";
			}
		}
		return $str;

	}
	
?>