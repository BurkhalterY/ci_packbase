<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends MY_Model
{
	/* Set MY_Model variables */
	protected $_table = 'users';
	protected $primary_key = 'id';
	protected $protected_attributes = ['id'];
	protected $belongs_to = ['user_type'=> ['primary_key' => 'fk_user_type',
											'model' => 'user_type_model']];

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}
}
