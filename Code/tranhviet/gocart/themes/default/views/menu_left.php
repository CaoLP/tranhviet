<div class="verticalMenu">
    <ul>
        <?php
        $loadSubMenu = false;
        if (isset($override)):
            if ($override):
                $loadSubMenu = true; else:
                $loadSubMenu = false;
            endif; else:
            $loadSubMenu = false;
        endif;
        if (!$loadSubMenu):
            ?>
            <li>
                <a href="<?php echo site_url(); ?>"><?php echo lang('homepage'); ?></a>
            </li>
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
                            } ?>><?php echo $menu_page->menu_title; ?></a>
                        <?php else: ?>
                            <a href="<?php echo site_url($menu_page->slug); ?>"><?php echo $menu_page->menu_title; ?></a>
                        <?php endif; ?>
                    </li>

                <?php endforeach;
            }
            ?>
        <?php else: ?>
            <?php if (isset($sub_categories)): ?>
                <li><a href=""><?php echo $page_title; ?></a></li>
                <?php foreach ($sub_categories as $cat_menu): ?>
                    <li><a href="<?php echo site_url($cat_menu->slug); ?>"><?php echo $cat_menu->name; ?></a></li>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endif ?>
    </ul>
    <div class="bottomMenu">
        <div class="support">
            <img style="border: none;" src="<?php echo base_url(); ?>images/phoneimge.png"/>
            <ul>
                <li><h3>Mua hàng online giá rẻ hơn</h3></li>
                <li class="matranh">(từ 8.30 - 17.30 hàng ngày)</li>
                <li class="chitiet"><?php echo $this->settings['info_hotline']; ?></li>
            </ul>

        </div>
        <div class="congdong">
            <a href="<?php echo $this->settings['info_youtube']; ?>"><img style="border: none;"
                                                                          src="<?php echo base_url(); ?>images/01.gif"/></a>
            <a href="<?php echo $this->settings['info_facebook']; ?>"> <img style="border: none;"
                                                                            src="<?php echo base_url(); ?>images/02.gif"/></a>
            <a href="<?php echo $this->settings['info_google']; ?>"><img style="border: none;"
                                                                         src="<?php echo base_url(); ?>images/03.gif"/></a>
            <a href="<?php echo $this->settings['info_twitter']; ?>"><img class="noneMarginRight" style="border: none;"
                                                                          src="<?php echo base_url(); ?>images/04.gif"/></a>
        </div>
        <div class="lienhe">
            <ul>
                <li><span><img style="border: none;"
                               src="<?php echo base_url(); ?>images/iphone.png"/> <?php echo $this->settings['info_phone']; ?></span>
                </li>
                <li><span><img style="border: none;"
                               src="<?php echo base_url(); ?>images/fax.png"/> <?php echo $this->settings['info_fax']; ?></span>
                </li>
                <li><span><img style="border: none;"
                               src="<?php echo base_url(); ?>images/yahoo.png"/> <?php echo $this->settings['info_yahoo']; ?></span>
                </li>
                <li><span><img style="border: none;"
                               src="<?php echo base_url(); ?>images/email.png"/> <?php echo $this->settings['info_email']; ?></span>
                </li>
            </ul>
        </div>
        <div class="lienhe_skype">
            <img style="border: none;" src="<?php echo base_url(); ?>images/Skype_Logo.png"/>
            <br/>
            <span><?php echo $this->settings['info_skype']; ?></span>
        </div>
    </div>
</div>