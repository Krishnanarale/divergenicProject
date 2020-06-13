<?php 

/**
 * 
 */
class HobbieModel extends CI_Model {
	
	private $table = 'hobbies';

	public function getHobbies($user) {
		return $this->db->get_where($this->table, array('userId' => $user), '', '');
	}

	public function addHobbie($data) {
		return $this->db->insert($this->table, $data);
	}

	public function getHobbie($data) {
		return $this->db->get_where($this->table, array('id' => $data['id']), '', '');
	}

	public function updateHobbie($id, $data) {
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}

	public function deleteHobbie($data) {
		return $this->db->delete($this->table, array('id' => $data['id']));
	}
}