<?php 

/**
 * 
 */
class SubHobbieModel extends CI_Model {
	private $table = 'subHobbies';
	private $viewTable = 'vw_SubHobbies';

	public function getAllSubHobbies($user) {
		return $this->db->get_where($this->viewTable, array('userId' => $user), '', '');
	}

	public function addSubHobbies($data) {
		return $this->db->insert($this->table, $data);
	}

	public function getSubHobbie($data) {
		return $this->db->get_where($this->table, array('id' => $data['id']), '', '');
	}

	public function updateSubHobbie($id, $data) {
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}

	public function deleteSubHobbie($data) {
		return $this->db->delete($this->table, array('id' => $data['id']));
	}

	public function getUserOfMostSubHobbies() {
		return $this->db->query('SELECT `userId`, COUNT(`userId`) AS `mostSubHobbies` FROM `vw_subHobbies` GROUP BY `userId` ORDER BY `mostSubHobbies` DESC LIMIT 1');
	}
}