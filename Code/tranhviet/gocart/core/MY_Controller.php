<?php

    /**
     * The base controller which is used by the Front and the Admin controllers
     */
    class Base_Controller extends CI_Controller {

        public function __construct() {

            parent::__construct();

            //kill any references to the following methods
            $mthd = $this->router->method;
            if ($mthd == 'view' || $mthd == 'partial' || $mthd == 'set_template') {
                show_404();
            }

            //load base libraries, helpers and models
            $this->load->database();

            // load the migrations class & settings model
            $this->load->library('migration');
            $this->load->model('Settings_model');

            // Migrate to the latest migration file found
            if (!$this->migration->latest()) {
                echo $this->migration->error_string();
            }

            //load in config items from the database
            $settings = $this->Settings_model->get_settings('gocart');
            foreach ($settings as $key => $setting) {
                //special for the order status settings
                if ($key == 'order_statuses') {
                    $setting = json_decode($setting, true);
                }
                $this->config->set_item($key, $setting);
            }

            //load the default libraries
            $this->load->library(array('session', 'auth', 'go_cart'));
            $this->load->model(array('Customer_model', 'Category_model', 'Location_model'));
            $this->load->helper(array('url', 'file', 'string', 'html', 'language'));

            //if SSL is enabled in config force it here.
            if (config_item('ssl_support') && (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == 'off')) {
                $CI =& get_instance();
                $CI->config->config['base_url'] = str_replace('http://', 'https://', $CI->config->config['base_url']);
                redirect($CI->uri->uri_string());
            }
        }

    }

//end Base_Controller

    class Front_Controller extends Base_Controller {
        var $setting = array();
        //we collect the categories automatically with each load rather than for each function
        //this just cuts the codebase down a bit
        var $categories = '';

        //load all the pages into this variable so we can call it from all the methods
        var $pages = '';

        // determine whether to display gift card link on all cart pages
        //  This is Not the place to enable gift cards. It is a setting that is loaded during instantiation.
        var $gift_cards_enabled;

        var $lang_key = 'vietnam';
        var $slide = array();
        var $ads = array();

        function __construct() {

            parent::__construct();

            //load the theme package
            $this->load->add_package_path(APPPATH . 'themes/' . config_item('theme') . '/');

            //load GoCart library
            $this->load->library('Banners');

            //load needed models
            $this->load->model(array('Page_model', 'Product_model', 'Digital_Product_model', 'Gift_card_model', 'Option_model', 'Order_model', 'Settings_model', 'Category_model'));

            //load helpers
            $this->load->helper(array('form_helper', 'formatting_helper'));

            //load common language
            $this->load_lang('common');

            //fill in our variables
            $this->categories = $this->Category_model->get_categories_tiered(0);
            $this->pages = $this->Page_model->get_pages_tiered();
            $this->settings = $this->Settings_model->get_settings('gocart');

            // check if giftcards are enabled
            $gc_setting = $this->Settings_model->get_settings('gift_cards');
            if (!empty($gc_setting['enabled']) && $gc_setting['enabled'] == 1) {
                $this->gift_cards_enabled = true;
            } else {
                $this->gift_cards_enabled = false;
            }
            $slide_setting = $this->Settings_model->get_settings('slide');
            if (!empty($slide_setting['slide_l'])) {
                $qty_l = 0;
                $sort_l = 'RANDOM';
                $categories_l = array();
                $json = json_decode($slide_setting['slide_l']);
                $qty_l = $json->qty_l;
                $sort_l = $json->sort_l;
                if (isset($json->categories_l)) {
                    $categories_l = $json->categories_l;
                }
                if (count($categories_l) > 0) {
                    $this->slide['slide_l'] = $this->Category_model->get_slide_products($categories_l, $qty_l, $sort_l);
                } else {
                    $this->slide['slide_l'] = $this->Category_model->get_slide_products(array(), $qty_l, $sort_l);
                }

            } else {
                $this->slide['slide_l'] = $this->Category_model->get_slide_products(array(), 10, 'RANDOM');
            }
            if (!empty($slide_setting['slide_r'])) {
                $qty_r = 0;
                $sort_r = 'RANDOM';
                $categories_r = array();
                $json = json_decode($slide_setting['slide_r']);
                $qty_r = $json->qty_r;
                $sort_r = $json->sort_r;
                if (isset($json->categories_r)) {
                    $categories_r = $json->categories_r;
                }
                if (count($categories_r) > 0) {
                    $this->slide['slide_r'] = $this->Category_model->get_slide_products($categories_r, $qty_r, $sort_r);
                } else {
                    $this->slide['slide_r'] = $this->Category_model->get_slide_products(array(), $qty_r, $sort_r);
                }

            } else {
                $this->slide['slide_r'] = $this->Category_model->get_slide_products(array(), 10, 'RANDOM');
            }
            //ads

            $data_js = $this->Settings_model->get_settings('ads');
            if (isset($data_js['ads']) && !empty($data_js['ads'])) {
                $json = json_decode($data_js['ads']);
                $this->ads['left'] = $json->left;
                $this->ads['right'] = $json->right;
            }

            //$this->output->enable_profiler(TRUE);
        }

        /*
        This works exactly like the regular $this->load->view()
        The difference is it automatically pulls in a header and footer.
        */
        function view($view, $vars = array(), $string = false) {
            if ($string) {
                $result = $this->load->view('header', $vars, true);
                $result .= $this->load->view('slide_left', $vars, true);
                $result .= $this->load->view('slide_right', $vars, true);
                $result .= $this->load->view('menu_top', $vars, true);
                $result .= $this->load->view('content_right', $vars, true);
                $result .= $this->load->view('menu_left', $vars, true);
                $result .= $this->load->view($view, $vars, true);
                $result .= $this->load->view('footer', $vars, true);

                return $result;
            } else {
                $this->load->view('header', $vars);
                $this->load->view('slide_left', $vars);
                $this->load->view('slide_right', $vars);
                $this->load->view('menu_top', $vars);
                $this->load->view('content_right', $vars);
                $this->load->view('menu_left', $vars);
                if (!empty($view))
                    $this->load->view($view, $vars);
                $this->load->view('footer', $vars);
            }
        }

        /*
        This function simply calls $this->load->view()
        */
        function partial($view, $vars = array(), $string = false) {
            if ($string) {
                return $this->load->view($view, $vars, true);
            } else {
                $this->load->view($view, $vars);
            }
        }

        function load_lang($lang) {
            $type = 'vietnam';
            if (!$this->session->userdata('user_lang')) {
                $this->session->set_userdata("user_lang", $type);
            } else {
                $type = $this->session->userdata('user_lang');
            }
            $this->lang->load($lang, $type);
            $this->lang_key = $type;
        }
    }

    class Admin_Controller extends Base_Controller {

        private $template;

        function __construct() {
            parent::__construct();

            $this->auth->is_logged_in(uri_string());

            //load the base language file
            $this->load_lang('admin_common');
            $this->load_lang('media');
        }

        function load_lang($lang) {
            $type = 'vietnam';
            if (!$this->session->userdata('lang')) {
                $this->session->set_userdata("lang", $type);
            } else {
                $type = $this->session->userdata('lang');
            }
            $this->config->set_item('language', $type);
            $this->lang->load($lang, $type);
        }

        function view($view, $vars = array(), $string = false) {
            //if there is a template, use it.
            $template = '';
            if ($this->template) {
                $template = $this->template . '_';
            }

            if ($string) {
                $result = $this->load->view('admin/' . $template . 'header', $vars, true);
                $result .= $this->load->view($view, $vars, true);
                $result .= $this->load->view('admin/' . $template . 'footer', $vars, true);

                return $result;
            } else {
                $this->load->view('admin/' . $template . 'header', $vars);
                $this->load->view($view, $vars);
                $this->load->view('admin/' . $template . 'footer', $vars);
            }

            //reset $this->template to blank
            $this->template = false;
        }

        /* Template is a temporary prefix that lasts only for the next call to view */
        function set_template($template) {
            $this->template = $template;
        }
    }