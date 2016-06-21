<?php
	$base = "http://localhost/Castiko/";//"http://castiko.com/";
	
	if(isset($_GET['url']) && $_GET['url'] != ''){
		
		$link = trim($_GET['url']);
		
		$link = "{$base}home/joinBySMS/{$link}";
		header("Location: {$link}");
		exit();
		
	}else{
		header("Location: {$base}");
		exit();
	}

?>