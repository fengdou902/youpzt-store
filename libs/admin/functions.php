<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
//添加后台css,js
 add_action('admin_enqueue_scripts','youpzt_store_enqueue_scripts',18);
 function youpzt_store_enqueue_scripts(){
 			wp_enqueue_style('youpzt_store_base', UPSTORE_PLUGIN_ASSETS_URI.'css/base.css',array(),1.0);
 			wp_enqueue_style('youpzt_store_admin', UPSTORE_PLUGIN_ASSETS_URI.'css/admin.css',array(),1.0);
 	
      //wp_enqueue_script('metabox_fields_js',UPSTORE_PLUGIN_ASSETS_URI.'/js/metabox_fields.js');
 }
//修改产品描述表单
 add_action( 'add_meta_boxes','add_product_meta_boxes', 30 );

 function add_product_meta_boxes(){
 	add_meta_box( 'postexcerpt','产品描述', 'product_excerpt_meta_box', 'product', 'normal' );
 }
function product_excerpt_meta_box($post){
	 			$settings = array(
					'textarea_name' => 'excerpt',
					'quicktags'     => array( 'buttons' => 'em,strong,link' ),
					'tinymce'       => array(
						'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
						'theme_advanced_buttons2' => '',
					),
			'editor_css'    => '<style>#wp-excerpt-editor-container .wp-editor-area{height:175px; width:100%;}</style>'
		);

		wp_editor( htmlspecialchars_decode( $post->post_excerpt ), 'excerpt',$settings);
}

/**
 * WordPress 给“特色图像”模块添加说明文字
 */
  $youpzt_get_post_type=isset($_GET['post_type'])?$_GET['post_type']:false;
    if ($youpzt_get_post_type==='product') {
    add_filter( 'admin_post_thumbnail_html', 'add_featured_image_instruction');
    }
function add_featured_image_instruction( $content ) {
    return $content .= '<p>特色图像将用来作为该产品的预览图，请务必为产品选择一个特色图像。</p>';
    
}
/**
 * 自定义 WordPress 后台底部的版权和版本信息
 */
add_filter('admin_footer_text', 'youpzt_store_left_admin_footer_text',20); 
function youpzt_store_left_admin_footer_text($text) {
  // 左边信息
  $text = '<span id="footer-thankyou">感谢使用<a href="http://www.youpzt.com" target="_blank" rel="nofollow">优品定制</a>进行创作</span>'; 
  return $text;
}
add_filter('update_footer', 'youpzt_right_admin_footer_text', 11); 
function youpzt_right_admin_footer_text($text) {
  // 右边信息,默认显示版本号
  $text = "";
  return $text;
}
?>
