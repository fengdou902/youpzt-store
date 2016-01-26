<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/*
*优品商城 cart
*from www.youpzt.com
*/
class Youpzt_Cart {
	public $is_logined=0;//登录用户使用数据库存储，非登录使用session
	public $cart_contents = array();
	public $total;//购物车中的总价
	public $subtotal;//购物车中的某个商品的总价
	private $debug = false;

		/**
     * 构造函数
     *
     * @param array
     */
    public function __construct() {
        //是否第一次使用?
        if(isset($_SESSION['cart_contents'])) {
            $this->cart_contents = $_SESSION['cart_contents'];
        }else {
            $this->cart_contents['cart_total'] = 0;
            $this->cart_contents['total_items'] = 0;
        }
         
        if($this->debug === TRUE) {
            $this->_log("cart_create_success");
        }
    }
    /**
     * 将物品加入购物车
     *
     * @access  public
     * @param   array   一维或多维数组,必须包含键值名: 
                        id -> 产品ID标识, 
                        qty -> 数量(quantity), 
                        price -> 单价(price), 
                        name -> 产品名称
     * @return  bool
     */
    public function insert_items($items = array()) {
        //输入物品参数异常
        if( ! is_array($items)||count($items) == 0) {
            if($this->debug === TRUE) {
                $this->_log("cart_no_items_insert");
            }
            return FALSE;
        }
				//物品参数处理
        $save_cart = FALSE;
        if(isset($items['id'])) {
            if($this->_insert($items) === TRUE) {
                $save_cart = TRUE;
            }
        } else {
            foreach($items as $val) {
                if(is_array($val)&&isset($val['id'])) {
                    if($this->_insert($val) == TRUE) {
                        $save_cart = TRUE;
                    }
                }
            }
        }
 				//当插入成功后保存数据到session
        if($save_cart) {
            if ($this->is_logined==1) {//登录
	            $this->_save_cart('sql');
	          }elseif ($this->is_logined==0) {//未登录
	          	$this->_save_cart('session');
	          }
            return TRUE;
        }
         
        return FALSE;

       }

    /**
     * 更新购物车物品信息
     *
     * @access  public
     * @param   array
     * @return  bool
     */
    public function update($items = array()) {
        //输入物品参数异常
        if( !is_array($items) OR count($items) == 0) {
            if($this->debug === TRUE) {
                $this->_log("cart_no_items_insert");
            }
            return FALSE;
        }
         
        //物品参数处理
        $save_cart = FALSE;
        if(isset($items['id'])&&isset($items['qty'])) {
            if($this->_update($items) === TRUE) {
                $save_cart = TRUE;
            }
        } else {
            foreach($items as $val) {
                if(is_array($val)&&isset($val['id'])&&isset($val['qty'])) {
                    if($this->_update($val) === TRUE) {
                        $save_cart = TRUE;
                    }
                }
            }
        }
         
        //当更新成功后保存数据
        if($save_cart) {
        	if ($this->is_logined==1) {//登录
            $this->_save_cart('sql');
          }elseif ($this->is_logined==0) {//未登录
          	$this->_save_cart('session');
          }
            return TRUE;
        }
         
        return FALSE;
    }

    /**
     * 插入数据
     *
     * @access  private 
     * @param   array
     * @return  bool
     */
    private function _insert($items = array()) {
        //输入物品参数异常
        if( ! is_array($items) OR count($items) == 0) {
            if($this->debug === TRUE) {
                $this->_log("cart_no_data_insert");
            }
            return FALSE;
        }
         
        //如果物品参数无效（无id/qty/price/name）
        if( ! isset($items['id']) OR ! isset($items['qty']) OR ! isset($items['price']) OR ! isset($items['name'])) {
            if($this->debug === TRUE) {
                $this->_log("cart_items_data_invalid");
            }
            return FALSE;
        }
          //去除物品数量左零及非数字字符
        $items['qty'] = trim(preg_replace('/([^0-9])/i', '', $items['qty']));
        $items['qty'] = trim(preg_replace('/^([0]+)/i', '', $items['qty']));
         
        //如果物品数量为0，或非数字，则我们对购物车不做任何处理!
        if( ! is_numeric($items['qty']) OR $items['qty'] == 0) {
            if($this->debug === TRUE) {
                $this->_log("cart_items_data(qty)_invalid");
            }
            return FALSE;
        }
        //如果物品单价非数字
        if( ! is_numeric($items['price'])) {
            if($this->debug === TRUE) {
                $this->_log("cart_items_data(price)_invalid");
            }
            return FALSE;
        }
        //加入物品到购物车
        if ($this->is_logined==0) {//未登录
        	 //生成物品的唯一id
	        if(isset($items['options']) AND count($items['options']) >0) {
	            $rowid = md5($items['id'].implode('', $items['options']));
	        } else {
	            $rowid = md5($items['id']);
	        }
	         
	        //加入物品到购物车
	        unset($this->cart_contents[$rowid]);
	        $this->cart_contents[$rowid]['rowid'] = $rowid;
	        foreach($items as $key => $val) {
	            $this->cart_contents[$rowid][$key] = $val;
	        }
        }elseif ($this->is_logined==1) {
        	
        }
        return TRUE;

    }

     /**
     * 更新购物车物品信息（私有）
     *
     * @access  private
     * @param   array
     * @return  bool
     */
    private function _update($items = array()) {
				//输入物品参数异常
        if( ! isset($items['rowid']) OR ! isset($items['qty']) OR ! isset($this->cart_contents[$items['rowid']])) {
            if($this->debug == TRUE) {
                $this->_log("cart_items_data_invalid");
            }
            return FALSE;
        }
         
        //去除物品数量左零及非数字字符
        $items['qty'] = preg_replace('/([^0-9])/i', '', $items['qty']);
        $items['qty'] = preg_replace('/^([0]+)/i', '', $items['qty']);
         
        //如果物品数量非数字，对购物车不做任何处理!
        if( ! is_numeric($items['qty'])) {
            if($this->debug === TRUE) {
                $this->_log("cart_items_data(qty)_invalid");
            }
            return FALSE;
        }
        //如果购物车物品数量与需要更新的物品数量一致，则不需要更新
        if($this->cart_contents[$items['rowid']]['qty'] == $items['qty']) {
            if($this->debug === TRUE) {
                $this->_log("cart_items_data(qty)_equal");
            }
            return FALSE;
        }
         
        //如果需要更新的物品数量等于0，表示不需要这件物品，从购物车种清除
        //否则修改购物车物品数量等于输入的物品数量
        if($items['qty'] == 0) {
            unset($this->cart_contents[$items['rowid']]);
        } else {
            $this->cart_contents[$items['rowid']]['qty'] = $items['qty'];
        }
    	return TRUE;
    }

        /**
     * 保存购物车数据到session或数据库
     * 
     * @access  private
     * @return  bool
     */
    private function _save_cart($type='session') {
    	if ($type=='session') {
        //首先清除购物车总物品种类及总金额
        unset($this->cart_contents['total_items']);
        unset($this->cart_contents['cart_total']);
         
        //然后遍历数组统计物品种类及总金额
        $total = 0;
        foreach($this->cart_contents as $key => $val) {
            if( ! is_array($val) OR ! isset($val['price']) OR ! isset($val['qty'])) {
                continue;
            }
             
            $total += ($val['price'] * $val['qty']);
             
            //每种物品的总金额
            $this->cart_contents[$key]['subtotal'] = ($val['price'] * $val['qty']);
        }
         
        //设置购物车总物品种类及总金额
        $this->cart_contents['total_items'] = count($this->cart_contents);
        $this->cart_contents['cart_total'] = $total;
         
        //如果购物车的元素个数少于等于2，说明购物车为空
        if(count($this->cart_contents) <= 2) {
            unset($_SESSION['cart_contents']);
            return FALSE;
        }
         
        //保存购物车数据到session
        $_SESSION['cart_contents'] = $this->_cart_contents;
      }elseif ($type=='sql') {//保存到数据库中
      	
      }
      return TRUE;
    }
		/**
     * 日志记录
     *
     * @access  private
     * @param   string
     * @return  bool
     */
    private function _log($msg) {
        return @file_put_contents('cart_err.log', $msg, FILE_APPEND);
    }

}
?>
