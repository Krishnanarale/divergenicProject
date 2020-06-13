<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('common/header');
		$this->load->view('login');
	}

	public function signup() {
		$this->load->view('common/header');
		$this->load->view('signup');
	}

	public function register() {
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == false) {
			$response = array(
				'status' => 'failed',
				'error' => validation_errors()
			);
			die(json_encode($response));
		}
		$this->load->model('UserModel');
		$result = $this->UserModel->addUser($this->input->post());
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
		$this->load->model('UserModel');
		$result = $this->UserModel->getUser($this->input->post())->result_array();
		if ($result[0]['password'] === $this->input->post('password')) {
			$this->session->set_userdata('user', $result[0]);
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
		$this->session->unset_userdata('user');
		$this->session->sess_destroy();
		redirect(base_url()."login"); 
	}

	public function home() {
		if ($this->session->has_userdata('user')) {
			$this->load->view('common/header');
			$this->load->view('common/navbar');
			$this->load->view('home');
		} else {
			redirect(base_url()."login");		
		}
	}
}
