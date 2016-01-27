<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

  //添加ajax事件
add_action('init','add_ajax_events');
function add_ajax_events() {
				$ajax_events = array(
										'workman_send_uid_msg'   => true,
										'apply_coupon'      		=> true,
										'remove_coupon'        	 => true,
										'add_to_cart'          	 => true,
										'change_qrt_cart'         => true,
										'remove_to_cart'         => true,
										'change_order_status'    => false,
										'delete_order'	  			=>false,	
										'get_variation'           => true,
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
/**
*添加购物车
* @param $product_id产品id
*				$product_count产品数量
*@return  bool
*/
function add_to_cart($product_id,$product_count=null){
			global $current_user;
			$cart_item=array();
			if (!$product_id) {
					$product_id=isset($_REQUEST['product_id'])?$_REQUEST['product_id']:false;
			}
			if (!$product_count) {
				$product_count=isset($_REQUEST['product_count'])?$_REQUEST['product_count']:1;
			}
			
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
					return	$cart_obj->insert_to_cart($cart_item);
			}	
			
}
/**
*改变购物车中的产品数量（只能加和减）
* @param $row_id订单id
*					$type改变类型，add加，reduce减
*@return  bool
*/
function change_qrt_cart($row_id,$type='add'){
	global $current_user;
	if (!$row_id) {
		$row_id=isset($_REQUEST['row_id'])?$_REQUEST['row_id']:false;
	}
	$change_type=isset($_REQUEST['type'])?$_REQUEST['type']:$type;
	if ($row_id) {
		$row_id=intval($row_id);
		$cart_obj=new Youpzt_Order($current_user->ID);
		return $cart_obj->change_qrt_order($row_id,$change_type);
	}
}
/**
*从购物车中移除产品
* @param $row_id订单id
*@return  bool
*/
function remove_to_cart($row_id){
	if (!$row_id) {
		$row_id=isset($_REQUEST['row_id'])?$_REQUEST['row_id']:false;
	}
	
	if ($row_id) {
		$row_id=intval($row_id);
		return delete_order($row_id);//其实是根据id删除订单表中的数据
	}
}
/**
*改变改变订单状态
* @param $order_id(int)订单id
*					$status(int) 状态值：-1关闭取消，0购物车，1待付款，2待发货（已付款），3已发货，4已收货，5交易完成
*@return  bool
*/
function change_order_status($order_id,$status){
	global $current_user;
	$order_id=isset($_REQUEST['order_id'])?$_REQUEST['order_id']:$order_id;
	$status=isset($_REQUEST['status'])?$_REQUEST['status']:$status;
	if ($order_id&&$status) {
		$order_id=intval($order_id);
		$status=intval($status);
		$order_obj=new Youpzt_Order($current_user->ID);
		$update_data=array(
				'order_status'=>$status
			);
		return $order_obj->update_order($order_id,$update_data);
	}
}
/**
*删除订单
* @param $order_id订单id
*@return  bool
*/
function delete_order($order_id){
		global $current_user;
		if (!$order_id) {
			$order_id=isset($_REQUEST['order_id'])?$_REQUEST['order_id']:false;
		}
		if ($order_id) {
				$order_obj=new Youpzt_Order($current_user->ID);
				return $order_obj->delete_order($order_id);
		}else{
			return false;
		}	
}
?>
