<?php echo form_open($this->config->item('admin_folder') . '/ads'); ?>
<div class="form-actions">
    <button type="submit" class="btn btn-primary" name="submit"><?php echo lang('save'); ?></button>
</div>
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
                        </div>
                        <div id="ads_l">
                            <?php for ($i = 0; $i < 5; $i++):
                                ?>
                                <div
                                    style="background-color: #fff;border: 1px solid #ddd;padding: 1px 45px 5px;;margin-top: 10px;;border-radius: 20px"
                                    id="ads_l_1"
                                    >
                                    <div class="row">
                                        <div class="span4">
                                            <legend><?php echo lang('common_ads'); ?></legend>
                                            <div class="row">
                                                <div class="span4"><label>Title</label>
                                                    <input name="name_l_<?php echo $i; ?>" type="text" class="span4"
                                                           value="<?php echo isset($left[$i]) ? $left[$i]->name : '' ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="span4"><label>Link</label>
                                                    <input name="link_l_<?php echo $i; ?>" type="text" class="span4"
                                                           value="<?php echo isset($left[$i]) ? $left[$i]->link : '' ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="span4"><label>Image</label>
                                                    <input name="img_l_<?php echo $i; ?>" type="text" class="span4"
                                                           value="<?php echo isset($left[$i]) ? $left[$i]->img : '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="span5">
                        <div class="row">
                            <legend>QC phải</legend>
                        </div>

                        <div id="ads_r">
                            <?php for ($i = 0; $i < 5; $i++): ?>
                                <div
                                    style="background-color: #fff;border: 1px solid #ddd;padding: 1px 45px 5px;;margin-top: 10px;;border-radius: 20px"
                                    id="ads_l_1"
                                    >
                                    <div class="row">
                                        <div class="span4">
                                            <legend><?php echo lang('common_ads'); ?></legend>
                                            <div class="row">
                                                <div class="span4"><label>Title</label>
                                                    <input name="name_r_<?php echo $i; ?>" type="text" class="span4"
                                                           value="<?php echo isset($right[$i]) ? $right[$i]->name : '' ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="span4"><label>Link</label>
                                                    <input name="link_r_<?php echo $i; ?>" type="text" class="span4"
                                                           value="<?php echo isset($right[$i]) ? $right[$i]->link : '' ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="span4"><label>Image</label>
                                                    <input name="img_r_<?php echo $i; ?>" type="text" class="span4"
                                                           value="<?php echo isset($right[$i]) ? $right[$i]->img : '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>

                </div>
            </div>
        </fieldset>
    </div>
</div>
</form>
