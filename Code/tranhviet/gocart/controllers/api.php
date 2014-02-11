<?php
    class Api extends CI_Controller {
        function __construct() {
            parent::__construct();
            $this->load->model(array('Product_model', 'Customer_model', 'Category_model', 'Order_model', 'Gift_card_model', 'Coupon_model', 'Staffs_model'));
        }

        function index($action = null) {
            $key = null;
            if (isset($_POST['apikey']) || isset($action))
                $key = $_POST['apikey'];
            else {
                echoError(99);
                die;
            }
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

        function echoError($code) {
            echo json_encode(array('error' => $code));
        }
    }