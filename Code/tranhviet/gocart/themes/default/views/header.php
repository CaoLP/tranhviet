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
    <?php echo theme_js('scrollingcarousel.2.0.min.js', true); ?>

    <!--Begin Share this-->
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script
        type="text/javascript">stLight.options({publisher: "ffaea2c1-fa0c-4425-af0b-41ef51907509", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
    <!-- END Share this   -->
    <?php
    //with this I can put header data in the header instead of in the body.
    if (isset($additional_header_info)) {
        echo $additional_header_info;
    }

    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#vertical-1').scrollingCarousel({
                scrollerAlignment: 'vertical',
                autoScroll: true
            });
            $('#vertical-2').scrollingCarousel({
                scrollerAlignment: 'vertical',
                autoScroll: true
            });
        });
    </script>

    <style>
        .carousel-demo-vertical {
            height: 600px;
            width: 145px;
            margin: 9px;
            float: left;
            background-color: #ffffff;

        }

        .carousel-demo-vertical ul {
            overflow: hidden;
            margin: 2.5px;
            padding: 0;
            list-style: none;
        }

        .carousel-demo-vertical li {
            margin: 2px;
            padding: 0;
            height: auto;
        }

    </style>
</head>
<body>
<div class="content-center">
    <div class="indexHeader">
        <div class="top-action">
            <div class="cart-nav">
                <ul class="nav pull-right">

                    <?php if ($this->Customer_model->is_logged_in(false, false)): ?>
                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i
                                    class="icon-user"></i>&nbsp;<?php echo lang('account'); ?><b
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
                        <li><a href="<?php echo site_url('secure/login'); ?>"><i
                                    class="icon-user"></i>&nbsp;<?php echo lang('login'); ?></a></li>
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


