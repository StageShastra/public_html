<?php

	class ModelDirector extends CI_Model {

		public function arr2csv($data = []){
			$csv = '';
			foreach ($data as $key => $value)
				$csv .= trim($value) . ', ';
			return rtrim($csv, ", ");
		}

		public function calculateAge($dob = 0){
			$diff = abs(time() - $dob);
			$years = floor($diff / (365*60*60*24));
			return $years;
		}

		public function deleteActorFromDirector($ref = ''){
			$data = array('StashDirectorActorLink_status' => 0);
			$this->db->where("StashDirectorActorLink_actor_id_ref", $ref);
			return $this->db->update("StaSh-Director-Actor-Link", $data);
		}

		public function getActorsInDirectorList($ref = ''){
			$this->db->select("*");
			$this->db->from("StaSh-Actor as act"); //StashDirectorActorLink_actor_id_ref
			$this->db->join("StaSh-Director-Actor-Link as DALink", "DALink.StashDirectorActorLink_actor_id_ref = act.StashActor_actor_id_ref");
			$this->db->where("DALink.StashDirectorActorLink_director_id_ref", $ref);
			$this->db->where("DALink.StashDirectorActorLink_status", 1);
			$query = $this->db->get();
			$result = [];
			$actors = $query->result('array');
			foreach ($actors as $key => $actor) {
				$actor['StashActor_sex'] = ($actor['StashActor_gender']) ? "M" : "F";
				$actor['StashActor_age'] = $this->calculateAge($actor['StashActor_dob']);
				$actor['StashActor_range'] = $actor['StashActor_min_role_age'] . " - " . $actor['StashActor_max_role_age'];
				$result[] = $actor;
			}

			return $result;
		}

	}

?>