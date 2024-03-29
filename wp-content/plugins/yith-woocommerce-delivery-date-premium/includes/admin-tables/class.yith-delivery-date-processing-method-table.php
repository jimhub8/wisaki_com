<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'YITH_Processing_Method_Table' ) ) {

	class YITH_Processing_Method_Table extends WP_List_Table {

		public function __construct() {


			parent::__construct( array(
				'singular' => __( 'Processing Method', 'yith-woocommerce-delivery-date' ),
				//singular name of the listed records
				'plural'   => __( 'Processing Methods', 'yith-woocommerce-delivery-date' ),
				//plural name of the listed records
				'ajax'     => true
				//does this table support ajax?
			) );
		}


		/**
		 * return the columns for the table
		 * @return array
		 * @since 2.0.0
		 * @author YITH
		 */
		public function get_columns() {

			$columns = array(
				'cb'          => '<input type="checkbox"/>',
				'post_title'  => __( 'Title', 'yith-woocommerce-delivery-date' ),
				'n_workday'   => __( 'Number of Workdays', 'yith-woocommerce-delivery-date' ),
				'workdays'    => __( 'Workdays', 'yith-woocommerce-delivery-date' ),
				'post_author' => __( 'Author', 'yith-woocommerce-delivery-date' ),
				'post_date'   => __( 'Date', 'yith-woocommerce-delivery-date' )
			);

			return $columns;
		}

		/**
		 * @param object $item
		 *
		 * @return string
		 */
		public function column_cb( $item ) {
			return sprintf(
				'<input type="checkbox" name="ywcdd_processing_method_ids[]" value="%s" />', $item
			);
		}

		/**
		 * @param object|int $item
		 * @param string $column_name
		 */
		public function column_default( $item, $column_name ) {

			$output = '';
			switch ( $column_name ) {

				case 'post_title' :
					$action_edit_query_args = array(
						'action' => 'edit',
						'post'   => $item
					);
					$action_edit_url        = esc_url( add_query_arg( $action_edit_query_args, admin_url( 'post.php' ) ) );

					$delete = ( isset( $_GET['status'] ) && 'trash' === $_GET['status'] );

					$actions = array();

					if ( $delete ) {

						$post_type        = get_post_type( $item );
						$post_type_object = get_post_type_object( $post_type );

						$actions['untrash'] = "<a title='" . esc_attr__( 'Restore this item from Trash', 'yith-woocommerce-delivery-date' ) . "' href='" . wp_nonce_url( admin_url( sprintf( $post_type_object->_edit_link . '&amp;action=untrash', $item ) ), 'untrash-post_' . $item ) . "'>" . __( 'Restore', 'yith-woocommerce-role-based-prices' ) . "</a>";

						$actions['delete'] = '<a href="' . esc_url( get_delete_post_link( $item, '',
								true ) ) . '" class="submitdelete">' . __( 'Delete permanently', 'yith-woocommerce-delivery-date' ) . '</a>';
					} else {
						$actions['edit']  = '<a href="' . $action_edit_url . '">' . __( 'Edit', 'yith-woocommerce-delivery-date' ) . '</a>';
						$actions['trash'] = '<a href="' . esc_url( get_delete_post_link( $item, '', false ) ) . '" class="submitdelete">' . __( 'Trash', 'yith-woocommerce-delivery-date' ) . '</a>';
					}

					$post_title = get_the_title( $item );
					$output     = sprintf( '<strong><a class="tips" target="_blank" href="%s" data-tip="%s">#%d %s </a></strong> %s', $action_edit_url, __( 'Edit', 'yith-woocommerce-delivery-date' ), $item, $post_title, $this->row_actions( $actions ) );
					break;
				case 'n_workday':
					$output = get_post_meta( $item, '_ywcdd_minworkday', true );
					break;
				case 'workdays':
					$shippingday = get_post_meta( $item, '_ywcdd_list_day', true );
					$all_workday = yith_get_worksday( false );
					if ( $shippingday ) {

						$value = array();
						foreach ( $shippingday as $key => $day ) {

							if ( $day['enabled'] == 'yes' ) {
								$value[] = isset( $all_workday[ $day['day'] ] ) ? $all_workday[ $day['day'] ] : $day['day'];
							}
						}
						if ( count( $value ) > 0 ) {
							$output = implode( ',', $value );
						}
					}
					break;
				case 'post_author':

					$post = get_post( $item );

					$author_query_args = array(
						'user_id' => $post->post_author,
					);

					$user_link = esc_url( add_query_arg( $author_query_args, admin_url( 'user-edit.php' ) ) );
					$user      = get_user_by( 'id', $post->post_author );

					echo sprintf( '<a href="%s" target="_blank">%s</a>', $user_link, $user->user_nicename );
					break;

				case 'post_date':
					$post = get_post( $item );
					echo '<p>' . $post->post_modified . '</p>';
					break;
			}

			echo $output;
		}

		public function prepare_items() {
			$per_page              = 15;
			$columns               = $this->get_columns();
			$hidden                = array();
			$sortable              = $this->get_sortable_columns();
			$this->_column_headers = array( $columns, $hidden, $sortable );

			$current_page = $this->get_pagenum();

			$query_args = array(
				'posts_per_page' => $per_page,
				'paged'          => $current_page,
				'fields'         => 'ids'
			);

			$type = get_option( 'ywcdd_processing_type', 'checkout' );
			$type = 'checkout' == $type ? 'yes' : 'no';

			$query_args['meta_query'] = array(
				array(
					'key'     => '_ywcdd_type_checkout',
					'value'   => $type,
					'compare' => '='
				)
			);

			if ( isset( $_GET['status'] ) && 'all' !== $_GET['status'] ) {

				$query_args['post_status'] = $_GET['status'];
			}

			if ( isset( $_GET['author'] ) && 'mine' === $_GET['author'] ) {
				$query_args['author'] = $_GET['author'];
			}

			$items = YITH_Delivery_Date_Processing_Method()->get_processing_method( $query_args );

			@usort( $items, array( $this, 'sort_by' ) );

			$this->items = $items;
			$count_posts = wp_count_posts( 'yith_proc_method' );
			$total_items = $count_posts->publish;
			/**
			 * REQUIRED. We also have to register our pagination options & calculations.
			 */
			$this->set_pagination_args( array(
				'total_items' => $total_items,                  //WE have to calculate the total number of items
				'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
				'total_pages' => ceil( $total_items / $per_page )   //WE have to calculate the total number of pages
			) );
		}

		public function display_rows_or_placeholder() {
			if ( $this->has_items() ) {
				$this->display_rows();
			} else {
				echo '<tr class="no-items"><td class="colspanchange" colspan="' . $this->get_column_count() . '">';
				$this->no_items();
				echo '</td></tr>';
			}
		}

		/**
		 * return bulk actions
		 * @return array|false|string
		 * @since 1.0.0
		 * @author YITHEMES
		 */
		public function get_bulk_actions() {

			$actions = $this->current_action();

			if ( isset( $_REQUEST['ywcdd_processing_method_ids'] ) ) {

				$rules = $_REQUEST['ywcdd_processing_method_ids'];

				if ( $actions == 'delete' || $actions == 'trash' ) {

					$delete = $actions == 'delete';


					foreach ( $rules as $rule_id ) {

						if ( $delete ) {
							wp_delete_post( $rule_id, true );
						} else {
							wp_trash_post( $rule_id );
						}
					}

					$args = array(
						'page' => 'yith_delivery_date_panel',
						'tab'  => 'processing-method'
					);

					$admin_url = admin_url( 'admin.php' );
					$url       = esc_url_raw( add_query_arg( $args, $admin_url ) );

					wp_redirect( $url );
					exit;
				}


			}

			$actions = array(
				'delete' => __( 'Delete', 'yith-woocommerce-delivery-date' ),
				'trash'  => __( 'Move to Trash', 'yith-woocommerce-delivery-date' )
			);

			return $actions;
		}

		/**
		 * get views for the table
		 * @return array
		 * @since 1.0.0
		 * @author YITHEMES
		 */
		protected function get_views() {
			$views = array(
				'all'     => __( 'All', 'yith-woocommerce-delivery-date' ),
				'publish' => __( 'Published', 'yith-woocommerce-delivery-date' ),
				'mine'    => __( 'Mine', 'yith-woocommerce-delivery-date' ),
				'trash'   => __( 'Trash', 'yith-woocommerce-delivery-date' ),
				'draft'   => __( 'Draft', 'yith-woocommerce-delivery-date' )
			);

			$current_view = $this->get_current_view();

			foreach ( $views as $view_id => $view ) {

				$query_args = array(
					'posts_per_page'  => - 1,
					'post_type'       => 'yith_proc_method',
					'post_status'     => 'publish',
					'suppress_filter' => false
				);

				$type = get_option( 'ywcdd_processing_type', 'checkout' );
				$type = 'checkout' == $type ? 'yes' : 'no';

				$query_args['meta_query'] = array(
					array(
						'key'     => '_ywcdd_type_checkout',
						'value'   => $type,
						'compare' => '='
					)
				);
				$status     = 'status';
				$id         = $view_id;

				if ( 'mine' === $view_id ) {
					$query_args['author'] = get_current_user_id();
					$status               = 'author';
					$id                   = get_current_user_id();

				} elseif ( 'all' !== $view_id ) {
					$query_args['post_status'] = $view_id;
				}

				$href              = esc_url( add_query_arg( $status, $id ) );
				$total_items       = count( get_posts( $query_args ) );
				$class             = $view_id == $current_view ? 'current' : '';
				$views[ $view_id ] = sprintf( "<a href='%s' class='%s'>%s <span class='count'>(%d)</span></a>", $href, $class, $view, $total_items );
			}


			return $views;
		}

		/**
		 * return current view
		 * @return string
		 * @since 1.0.0
		 * @author YITHEMES
		 */
		public function get_current_view() {

			return empty( $_GET['status'] ) ? 'all' : $_GET['status'];
		}

		/**
		 * change the display function
		 * @author YITHEMES
		 * @since 2.0.2
		 */
		public function display() {
			wp_nonce_field( 'ajax-processing-method-nonce', '_ajax_processing_method_nonce' );
			parent::display();
		}

		public function ajax_response() {

			check_ajax_referer( 'ajax-processing-method-nonce', '_ajax_processing_method_nonce' );

			$this->prepare_items();
			extract( $this->_args );
			extract( $this->_pagination_args, EXTR_SKIP );

			ob_start();
			if ( ! empty( $_REQUEST['no_placeholder'] ) ) {
				$this->display_rows();
			} else {
				$this->display_rows_or_placeholder();
			}
			$rows = ob_get_clean();

			ob_start();
			$this->print_column_headers();
			$headers = ob_get_clean();

			ob_start();
			$this->pagination( 'top' );
			$pagination_top = ob_get_clean();

			ob_start();
			$this->pagination( 'bottom' );
			$pagination_bottom = ob_get_clean();

			$response                         = array( 'rows' => $rows );
			$response['pagination']['top']    = $pagination_top;
			$response['pagination']['bottom'] = $pagination_bottom;
			$response['column_headers']       = $headers;

			ob_start();
			$this->views();
			$view = ob_get_clean();

			$response['views'] = $view;

			if ( isset( $total_items ) ) {
				$response['total_items_i18n'] = sprintf( _n( '1 item', '%s items', $total_items ), number_format_i18n( $total_items ) );
			}

			if ( isset( $total_pages ) ) {
				$response['total_pages']      = $total_pages;
				$response['total_pages_i18n'] = number_format_i18n( $total_pages );
			}

			die( json_encode( $response ) );

		}

	}

}