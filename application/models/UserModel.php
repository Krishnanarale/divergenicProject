<?php
class UserModel extends CI_Model {

	private $table = 'users';

	public function addUser($data) {
		return $this->db->insert('users', $data);
	}

	public function getUser($data) {
		return $this->db->get_where('users', array('email' => $data['email']), '', '');
	}
}