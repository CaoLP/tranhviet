<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo (!empty($seo_title)) ? $seo_title . ' - ' : '';
        echo $this->config->item('company_name'); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <?php if (isset($meta)): ?>
        <?php echo $meta; ?>
    <?php else: ?>
        <meta name="Keywords" content="Shopping Cart, eCommerce, Code Igniter">
        <meta name="Description" content="Go Cart is an open source shopping cart built on the Code Igniter framework">
    <?php endif; ?>
    <?php echo theme_css('style.css', true); ?>
    <?php echo theme_css('bootstrap.min.css', true); ?>
    <?php echo theme_css('jquery.fancybox.css', true); ?>

    <?php echo theme_js('jquery.js', true); ?>
    <?php echo theme_js('jquery.simplyscroll.js', true); ?>
    <?php echo theme_js('bootstrap.min.js', true); ?>
    <?php echo theme_js('equal_heights.js', true); ?>
    <?php echo theme_js('squard.js', true); ?>

    <?php echo theme_js('jquery.fancybox.js', true); ?>


    <?php
    //with this I can put header data in the header instead of in the body.
    if (isset($additional_header_info)) {
        echo $additional_header_info;
    }

    ?>
    <script type="text/javascript">
        (function ($) {
            $(function () {
                $("#scroller").simplyScroll({
                    customClass: 'vert',
                    orientation: 'vertical',

                    pauseOnHover: true
                });
                $("#scroller2").simplyScroll({
                    customClass: 'vert',
                    orientation: 'vertical',

                    pauseOnHover: true
                });
            });
        })(jQuery);
    </script>
</head>
<body>
<div class="content-center">
    <div class="indexHeader">
        <div class="top-action">
            <div class="cart-nav">
                <ul class="nav pull-right">

                    <?php if ($this->Customer_model->is_logged_in(false, false)): ?>
                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">  <i class="icon-user"></i>&nbsp;<?php echo lang('account'); ?><b
                                    class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo site_url('secure/my_account'); ?>"><?php echo lang('my_account') ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('secure/my_downloads'); ?>"><?php echo lang('my_downloads') ?></a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="<?php echo site_url('secure/logout'); ?>"><?php echo lang('logout'); ?></a>
                                </li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li><a href="<?php echo site_url('secure/login'); ?>"><i class="icon-user"></i>&nbsp;<?php echo lang('login'); ?></a></li>
                    <?php endif; ?>
                    <li>
                        <a href="<?php echo site_url('cart/view_cart'); ?>">
                            <i class="icon-shopping-cart"></i>&nbsp;
                            <?php
                            if ($this->go_cart->total_items() == 0) {
                                echo sprintf(lang('multiple_items'), $this->go_cart->total_items());
                            } else {
                                if ($this->go_cart->total_items() > 1) {
                                    echo sprintf(lang('multiple_items'), $this->go_cart->total_items());
                                } else {
                                    echo sprintf(lang('single_item'), $this->go_cart->total_items());
                                }
                            }
                            ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>


