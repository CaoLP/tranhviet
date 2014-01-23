<script type="text/javascript">
    $(document).ready(function () {
        $('#cate').change(function () {
            if ($('#cate').val() != 0) {
                $('#title').attr("readonly", true);
                $('#title').val('***');
                $('#en_title').attr("readonly", true);
                $('#en_title').val('***');
                $('#url').attr("readonly", true);
                $('#url').val('***');
            } else {
                $('#title').attr("readonly", false);
                $('#title').val('');
                $('#en_title').attr("readonly", false);
                $('#en_title').val('');
                $('#url').attr("readonly", false);
                $('#url').val('');
            }
        });
    });
</script>
<?php echo form_open($this->config->item('admin_folder') . '/pages/link_form/' . $id); ?>

<label><?php echo lang('cate_title'); ?></label>
<?php
$data[0] = lang('select_one');
foreach ($categories as $cate) {
    $data[$cate->id] = $cate->name;
}
?>

<?php echo form_dropdown('cate', $data, set_value('categories', array($category_id)), 'class="span3" id="cate"'); ?>

<label for="menu_title"><?php echo lang('title'); ?> </label>
<?php
$data = array('id' => 'title', 'name' => 'title', 'value' => set_value('title', $title), 'class' => 'span3', 'readonly' => $category_id != '0' ? 'readonly' : '');
echo form_input($data);
?>
<label for="en_menu_title"><?php echo lang('en_title'); ?> </label>
<?php
$data = array('id' => 'en_title', 'name' => 'en_title', 'value' => set_value('en_title', $en_title), 'class' => 'span3', 'readonly' => $category_id != '0' ? 'readonly' : '');
echo form_input($data);
?>
<label for="url"><?php echo lang('url'); ?></label>
<?php
$data = array('id' => 'url', 'name' => 'url', 'value' => set_value('url', $url), 'class' => 'span3', 'readonly' => $category_id != '0' ? 'readonly' : '');
echo form_input($data);
?>
<span class="help-inline"><?php echo lang('url_example'); ?></span>

<label for="sequence"><?php echo lang('parent_id'); ?></label>
<?php
$options = array();
$options[0] = lang('top_level');
function page_loop($pages, $dash = '', $id = 0)
{
    $options = array();
    foreach ($pages as $page) {
        //this is to stop the whole tree of a particular link from showing up while editing it
        if ($id != $page->id) {
            $options[$page->id] = $dash . ' ' . $page->title;
            $options = $options + page_loop($page->children, $dash . '-', $id);
        }
    }
    return $options;
}

$options = $options + page_loop($pages, '', $id);
echo form_dropdown('parent_id', $options, set_value('parent_id', $parent_id, 'class="span3"'));
?>

<label for="sequence"><?php echo lang('sequence'); ?></label>
<?php
$data = array('id' => 'sequence', 'name' => 'sequence', 'value' => set_value('sequence', $sequence), 'class' => 'span3');
echo form_input($data);
?>

<label class="checkbox">
    <?php
    $data = array('name' => 'new_window', 'value' => '1', 'checked' => (bool)$new_window);
    echo form_checkbox($data);
    ?>
    <?php echo lang('open_in_new_window'); ?></label>

<div class="form-actions">
    <input class="btn btn-primary" type="submit" value="<?php echo lang('save'); ?>"/>
</div>
</form>