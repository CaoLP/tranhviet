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
            <?php if (isset($this->categories[0])): ?>
                <?php foreach ($this->categories[0] as $cat_menu): ?>
                    <li><a href="<?php echo site_url($cat_menu->slug); ?>"><?php echo $cat_menu->name; ?></a></li>
                <?php endforeach; ?>
            <?php
            endif;
            ?>
        </ul>

    </div>


</div>

</div>



</div>
</div>
</body>
</html>
