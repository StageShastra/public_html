<?php

	// All Useful function stored here

	$connection = $con;


	function getActorProfile($ref = 0){
		global $connection;
		$query = "SELECT * FROM beta_actor_profile WHERE StashActor_actor_ref = {$ref} LIMIT 1";
		$runSQL = mysqli_query($connection, $query);
		$fetch = mysqli_fetch_assoc($runSQL);
		return $fetch;
	}

	function getActorExperience($ref = 0){
		global $connection;
		$query = "SELECT * FROM beta_actor_experience WHERE StashActorExperience_actor_ref = {$ref}";
		$runSQL = mysqli_query($connection, $query);
		$result = [];
		while($fetch = mysqli_fetch_assoc($runSQL))
			$result[] = $fetch;
		return $result;
	}

	function getActorTraining($ref = 0){
		global $connection;
		$query = "SELECT * FROM beta_actor_training WHERE StashActorTraining_actor_ref = {$ref}";
		$runSQL = mysqli_query($connection, $query);
		$result = [];
		while($fetch = mysqli_fetch_assoc($runSQL))
			$result[] = $fetch;
		return $result;
	}

	function calculateAge($dob = 0){
		$diff = abs(time() - $dob);
		$years = floor($diff / (365*60*60*24));
		return $years;
	}

	function confirmActorAccount($email=''){
		global $connection;
		$query = "UPDATE beta_actor SET status = '1' WHERE email = '{$email}' LIMIT 1";
		$runSQL = mysqli_query($connection, $query);
		if(mysqli_affected_rows($connection))
			return true;
		return false;
	}

	function isActorExist($email = ''){
		global $connection;
		$query = "SELECT * FROM beta_actor WHERE email = '{$email}' LIMIT 1";
		$runSQL = mysqli_query($connection, $query);
		if(mysqli_affected_rows($connection))
			return true;
		return false;
	}


?>