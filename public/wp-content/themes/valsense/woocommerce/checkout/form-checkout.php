<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

// do_action( 'woocommerce_before_checkout_form', $checkout );


?>

<form id="hs_checkout" name="checkout" method="post" class="checkout woocommerce-checkout d-none" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

    <div class="row justify-content-center py-3 mt-5">
        <div class="col12 col-lg-6">

            <?php if ( $checkout->get_checkout_fields() ) : ?>

                <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                <?php do_action( 'woocommerce_checkout_billing' ); ?>

                <?php do_action( 'woocommerce_checkout_shipping' ); ?>

                <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

            <?php endif; ?>

        </div>
    </div>


    <div class="row justify-content-center py-3 px-5 mt-3">

        <div id="order_review" class="woocommerce-checkout-review-order">
            <?php do_action( 'woocommerce_checkout_order_review' ); ?>
        </div>

        <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

    </div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
