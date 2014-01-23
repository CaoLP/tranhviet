<fieldset>
    <legend><?php echo lang('common_slide_l'); ?></legend>
    <div class="row">
        <div id="category_l" class="span10">
            <div class="span3">
                <?php if (isset($categories[0])): ?>
                    <label><?php echo lang('slide_category_title'); ?></label>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th colspan="2"><?php echo lang('name') ?></th>
                        </tr>
                        </thead>
                        <?php
                        function list_categories($parent_id, $cats, $sub = '', $product_categories)
                        {

                            foreach ($cats[$parent_id] as $cat):?>
                                <tr>
                                    <td><?php echo $sub . $cat->name; ?></td>
                                    <td>
                                        <input type="checkbox" name="categories[]"
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
                        $product_categories = array();
                        list_categories(0, $categories, '', $product_categories);
                        ?>
                    </table>
                <?php endif; ?>
            </div>
            <div class="span3">
                <label><?php echo lang('slide_category_qty'); ?></label>
                <?php echo form_input(array('name' => 'qty', 'class' => '3', 'value' => '0')); ?>
            </div>
            <div class="span3">
                <label><?php echo lang('slide_category_sort'); ?></label>
                <?php echo form_dropdown('theme', array('desc' => lang('slide_category_desc'),
                        'asc' => lang('slide_category_asc'), 'rand' => lang('slide_category_rand')),
                    set_value('theme', array('rand')), 'class="span3"');?>
            </div>
        </div>
    </div>
</fieldset>
