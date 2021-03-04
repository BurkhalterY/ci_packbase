<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_type_model extends MY_Model
{
	/* Set MY_Model variables */
	protected $_table = 'users_types';
	protected $primary_key = 'id';
	protected $protected_attributes = ['id'];
	protected $has_many = ['users' => ['primary_key' => 'fk_user_type',
									   'model' => 'user_model']];

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}
}
