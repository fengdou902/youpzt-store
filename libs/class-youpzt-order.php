<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Order
 *
 * @class    Youpzt_Order
 * @version  2.2.0
 * @package  youpztStore/Classes
 * @category Class
 * @author   优品主题
 */
class Youpzt_Order{

		public $order_type = 1;//订单类型
		public $user_id;//下单用户id
		private $debug = false;
		//构造方法初始化  
    public function __construct($user_id) {
    		global $current_user;
    		if ($user_id&&$user_id>0) {
    		  	$this->user_id=$user_id;//用户id  
    		  }else{
    		  	$this->user_id=$current_user->ID;//用户id  
    		  }  
        
    } 
    /**
     * 添加订单
     *
     * @access  public

     * @return  bool
     */
    public function insert_to_cart($order_item=array()){
	    	if(!is_array($order_item)||count($order_item) == 0) {
	   					return false;
	   				}
	   			if (isset($order_item['product_id'])) {
	   				$product_id=intval($order_item['product_id']);
	   				global $wpdb;
	   				$return_order_id = $wpdb->get_var("SELECT order_id FROM {$wpdb->youpzt_order} WHERE product_id=$product_id and order_status=0");//检测购物车中是否存在这个产品
	   				if ($return_order_id) {//存在这个产品
		   					$old_product_count=get_order_meta($return_order_id,'product_count',true);
		   					$old_product_count=$old_product_count?$old_product_count:0;
		   					$new_product_count=intval($old_product_count)+1;
		   					update_order_meta($return_order_id,'product_count',$new_product_count);
	   				}else{
	   					$this->insert_order($order_item);//添加新的订单
	   				}
	   			}
	   			
    }

    /**
     * 添加订单
     *
     * @access  public
     * @param   array   一维或多维数组,必须包含键值名: 
                        product_id -> 产品ID标识, 
                        product_count -> 数量(quantity), 
                        product_price -> 单价(price), 
                        name -> 产品名称
                        order_status->订单状态

     * @return  bool
     */
   public function insert_order($order_item=array()){
   			if(!is_array($order_item)||count($order_item) == 0) {
   					return false;
   				}
   			global $wpdb;
 				date_default_timezone_set ('PRC');//设置默认时间函数        
        $today_time=date('Y-m-d H:i:s',time());//当前时间
        $order_time=date('YmdHis',time());
        $order_number=$order_time.mt_rand(1000,9999);//生成订单号
        $insert_order_id=$wpdb->insert($wpdb->youpzt_order,array(
			                                      'order_type'=>$this->order_type,//1，支付宝等直接购买，2，虚拟货币购买
			                                      'order_number'=>$order_number,
			                                      'product_id'=>$order_item['product_id'],
			                                      'order_name'=>$order_item['name'],//默认是产品名                     
			                                      'order_buyer'=>$this->user_id,//购买者
			                                      'order_date'=>$today_time,
			                                      'order_status' =>$order_item['order_status'],//订单状态-1,取消，0购物车,1订单待付款,2订单已付款，3订单交易完成，4退款
                                    ),
                                    array('%d','%s','%d','%s','%d','%s','%d'));
                if($insert_order_id){
                	if (isset($order_item['product_id'])) {
		                		//添加订单的扩展字段
		                		$order_meta_config=array(
		                					'product_id'		=>$order_item['product_id'],
		                					'single_price'	=>$order_item['product_price'],//单价
		                			);
		                		if (!empty($order_meta_config)) {
		                				$order_meta_arg_string=serialize($order_meta_config);
		                				update_order_meta($insert_order_id,'order_more_att',$order_meta_arg_string);//添加更新不变属性
		                		}

		                		$product_count=isset($order_item['product_count'])?$order_item['product_count']:1;
		                		$total_price=intval($product_count)*intval($order_item['product_price']);
		                		$order_meta_more=array(
		                					'product_count'=>$product_count,//产品数量
		                					'total_price'=>$total_price,//订单总价
		                			);
		                		if (!empty($order_meta_more)){
		                				foreach ($order_meta_more as $meta_key => $order_meta) {
		                						update_order_meta($insert_order_id,$meta_key,$order_meta);
		                				}
		                		}
                		}
                    $reg=$wpdb->insert_id;//$wpdb->insert_id会输出插入id
                }else{
                    $reg=0;
                }
   } 

  	//更新订单
   public function update_order($order_id=null,$update_data,$where_clause){
   			if(!is_array($update_data)||count($update_data) == 0) {
   					return false;
   				}
   				if (!$where_clause) {
   					$where_clause=array(
   						'order_id'=>$order_id
   						);
   				}
   			global $wpdb;
   			if ($order_id&&is_int($order_id)) {

            $result=$wpdb->update($wpdb->youpzt_order,$update_data,$where_clause);
            if ($result) {
                echo '1';
            }else{
                echo '0';
            }
        } 
   } 

   //删除订单
   public function delete_order($order_id){
		   	if ($order_id&&is_int($order_id)) {
		   		global $wpdb;
		   		$return_del=$wpdb->query($wpdb->prepare("DELETE FROM $wpdb->youpzt_order WHERE order_id=%d;",$order_id));
		   		if ($return_del) {
		   			$return_del_meta=$wpdb->query($wpdb->prepare("DELETE FROM $wpdb->youpzt_ordermeta WHERE youpzt_order_id=%d;",$order_id));//删除对应meta数据
		   		}
		   		return $return_del;
		   	}else{
		   		return false;
		   	}
   }
    //获取订单状态
   public function get_order_status($order_id){
   		if ($order_id&&is_int($order_id)) {
   			$order_status=$this->get_order_var('order_status','order_id',$order_id);
   			return $order_status;
   		}else{
   			return false;
   		}
   		
   }
   //获取订单变量
   public function get_order_var($get_order_var='order_status',$by='order_id',$by_var=null){
   	if ($get_order_var&&$by&&$by_var) {
	   		global $wpdb;
				$order_var_value = $wpdb->get_var("SELECT $get_order_var FROM {$wpdb->youpzt_order} WHERE $by=$by_var");
				return $order_var_value;
   	}
   		
   } 
}
?>
