<?php

/**
/utf8
 * activation - setup table, store db version for future updates
 */


/**
 * Updates metadata cache for list of order IDs.
 *
 * Performs SQL query to retrieve the metadata for the order IDs and updates the
 * metadata cache for the orders. Therefore, the functions, which call this
 * function, do not need to perform SQL queries on their own.
 *
 * @param array $order_ids List of post IDs.
 * @return bool|array Returns false if there is nothing to update or an array of metadata.
 */
if (!function_exists('update_ordermeta_cache')) {
function update_ordermeta_cache($order_ids) {
	return update_meta_cache('youpzt_order_meta', $order_ids);
}
}

/**
 * Add meta data field to a order.
 *
 * @param int $order_id order ID.
 * @param string $key Metadata name.
 * @param mixed $value Metadata value.
 * @param bool $unique Optional, default is false. Whether the same key should not be added.
 * @return bool False for failure. True for success.
 */
if (!function_exists('add_order_meta')) {
function add_order_meta( $order_id, $meta_key, $meta_value, $unique = false ) {
	return add_metadata('youpzt_order', $order_id, $meta_key, $meta_value, $unique);
}
}

/**
 * Remove metadata matching criteria from a order.
 *
 * You can match based on the key, or key and value. Removing based on key and
 * value, will keep from removing duplicate metadata with the same key. It also
 * allows removing all metadata matching key, if needed.
 *
 * @param int $order_id order ID
 * @param string $meta_key Metadata name.
 * @param mixed $meta_value Optional. Metadata value.
 * @return bool False for failure. True for success.
 */
if (!function_exists('delete_order_meta')) {
function delete_order_meta( $order_id, $meta_key, $meta_value = '',$delete_all = false) {
	return delete_metadata('youpzt_order', $order_id, $meta_key, $meta_value,$delete_all = false);
}
}

/**
 * Retrieve order meta field for a order.
 *
 * @param int $order_id order ID.
 * @param string $key The meta key to retrieve.
 * @param bool $single Whether to return a single value.
 * @return mixed Will be an array if $single is false. Will be value of meta data field if $single
 *  is true.
 */
if (!function_exists('get_order_meta')) {
function get_order_meta( $order_id, $key, $single = false ) {
	return get_metadata('youpzt_order', $order_id, $key, $single);
}
}
/**
 * Update order meta field based on order ID.
 *
 * Use the $prev_value parameter to differentiate between meta fields with the
 * same key and order ID.
 *
 * If the meta field for the order does not exist, it will be added.
 *
 * @param int $order_id order ID.
 * @param string $key Metadata key.
 * @param mixed $value Metadata value.
 * @param mixed $prev_value Optional. Previous value to check before removing.
 * @return bool False on failure, true if success.
 */
if (!function_exists('update_order_meta')) {
function update_order_meta( $order_id, $meta_key, $meta_value, $prev_value = '' ) {
	return update_metadata('youpzt_order', $order_id, $meta_key, $meta_value, $prev_value);
}
}
/**
 * Delete everything from order meta matching meta key.
 *
 * @param string $order_meta_key Key to search for when deleting.
 * @return bool Whether the order meta key was deleted from the database
 */
if (!function_exists('delete_order_meta_by_key')) {
function delete_order_meta_by_key($order_meta_key) {
	if ( !$order_meta_key )
		return false;

	global $wpdb;
	$order_ids = $wpdb->get_col($wpdb->prepare("SELECT DISTINCT order_id FROM $wpdb->youpzt_ordermeta WHERE meta_key = %s", $order_meta_key));
	if ( $order_ids ) {
		$ordermetaids = $wpdb->get_col( $wpdb->prepare( "SELECT meta_id FROM $wpdb->youpzt_ordermeta WHERE meta_key = %s", $order_meta_key ) );
		$in = implode( ',', array_fill(1, count($ordermetaids), '%d'));
		do_action( 'delete_ordermeta', $ordermetaids );
		$wpdb->query( $wpdb->prepare("DELETE FROM $wpdb->youpzt_ordermeta WHERE meta_id IN($in)", $ordermetaids ));
		do_action( 'deleted_ordermeta', $ordermetaids );
		foreach ( $order_ids as $order_id )
			wp_cache_delete($order_id, 'youpzt_order_meta');
		return true;
	}
	return false;
}
}
/**
 * Retrieve order meta fields, based on order ID.
 *
 * The order meta fields are retrieved from the cache, so the function is
 * optimized to be called more than once. It also applies to the functions, that
 * use this function.
 *
 * @param int $order_id order ID
 * @return array
 */
if (!function_exists('get_order_custom')) {
function get_order_custom( $order_id ) {
	$order_id = (int) $order_id;

	if ( ! wp_cache_get($order_id, 'youpzt_order_meta') )
		update_ordermeta_cache($order_id);

	return wp_cache_get($order_id, 'youpzt_order_meta');
}
}
/**
 * Retrieve meta field names for a order.
 *
 * If there are no meta fields, then nothing (null) will be returned.
 *
 * @param int $order_id order ID
 * @return array|null Either array of the keys, or null if keys could not be retrieved.
 */
if (!function_exists('get_order_custom_keys')) {
function get_order_custom_keys( $order_id ) {
	$custom = get_order_custom( $order_id );

	if ( !is_array($custom) )
		return;

	if ( $keys = array_keys($custom) )
		return $keys;
}
}
/**
 * Retrieve values for a custom order field.
 *
 * The parameters must not be considered optional. All of the order meta fields
 * will be retrieved and only the meta field key values returned.
 *
 * @param string $key Meta field key.
 * @param int $order_id order ID
 * @return array Meta field values.
 */
if (!function_exists('get_order_custom_values')) {
function get_order_custom_values( $key = '', $order_id ) {
	if ( !$key )
		return null;

	$custom = get_order_custom($order_id);

	return isset($custom[$key]) ? $custom[$key] : null;
}
}
?>