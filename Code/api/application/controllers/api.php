<?php
    class Api extends CI_Controller {
        function __construct() {
            parent::__construct();
            $this->load->model(array('Settings_model','Api_model'));
        }

        function index($action = null) {
        echo 'aaaa';
            $key = null;
            if (isset($_POST['apikey']) || isset($action))
                $key = $_POST['apikey'];
            else {
                echoError(99);
                die;
            }            
            $systemkey = $this->Settings_model->get_setting('apikey');
            if($key == $systemkey){
            switch ($action) {
                case 'query':
                    if (isset($_POST['query']))
                        echo json_encode($this->Staffs_model->excuteQuery($_POST['query']));
                    else
                        echoError(98);
                default:
                    echoError(99);
            }
            }
            else{
            echoError(97);
            }
        }
        
	function test($query = null){
	echo 'hiiiiii';
	echo $query;
	 $query = urldecode($query)
	 	echo $query;
	    //echo json_encode($this->Staffs_model->excuteQuery($query));

	}
	
        function echoError($code) {
            echo json_encode(array('error' => $code));
        }
    }