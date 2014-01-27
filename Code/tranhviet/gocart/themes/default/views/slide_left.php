<div class="adLeft">
    <div class="slider">
        <ul id="scroller">
            <?php
            if (isset($this->slide['slide_l'])):
                foreach ($this->slide['slide_l'] as $item):
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
            <p>Liên kết QC</p>
        </div>
        <div class="imageQuangCao">
            <a href="#"><img src="<?php echo base_url(); ?>images/quangcao/trungdesgallery_Web_New_03.gif"/></a>
        </div>
        <div class="imageQuangCao">
            <a href="#"><img src="<?php echo base_url(); ?>images/quangcao/trungdesgallery_Web_New_06.gif"/></a>
        </div>
        <div class="imageQuangCao">
            <a href="#"><img src="<?php echo base_url(); ?>images/quangcao/trungdesgallery_Web_New_08.gif"/></a>
        </div>
        <div class="imageQuangCao">
            <a href="#"><img src="<?php echo base_url(); ?>images/quangcao/trungdesgallery_Web_New_10.gif"/></a>
        </div>
        <div class="imageQuangCao">
            <a href="#"><img src="<?php echo base_url(); ?>images/quangcao/trungdesgallery_Web_New_16.gif"/></a>
        </div>
    </div>
</div>
