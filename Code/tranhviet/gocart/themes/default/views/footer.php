</div>
<div class="footer">
                <span class="copyRight">
                    Copyright © 2014 | Version 1.0 | <a href="<?php echo base_url(); ?>"><?php echo base_url(); ?></a>
                </span>
    <br />
                <span class="address">
                    <a href="<?php echo base_url(); ?>"><?php echo base_url(); ?></a> - <?php echo $this->settings['address1']; ?> - Email: <?php echo $this->settings['email']; ?>
                </span>
    <div class="footer_line"></div>

    <div class="footer_lienket">
        <ul>
            <<a href="<?php echo site_url(); ?>"><?php echo lang('homepage'); ?></a>
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

</div>



</div>
</div>
</body>
</html>
