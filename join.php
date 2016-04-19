<?php

	$ref = 0;

	if(isset($_GET['ref'])){

		$ref = (int)$_GET['ref'];


	}

	header("Location: actor/signup.php?refCode={$ref}");
	exit();

?>