<?php

class Ads extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->auth->check_access('Admin', true);
        $this->load->model('Settings_model');
        $this->load_lang('Slide');
    }

    function index()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $data['page_title'] = lang('common_ads');
        $this->view($this->config->item('admin_folder') . '/ads', $data);
    }
}
