<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SubHobbiesController extends CI_Controller {

	private $userId;

	public function __construct() {
		parent:: __construct();
		$this->load->model('SubHobbieModel');
		$this->userId = $this->session->userdata('user')['id'];
	}

	public function index() {
		$this->load->view('common/header');
		$this->load->view('common/navbar');
		$this->load->view('subHobbies');
	}

	public function getAllSubHobbies() {
		$result = $this->SubHobbieModel->getAllSubHobbies($this->userId);
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

	public function getAllSubHobbiesByUser() {
		$result = $this->SubHobbieModel->getAllSubHobbies($this->input->post('id'));
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

	public function addSubHobbie() {
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('hobbieId', 'Hobbie', 'trim|required');
		$this->form_validation->set_rules('subHobbie', 'SubHobbie', 'trim|required');
		if ($this->form_validation->run() == false) {
			$response = array(
				'status' => 'failed',
				'error' => validation_errors()
			);
			die(json_encode($response));
		}	
		$data = $this->input->post();
		$data['userId'] = $this->userId;
		$result = $this->SubHobbieModel->addSubHobbies($data);
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

	public function getSubHobbie() {
		$result = $this->SubHobbieModel->getSubHobbie($this->input->post());
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

	public function updateSubHobbie($id) {
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('hobbieId', 'Hobbie', 'trim|required');
		$this->form_validation->set_rules('subHobbie', 'SubHobbie', 'trim|required');
		if ($this->form_validation->run() == false) {
			$response = array(
				'status' => 'failed',
				'error' => validation_errors()
			);
			die(json_encode($response));
		}
		$result = $this->SubHobbieModel->updateSubHobbie($id,$this->input->post());
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

	public function deleteSubHobbie() {
		$result = $this->SubHobbieModel->deleteSubHobbie($this->input->post());
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

	public function getUserOfMostSubHobbies() {
		$result = $this->SubHobbieModel->getUserOfMostSubHobbies();
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