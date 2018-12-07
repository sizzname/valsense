<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>


<div class="row ry-3">
    <div class="col-4 col-md-6">
        <img src="<?php echo get_template_directory_uri(); ?>/img/valsense.jpg" alt="" class="w-100">
    </div>
    <div class="col-8 col-md-6">


<form class="woocommerce-cart-form container" action="<?php echo esc_url( wc_get_cart_url() ) . '#add_cart'; ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

    <!--<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
			<tr>
				<th class="product-thumbnail">&nbsp;</th>
				<th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
				<th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
				<th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
				<th class="product-subtotal"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tbody>-->
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<div class="row woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">


						<div class="product-thumbnail col-sm-5">
						<?php
                        $img_url =  get_stylesheet_directory_uri();
//                        $src = wp_get_attachment_image_src( $product_id );
                        $src = get_the_post_thumbnail_url( $product_id, 'full' );
//						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

//						if ( ! $product_permalink ) {
//							echo wp_kses_post( $thumbnail );
//						} else {
//							printf(  wp_kses_post( $thumbnail ) );
//						}
//                        echo $src;
//						var_dump($src);
						?>
                            <img src="<?php  echo $img_url . '/images/photo.jpg'; ?>">

						</div>
                        <div class="prod_inf col-sm-7">
                            <div class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                            <?php
                            if ( ! $product_permalink ) {
                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                            } else {
                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( $_product->get_name() ), $cart_item, $cart_item_key ) );
    //							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                            }

                            do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                            // Meta data.
                            echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                            // Backorder notification.
                            if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>' ) );
                            }
                            ?>
                            </div>
                            <table>
                                <tr>
                                    <td>
                                        <?php esc_html_e( 'Price', 'woocommerce' ); ?>
                                    </td>
                                    <td>
                                        <div class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                                            <?php
                                            echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                            ?>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <?php esc_html_e( 'Quantity', 'woocommerce' ); ?>
                                    </td>
                                    <td>
                                        <div class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                                        <?php
                                        if ( $_product->is_sold_individually() ) {
                                            $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                        } else {
                                            $product_quantity = woocommerce_quantity_input( array(
                                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                                'input_value'  => $cart_item['quantity'],
                                                'max_value'    => $_product->get_max_purchase_quantity(),
                                                'min_value'    => '0',
                                                'product_name' => $_product->get_name(),
                                            ), $_product, false );
                                        }

                                        echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                        ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e( 'Total', 'woocommerce' ); ?>
                                    </td>
                                    <td>
                                        <div class="product-subtotal" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>">
                                            <?php
                                                echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                                <?php
                            }
                        }
                        ?>
                        <?php do_action( 'woocommerce_cart_contents' ); ?>

                        <?php if ( wc_coupons_enabled() ) { ?>
                            <table class="hs_coupon">
                                <tr>
                                    <td><?php esc_html_e( 'Код на скидку:', 'woocommerce' ); ?></td>
                                    <td> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" />
                                        <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>">
                                            <?php esc_attr_e( 'Применить', 'woocommerce' ); ?>
                                        </button>
                                    </td>
                                </tr>
                                <?php do_action( 'woocommerce_cart_coupon' ); ?>
                                <tr>
                                    <td><?php _e( 'Итого со скидкой', 'woocommerce' ); ?></td>
                                    <td><?php wc_cart_totals_order_total_html(); ?></td>
                                </tr>
                            </table>
                        <?php } ?>
                        <div class="row book_btn">
                        <div class=" book_cart">
                            <a href="#hs_checkout" class="button" id="hs_booking_cart"><?php esc_html_e( 'Заказать', 'woocommerce' ); ?></a>
                        </div>
                        <div class="refresh_btn">
                            <div colspan="6" class="actions">
                                <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

                                <?php do_action( 'woocommerce_cart_actions' ); ?>
                                <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                            </div>
                        </div>
<!--                            <tr class="order-total">-->
<!--                                <th>--><?php //_e( 'Total', 'woocommerce' ); ?><!--</th>-->
<!--                                <td data-title="--><?php //esc_attr_e( 'Total', 'woocommerce' ); ?><!--">--><?php //wc_cart_totals_order_total_html(); ?><!--</td>-->
<!--                            </tr>-->
                    </div>
                    </div>

                    <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                <!--</tbody>
            </table>-->
            <?php do_action( 'woocommerce_after_cart_table' ); ?>

    </div>
    <div class="row certificate">
        <?php
        $dir = wp_get_upload_dir();
        ?>
        <div class="col-sm-6">
            <a href="<?php echo $dir['baseurl']. '/2018/08/img6.jpg' ?>" class="" target="_blank"><img src="<?php echo $dir['baseurl']. '/2018/08/img6.jpg' ?>"></a>
        </div>
        <div class="col-sm-6">
            <a href="<?php echo $dir['baseurl']. '/2018/08/gosreg.png' ?>" class="" target="_blank"><img src="<?php echo $dir['baseurl']. '/2018/08/gosreg.png' ?>"></a>
        </div>
    </div>
</form>

<div class="cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		//do_action( 'woocommerce_cart_collaterals' );
	?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>

    </div>
</div>
