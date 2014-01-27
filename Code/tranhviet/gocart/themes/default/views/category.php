<div class="contentRight">
    <div class="sanpham">
        <div class="bannerSanPham">
           <?php if(isset($category)):?> <span><?php echo $category->name; ?></span><?php endif;?>
        </div>
        <?php if(!empty($category->description)): ?>
            <div class="span9" style="border: 1px solid #ddd;margin-bottom: 10px;border-radius: 5px; padding: 2px;">
                <div><?php echo $category->description; ?></div>
            </div>
        <?php endif; ?>
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
                        $photo  = theme_img('no_picture.png', lang('no_image_available'));
                        $product->images    = array_values($product->images);

                        if(!empty($product->images[0]))
                        {
                            $primary    = $product->images[0];
                            foreach($product->images as $photo)
                            {
                                if(isset($photo->primary))
                                {
                                    $primary    = $photo;
                                }
                            }

                            $photo  = '<img src="'.base_url('uploads/images/thumbnails/'.$primary->filename).'" alt="'.$product->seo_title.'"/>';
                        }
                        ?>
                        <div class="product">
                            <div class="innerContent">
                                <h3>
                                    <a href="<?php echo site_url(implode('/', $base_url).'/'.$product->slug); ?>"><?php echo $product->name;?></a>
                                </h3>
                                <a href="<?php echo site_url(implode('/', $base_url).'/'.$product->slug); ?>">
                                    <?php echo $photo; ?>
                                </a>
                                <ul>
                                    <li class="matranh">Mã tranh: <?php echo $product->sku;?></li>
                                    <?php if($product->saleprice > 0):?>
                                        <li class="chitiet">Giá tiền:  <span class="price-slash"> <?php echo format_currency($product->price); ?></span>
                                            <span class="price-sale"> <?php echo format_currency($product->saleprice); ?></span></li>
                                    <?php else: ?>
                                        <li class="chitiet">Giá tiền:  <?php echo format_currency($product->price); ?></li>
                                    <?php endif; ?>
                                    <li class="chitiet">Tranh sáng tác</li>
                                    <?php if((bool)$product->track_stock && $product->quantity < 1 && config_item('inventory_enabled')) { ?>
                                        <li class="chitiet">Tình trạng: <?php echo lang('out_of_stock');?></li>
                                    <?php } ?>
                                    <li class="chitiet">
                                        <a href="<?php echo site_url(implode('/', $base_url).'/'.$product->slug); ?>">Xem chi tiết</a>
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