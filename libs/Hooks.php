<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
//注册商城所需要的页面
function youpzt_store_create_pages(){
    /*$config_store_pages=array(
            'cart'=>'购物车',
            'checkout'=>'结算',
            'my-account'=>'我的账户',
            'my-address'=>'我的地址',
            'shop'=>'商店'
        );*/
    $config_store_pages=array(
            'youpzt-store'=>'我的账户',
            'shop'=>'商店'
        );
    foreach ($config_store_pages as $key => $store_page_val) {
        $register_page = array(
             'post_title' => $store_page_val,
             'post_name'=>$key,
             'post_type' => 'page',
             'post_status' => 'publish',
             'post_author' => 1
          );
        wp_insert_post($register_page);
    }
}

//register_activation_hook( __FILE__, 'yirenku_create_db_table' );
if (!function_exists('youpzt_store_create_db_table')) {
		function youpzt_store_create_db_table()
		{
			// setup custom table
			global $wpdb;
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');		
			global $wp_version;

			//订单表
			  if( $wpdb->get_var("SHOW TABLES LIKE '$wpdb->youpzt_order'") != $wpdb->youpzt_order){
  
			    $sql = "CREATE TABLE " . $wpdb->youpzt_order . " (
							  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
							  `user_id` int(20) unsigned NOT NULL,
							  `order_number` varchar(80) NOT NULL DEFAULT '' COMMENT '订单号',
							  `product_id` int(20) DEFAULT NULL,
							  `openid` varchar(120) DEFAULT NULL,
							  `real_price` int(20) unsigned NOT NULL COMMENT '实际价格',
							  `duihuan_price` int(20) unsigned NOT NULL COMMENT '兑换价格',
							  `order_time` datetime NOT NULL COMMENT '订单时间',
							  `order_status` tinyint(2) NOT NULL COMMENT '-1失败，0待付款，1支付完成，2取消',
							  PRIMARY KEY (`id`)
			    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
			    dbDelta($sql);
			  }

			
			update_option( "yirenku_db_version", '0.2' );
		}
}

//add_action( 'admin_menu', 'youpzt_store_create_db_table' ); 
global $pagenow;
$admin_page_GET=isset($_GET['page'])?$_GET['page']:false;
if (is_admin()&&$admin_page_GET=='yirenku_setting_page'&& isset( $_GET['activated'])){

	//youpzt_store_create_db_table();//创建数据库
}
/**
 * define store table in wpdb
 */
if (!function_exists('youpzt_store_define_table')) {
		function youpzt_store_define_table() {
			global $wpdb;
			//$wpdb->termmeta = $wpdb->prefix . 'termmeta';
			$wpdb->youpzt_order = $wpdb->prefix . 'youpzt_order';
			$wpdb->youpzt_ordermeta = $wpdb->prefix . 'youpzt_ordermeta';
			$wpdb->youpzt_address= $wpdb->prefix . 'youpzt_address';
		}
}
add_action( 'init', 'youpzt_store_define_table' );
/**
 * delete term meta table and db version option upon uninstall
 */
 
//register_uninstall_hook( __FILE__, 'yirenku_de_db_table' );
if (!function_exists('youpzt_store_de_db_table')) {
	function youpzt_store_de_db_table()
	{
		global $wpdb;	
		//$table_name = $wpdb->prefix . 'termmeta';
		
		//$wpdb->query("DROP TABLE IF EXISTS $table_name");
		
		delete_option( "youpzt_store_db_version" );
	}
}
?>