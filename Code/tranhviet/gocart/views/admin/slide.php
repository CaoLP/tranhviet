<?php echo form_open($this->config->item('admin_folder') . '/slide'); ?>
<div class="form-actions">
    <button type="submit" class="btn btn-primary"><?php echo lang('save'); ?></button>
</div>

<div class="tabbable">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#slide_l" data-toggle="tab"><?php echo lang('common_slide_l'); ?></a></li>
        <li><a href="#slide_r" data-toggle="tab"><?php echo lang('common_slide_r'); ?></a></li>
    </ul>
</div>
<div class="tab-content">
    <div class="tab-pane active" id="slide_l">
        <fieldset>
            <legend><?php echo lang('common_slide_l'); ?></legend>
            <div class="row">
                <div id="category_l" class="span10">
                    <div class="span4">
                        <label><?php echo lang('slide_category_qty'); ?></label>
                        <?php echo form_input(array('name' => 'qty_l', 'class' => 'span4', 'value' => $qty_l)); ?>
                    </div>
                    <div class="span4">
                        <label><?php echo lang('slide_category_sort'); ?></label>
                        <?php echo form_dropdown('sort_l', array('desc' => lang('slide_category_desc'),
                                'asc' => lang('slide_category_asc'), 'RANDOM' => lang('slide_category_rand')),
                            set_value('sort_l', $sort_l), 'class="span4"');?>
                    </div>
                    <div class="span8">
                        <?php if (isset($categories[0])): ?>
                            <label id="label"><?php echo lang('slide_category_title'); ?></label>
                            <table id="table" class="table table-striped">
                                <thead>
                                <tr>
                                    <th colspan="2"><?php echo lang('slide_category_title'); ?></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <?php
                                function list_categories($parent_id, $cats, $sub = '', $product_categories)
                                {

                                    foreach ($cats[$parent_id] as $cat):?>
                                        <tr>
                                            <td><?php echo $sub . $cat->name; ?></td>
                                            <td>
                                                <input type="checkbox" name="categories_l[]"
                                                       value="<?php echo $cat->id; ?>" <?php echo (in_array($cat->id, $product_categories)) ? 'checked="checked"' : ''; ?>/>
                                            </td>
                                        </tr>
                                        <?php
                                        if (isset($cats[$cat->id]) && sizeof($cats[$cat->id]) > 0) {
                                            $sub2 = str_replace('&rarr;&nbsp;', '&nbsp;', $sub);
                                            $sub2 .= '&nbsp;&nbsp;&nbsp;&rarr;&nbsp;';
                                            list_categories($cat->id, $cats, $sub2, $product_categories);
                                        }
                                    endforeach;
                                }

                                $product_categories = $categories_l;
                                list_categories(0, $categories, '', $product_categories);
                                ?>
                            </table>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </fieldset>
    </div>
    <div class="tab-pane" id="slide_r">
        <fieldset>
            <legend><?php echo lang('common_slide_r'); ?></legend>
            <div class="row">
                <div id="category_l" class="span10">
                    <div class="span4">
                        <label><?php echo lang('slide_category_qty'); ?></label>
                        <?php echo form_input(array('name' => 'qty_r', 'class' => 'span4', 'value' => $qty_r)); ?>
                    </div>
                    <div class="span4">
                        <label><?php echo lang('slide_category_sort'); ?></label>
                        <?php echo form_dropdown('sort_r', array('desc' => lang('slide_category_desc'),
                                'asc' => lang('slide_category_asc'), 'RANDOM' => lang('slide_category_rand')),
                            set_value('sort_r', $sort_r), 'class="span4"');?>
                    </div>
                    <div class="span8">
                        <?php if (isset($categories[0])): ?>
                            <label id="label"><?php echo lang('slide_category_title'); ?></label>
                            <table id="table" class="table table-striped">
                                <thead>
                                <tr>
                                    <th colspan="2"><?php echo lang('slide_category_title'); ?></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <?php
                                function list_categories_r($parent_id, $cats, $sub = '', $product_categories)
                                {

                                    foreach ($cats[$parent_id] as $cat):?>
                                        <tr>
                                            <td><?php echo $sub . $cat->name; ?></td>
                                            <td>
                                                <input type="checkbox" name="categories_r[]"
                                                       value="<?php echo $cat->id; ?>" <?php echo (in_array($cat->id, $product_categories)) ? 'checked="checked"' : ''; ?>/>
                                            </td>
                                        </tr>
                                        <?php
                                        if (isset($cats[$cat->id]) && sizeof($cats[$cat->id]) > 0) {
                                            $sub2 = str_replace('&rarr;&nbsp;', '&nbsp;', $sub);
                                            $sub2 .= '&nbsp;&nbsp;&nbsp;&rarr;&nbsp;';
                                            list_categories_r($cat->id, $cats, $sub2, $product_categories);
                                        }
                                    endforeach;
                                }

                                $product_categories = $categories_r;
                                list_categories_r(0, $categories, '', $product_categories);
                                ?>
                            </table>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </fieldset>
    </div>
</div>
</form>
