<div class="adRight">
    <div id="vertical-2" class="carousel-demo-vertical">
        <ul>
            <?php
            if (isset($this->slide['slide_r'])):
                foreach ($this->slide['slide_r'] as $item):
                    $photo = theme_url('assets/img/no_picture.png');
                    $item->images = json_decode($item->images, true);
                    $item->img = array();
                    foreach ($item->images as $im) {
                        $item->img[] = $im;
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
                            <img src="<?php echo $photo; ?>" style="width: 130px;"
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
            <p>Video Clip</p>
        </div>
        <div class="videoQuangCao">
            <iframe width="140px" height="130px" frameBorder="0"
                    src="http://www.youtube.com/embed/XGSy3_Czz8k"></iframe>
        </div>

    </div>
    <div class="quangcao">
        <div class="textHeader">
            <p><?php echo lang('ad'); ?></p>
        </div>
        <?php
        if (isset($this->ads['right']))
            foreach ($this->ads['right'] as $item): ?>
                <div class="imageQuangCao">
                    <a href="<?php echo $item->link; ?>"><img src="<?php echo $item->img; ?>"
                                                              alt="<?php echo $item->name; ?>"/></a>
                </div>
            <?php endforeach; ?>
    </div>
</div>


