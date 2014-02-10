<?php

    class Ads extends Admin_Controller {

        function __construct() {
            parent::__construct();

            $this->auth->check_access('Admin', true);
            $this->load->model('Settings_model');
        }

        function index() {
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $data['page_title'] = lang('common_ads');
            if (isset($_POST['submit'])) {
                $left = array();
                $right = array();
                for ($i = 0; $i < 5; $i++):
                    $name = $this->input->post('name_l_' . $i);
                    $link = $this->input->post('link_l_' . $i);
                    $img = $this->input->post('img_l_' . $i);
                    if (!empty($link) && !empty($img)):
                        $left[] = array(
                            'name' => $this->input->post('name_l_' . $i),
                            'link' => $this->input->post('link_l_' . $i),
                            'img' => $this->input->post('img_l_' . $i)
                        );
                    endif;
                    $name = $this->input->post('name_r_' . $i);
                    $link = $this->input->post('link_r_' . $i);
                    $img = $this->input->post('img_r_' . $i);
                    if (!empty($link) && !empty($img)):
                        $right[] = array(
                            'name' => $this->input->post('name_r_' . $i),
                            'link' => $this->input->post('link_r_' . $i),
                            'img' => $this->input->post('img_r_' . $i)
                        );
                    endif;
                endfor;
                $d = array('left' => $left, 'right' => $right);
                $save = array('ads' => json_encode($d));
                // echo json_encode($d);
                $this->Settings_model->save_settings('ads', $save);
                redirect(config_item('admin_folder') . '/ads');
            } else {
                $data_js = $this->Settings_model->get_settings('ads');
                if (isset($data_js['ads']) && !empty($data_js['ads'])) {
                    $json = json_decode($data_js['ads']);
                    $data['left'] = $json->left;
                    $data['right'] = $json->right;
                }
                $this->view($this->config->item('admin_folder') . '/ads', $data);
            }

        }
    }
