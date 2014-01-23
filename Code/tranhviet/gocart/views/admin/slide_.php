<script type="text/javascript">
    $(document).ready(function () {
        $('#gc_check_all1').click(function () {
            if (this.checked) {
                $('.gc_check1').prop('checked',true);
            }
            else {
                $(".gc_check1").prop('checked',false);
            }
        });
        $('#gc_check_all2').click(function () {
            if (this.checked) {
                $('.gc_check2').prop('checked',true);
            }
            else {
                $(".gc_check2").prop('checked',false);
            }
        });
        $('input:radio[name="l_type"]').change(
            function () {
                if ($(this).val() == 0) {
                    $("#category_l").removeClass("hide");
                    $("#product_l").addClass("hide");
                }
                if ($(this).val() == 1) {
                    $("#category_l").addClass("hide");
                    $("#product_l").addClass("hide");
                }
                if ($(this).val() == 2) {
                    $("#product_l").removeClass("hide");
                    $("#category_l").addClass("hide");
                }
            });
        $('#cate_2').change(
            function () {
               // $('#product_items').html('');
                run_product_query();
            });
    });
    function run_product_query() {
        $.post("<?php echo site_url($this->config->item('admin_folder').'/slide/load_product/');?>", { cate_id: $('#cate_2').val(), limit: 10},
            function (data) {
               // $('#product_items').html('');
                $.each(data, function (index, value) {
                    $('#product_items').append('<tr id="' + index + '">' +
                        '<td><input name="products[]" type="checkbox" value="' + index + '" class="gc_check1"/></td>' +
                        '<td>' + value + '</td>' +
                        '<td> <button type="button" class="btn btn-mini pull-right" onclick="add_slide('+index+');"><i class="icon-plus"></i></button></td>' +
                        '</tr>');
                    install_drag_drop();
                });
            }, 'json');
    }
    function add_slide(index){

    }
    function install_drag_drop() {
        var tb1 = $("#product_items tr");
        var tb2 = $("#slide_list");
        tb1.draggable({
            appendTo: "body",
            helper: "clone",
            opacity: "0.35",
            revert: "invalid"
        });
        tb2.droppable({
            accept: 'tr',
            tolerance: "pointer",
            drop: function (event, ui) {
                var drop_id = $(ui.draggable).find('tr[id]').val();
                var name = $(ui.draggable).find('td:eq(1)').text();
                alert(drop_id);
                $(ui.draggable).appendTo(this);
            }
        });
    }
</script>
<!--(function ($) {-->
<!--$(document).ready(function () {-->
<!--var tb1 = $("#product_items tr");-->
<!--var tb2 = $("#slide_list");-->
<!--tb1.draggable({-->
<!--appendTo: "body",-->
<!--helper: "clone",-->
<!--opacity: "0.35",-->
<!--revert: "invalid",-->
<!--drag: function(event,ui){-->
<!--var drop_id = $(this).attr('id');-->
<!--if(check_id(drop_id)){-->
<!--tb2.draggable( "option", "disabled", false );-->
<!--}else{-->
<!--tb2.draggable( "option", "disabled", false );-->
<!--}-->
<!--}-->
<!--});-->
<!--tb2.droppable({-->
<!--accept: 'tr',-->
<!--tolerance: "pointer",-->
<!--drop: function (event, ui) {-->
<!--var drop_id = $(ui.draggable).attr('id');-->
<!--if(check_id(drop_id)){-->
<!--var name = $(ui.draggable).find('td:eq(1)').text();-->
<!--var row = '<tr id="'+drop_id+'"><td>'+name+'</td><tr>';-->
<!--    tb2.append(row);-->
<!--    }-->
<!--    }-->
<!--    });-->
<!--    });-->
<!--    })(jQuery);-->
<!---->
<!--    function check_id(id){-->
<!--    var result = true;-->
<!--    var IDs = $("#slide_items tr[id]")-->
<!--    .map(function() { return this.id; })-->
<!--    .get();-->
<!--    IDs.forEach(function(entry) {-->
<!--    if(id==entry) { result = false;die;}-->
<!--    });-->
<!--    return result;-->
<!--    }-->
<!--http://www.jeasyui.com/tutorial/dd/dnd2.php-->

<fieldset>
    <legend><?php echo lang('common_slide_l'); ?></legend>
    <div class="row">
        <div class="span3">
            <label class="radio"><?php echo lang('slide_category'); ?>
                <?php echo form_radio('l_type', '0', false); ?></label>
        </div>
        <div class="span3">
            <label class="radio"><?php echo lang('slide_random'); ?>
                <?php echo form_radio('l_type', '1', false); ?></label>
        </div>
        <div class="span3">
            <label class="radio"><?php echo lang('slide_custom'); ?>
                <?php echo form_radio('l_type', '2', false); ?></label>
        </div>
    </div>
    <div class="row">
        <div id="category_l" class="span10">
            <div class="span3">
                <label><?php echo lang('slide_category_title'); ?></label>
                <?php
                $data[0] = lang('slide_select_one');
                foreach ($categories as $cate) {
                    $data[$cate->id] = $cate->name;
                }
                ?>
                <?php echo form_dropdown('cate_1', $data, set_value('categories', array()), 'class="span3"'); ?>
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
        <div id="product_l" class="span10 hide">
            <div class="row span8">
                <label><?php echo lang('slide_category_title'); ?></label>
                <?php echo form_dropdown('cate_2', $data, set_value('categories', array()), 'id = "cate_2" class="span4"'); ?>
            </div>
            <div class="row span10">
                <div class="span4">
                    <table class="table" id="product_list">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="gc_check_all1"/></th>
                            <th><?php echo lang('slide_product_name'); ?> </th>
                            <th>
                                <button type="button" class="btn btn-mini pull-right" onclick=""><i
                                        class="icon-plus"></i></button>
                            </th>
                        </tr>
                        </thead>
                        <tbody id="product_items">
                        </tbody>
                    </table>
                </div>
                <div class="span4">

                    <table class="table" id="slide_list">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="gc_check_all2"/></th>
                            <th><?php echo lang('slide_product_name'); ?></th>
                            <th>
                                <button type="button" class="btn btn-mini btn-danger pull-right" onclick=""><i
                                        class="icon-trash icon-white"></i></button>
                            </th>
                        </tr>
                        </thead>
                        <tbody id="slide_items">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</fieldset>
<fieldset>
    <legend><?php echo lang('common_slide_r'); ?></legend>
    <div class="row">
        <div class="span3">
            <label class="radio"><?php echo lang('slide_category'); ?>
                <?php echo form_radio('r_type', '0', false); ?></label>
        </div>
        <div class="span3">
            <label class="radio"><?php echo lang('slide_random'); ?>
                <?php echo form_radio('r_type', '1', false); ?></label>
        </div>
        <div class="span3">
            <label class="radio"><?php echo lang('slide_custom'); ?>
                <?php echo form_radio('r_type', '2', false); ?></label>
        </div>
    </div>
    <div class="row"></div>
</fieldset>
