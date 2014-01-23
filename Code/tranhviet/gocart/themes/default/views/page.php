<div class="contentRight">
    <div class="sanpham">
        <div class="bannerSanPham">
            <?php if(isset($page)):?> <span><?php echo $page->title; ?></span><?php endif;?>
        </div>
        <div class="row" style="margin: 5px">
            <div>
                <?php echo $page->content; ?>
            </div>
        </div>
    </div>
</div>