<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/*
*获取产品价格（优先缓存）
*@param int $product_id 产品id
*@param string $type 价格类型（售价sale_price，原价old_price）
*/
function youpzt_get_product_price($product_id,$type="sale_price"){
    if (!$product_id) {
        return false;
    }
    return youpzt_get_product_data($product_id,$type);
}
/*获取产品数据（直接数据库中提取）
*@param int $product_id 产品id
*@param string $type 数据类型
*/
function youpzt_get_product_data($product_id,$type){
    if (!$product_id) {
        return false;
    }
    $product_data=get_post_meta($product_id,'youpzt_store_product_data',true);
    if (is_string($product_data)) {
        $product_data=unserialize($product_data);
    }  
    if (!$type) {
        return $product_data;
    }else{
        return $product_data[$type];
    }
}
?>
