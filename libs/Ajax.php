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
										'get_orderList'         => true,
										'change_order_status'    => false,
										'delete_order'	  			=>false,
										'add_to_address'				=>true,	
										'delete_address'				=>true,
										'set_default_address'		=>true,
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
			$cart_item['product_price']=youpzt_get_product_price($product_id);//单价
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
*获取订单列表
* @param $status(int)订单状态
*					$offset(int) 列表的当前页码偏移
*					$number(int) 每页的数量
*@return  array订单列表数组
*/
function get_orderList($status,$offset,$number){
	if ($status&&$offset) {
			global $current_user;
			$where="order_status=".$status;
			$order_obj=new Youpzt_Order($current_user->ID);
			return $order_obj->get_orderList($where,$offset,$number);
	}
}
/**
*获取订单列表
* @param $status(int)订单状态
*					$offset(int) 列表的当前页码偏移
*					$number(int) 每页的数量
*@return  array当前订单的所有数据
*/
function get_order_by_id($order_id){
	if ($order_id) {
			global $current_user;
			$order_obj=new Youpzt_Order($current_user->ID);
			return $order_obj->get_order_by_id($order_id);
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
/**
*添加地址
* @param $user_id (int)用户id
*				$set_address (arr)设置地址的数组值
*	@return  bool
*/
function add_to_address($set_address,$user_id){
	if (!$user_id) {
		global $current_user;
		$user_id=$current_user->ID;
	}
		$address_item['city']=isset($_REQUEST['city'])?$_REQUEST['city']:$set_address['city'];
		$address_item['address_detail']=isset($_REQUEST['address_detail'])?$_REQUEST['address_detail']:$set_address['address_detail'];
		$address_item['contact_name']=isset($_REQUEST['contact_name'])?$_REQUEST['contact_name']:$set_address['contact_name'];
		$address_item['zipcode']=isset($_REQUEST['zipcode'])?$_REQUEST['zipcode']:$set_address['zipcode'];
		$address_item['telphone']=isset($_REQUEST['telphone'])?$_REQUEST['telphone']:$set_address['telphone'];
	  if(is_array($address_item)||count($address_item) == 0) {
				$address_obj=new Youpzt_Address($user_id);
				return $address_obj->insert_address($address_item);
		}
}
/**
*删除地址
* @param $address_id 地址id
*@return  bool
*/
function delete_address($address_id){
	$address_id=isset($_REQUEST['address_id'])?$_REQUEST['address_id']:$address_id;
		if ($address_id) {
				$address_obj=new Youpzt_Address();
				return $address_obj->delete_address($address_id);
		}
}
/**
*设置默认地址
* @param $address_id 地址id
*@return  bool
*/
function set_default_address($address_id,$user_id){
		if (!$user_id) {
			global $current_user;
			$user_id=$current_user->ID;
		}
		if ($address_id) {
			return update_user_meta($user_id,'default_address_id',$address_id);
		}
}
?>
