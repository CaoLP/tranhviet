<?php
    Class Api_model extends CI_Model {
        function __construct() {
            parent::__construct();
        }

        function excuteQuery($sql) {
            $result = $this->db->query($sql);
            if ($result != 1 && $result != 0)
                return $result->result();
            else return $result;
        }
    }