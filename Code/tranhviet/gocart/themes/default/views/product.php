<div class="contentRight">
<div class="sanpham" style=" height: 100%; margin-top: 0">
<div class="bannerSanPham">
    <span> <?php echo $product->name; ?></span>
</div>
<script>
    $('.fancybox-buttons').fancybox({
        helpers: {
            title: {
                type: 'outside'
            },
            overlay: {
                speedOut: 0
            }
        }
    });
    $(document).ready(function () {
        $('.images').click(function () {
            $(this).squard('280', $('#border-image-wrap'));
            $('.fancybox-buttons').attr('href', $(this).attr('ref'));
        });
    });


</script>
<script>
    window.onload = function () {
        $('.product').equalHeights();
    }
</script>
<div class="row" style="margin: 5px">
<div class="image-wrap">
    <div class="border-image-wrap" id="border-image-wrap">
        <?php
            $photo = theme_img('no_picture.png', lang('no_image_available'));
            $product->images = array_values($product->images);
            $ref_photo = '';
            if (!empty($product->images[0])) {
                $primary = $product->images[0];
                foreach ($product->images as $photo) {
                    if (isset($photo->primary)) {
                        $primary = $photo;
                    }
                }

                $photo = '<img class="responsiveImage" src="' . base_url('uploads/images/medium/' . $primary->filename) . '" alt="' . $product->seo_title . '"/>';
                $ref_photo = '<div style="text-align: center;padding-top: 10px;"><a href="' . base_url('uploads/images/full/' . $primary->filename) . '" class="fancybox-buttons"  data-fancybox-group="button" >Xem hình lớn</a></div>';
            }
            echo $photo;
        ?>
    </div>
    <?php echo $ref_photo; ?>
    <?php if (!empty($primary->caption)): ?>
        <div class="product-thumbnails">
            <?php echo $primary->caption; ?>
        </div>
    <?php endif; ?>
    <?php if (count($product->images) > 1): ?>
        <div class="product-thumbnails">
            <?php foreach ($product->images as $image): ?>
                <img class="images" src="<?php echo base_url('uploads/images/medium/' . $image->filename); ?>"
                     ref="<?php echo base_url('uploads/images/full/' . $image->filename); ?>"
                    />
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<div class="product-info">
    <div class="top-info">
        <div class="name-wrapper">

        </div>
        <div class="product-option">
            <div class="product-cart-form">
            <?php echo form_open('cart/add_to_cart', 'class="form-info"'); ?>
            <input type="hidden" name="cartkey" value="<?php echo $this->session->flashdata('cartkey'); ?>"/>
            <input type="hidden" name="id" value="<?php echo $product->id ?>"/>
            <table class="table_product">
                <tbody><tr>
                    <td colspan="2" class="price-sale td_content_Product">
                        <?php echo $this->lang_key == 'vietnam' ? $product->name : empty($product->en_name) ? $product->name : $product->en_name; ?>
                    </td>

                </tr>
                <tr>
                    <td class="td_content"><?php echo lang('sku'); ?></td>
                    <td><span class="price-sale"><?php echo $product->sku; ?></span>
                        <?php if ((bool)$product->track_stock && $product->quantity < 1 && config_item('inventory_enabled')): ?>
                            <div class="out-of-stock">
                                <div><?php echo lang('out_of_stock'); ?></div>
                            </div>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td class="td_content"><?php echo lang('price'); ?></td>
                    <td>
                        <?php if ($product->saleprice > 0): ?>
                            <span class="price-sale"><?php echo format_currency($product->price); ?></span> &nbsp; <span class="price-slash"><?php echo format_currency($product->saleprice); ?></span>
                        <?php else: ?>
                            <?php echo format_currency($product->price); ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php if (count($options) > 0): ?>
                    <?php foreach ($options as $option):
                        $required = '';
                        if ($option->required) {
                            $required = ' <p class="help-block">Required</p>';
                        }
                        ?>
                        <tr>
                            <td class="td_content td_content_line_height"><?php echo $option->name; ?></td>
                            <td>
                                <?php

                                //if we're dealing with a textfield or text area, grab the option value and store it in value
                                if ($option->type == 'checklist') {
                                    $value = array();
                                    if ($posted_options && isset($posted_options[$option->id])) {
                                        $value = $posted_options[$option->id];
                                    }
                                } else {
                                    if (isset($option->values[0])) {
                                        $value = $option->values[0]->value;
                                        if ($posted_options && isset($posted_options[$option->id])) {
                                            $value = $posted_options[$option->id];
                                        }
                                    } else {
                                        $value = false;
                                    }
                                }

                                if ($option->type == 'textfield'):?>
                                    <input type="text" name="option[<?php echo $option->id; ?>]"
                                           value="<?php echo $value; ?>" class="span4"/>
                                    <?php echo $required; ?>
                                <?php elseif ($option->type == 'textarea'): ?>
                                    <textarea class="span4"
                                              name="option[<?php echo $option->id; ?>]"><?php echo $value; ?></textarea>
                                    <?php echo $required; ?>
                                <?php
                                elseif ($option->type == 'droplist'): ?>
                                    <select name="option[<?php echo $option->id; ?>]">
                                        <option value=""><?php echo lang('choose_option'); ?></option>

                                        <?php foreach ($option->values as $values):
                                            $selected = '';
                                            if ($value == $values->id) {
                                                $selected = ' selected="selected"';
                                            }?>

                                            <option<?php echo $selected; ?> value="<?php echo $values->id; ?>">
                                                <?php echo ($values->price != 0) ? ' (+' . format_currency($values->price) . ') ' : '';
                                                echo $values->name; ?>
                                            </option>

                                        <?php endforeach; ?>
                                    </select>
                                    <?php echo $required; ?>
                                <?php
                                elseif ($option->type == 'radiolist'): ?>
                                    <?php foreach ($option->values as $values):

                                        $checked = '';
                                        if ($value == $values->id) {
                                            $checked = ' checked="checked"';
                                        }?>
                                        <label class="radio">
                                            <input<?php echo $checked; ?> type="radio"
                                                                          name="option[<?php echo $option->id; ?>]"
                                                                          value="<?php echo $values->id; ?>"/>
                                            <?php echo ($values->price != 0) ? '(+' . format_currency($values->price) . ') ' : '';
                                            echo $values->name; ?>
                                        </label>
                                    <?php endforeach; ?>
                                    <?php echo $required; ?>
                                <?php
                                elseif ($option->type == 'checklist'): ?>
                                    <?php foreach ($option->values as $values):

                                        $checked = '';
                                        if (in_array($values->id, $value)) {
                                            $checked = ' checked="checked"';
                                        }?>
                                        <label class="checkbox">
                                            <input<?php echo $checked; ?> type="checkbox"
                                                                          name="option[<?php echo $option->id; ?>][]"
                                                                          value="<?php echo $values->id; ?>"/>
                                            <?php echo ($values->price != 0) ? '(' . format_currency($values->price) . ') ' : '';
                                            echo $values->name; ?>
                                        </label>

                                    <?php endforeach; ?>
                                    <?php echo $required; ?>
                                <?php endif; ?>


                            </td>


                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if (!$product->fixed_quantity) : ?>

                    <tr>
                        <td class="td_content td_content_line_height"><?php echo lang('quantity') ?></td>
                        <td>
                            <?php if (!config_item('inventory_enabled') || config_item('allow_os_purchase') || !(bool)$product->track_stock || $product->quantity > 0) : ?>
                                <?php if (!$product->fixed_quantity) : ?>
                                    <input class="span2" type="text" name="quantity"
                                           value=""/>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>


                    </tr>
                <?php endif; ?>
                <tr>
                    <td class="td_content_Product " style="text-align: center;" colspan="2">
                        <input type="hidden" name="cartkey" value="">
                        <input type="hidden" name="id" value="1">
                                <span class='st_facebook_hcount' displayText='Facebook'></span>
                                <span class='st_twitter_hcount' displayText='Tweet'></span>
                                <span class='st_googleplus_hcount' displayText='Google +'></span>

                    </td>

                </tr>
                <tr>
                    <td colspan="2" style="text-align:center">


                        <button class="btn btn-primary btn-large" type="submit" value="submit"><i class="icon-shopping-cart icon-white"></i> Thêm vào giỏ                                </button>

                        <div class="dathang_sum">
                            <div class="dathang_or"> Hoặc </div>
                            <div class="dathang_phone">
                                Đặt hàng qua điện thoại:
                                <br>
                                <span style="color:#ba0000; font-size:13px; font-weight:bold;"><?php echo $this->settings['info_hotline'];?> - <?php echo $this->settings['info_phone'];?></span>
                            </div>
                        </div>

                    </td>

                </tr>
                </tbody>
            </table>

            </form>
            </div>

        </div>
    </div>
</div>
</div>

<div class="product-des">
    <div class="tabbable">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#product_des" data-toggle="tab"><?php echo lang('tab_description'); ?></a></li>
        </ul>
    </div>
</div>
<div class="tab-content" style="height: 560px;">
    <div class="tab-pane active" id="product_des">
        <div class="span9">
            <?php echo $this->lang_key == 'vietnam' ? $product->description : empty($product->en_description) ? $product->description : $product->en_description; ?>
        </div
    </div>
</div>
</div>

<?php if (!empty($product->related_products)): ?>
    <div class="related_products">
        <h3 style="margin-top:20px;"><?php echo lang('related_products_title'); ?></h3>
        <?php foreach ($product->related_products as $relate): ?>
            <?php
            $photo = theme_img('no_picture.png', lang('no_image_available'));

            $relate->images = array_values((array)json_decode($relate->images));

            if (!empty($relate->images[0])) {
                $primary = $relate->images[0];
                foreach ($relate->images as $photo) {
                    if (isset($photo->primary)) {
                        $primary = $photo;
                    }
                }

                $photo = '<img src="' . base_url('uploads/images/thumbnails/' . $primary->filename) . '" alt="' . $relate->seo_title . '"/>';
            }
            ?>
            <div class="product">
                <div class="innerContent">
                    <h3>
                        <a href="<?php echo site_url($relate->slug); ?>">
                            <?php echo $this->lang_key == 'vietnam' ? $relate->name : empty($relate->en_name) ? $relate->name : $relate->en_name; ?>
                        </a>
                    </h3>
                    <a href="<?php echo site_url($relate->slug); ?>">
                        <?php echo $photo; ?>
                    </a>
                    <ul>
                        <li class="matranh"> <?php echo lang('sku'); ?>: <?php echo $relate->sku; ?></li>
                        <?php if ($relate->saleprice > 0): ?>
                            <li class="chitiet"><?php echo lang('price'); ?></li>
                            <li class="chitiet"><span
                                    class="price-slash"> <?php echo format_currency($relate->price); ?></span>
                                            <span
                                                class="price-sale"> <?php echo format_currency($relate->saleprice); ?></span>
                            </li>
                        <?php else: ?>
                            <li class="chitiet"> <span
                                    class="price-sale"> <?php echo format_currency($relate->price); ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if ((bool)$relate->track_stock && $relate->quantity < 1 && config_item('inventory_enabled')) { ?>
                            <li class="chitiet"><?php echo lang('status'); ?>
                                : <?php echo lang('out_of_stock'); ?></li>
                        <?php } ?>
                        <li class="chitiet">
                            <a href="<?php echo site_url($relate->slug); ?>"> <?php echo lang('details'); ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<script>
    $(function () {
        $('.category_container').each(function () {
            $(this).children().equalHeights();
        });
    });
</script>
</div>
