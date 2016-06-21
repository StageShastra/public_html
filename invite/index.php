<?php
	
	if(isset($_GET['url']) && $_GET['url'] != ''){
		
		$link = trim($_GET['url']);
		
		$link = "http://castiko.com/home/joinBySMS/{$link}";
		header("Location: {$link}");
		exit();
		
	}else{
		header("Location: http://castiko.com/");
		exit();
	}

?>