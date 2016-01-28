<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/* Get current page url */
if ( ! function_exists( 'youpzt_get_current_page_url' ) ) :
function youpzt_get_current_page_url(){
	global $wp;
	return get_option( 'permalink_structure' ) == '' ? add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) : home_url( add_query_arg( array(), $wp->request ) );
}
endif;

if ( ! function_exists( 'youpzt_get_current_page_url2' ) ) :
function youpzt_get_current_page_url2(){
    $protocol = strtolower($_SERVER['REQUEST_SCHEME']);
    $ssl = $protocol=='https'?true:false;
    $port  = $_SERVER['SERVER_PORT'];
    $port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
    $host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
    return $protocol . '://' . $host . $port . $_SERVER['REQUEST_URI'];
}
endif;

/* Convert IP */
if ( ! function_exists( 'youpzt_convertip' ) ) :
function youpzt_convertip($ip){
    //$url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php';
	//$data = array('format'=>'json','ip'=>$ip);
    $url = 'http://wap.ip138.com/ip.asp';
    $data = array('ip' => $ip );
    $location = um_curl_post($url,$data);
    preg_match_all("/<b>查询结果：(.*)<\/b>/isU",$location,$result);
    return empty($result[1][0]) ? __('火星','um') : $result[1][0];
}
endif;

/**
 * Enqueue scripts and styles.
 */
 if ( ! function_exists( 'youpzt_of_register_assets' ) ) :
function youpzt_of_register_assets() {	
	$get_tab=isset($_GET['tab'])?$_GET['tab']:'my-orders';
	if (is_page(array('shop','youpzt-store'))||(is_single()&&get_post_type()=='product')) {
		wp_enqueue_style( 'youpzt-store-normalize', UPSTORE_PLUGIN_ASSETS_URI. 'css/normalize.css','',1.1);
		wp_enqueue_style( 'youpzt-store-h-ui', UPSTORE_PLUGIN_ASSETS_URI. 'css/h-ui.css','',1.1);
		wp_enqueue_style( 'youpzt-store-base', UPSTORE_PLUGIN_ASSETS_URI. 'css/base.css','',1.1);
		wp_enqueue_style( 'smoothproducts', UPSTORE_PLUGIN_ASSETS_URI. 'css/smoothproducts.css','',1.1);
		wp_enqueue_style( 'youpzt-store-style', UPSTORE_PLUGIN_ASSETS_URI. 'css/style.css','',1.1);

		wp_enqueue_script( 'youpzt-store-jquery.validate.min', UPSTORE_PLUGIN_ASSETS_URI. 'js/jquery.validate.min.js', array('jquery' ), '1.0', true );
		wp_enqueue_script( 'youpzt-store-validate-methods', UPSTORE_PLUGIN_ASSETS_URI. 'js/validate-methods.js', array('jquery' ), '1.0', true );
		wp_enqueue_script( 'youpzt-store-messages_zh', UPSTORE_PLUGIN_ASSETS_URI. 'js/messages_zh.min.js', array('jquery' ), '1.0', true );
		wp_enqueue_script( 'smoothproducts.min', UPSTORE_PLUGIN_ASSETS_URI. 'js/smoothproducts.min.js', array('jquery' ), '1.0', true );
		wp_enqueue_script( 'youpzt-store-main', UPSTORE_PLUGIN_ASSETS_URI. 'js/main.js', array('jquery' ), '1.0', true );
		wp_enqueue_script( 'layer', UPSTORE_PLUGIN_ASSETS_URI. 'js/layer/layer.js', array('jquery' ), '1.0', true );
		wp_enqueue_script( 'jquery.cityselect', UPSTORE_PLUGIN_ASSETS_URI. 'js/cities/jquery.cityselect.js', array('jquery' ), '1.0', true );
		
	}

}
endif; 
add_action( 'wp_enqueue_scripts', 'youpzt_of_register_assets');

/* 取消原有jQuery*/
 if ( ! function_exists( 'youpztStore_headerScript' ) ) {
		function youpztStore_headerScript() {
		    if ( !is_admin() ) {
		        wp_deregister_script( 'jquery' );
		        //wp_enqueue_script('jquery','http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js',array(),'2.1.1');
		        //wp_enqueue_script('jquery','http://libs.baidu.com/jquery/2.0.0/jquery.min.js',array(),'2.0.1');
		        wp_enqueue_script( 'jquery', UPSTORE_PLUGIN_ASSETS_URI. 'js/jquery-1.11.0.js', array(), '1.11');
		        wp_enqueue_script( 'jquery' );   
		    }  
		} 
	
}
add_action( 'init', 'youpztStore_headerScript');
?>
