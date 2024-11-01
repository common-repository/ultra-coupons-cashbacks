<?php

/**
 * Welcome Page View
 *
 * @since 1.0
 * @package WPCD
 */

// If accessed directly, exit
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />

<div id="upc-welcome" class="lite">

<div class="upc-welcome-container">

    <div class="upc-intro">

        <div class="upc-icon">
            <img src="<?php echo UPC_Plugin::instance()->plugin_assets; ?>img/icon-128x128.png" alt="<?php esc_attr_e( 'Ultra Promocode', 'upc-coupon' ); ?>">
        </div>

        <div class="upc-block">
            <h1><?php esc_html_e( 'Welcome to Ultra Promocode', 'upc-coupon' ); ?></h1>
            <h6><?php esc_html_e( 'Thank you for choosing Ultra Promocode - the best Coupon Plugin for WordPress Websites.', 'upc-coupon' ); ?></h6>
            <br/>
            <h6><?php esc_html_e( 'Check out the video below that shows how you can create your first coupon and insert the coupon in a post or page.', 'upc-coupon' ); ?></h6>
        </div>

        <div class="upc-feature-video">
            <div>
                <iframe width="716" height="415" src="https://www.youtube-nocookie.com/embed/ZeeMcHQMdx8?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
        </div>

        <div class="upc-block">

            <h6><?php esc_html_e( 'Ultra Promocode makes it insanely easy to create coupons and present them the right way in your posts/pages.', 'upc-coupon' ); ?></h6>

            <div class="upc-button-wrap upc-clear">
                <div class="upc-left">
                    <a href="<?php echo admin_url( 'post-new.php?post_type=upc_coupons' ); ?>" class="upc-btn upc-btn-block upc-btn-lg upc-btn-green">
                        <?php esc_html_e( 'Create Your First Coupon', 'upc-coupon' ); ?>
                    </a>
                </div>
                <div class="upc-right">
                    <a href="https://ultrapromocode.com/knowledgebase//?utm_source=WordPress&amp;utm_medium=link&amp;utm_campaign=dashboard"
                        class="upc-btn upc-btn-block upc-btn-lg upc-btn-grey" target="_blank" rel="noopener noreferrer">
                        <?php esc_html_e( 'Read the Documentation', 'upc-coupon' ); ?>
                    </a>
                </div>
            </div>

        </div>

    </div><!-- /.

upc-intro -->

    <div class="upc-features">

        <div class="upc-block">

            <h1><?php esc_html_e( 'Ultra Promocode Features', 'upc-coupon' ); ?></h1>
            <h6><?php esc_html_e( 'Ultra Promocode comes with features that are designed to protect your affiliate sales and boost your revenue.', 'upc-coupon' ); ?></h6>

            <div class="upc-feature-list upc-clear">

                <div class="upc-feature-block upc-first">
                    <img src="<?php echo UPC_Plugin::instance()->plugin_assets; ?>img/lightweight.png">
                    <h5><?php esc_html_e( 'Click to Copy', 'upc-coupon' ); ?></h5>
                    <p><?php esc_html_e( 'Users can copy the coupon code with just one click. How cool is that?', 'upc-coupon' ); ?></p>
                </div>

                <div class="upc-feature-block upc-last">
                    <img src="<?php echo UPC_Plugin::instance()->plugin_assets; ?>img/responsive.png">
                    <h5><?php esc_html_e( 'Responsive', 'upc-coupon' ); ?></h5>
                    <p><?php esc_html_e( 'Coupon templates are designed to work on all screen sizes.', 'upc-coupon' ); ?></p>
                </div>

                <div class="upc-feature-block upc-first">
                    <img src="<?php echo UPC_Plugin::instance()->plugin_assets; ?>img/image.png">
                    <h5><?php esc_html_e( 'Image Coupons', 'upc-coupon' ); ?></h5>
                    <p><?php esc_html_e( 'Add printable image coupons that can be printed and used offline.', 'upc-coupon' ); ?></p>
                </div>

                <div class="upc-feature-block upc-last">
                    <img src="<?php echo UPC_Plugin::instance()->plugin_assets; ?>img/preview.png">
                    <h5><?php esc_html_e( 'Live Preview', 'upc-coupon' ); ?></h5>
                    <p><?php esc_html_e( 'Watch the coupon as you create it, so you know what you are doing.', 'upc-coupon' ); ?></p>
                </div>

                <div class="upc-feature-block upc-first">
                    <img src="<?php echo UPC_Plugin::instance()->plugin_assets; ?>img/expire.png">
                    <h5><?php esc_html_e( 'Expiration Dates', 'upc-coupon' ); ?></h5>
                    <p><?php esc_html_e( 'Let your users know which coupons are expired and which are available.', 'upc-coupon' ); ?></p>
                </div>

                <div class="upc-feature-block upc-last">
                    <img src="<?php echo UPC_Plugin::instance()->plugin_assets; ?>img/hide.png">
                    <h5><?php esc_html_e( 'Hide Expired Coupon', 'upc-coupon' ); ?></h5>
                    <p><?php esc_html_e( 'Don\'t want to update expired coupons? No problem, just hide \'em.', 'upc-coupon' ); ?></p>
                </div>
                
                <div class="upc-feature-block upc-first">
                    <img src="<?php echo UPC_Plugin::instance()->plugin_assets; ?>img/social.png">
                    <h5><?php esc_html_e( 'Social Share', 'upc-coupon' ); ?></h5>
                    <p><?php esc_html_e( 'Add social share buttons in your coupons, let users spread the love.', 'upc-coupon' ); ?></p>
                </div>

                <div class="upc-feature-block upc-last">
                    <img src="<?php echo UPC_Plugin::instance()->plugin_assets; ?>img/settings.png">
                    <h5><?php esc_html_e( 'Voting System', 'upc-coupon' ); ?></h5>
                    <p><?php esc_html_e( 'Let your users vote whether a coupon worked for them or not.', 'upc-coupon' ); ?></p>
                </div>

                <div class="upc-feature-block upc-first">
                    <img src="<?php echo UPC_Plugin::instance()->plugin_assets; ?>img/widget.png">
                    <h5><?php esc_html_e( 'Widgets', 'upc-coupon' ); ?></h5>
                    <p><?php esc_html_e( 'So you can add your coupons in any widget areas on your site.', 'upc-coupon' ); ?></p>
                </div>

                <div class="upc-feature-block upc-last">
                    <img src="<?php echo UPC_Plugin::instance()->plugin_assets; ?>img/inserter.png">
                    <h5><?php esc_html_e( 'Shortcode Inserter', 'upc-coupon' ); ?></h5>
                    <p><?php esc_html_e( 'Instead of copy-paste, insert coupons straight from your editor.', 'upc-coupon' ); ?></p>
                </div>

            </div>

            <div class="upc-button-wrap">
                <a href="https://ultrapromocode.com/?utm_source=WordPress&amp;utm_medium=link&amp;utm_campaign=profeatures"
                    class="upc-btn upc-btn-lg upc-btn-grey" rel="noopener noreferrer" target="_blank">
                    <?php esc_html_e( 'Check Out More', 'upc-coupon' ); ?>
                </a>
            </div>

        </div>

    </div><!-- /.features -->

    <div class="upc-upgrade-cta upgrade">

        <div class="upc-block upc-clear">

            <div class="upc-upgrade-cta-left">
                <h2><?php esc_html_e( 'Upgrade to PRO', 'upc-coupon' ); ?></h2>
                <ul>
                    <li><span class="dashicons dashicons-yes"></span> <?php esc_html_e( '7 Coupon Templates', 'upc-coupon' ); ?></li>
                    <li><span class="dashicons dashicons-yes"></span> <?php esc_html_e( 'Hide Coupon Code', 'upc-coupon' ); ?></li>
                    <li><span class="dashicons dashicons-yes"></span> <?php esc_html_e( 'Expiration Counter', 'upc-coupon' ); ?></li>
                    <li><span class="dashicons dashicons-yes"></span> <?php esc_html_e( 'Import from CSV', 'upc-coupon' ); ?></li>
                    <li><span class="dashicons dashicons-yes"></span> <?php esc_html_e( 'Category Shortcode', 'upc-coupon' ); ?></li>
                    <li><span class="dashicons dashicons-yes"></span> <?php esc_html_e( 'Archive Shortcode', 'upc-coupon' ); ?></li>
                    <li><span class="dashicons dashicons-yes"></span> <?php esc_html_e( 'Extensive Settings', 'upc-coupon' ); ?></li>
                    <li><span class="dashicons dashicons-yes"></span> <?php esc_html_e( 'Lifetime Usage', 'upc-coupon' ); ?></li>
                    <li><span class="dashicons dashicons-yes"></span> <?php esc_html_e( '1 Year Update', 'upc-coupon' ); ?></li>
                    <li><span class="dashicons dashicons-yes"></span> <?php esc_html_e( '1 Year Priority Support', 'upc-coupon' ); ?></li>
                </ul>
            </div>

            <div class="upc-upgrade-cta-right">
                <h2><span><?php esc_html_e( 'PRO', 'upc-coupon' ); ?></span></h2>
                <div class="upc-price">
                    <span class="upc-amount">29.99</span><br>
                    <span class="upc-term"><?php esc_html_e( 'per year', 'upc-coupon' ); ?></span>
                </div>
                <a href="<?php echo admin_url( 'edit.php?post_type=upc_coupons&page=ultra-promocode-pricing' ); ?>"
                    class="upc-btn upc-btn-block upc-btn-lg upc-btn-green upc-upgrade-modal">
                    <?php esc_html_e( 'Upgrade Now!', 'upc-coupon' ); ?>
                </a>
            </div>

        </div>

    </div>

    <div class="upc-testimonials upgrade">

        <div class="upc-block">

            <h1><?php esc_html_e( 'Testimonials', 'upc-coupon' ); ?></h1>

            <div class="upc-testimonial-block upc-clear">
                <img src="<?php echo UPC_Plugin::instance()->plugin_assets; ?>img/testimonial1.png">
            </div>

            <div class="upc-testimonial-block upc-clear">
                <img src="<?php echo UPC_Plugin::instance()->plugin_assets; ?>img/testimonial3.png">
            </div>

            <div class="upc-testimonial-block upc-clear">
                <img src="<?php echo UPC_Plugin::instance()->plugin_assets; ?>img/testimonial2.png">
            </div>

            <div class="upc-button-wrap">
                <a href="https://wordpress.org/support/plugin/ultra-promocode/reviews/"
                    class="upc-btn upc-btn-lg upc-btn-grey" rel="noopener noreferrer" target="_blank">
                    <?php esc_html_e( 'Read More Reviews on WP.org', 'upc-coupon' ); ?>
                </a>
            </div>

        </div>

    </div><!-- /.testimonials -->

    <div class="upc-footer">

        <div class="upc-block upc-clear">

            <div class="upc-button-wrap upc-clear">
                <div class="upc-left">
                    <a href="<?php echo admin_url( 'post-new.php?post_type=upc_coupons' ); ?>"
                        class="upc-btn upc-btn-block upc-btn-lg upc-btn-green">
                        <?php esc_html_e( 'Create Your First Coupon', 'upc-coupon' ); ?>
                    </a>
                </div>
                <div class="upc-right">
                    <a href="<?php echo admin_url( 'edit.php?post_type=upc_coupons&page=ultra-promocode-pricing' ); ?>"
                        class="upc-btn upc-btn-block upc-btn-lg upc-btn-trans-green upc-upgrade-modal">
                        <span class="underline">
                            <?php esc_html_e( 'Ultra Promocode Pro', 'upc-coupon' ); ?> <span class="dashicons dashicons-arrow-right"></span>
                        </span>
                    </a>
                </div>
            </div>

        </div>

    </div><!-- /.footer -->

</div><!-- /.container -->

</div><!-- /#

upc-welcome -->