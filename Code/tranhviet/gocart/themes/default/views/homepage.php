<div class="contentRight">
    <div class="banner">
        <?php $this->banners->show_collection(1, 5); ?>
    </div>
    <div class="sanpham">
        <div class="bannerSanPham">
            <span>Tranh mới</span>
        </div>
        <div class="row" style="margin: 5px">
            <div>
                <?php if (count($products) == 0): ?>
                    <h2 style="margin:50px 0px; text-align:center;">
                        <?php echo lang('no_products'); ?>
                    </h2>
                <?php elseif (count($products) > 0): ?>

                <div class="row">
                    <div class="span3 pull-right">
                        <select class="span3" id="sort_products"
                                onchange="window.location='<?php echo site_url(uri_string()); ?>'+$(this).val();">
                            <option value=''><?php echo lang('default'); ?></option>
                            <option<?php echo (!empty($_GET['by']) && $_GET['by'] == 'name/asc') ? ' selected="selected"' : ''; ?>
                                value="?by=name/asc"><?php echo lang('sort_by_name_asc'); ?></option>
                            <option<?php echo (!empty($_GET['by']) && $_GET['by'] == 'name/desc') ? ' selected="selected"' : ''; ?>
                                value="?by=name/desc"><?php echo lang('sort_by_name_desc'); ?></option>
                            <option<?php echo (!empty($_GET['by']) && $_GET['by'] == 'price/asc') ? ' selected="selected"' : ''; ?>
                                value="?by=price/asc"><?php echo lang('sort_by_price_asc'); ?></option>
                            <option<?php echo (!empty($_GET['by']) && $_GET['by'] == 'price/desc') ? ' selected="selected"' : ''; ?>
                                value="?by=price/desc"><?php echo lang('sort_by_price_desc'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="contents">
                    <?php foreach ($products as $product): ?>
                        <?php
                        $photo = theme_img('no_picture.png', lang('no_image_available'));
                        $product->images = array_values($product->images);

                        if (!empty($product->images[0])) {
                            $primary = $product->images[0];
                            foreach ($product->images as $photo) {
                                if (isset($photo->primary)) {
                                    $primary = $photo;
                                }
                            }

                            $photo = '<img src="' . base_url('uploads/images/thumbnails/' . $primary->filename) . '" alt="' . $product->seo_title . '"/>';
                        }
                        ?>
                        <div class="product">
                            <div class="innerContent">
                                <h3>
                                    <a href="<?php echo site_url(implode('/', $base_url) . '/' . $product->slug); ?>">
                                        <?php echo $this->lang_key == 'vietnam' ? $product->name : empty($product->en_name) ? $product->name : $product->en_name; ?></a>
                                </h3>
                                <a href="<?php echo site_url(implode('/', $base_url) . '/' . $product->slug); ?>">
                                    <?php echo $photo; ?>
                                </a>
                                <ul>
                                    <li class="matranh"> <?php echo lang('sku'); ?>: <?php echo $product->sku; ?></li>
                                    <?php if ($product->saleprice > 0): ?>
                                        <li class="chitiet"><?php echo lang('price'); ?></li>
                                        <li class="chitiet"><span
                                                class="price-slash"> <?php echo format_currency($product->price); ?></span>
                                            <span
                                                class="price-sale"> <?php echo format_currency($product->saleprice); ?></span>
                                        </li>
                                    <?php else: ?>
                                        <li class="chitiet"> <span
                                                class="price-sale"> <?php echo format_currency($product->price); ?></span>
                                        </li>
                                    <?php endif; ?>
                                    <?php if ((bool)$product->track_stock && $product->quantity < 1 && config_item('inventory_enabled')) { ?>
                                        <li class="chitiet"><?php echo lang('status'); ?>
                                            : <?php echo lang('out_of_stock'); ?></li>
                                    <?php } ?>
                                    <li class="chitiet">
                                        <a href="<?php echo site_url(implode('/', $base_url) . '/' . $product->slug); ?>"> <?php echo lang('details'); ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <?php echo $this->pagination->create_links(); ?>&nbsp;
            </div>
        </div>
    </div>
</div>
</div>