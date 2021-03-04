<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

	/**
	 * '*' for all users
	 * '@' for logged in users
	 * '0, 1, 2, 4, 8, ...' for access level (power of 2)
	 */
	protected $access_level = "*";

	public function __construct()
	{
		parent::__construct();
		
		if (!$this->check_permission()) {
			show_error(lang('msg_err_access_denied_message'), 403, lang('msg_err_access_denied_header'));
		}
	}

	protected function ask_for_login()
	{
		$_SESSION['after_login_redirect'] = current_url();
		redirect('auth/login');
	}

	protected function check_permission($required_level = NULL)
	{
		if (is_null($required_level)) {
			$required_level = $this->access_level;
		}

		if ($required_level == "*") {
			return true;
		} else if (!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] != true) {
			$this->ask_for_login();
		} else if ($required_level == "@") {
			return true;
		} else if ($required_level <= $_SESSION['user_access']) {
			return true;
		} else {
			return false;
		}
	}


	public function display_view($view_parts, $data = NULL)
	{
		if (!isset($data['title'])) {
			$data['title'] = '';
		}

		$this->load->view('common/header', $data);

		if (is_array($view_parts)) {
			foreach ($view_parts as $view_part) {
				$this->load->view($view_part, $data);
			}
		} else if (is_string($view_parts)) {
			$this->load->view($view_parts, $data);
		}

		$this->load->view('common/footer');
	}
}