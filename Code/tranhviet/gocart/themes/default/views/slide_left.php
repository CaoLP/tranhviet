<div class="adLeft">
    <div id="vertical-1" class="carousel-demo-vertical">
        <ul>
            <?php
                if (isset($this->slide['slide_l'])):
                    foreach ($this->slide['slide_l'] as $item):
                        $photo = theme_url('assets/img/no_picture.png');
                        $item->images = json_decode($item->images, true);
                        $item->img = array();
                        if (!empty($item->images)) {
                            foreach ($item->images as $im) {
                                $item->img[] = $im;
                            }
                        }
                        if (!empty($item->img[0])) {
                            $primary = $item->img[0]['filename'];
                            foreach ($item->img as $photo) {
                                if (isset($photo['primary'])) {
                                    $primary = $photo;
                                }
                            }
                            $photo = base_url('uploads/images/thumbnails/' . $primary['filename']);
                        }
                        ?>
                        <li>
                            <a href="<?php echo base_url() . $item->slug ?>">
                                <img src="<?php echo $photo; ?>"
                                     alt="<?php echo $item->name; ?>">
                            </a>
                        </li>
                    <?php
                    endforeach;
                endif;
            ?>
        </ul>
    </div>

    <div class="quangcao">
        <div class="textHeader">
            <p><?php echo lang('ad'); ?></p>
        </div>
        <?php
            if (isset($this->ads['left']))
                foreach ($this->ads['left'] as $item): ?>
                    <div class="imageQuangCao">
                        <a href="<?php echo $item->link; ?>"><img src="<?php echo $item->img; ?>"
                                                                  alt="<?php echo $item->name; ?>"/></a>
                    </div>
                <?php endforeach; ?>
    </div>
</div>
