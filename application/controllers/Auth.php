<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {
	
	protected $access_level = "*";

	public function __construct() {
		parent::__construct();
		$this->load->model(['user_model', 'user_type_model']);
	}

	public function index() {
		redirect('auth/login');
	}

	public function login() {
		$this->form_validation->set_rules('username', 'Nom d\'utilisateur', 'required');
		$this->form_validation->set_rules('password', 'Mot de passe', 'required');

		if ($this->form_validation->run()) {

			$user = $this->user_model->with('user_type')->get_by('username', $this->input->post('username'));

			if(!is_null($user)){
				if(password_verify($this->input->post('password'), $user->password)){
					$_SESSION['is_logged'] = true;
					$_SESSION['user_id'] = $user->id;
					$_SESSION['user_access'] = $user->user_type->level;
					redirect($_SESSION['after_login_redirect'] ?? '');
				}
			}
			$error = true;
		}

		$this->display_view('auth/login', ['title' => 'Connexion', 'valid' => isset($error)]);
	}

	public function register() {
		$this->form_validation->set_rules('username', 'Nom d\'utilisateur', 'required|is_unique[users.username]');
		$this->form_validation->set_rules('email', 'Adresse e-mail', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Mot de passe', 'required|min_length[8]');
		$this->form_validation->set_rules('passconf', 'Confirmation de mot de passe', 'required|matches[password]');

		if ($this->form_validation->run()) {
			$user = [
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'fk_user_type' => ACCESS_LVL_REGISTERED_ID
			];
			$this->user_model->insert($user);

			$_SESSION['is_logged'] = true;
			$_SESSION['user_id'] = $this->db->insert_id();
			$_SESSION['user_access'] = $user->fk_user_type;
			redirect($_SESSION['after_login_redirect'] ?? '');
		}

		$this->display_view('auth/register', ['title' => 'Inscription']);
	}

	public function logout() {
		session_destroy();
		redirect('auth');
	}
}
