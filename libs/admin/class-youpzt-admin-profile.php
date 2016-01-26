<?php
/**
 * Add extra profile fields for users in admin
 *
 * @author   WooThemes
 * @category Admin
 * @package  youpzt_store/Admin
 * @version  2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'YOUPZT_STORE_Admin_Profile' ) ) :

/**
 * YOUPZT_STORE_Admin_Profile Class.
 */
class YOUPZT_STORE_Admin_Profile {

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		add_action( 'show_user_profile', array( $this, 'add_customer_meta_fields' ) );
		add_action( 'edit_user_profile', array( $this, 'add_customer_meta_fields' ) );

		add_action( 'personal_options_update', array( $this, 'save_customer_meta_fields' ) );
		add_action( 'edit_user_profile_update', array( $this, 'save_customer_meta_fields' ) );
	}

	/**
	 * Get Address Fields for the edit user pages.
	 *
	 * @return array Fields to display which are filtered through youpzt_store_customer_meta_fields before being returned
	 */
	public function get_customer_meta_fields() {
		$show_fields = apply_filters('youpzt_store_customer_meta_fields', array(
			'billing' => array(
				'title' => __( '顾客扩展', 'youpzt_store' ),
				'fields' => array(
					'billing_address_1' => array(
						'label'       => __( 'Address 1', 'youpzt_store' ),
						'description' => ''
					),
					'billing_address_2' => array(
						'label'       => __( 'Address 2', 'youpzt_store' ),
						'description' => ''
					),
					'billing_city' => array(
						'label'       => __( 'City', 'youpzt_store' ),
						'description' => ''
					),
					'billing_postcode' => array(
						'label'       => __( 'Postcode', 'youpzt_store' ),
						'description' => ''
					),
					'billing_state' => array(
						'label'       => __( 'State/County', 'youpzt_store' ),
						'description' => __( 'State/County or state code', 'youpzt_store' ),
						'class'       => 'js_field-state'
					),
					'billing_phone' => array(
						'label'       => __( 'Telephone', 'youpzt_store' ),
						'description' => ''
					),
					'billing_email' => array(
						'label'       => __( 'Email', 'youpzt_store' ),
						'description' => ''
					)
				)
			),
			'shipping' => array(
				'title' => __( '顾客配送地址', 'youpzt_store' ),
				'fields' => array(
					'shipping_first_name' => array(
						'label'       => __( '收件姓名', 'youpzt_store' ),
						'description' => ''
					),
					'shipping_address_1' => array(
						'label'       => __( '地址1', 'youpzt_store' ),
						'description' => ''
					),
					'shipping_address_2' => array(
						'label'       => __( '地址2', 'youpzt_store' ),
						'description' => ''
					),
					'shipping_city' => array(
						'label'       => __( '城市', 'youpzt_store' ),
						'description' => ''
					),
					'shipping_postcode' => array(
						'label'       => __( '邮编', 'youpzt_store' ),
						'description' => ''
					),
					'shipping_state' => array(
						'label'       => __( 'State/County', 'youpzt_store' ),
						'description' => __( 'State/County or state code', 'youpzt_store' ),
						'class'       => 'js_field-state'
					)
				)
			)
		) );
		return $show_fields;
	}

	/**
	 * Show Address Fields on edit user pages.
	 *
	 * @param WP_User $user
	 */
	public function add_customer_meta_fields( $user ) {
		if ( ! current_user_can( 'manage_youpzt_store' ) ) {
			//return;//没有这样的权限，先注释掉
		}

		$show_fields = $this->get_customer_meta_fields();

		foreach ( $show_fields as $fieldset ) :
			?>
			<h3><?php echo $fieldset['title']; ?></h3>
			<table class="form-table">
				<?php
				foreach ( $fieldset['fields'] as $key => $field ) :
					?>
					<tr>
						<th><label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field['label'] ); ?></label></th>
						<td>
							<?php if ( ! empty( $field['type'] ) && 'select' == $field['type'] ) : ?>
								<select name="<?php echo esc_attr( $key ); ?>" id="<?php echo esc_attr( $key ); ?>" class="<?php echo ( ! empty( $field['class'] ) ? $field['class'] : '' ); ?>" style="width: 25em;">
									<?php
										$selected = esc_attr( get_user_meta( $user->ID, $key, true ) );
										foreach ( $field['options'] as $option_key => $option_value ) : ?>
										<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $selected, $option_key, true ); ?>><?php echo esc_attr( $option_value ); ?></option>
									<?php endforeach; ?>
								</select>
							<?php else : ?>
							<input type="text" name="<?php echo esc_attr( $key ); ?>" id="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( get_user_meta( $user->ID, $key, true ) ); ?>" class="<?php echo ( ! empty( $field['class'] ) ? $field['class'] : 'regular-text' ); ?>" />
							<?php endif; ?>
							<br/>
							<span class="description"><?php //echo wp_kses_post( $field['description'] ); ?></span>
						</td>
					</tr>
					<?php
				endforeach;
				?>
			</table>
			<?php
		endforeach;
	}

	/**
	 * Save Address Fields on edit user pages.
	 *
	 * @param int $user_id User ID of the user being saved
	 */
	public function save_customer_meta_fields( $user_id ) {
		$save_fields = $this->get_customer_meta_fields();

		foreach ( $save_fields as $fieldset ) {

			foreach ( $fieldset['fields'] as $key => $field ) {

				if ( isset( $_POST[ $key ] ) ) {
					update_user_meta( $user_id, $key,$_POST[ $key ]);
				}
			}
		}
	}
}

endif;

return new YOUPZT_STORE_Admin_Profile();
