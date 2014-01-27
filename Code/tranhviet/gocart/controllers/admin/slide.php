<?php

class Slide extends Admin_Controller
{

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
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $data['page_title'] = lang('common_slide');
        $data['categories'] = $this->Category_model->get_categories_tiered();
        $data['categories_l'] = array();
        $data['qty_l'] = '';
        $data['sort_l'] = '';

        $data['categories_r'] = array();
        $data['qty_r'] = '';
        $data['sort_r'] = '';
        $data_js = $this->Settings_model->get_settings('slide');

        if (isset($data_js['slide_l']) && !empty($data_js['slide_l'])) {
            $json_left = json_decode($data_js['slide_l'], true);
            $data['qty_l'] = $json_left['qty_l'];
            $data['sort_l'] = $json_left['sort_l'];
            $data['categories_l'] = $json_left['categories_l'];
        }
        if (isset($data_js['slide_r']) && !empty($data_js['slide_l'])) {
            $json_right = json_decode($data_js['slide_r'], true);
            $data['qty_r'] = $json_right['qty_r'];
            $data['sort_r'] = $json_right['sort_r'];
            $data['categories_r'] = $json_right['categories_r'];
        }

        $this->form_validation->set_rules('qty_l', 'lang:slide_category_qty', 'trim|numeric|greater_than[5]|less_than[20]');
        $this->form_validation->set_rules('qty_r', 'lang:slide_category_qty', 'trim|numeric|greater_than[5]|less_than[20]');


        if ($this->form_validation->run() == FALSE) {
            $data['error'] = validation_errors();
            $this->view($this->config->item('admin_folder') . '/slide', $data);
        } else {
            $this->session->set_flashdata('message', lang('config_updated_message'));

            //$save = $this->input->post();
            //fix boolean values
            $d['qty_l'] = $this->input->post('qty_l');
            $d['sort_l'] = $this->input->post('sort_l');
            $d['categories_l'] = $this->input->post('categories_l');
            $save['slide_l'] = json_encode(array('qty_l' => $d['qty_l'], 'sort_l' => $d['sort_l'], 'categories_l' => $d['categories_l']));
            //echo $save['slide_l'];
            $d['qty_r'] = $this->input->post('qty_r');
            $d['sort_r'] = $this->input->post('sort_r');
            $d['categories_r'] = $this->input->post('categories_r');
            $save['slide_r'] = json_encode(array('qty_r' => $d['qty_r'], 'sort_r' => $d['sort_r'], 'categories_r' => $d['categories_r']));
            //echo $save['slide_r'];
            $this->Settings_model->save_settings('slide', $save);

            redirect(config_item('admin_folder') . '/slide');
        }
    }

    function load_product()
    {
        $cate_id = trim($this->input->post('cate_id'));
        $limit = $this->input->post('limit');

        if (empty($cate_id)) {
            echo json_encode(array());
        } else {
            $results = $this->Product_model->get_products($cate_id, $limit, false, 'name', 'DESC');
            $return = array();
            foreach ($results as $r) {
                $return[$r->id] = $r->name;
            }
            echo json_encode($return);
        }
    }

    function form()
    {


    }

    function add_slides()
    {

    }
}
