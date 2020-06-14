<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HobbieController extends CI_Controller {

	private $userId;

	public function __construct() {
		parent:: __construct();
		$this->load->model('HobbieModel');
		$this->userId = $this->session->userdata('user')['id'];
	}

	public function getAllHobbies() {
		$result = $this->HobbieModel->getHobbies($this->userId);
		if ($result) {
			$response = array(
				'status' => 'success',
				'data' => $result->result_array()
			);
		} else {
			$response = array(
				'status' => 'failed',
				'data' => $result
			);
		}
		die(json_encode($response));
	}

	public function getAllHobbiesByUser() {
		$result = $this->HobbieModel->getHobbies($this->input->post('id'));
		if ($result) {
			$response = array(
				'status' => 'success',
				'data' => $result->result_array()
			);
		} else {
			$response = array(
				'status' => 'failed',
				'data' => $result
			);
		}
		die(json_encode($response));
	}

	public function addHobbie() {
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('hobbie', 'Hobbie', 'trim|required');
		if ($this->form_validation->run() == false) {
			$response = array(
				'status' => 'failed',
				'error' => validation_errors()
			);
			die(json_encode($response));
		}
		$data = $this->input->post();
		$data['userId'] = $this->userId;
		$result = $this->HobbieModel->addHobbie($data);
		if ($result) {
			$response = array(
				'status' => 'success',
				'data' => $result
			);
		} else {
			$response = array(
				'status' => 'failed',
				'data' => $result
			);
		}
		die(json_encode($response));
	}

	public function getHobbie() {
		$result = $this->HobbieModel->getHobbie($this->input->post());
		if ($result) {
			$response = array(
				'status' => 'success',
				'data' => $result->result_array()
			);
		} else {
			$response = array(
				'status' => 'failed',
				'data' => $result
			);
		}
		die(json_encode($response));
	}

	public function updateHobbie($id) {
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('hobbie', 'Hobbie', 'trim|required');
		if ($this->form_validation->run() == false) {
			$response = array(
				'status' => 'failed',
				'error' => validation_errors()
			);
			die(json_encode($response));
		}
		
		$result = $this->HobbieModel->updateHobbie($id,$this->input->post());
		if ($result) {
			$response = array(
				'status' => 'success',
				'data' => $result
			);
		} else {
			$response = array(
				'status' => 'failed',
				'data' => $result
			);
		}
		die(json_encode($response));
	}

	public function deleteHobbie() {
		$result = $this->HobbieModel->deleteHobbie($this->input->post());
		if ($result) {
			$response = array(
				'status' => 'success',
				'data' => $result
			);
		} else {
			$response = array(
				'status' => 'failed',
				'data' => $result
			);
		}
		die(json_encode($response));
	}

	public function getUserOfMostHobbies() {
		$result = $this->HobbieModel->getUserOfMostHobbies();
		if ($result) {
			$response = array(
				'status' => 'success',
				'data' => $result->result_array()
			);
		} else {
			$response = array(
				'status' => 'failed',
				'data' => $result
			);
		}
		die(json_encode($response));
	}
}