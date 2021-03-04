<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Secure extends MY_Controller {

	protected $access_level = 2;

	public function index()
	{
		echo 'You have access';
	}
}
