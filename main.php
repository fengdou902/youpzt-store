<?php
/*
Plugin Name: 优品商城
Plugin URI: http://www.youpzt.com/
Description: 为你的网站添加店铺功能，可以进行产品管理，订单管理，购物车，销售报表
Version: 1.0
Author: 优品主题
Author URI: http://www.youpzt.com/
*/

if ( !defined('ABSPATH') ) {exit;}
/* Set plugin version */
if ( !defined( 'UPSTORE_PLUGIN_VERSION' ) ) {
    define( 'UPSTORE_PLUGIN_VERSION', '1.0' );
}
/* Set plugin path */
if ( !defined( 'UPSTORE_PLUGIN_DIR' ) ) {
    define( 'UPSTORE_PLUGIN_DIR', plugin_dir_path(__FILE__) );
}
/* Set template path */
if ( !defined( 'UPSTORE_TEMPLATE_DIR' ) ) {
    define( 'UPSTORE_TEMPLATE_DIR', get_stylesheet_directory());
}
/* Set plugin url */
if ( !defined( 'UPSTORE_PLUGIN_URI' ) ) {
    define( 'UPSTORE_PLUGIN_URI', plugin_dir_url(__FILE__) );
}
/* Set plugin assets url */
if ( !defined( 'UPSTORE_PLUGIN_ASSETS_URI' ) ) {
    define( 'UPSTORE_PLUGIN_ASSETS_URI', plugins_url('assets/',__FILE__) );
}
/* Set plugin type */
if ( !defined( 'UPSTORE_TYPE' ) ) {
    define( 'UPSTORE_TYPE', 'sale' );
}
if ( !defined( 'UPSTORE_SITE_URL' ) ) {
    define('UPSTORE_SITE_URL', site_url());
}

if ( !defined( 'UPSTORE_HOME_URL' )) {
    define('UPSTORE_HOME_URL', home_url());
}
//注册商城所需要的页面
register_activation_hook( __FILE__, 'youpzt_store_create_pages' );

include(UPSTORE_PLUGIN_DIR. '/libs/Hooks.php');
include(UPSTORE_PLUGIN_DIR. '/libs/Ajax.php');

/* Including functions */
include(UPSTORE_PLUGIN_DIR.'libs/functions-core.php');
include(UPSTORE_PLUGIN_DIR.'libs/functions-user.php');
include(UPSTORE_PLUGIN_DIR.'libs/functions-widget.php');
include(UPSTORE_PLUGIN_DIR.'libs/postType-products.php');
include(UPSTORE_PLUGIN_DIR.'libs/youpzt-order-meta.php');
/* Including class */
include(UPSTORE_PLUGIN_DIR.'libs/class-youpzt-order.php');
include(UPSTORE_PLUGIN_DIR.'libs/class-youpzt-cart.php');
//加载后台配置选项
include(UPSTORE_PLUGIN_DIR . 'libs/setting/cs-framework.php');
global $wp_version;
if (version_compare($wp_version, '4.4', '<')) {
    //include(UPSTORE_PLUGIN_DIR. '/libs/setting/simple-term-meta.php');
}
/* Add admin menu */
if(is_admin()) {
     include(UPSTORE_PLUGIN_DIR.'libs/admin/functions.php');//加载后台functions
     include(UPSTORE_PLUGIN_DIR.'libs/admin/class-youpzt-admin-profile.php');
     include(UPSTORE_PLUGIN_DIR.'libs/admin/class-youpzt-admin-menus.php');
}else{
    include(UPSTORE_PLUGIN_DIR.'libs/functions-front.php');//加载前端functions
}

function display_product_menu(){
    add_menu_page('优品商城', '优品商城', 'administrator','youpzt_store', 'youpzt_order_manage_page','dashicons-welcome-view-site');
    add_submenu_page('youpzt_store','订单管理', '订单管理', 'administrator','youpzt_store_orders', 'youpzt_order_manage_page');
add_submenu_page('youpzt_store','报表统计', '报表统计', 'administrator','youpzt_store_reports', 'youpzt_store_reports_page');
    add_submenu_page('youpzt_store','工具', '工具', 'administrator','youpzt_store_tools', 'youpzt_store_tools_page');
}

function youpzt_store_page(){
    echo '待加';
}
?>
