<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'YoupztStore_Admin_Menus' ) ) :
include(UPSTORE_PLUGIN_DIR.'/libs/admin/class-youpzt-admin-orderlist.php');
/**
 * WC_Admin_Menus Class.
 */
class YoupztStore_Admin_Menus {

		/**
	 * Hook in tabs.
	 */
	public function __construct() {
	// Add menus
		add_action( 'admin_menu', array( $this, 'display_store_menus'));
		add_action( 'admin_head', array( $this, 'menu_order_count' ) );
	}

	/**
	 * Add menu items.
	 */
	public function display_store_menus() {
		global $menu;
 		add_menu_page('优品商城', '优品商城', 'administrator','youpzt_store',null,'dashicons-welcome-view-site','55.5');
 		$this->store_add_submenu_page('orders','订单管理');
 		$this->store_add_submenu_page('reports','报表统计');
 		$this->store_add_submenu_page('tools','工具');

	}
	/**
	 * 添加子菜单
	 */
	public function store_add_submenu_page($key, $title, $slug='', $cap='administrator'){
			if(!$slug) $slug = 'youpzt_store_'.$key;
			add_submenu_page( 'youpzt_store', $title, $title, $cap, $slug, array($this,'youpzt_store_'.str_replace('-', '_', $key).'_page'));
		}
	/**
	 * Adds the order processing count to the menu.
	 */
	public function menu_order_count() {
		global $submenu;

		if ( isset( $submenu['youpzt_store'] ) ) {
			// Remove 'WooCommerce' sub menu item
			unset( $submenu['youpzt_store'][0] );

			// Add count if user has access
			if ( apply_filters( 'woocommerce_include_processing_order_count_in_menu', true ) && current_user_can( 'manage_youpztstore' ) && ( $order_count = wc_processing_order_count() ) ) {
				foreach ( $submenu['youpzt_store'] as $key => $menu_item ) {
					if ( 0 === strpos( $menu_item[0], _x( 'Orders', 'Admin menu name', 'woocommerce' ) ) ) {
						$submenu['youpzt_store'][ $key ][0] .= ' <span class="awaiting-mod update-plugins count-' . $order_count . '"><span class="processing-count">' . number_format_i18n( $order_count ) . '</span></span>';
						break;
					}
				}
			}
		}
	}
	/*
	*订单页面
	*/
	public function youpzt_store_orders_page(){
		$order_slug='youpzt_store_orders';
		$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : false;//获取订单号
	  if(!isset($_GET['order_id'])){
			$status = isset($_GET['status']) ? $_GET['status'] : false;//获取订单状态
          $orderListTable = new Order_List_Table();//new出这个类将要决定我们的数据如何显示
          $orderListTable->prepare_items();?>
          <div class="wrap">
          <h2 class="nav-tab-wrapper" class="clearfix">订单管理</h2>
          <ul class="subsubsub">
			    <?php 
			    global $wpdb,$current_user;
			    $query = "SELECT order_status FROM $wpdb->youpzt_order";

			  //echo $query;
			    $status_obj=$wpdb->get_col($query,0);
			    //var_dump($status_obj);
			    $daifukuan=$daifahuo=$huishou=$yifahuo=$yiwancheng='';
			    foreach($status_obj as $o_status){//计算状态
			      switch($o_status){
			        case 1: $daifukuan++;break;
			        case 2: $daifahuo++;break;
			        case 3: $yifahuo++;break;
			        case 4: $yiwancheng++;break;
			        case 0:
			        case -1:
			          $huishou++;break;
			      }
			    }

			    if(!$daifukuan) $daifukuan=0;
			    if(!$daifahuo) $daifahuo=0;
			    if(!$yifahuo) $yifahuo=0;
			    if(!$yiwancheng) $yiwancheng=0;
			    if(!$huishou) $huishou=0;
			    ?>
      <li class="all"><a href="?page=<?php echo $order_slug;?>" <?php if(!$status){echo 'class="current"';};?>>全部</a> |</li>
      <li class="moderated"><a href="?page=<?php echo $order_slug;?>&status=moderated" <?php if($status=='moderated'){echo 'class="current"';};?>>待付款<span class="count">（<span class="pending-count"><?php echo $daifukuan;?></span>）</span></a> |</li>
      <li class="approved"><a href="?page=<?php echo $order_slug;?>&status=approved" <?php if($status=='approved'){echo 'class="current"';};?>>待发货<span class="count">（<span class="spam-count"><?php echo $daifahuo;?></span>）</span></a> |</li>
      <li class="yifahuo"><a href="?page=<?php echo $order_slug;?>&status=yifahuo" <?php if($status=='yifahuo'){echo 'class="current"';};?>>已发货<span class="count">（<span class="spam-count"><?php echo $yifahuo;?></span>）</span></a> |</li>
      <li class="yiwancheng"><a href="?page=<?php echo $order_slug;?>&status=yiwancheng" <?php if($status=='yiwancheng'){echo 'class="current"';};?>>已完成<span class="count">（<span class="spam-count"><?php echo $yiwancheng;?></span>）</span></a> |</li>
      <!--<li class="trash"><a href="?page=<?php echo $order_slug;?>&status=trash" <?php //if($status=='trash'){echo 'class="current"';};?>>回收站<span class="count">（<span class="trash-count"><?php //echo $huishou;?></span>）</span></a></li>-->
    </ul>
      <form method="get" action="admin.php">
      <input type="hidden" name="status" value="search">
        <input type="hidden" name="page" value="orders_manage" />
        <p class="search-box">
            <label class="screen-reader-text" for="search_id-search-input">search:</label>
            <?php 
              $keywork=isset($_GET['keyword'])?$_GET['keyword']:false;
            ?>
            <input type="search" id="search_id-search-input" name="keyword" value="<?php echo $keywork;?>" placeholder="输入订单号">
            <input type="submit" id="search-submit" class="button" value="查询">
        </p>
      </form><!--搜索框-->
            <form id="uploads-filter" method="get">
            <!-- For plugins, we also need to ensure that the form posts back to our current page -->
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <!-- Now we can render the completed list table -->
          <?php $orderListTable->display(); ?>
            </form>     
        </div>
    <?php 
    }elseif ($order_id) {
    	include(UPSTORE_PLUGIN_DIR.'/libs/admin/order-info.php');
    }
	}


}
endif;

return new YoupztStore_Admin_Menus();

