<?php 
$current_user = wp_get_current_user();
// Tabs
$top_tabs = array(
    'cart' => __('购物车','youpzt'),
    'checkout' => __('结算','youpzt'),
    'my-orders' => __('我的订单','youpzt'),
    'my-address' => __('我的地址','youpzt'),
);

foreach( $top_tabs as $tab_key=>$tab_value ){
    if( $tab_key ) $tab_array[] = $tab_key;
}

$get_tab = isset($_GET['tab']) && in_array($_GET['tab'], $tab_array) ? $_GET['tab'] : 'my-orders';//获取tab
get_header();

if ($get_tab=='my-orders') {
    include(UPSTORE_PLUGIN_DIR.'/templates/my-orders.php');
}elseif($get_tab=='checkout'){
    include(UPSTORE_PLUGIN_DIR.'/templates/checkout.php');
}elseif($get_tab=='cart') {
    include(UPSTORE_PLUGIN_DIR.'/templates/cart.php');
}elseif($get_tab=='my-address') {
    include(UPSTORE_PLUGIN_DIR.'/templates/my-address.php');
}

get_footer();?>