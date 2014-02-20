<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class tranhviet
{
    var $CI;

    function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->lang->load('tranhviet');
    }

    function rates()
    {
        //rates function should return an array of rates/prices
        //this is so a UPS function could perhaps return multiple shipping rates
        //setting up some sort of database setting for this is ok
        $settings = $this->CI->Settings_model->get_settings('tranhviet');

        if ($settings['enabled'] && $settings['enabled'] > 0) {
            return array(
                lang('taivanphong') => $settings['taivanphong'],
                lang('noithanh') => $settings['noithanh'],
                lang('ngoaithanh') => $settings['ngoaithanh'],
                lang('lientinh') => $settings['lientinh']
            );
        } else {
            return array();
        }

    }

    function install()
    {
        //set a default blank setting for flatrate shipping
        $this->CI->Settings_model->save_settings('tranhviet', array('taivanphong' => ''));
        $this->CI->Settings_model->save_settings('tranhviet', array('noithanh' => ''));
        $this->CI->Settings_model->save_settings('tranhviet', array('ngoaithanh' => ''));
        $this->CI->Settings_model->save_settings('tranhviet', array('lientinh' => ''));
        $this->CI->Settings_model->save_settings('tranhviet', array('enabled' => '0'));
    }

    function uninstall()
    {
        $this->CI->Settings_model->delete_settings('tranhviet');
    }

    function form($post = false)
    {
        $this->CI->load->helper('form');

        //this same function processes the form
        if (!$post) {
            $settings = $this->CI->Settings_model->get_settings('tranhviet');
            $taivanphong = $settings['taivanphong'];
            $noithanh = $settings['noithanh'];
            $ngoaithanh = $settings['ngoaithanh'];
            $lientinh = $settings['lientinh'];
        } else {
            $taivanphong = $post['taivanphong'];
            $noithanh = $post['noithanh'];
            $ngoaithanh = $post['ngoaithanh'];
            $lientinh = $post['lientinh'];

        }
        ob_start();
        ?>
        <label><?php echo lang('taivanphong'); ?></label>
        <?php echo form_input(array('name' => 'taivanphong', 'value' => $taivanphong, 'class' => 'span3')); ?>
        <label><?php echo lang('noithanh'); ?></label>
        <?php echo form_input(array('name' => 'noithanh', 'value' => $noithanh, 'class' => 'span3')); ?>
        <label><?php echo lang('ngoaithanh'); ?></label>
        <?php echo form_input(array('name' => 'ngoaithanh', 'value' => $ngoaithanh, 'class' => 'span3')); ?>
        <label><?php echo lang('lientinh'); ?></label>
        <?php echo form_input(array('name' => 'lientinh', 'value' => $lientinh, 'class' => 'span3')); ?>

        <label><?php echo lang('enabled'); ?></label>
        <select name="enabled" class="span3">
            <option
                value="1"<?php echo ((bool)$settings['enabled']) ? ' selected="selected"' : ''; ?>><?php echo lang('enabled'); ?></option>
            <option
                value="0"<?php echo ((bool)$settings['enabled']) ? '' : ' selected="selected"'; ?>><?php echo lang('disabled'); ?></option>
        </select>
        <?php
        $form = ob_get_contents();
        ob_end_clean();

        return $form;
    }

    function check()
    {
        $error = false;

        if (!is_numeric($_POST['taivanphong'])) {
            $error .= '<div>' . lang('val_err') . '</div>';
        }
        if (!is_numeric($_POST['noithanh'])) {
            $error .= '<div>' . lang('val_err') . '</div>';
        }
        if (!is_numeric($_POST['ngoaithanh'])) {
            $error .= '<div>' . lang('val_err') . '</div>';
        }
        if (!is_numeric($_POST['lientinh'])) {
            $error .= '<div>' . lang('val_err') . '</div>';
        }

        //count the errors
        if ($error) {
            return $error;
        } else {
            //we save the settings if it gets here
            $this->CI->Settings_model->save_settings(
                'tranhviet',
                array(
                    'taivanphong' => $_POST['taivanphong'],
                    'noithanh' => $_POST['noithanh'],
                    'ngoaithanh' => $_POST['ngoaithanh'],
                    'lientinh' => $_POST['lientinh'],
                    'enabled' => $_POST['enabled']
                )
            );

            return false;
        }
    }
}
