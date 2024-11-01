<div class="upc-share-buttons-container">
    <div class="col-md-12 row">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" target="_blank" class
		"upc-btn-social upc-btn-xs upc-btn-facebook"><i class="upc-facebook-f"><img class="upc-svg" src="<?php echo UPC_Plugin::instance()->plugin_assets.'svg/facebook-f.svg'; ?>"/></i></a>
        <a href="https://plus.google.com/share?url=<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" target="_blank" class="upc-btn-social upc-btn-xs upc-btn-google-plus"><i class="upc-google-plus-g"><img class="upc-svg" src="<?php echo UPC_Plugin::instance()->plugin_assets.'svg/google-plus-g.svg'; ?>"/></i></a>
        <a href="http://twitter.com/share?text=<?php echo the_title(); ?> Coupon&url=<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" target="_blank" class="upc-btn-social upc-btn-xs upc-btn-twitter">
		<i class="upc-twitter">
		<img class="upc-svg" src="<?php echo UPC_Plugin::instance()->plugin_assets.'svg/twitter.svg'; ?>"/></i></a>
    </div>
</div>