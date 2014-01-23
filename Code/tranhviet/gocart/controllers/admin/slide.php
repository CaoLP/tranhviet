<?php

class Slide extends Admin_Controller {

    function __construct()
    {
        parent::__construct();

        $this->auth->check_access('Admin', true);
        $this->load->model('Category_model');
        $this->load->model('Product_model');
        $this->load->model('Settings_model');
        $this->load_lang('Slide');
    }

    function index()
    {
        $this->load->helper('form');
        $data['page_title']	= lang('common_slide');
        $data['categories']		= $this->Category_model->get_categories_tiered();
        $this->view($this->config->item('admin_folder').'/slide', $data);
    }
    function load_product(){
        $cate_id	= trim($this->input->post('cate_id'));
        $limit	= $this->input->post('limit');

        if(empty($cate_id))
        {
            echo json_encode(array());
        }
        else
        {
            $results	= $this->Product_model->get_products($cate_id, $limit,false,'name','DESC');
            $return		= array();
            foreach($results as $r)
            {
                $return[$r->id]	= $r->name;
            }
            echo json_encode($return);
        }
    }
    function add_slide(){

    }
    function add_slides(){

    }
}