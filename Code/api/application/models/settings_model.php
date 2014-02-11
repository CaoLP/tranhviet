<?php
    Class Settings_model extends CI_Model {
        function __construct() {
            parent::__construct();
        }

        function get_setting($field)
	{
		$this->db->select($field);
		$result	= $this->db->get('settings');
		$data = array_shift($result->result_array());
		return $data[$field];
	}
    }