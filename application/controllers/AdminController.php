<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->model('AdminModel');
	}

	public function index() {
		if ($this->session->has_userdata('admin')) {
			$this->load->view('common/header');
			$this->load->view('common/navbar1');
			$this->load->view('admin/dashborad');
		} else {
			redirect(base_url()."admin");		
		}
	}

	public function adminLogin() {
			$this->load->view('common/header');
			$this->load->view('admin/login');
	}

	public function login() {
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == false) {
			$response = array(
				'error' => validation_errors()
			);
			die(json_encode($response));
		}
		$result = $this->AdminModel->getUser($this->input->post())->result_array();
		if ($result[0]['password'] === $this->input->post('password')) {
			$this->session->set_userdata('admin', $result[0]);
			$response = array(
				'status' => 'success',
				'data' => 'Logging in.'
			);
		} else {
			$response = array(
				'status' => 'failed',
				'data' => 'Login failed'
			);
		}
		die(json_encode($response));
	}

	public function logout() {
		$this->session->unset_userdata('admin');
		$this->session->sess_destroy();
		redirect(base_url()."admin"); 
	}

	public function getAllUsers() {
		$result = $this->AdminModel->getAllUsers();
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

	public function users() {
		if ($this->session->has_userdata('admin')) {
			$this->load->view('common/header');
			$this->load->view('common/navbar1');
			$this->load->view('admin/user');
		} else {
			redirect(base_url()."admin");		
		}
	} 
}