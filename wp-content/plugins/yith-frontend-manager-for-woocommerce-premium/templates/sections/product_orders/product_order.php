<?php

defined( 'ABSPATH' ) or exit;

global $thepostid, $post;


$order_id = isset( $_GET['id'] ) && $_GET['id'] > 0 ? $_GET['id'] : 0;

if ( $order_id == 0 ) {
	$order    = wc_create_order();
	$order_id = $order->get_id();
}


$post = get_post( $order_id );

$loop_thepostid = $thepostid;
$thepostid      = $order_id;

if ( isset( $_POST['save'] ) && $_POST['save'] != '' ) {
	$order = new WC_Order( $order_id );

	// UPDATE ORDER DATA

	if ( isset( $_POST['order_status'] ) ) {
		$order->update_status( $_POST['order_status'] );
	}

	if ( isset( $_POST['customer_user'] ) && is_numeri( $_POST['customer_user'] ) ) {
        $order->set_customer_id( absint( $_POST['customer_user'] ) );
	}

	$billing_address = array(
		'first_name' => $_POST['_billing_first_name'],
		'last_name'  => $_POST['_billing_last_name'],
		'company'    => $_POST['_billing_company'],
		'address_1'  => $_POST['_billing_address_1'],
		'address_2'  => $_POST['_billing_address_2'],
		'city'       => $_POST['_billing_city'],
		'state'      => $_POST['_billing_state'],
		'postcode'   => $_POST['_billing_postcode'],
		'country'    => $_POST['_billing_country'],
		'email'      => $_POST['_billing_email'],
		'phone'      => $_POST['_billing_phone'],
	);

	$billing_address = array_map( 'wc_clean', $billing_address );

	$order->set_address( $billing_address, 'billing' );

	$shipping_address = array(
		'first_name' => $_POST['_shipping_first_name'],
		'last_name'  => $_POST['_shipping_last_name'],
		'company'    => $_POST['_shipping_company'],
		'address_1'  => $_POST['_shipping_address_1'],
		'address_2'  => $_POST['_shipping_address_2'],
		'city'       => $_POST['_shipping_city'],
		'state'      => $_POST['_shipping_state'],
		'postcode'   => $_POST['_shipping_postcode'],
		'country'    => $_POST['_shipping_country'],
	);

	$shipping_address = array_map( 'wc_clean', $shipping_address );

	$order->set_address( $shipping_address, 'shipping' );

	wc_print_notice( __( 'Order updated.', 'yith-frontend-manager-for-woocommerce' ), 'success' );
}

yith_wcfm_include_woocommerce_core_file( 'wc-meta-box-functions.php' );

?>

    <div id="yith-wcfm-orders">

        <form method="post">
			<?php do_action( 'yith_wcfm_before_order_details', $post ); ?>
            <div id="woocommerce-order-data"><?php WC_Meta_Box_Order_Data::output( $post ); ?></div>
            <div id="woocommerce-order-items"><?php WC_Meta_Box_Order_Items::output( $post ); ?></div>
            <div id="woocommerce-order-downloads">
                <h4><?php _e( 'Downloadable Product Permissions', 'yith-frontend-manager-for-woocommerce' ); ?></h4>
				<?php WC_Meta_Box_Order_Downloads::output( $post ); ?>
            </div>
            <div id="woocommerce-order-notes"><?php WC_Meta_Box_Order_Notes::output( $post ); ?></div>
			<?php do_action( 'yith_wcfm_after_order_details', $post ); ?>
            <div id="woocommerce-order-actions"><?php WC_Meta_Box_Order_Actions::output( $post ); ?></div>
        </form>
    </div>

    <script type="text/javascript"> woocommerce_admin_meta_boxes.post_id = <?php echo $order_id; ?>; </script>

<?php

$thepostid = $loop_thepostid;