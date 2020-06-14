<?php
class AdminModel extends CI_Model {

	private $adminUser = 'adminUser';
	private $users = 'users';

	public function getUser($data) {
		return $this->db->get_where($this->adminUser, array('email' => $data['email']), '', '');
	}

	public function getAllUsers() {
		return $this->db->get($this->users);
	}
}