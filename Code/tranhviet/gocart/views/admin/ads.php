<?php echo form_open($this->config->item('admin_folder') . '/ads'); ?>
<div class="form-actions">
    <button type="submit" class="btn btn-primary"><?php echo lang('save'); ?></button>
</div>
<script>
    fields = 0;
    function addInput() {
        if (fields != 3) {
            document.getElementById('ads_l').innerHTML += "<input type='text' name='clients_form[clients_name]' size='32' maxlength='32' value='' id='clients_form_clients_name_" + fields + "' />" +
                '<select id="client_category_name_' + fields + '" name="client_category[]"><option value="">Select Category</option><option value="1">internal</option><option value="2">external</option><option value="3">others</option></select>';
            fields = fields + 1;
        } else {
            document.getElementById('ads_l').innerHTML += "<br />More then 3 not allowed.";
            document.form.add.disabled = true;
        }
    }
</script>
<div class="tabbable">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#ads" data-toggle="tab"><?php echo lang('common_ads'); ?></a></li>
    </ul>
</div>
<div class="tab-content">
    <div class="tab-pane active" id="ads">
        <fieldset>
            <div class="row">
                <div class="span12">
                    <div class="span5">
                        <div class="row">
                            <legend>QC trái</legend>
                            <input id="add_l" class="btn pull-right" type="button" value="+"
                                   style="margin:0px;" onclick="addInput();"/>
                        </div>
                        <div id="ads_l">
                            <div
                                style="background-color: #fff;border: 1px solid #ddd;padding: 1px 45px 5px;;margin-top: 10px;;border-radius: 20px">
                                <div class="row">
                                    <div class="span4">
                                        <legend>QC_1</legend>
                                        <div class="row">

                                            <div class="pull-right"><a onclick="return remove_image($(this));"
                                                                       rel="cbf19f948dcb8517cee5baccfc538b12"
                                                                       class="btn btn-danger"
                                                                       style="float:right; font-size:9px;"><i
                                                        class="icon-trash icon-white"></i> Gở bỏ</a></div>
                                        </div>
                                        <div class="row">
                                            <div class="span4"><label>Title</label>
                                                <input name="" type="text" class="span4"></div>
                                        </div>
                                        <div class="row">
                                            <div class="span4"><label>Link</label>
                                                <input name="" type="text" class="span4"></div>
                                        </div>
                                        <div class="row">
                                            <div class="span4"><label>Image</label>
                                                <input name="" type="text" class="span4"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="span5">
                        <div class="row">
                            <legend>QC phải</legend>
                            <input id="add_r" class="btn pull-right" type="button" value="+"
                                   style="margin:0px;" onclick="addInput();"/>
                        </div>

                        <div id="ads_r">
                            <div
                                style="background-color: #fff;border: 1px solid #ddd;padding: 1px 45px 5px;;margin-top: 10px;;border-radius: 20px">
                                <div class="row">
                                    <div class="span4">
                                        <legend>QC_1</legend>
                                        <div class="row">

                                            <div class="pull-right"><a onclick="return remove_image($(this));"
                                                                       rel="cbf19f948dcb8517cee5baccfc538b12"
                                                                       class="btn btn-danger"
                                                                       style="float:right; font-size:9px;"><i
                                                        class="icon-trash icon-white"></i> Gở bỏ</a></div>
                                        </div>
                                        <div class="row">
                                            <div class="span4"><label>Title</label>
                                                <input name="" type="text" class="span4"></div>
                                        </div>
                                        <div class="row">
                                            <div class="span4"><label>Link</label>
                                                <input name="" type="text" class="span4"></div>
                                        </div>
                                        <div class="row">
                                            <div class="span4"><label>Image</label>
                                                <input name="" type="text" class="span4"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </fieldset>
    </div>
</div>
</form>
