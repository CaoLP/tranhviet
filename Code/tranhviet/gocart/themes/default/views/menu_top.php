<div class="bodyCenter" xmlns="http://www.w3.org/1999/html">
    <div class="index">
        <div class="headerImage">
            <div class="imagebanner">
                <a href="<?php echo base_url(); ?>"><img
                        src="<?php echo base_url(); ?>images/trungdesgallery_Web_New_02.gif"/></a>

                <div class="searchBox">
                    <?php echo form_open('cart/search'); ?>
                    <input type="text" placeholder="<?php echo lang('search'); ?>" name="term" class="gn-search"><input
                        type="submit" class="search-icon" style="width: 26px;"></a>
                    </form>
                </div>
            </div>
        </div>
        <div class="menuTop">
            <div class="lauguageImage">
                <a href="<?php echo base_url(); ?>cart/lang">
                    <img src="<?php echo base_url(); ?>images/en48.png"/>
                    <img src="<?php echo base_url(); ?>images/vi48.png"/></a>
            </div>
            <div class="horizontalMenu">
                <ul>
                    <a href="<?php echo site_url(); ?>"><?php echo lang('homepage'); ?></a>
                    <?php
                    if (isset($this->pages[0])) {
                        foreach ($this->pages[0] as $menu_page):?>
                            <li>
                                <?php if (empty($menu_page->content)): ?>
                                    <a href="<?php
                                    if ($menu_page->category_id != '0')
                                        echo base_url() . $menu_page->url;
                                    else
                                        echo $menu_page->url;
                                    ?>" <?php if ($menu_page->new_window == 1) {
                                        echo 'target="_blank"';
                                    } ?>>
                                        <?php  echo $this->lang_key == 'vietnam'
                                            ? $menu_page->menu_title
                                            : empty($menu_page->en_menu_title)
                                                ? $menu_page->menu_title
                                                : $menu_page->en_menu_title; ?>
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo site_url($menu_page->slug); ?>">
                                        <?php  echo $this->lang_key == 'vietnam'
                                            ? $menu_page->menu_title
                                            : empty($menu_page->en_menu_title)
                                                ? $menu_page->menu_title
                                                : $menu_page->en_menu_title; ?>
                                    </a>
                                <?php endif; ?>
                            </li>

                        <?php endforeach;
                    }
                    ?>
                </ul>
            </div>
        </div>
