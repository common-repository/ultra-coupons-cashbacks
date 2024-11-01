<?php
global $coupon_id;
$coupon_vote = get_option( 'upc_coupon-vote-system' );

//Coupon vote
if ( $coupon_vote == "on" ){
    $up_votes = array_filter( explode( ",", get_post_meta( $coupon_id, "_up", true ) ) );
    $down_votes = array_filter( explode( ",", get_post_meta( $coupon_id, "_down", true ) ) );
    $all_votes = array_merge( $up_votes,$down_votes );
    if( !empty( $all_votes ) )
        $percentage = ceil( count( $up_votes ) / count( $all_votes ) * 100 );
    else
        $percentage = 100;
    ?>
    <div class="upc-vote-wrapper">
        <a class="upc-vote-up" href="#" data-id = "<?php echo $coupon_id; ?>"><span class="upc-tooltip"><?php echo __( 'It works.', 'upc-coupon' ); ?></span><div class="upc-thumbs-up"><img class="upc-svg" 
		src="<?php echo UPC_Plugin::instance()->plugin_assets.'svg/thumbs-up.svg'; ?>"/></div></a>
    <span class="upc-vote-percent" data-id="<?php echo $coupon_id ?>"><?php echo $percentage; ?>% <?php echo __( 'Success', 'upc-coupon' ); ?></span>
    <a class="upc-vote-down" href="#" data-id = "<?php echo $coupon_id; ?>">
        <span class="upc-tooltip"><?php echo __( 'It doesn\'t!', 'upc-coupon'); ?></span>
        <div class="upc-thumbs-down">
            <img class="upc-svg" src="<?php echo UPC_Plugin::instance()->plugin_assets.'svg/thumbs-down.svg'; ?>"/>
        </div>
    </a>
    </div>
<?php
}
?>