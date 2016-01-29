<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}
/**
 * 用户地址管理
 * @date      2016.01.28
 *from www.youpzt.com
 * @author    ZhaoJunfeng
**/

//配送地址类
class Youpzt_Address {

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
     * 删除地址
     *@param $address_id地址id
     * @access  public
     * @return  bool
     */
    public function delete_address($address_id){
        if ($address_id) {
           $return_del=$wpdb->query($wpdb->prepare("DELETE FROM $wpdb->youpzt_address WHERE id =%d",$address_id));
           return $return_del;
        }  
    }
    //添加地址
    public function insert_address($address_item=array()){
      if(!is_array($address_item)||count($address_item) == 0) {
            return false;
          }
      global $wpdb;
      $insert_dz_return=$wpdb->insert($wpdb->youpzt_address,array(
                                      'user_id'=>$this->user_id,
                                      'city'=>$address_item['city'],                                       
                                      'address_detail'=>$address_item['address_detail'],
                                      'contact_name'=>$address_item['contact_name'],
                                      'zipcode'=>$address_item['zipcode'],
                                      'telphone'=>$address_item['telphone']
                                  ),
                                  array('%d','%s','%s','%s','%s','%s'));
      return $insert_dz_return;
    }

}
?>