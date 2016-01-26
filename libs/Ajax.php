<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

  //添加ajax事件
  add_action('init','add_ajax_events');
  function add_ajax_events() {
  					$ajax_events = array(
												'workman_send_uid_msg'    => true,
												'apply_coupon'      			=> true,
												'remove_coupon'        	  => true,
												'add_to_cart'             => true,
												'get_variation'           => true,
												'mark_order_status'       => false,
												'add_variation'           => false,
												'get_customer_details'    => false,
												'add_order_item'          => false,
					);
			foreach ( $ajax_events as $ajax_event => $nopriv) {
					add_action( 'youpztStore_ajax_' . $ajax_event, $ajax_event);

					if ( $nopriv ) {

					}
			}
	}
/*局部事件处理，ajax事件*/
add_action('parse_request', 'youpzt_store_ajax_events');
function youpzt_store_ajax_events(){
	  //$ajax_event_var=isset($_POST['ajax_var'])? $_POST['ajax_var']:false;
    $ajax_event_var=isset($_REQUEST['ajax_var'])? $_REQUEST['ajax_var']:false;//debug
    if ($ajax_event_var) {
		    	if (has_action('youpztStore_ajax_'.$ajax_event_var)) {//检索hook
		    			do_action('youpztStore_ajax_'.$ajax_event_var);//触发
		    			exit();
		    	}	

    }

  }

//添加购物车
function add_to_cart(){
			global $wpdb,$current_user;
			$cart_item=array();
			$product_id=isset($_REQUEST['product_id'])?$_REQUEST['product_id']:false;
			$product_count=isset($_REQUEST['product_count'])?$_REQUEST['product_count']:1;
			if (!$product_id||$product_id==false) {
				return false;
			}

			$product_obj=get_post($product_id);
			$cart_item['product_id']=$product_obj->ID;
			$cart_item['name']=$product_obj->post_title;
			$cart_item['product_price']=$product_obj->post_title;//单价
			$cart_item['product_count']=$product_count;//产品数量
			if (is_user_logged_in()) {
					$cart_item['order_status']=0;//0状态为购物车状态
					$cart_obj=new Youpzt_Order($current_user->ID);
					$cart_obj->insert_to_cart($cart_item);
			}	
			echo 1;
}
//从购物车中移除
function remove_to_cart(){
	global $wpdb,$current_user;
}
?>
