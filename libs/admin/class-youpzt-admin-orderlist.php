<?php

// WP_List_Table is not loaded automatically so we need to load it in our application
if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
/**
 * Create a new table class that will extend the WP_List_Table
 
 There are many things this class will do:
 Set the columns
Define hidden columns
Define sortable columns
Define what each column data is shown
Prepare the table items
Define the data
Sort data function
 */
class Order_List_Table extends WP_List_Table {
		public $order_slug='youpzt_store_orders';
	    /** ************************************************************************
     * REQUIRED. Set up a constructor that references the parent constructor. We 
     * use the parent reference to set some default configs.
     ***************************************************************************/
    function __construct(){
        global $status, $page;
                
        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'order',     //singular name of the listed records
            'plural'    => 'orders',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );
        
    }
	 function no_items() {
    _e( '无相关数据展示' );
  }
/**
     * Prepare the items for the table to process
     *
     * @return Void
     */
    public function prepare_items()
    {
		$columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();

        $data = $this->table_data();
			$totalItems = count($data);
		
        @usort( $data, array( &$this, 'sort_data' ) );

        $perPage = 20;//添加页码功能
        $currentPage = $this->get_pagenum();

        $this->set_pagination_args( array(
            'total_items' => $totalItems,
            'per_page'    => $perPage
        ) );

        $data = @array_slice($data,(($currentPage-1)*$perPage),$perPage);

        $this->_column_headers = array($columns, $hidden, $sortable);
		 /**
         * Optional. You can handle your bulk actions however you see fit. In this
         * case, we'll handle them within our package just to keep things clean.
         */
				$order_arr = isset($_GET['order_ids']) ? $_GET['order_ids'] : false;//获取订单号数组
        $this->process_bulk_action($order_arr);
        $this->items = $data;
		
    }
/**
     * Override the parent columns method. Defines the columns to use in your listing table
     *
     * @return Array
     */
    public function get_columns()
    {
        $columns = array(
							  'cb'=> '<input type="checkbox" />',//添加复选框         
							  'product_thumb' =>__( '缩略图' ),
							  'product_name' =>__( '产品名' ),	
							  'consumer' =>__( '购买用户' ),  
								'product_count' =>__( '数量' ),
								'total_price' =>__( '总价' ),
								'order_time'=>__( '订单日期' ),
								//'user_telphone'=>__( '联系电话' ),
								'order_status'=>__( '状态' ),	
								'youpzt_list_option'=>__('操作')
					        );

        return $columns;
    }

/**
     * Define which columns are hidden
     *
     * @return Array
     */
    public function get_hidden_columns()
    {
        //return array('year', 'director');
				return array();
    }
/**
     * Define the sortable columns
     *
     * @return Array
     */
    public function get_sortable_columns()
    {
        return array('id' => array('id', false),'order_id' => array('order_id', false));
    }

//添加复选框	
function column_cb($item){
	return sprintf(
		'<input type="checkbox" name="%1$s[]" value="%2$s" />',
		/*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
		/*$2%s*/ $item['id']                //The value of the checkbox should be the record's id
	);
}
function column_order_status($item){
	
	//Build row actions
	$actions = array(
		'edit'      => sprintf('<a href="/wp-admin/admin.php?page='.$order_slug.'&order_id=%d">Edit</a>',$item['order_id']),
		//'delete'    => sprintf('<a href="?page=%s&action=%s&movie=%s">Delete</a>',$_REQUEST['page'],'delete',$item['ID']),
	);
	switch($item['order_status']){
							case -1: echo '<span class="color-info">已取消</span>';break;
							case 0: echo '<span class="color-info">购物车</span>';break;
							case 1: echo '<span class="color-warning">待付款</span>';break;
							case 2: echo '<span class="color-primary">待发货</span>';break;
							case 3: echo '<span class="color-warning">已发货</span>';break;
							case 4: echo '<span class="color-success">完成已收货</span>';break;
							default: echo '<span class="color-info">暂无</span>';break;
	}	
	//Return the title contents
	return sprintf('%1$s %3$s',
		/*$1%s*/ $status_order,
		/*$2%s*/ $item['id'],
		/*$3%s*/ $this->row_actions($actions)
	);
}
//添加快速操作
function get_bulk_actions() {

		  $actions = array(
			'delete' => '删除'
		  );
		  return $actions;
	
}

/** ************************************************************************
 * Optional. You can handle your bulk actions anywhere or anyhow you prefer.
 * For this example package, we will handle it in the class to keep things
 * clean and organized.
 * 
 * @see $this->prepare_items()
 **************************************************************************/
function process_bulk_action($order_arr) {
	
	//Detect when a bulk action is being triggered...
	if( 'delete'===$this->current_action() ) {
		global $wpdb;
		foreach($order_arr as $order){//批量删除
			$wpdb->query($wpdb->prepare("DELETE FROM $wpdb->youpzt_order WHERE order_id =%d",$order));
		}
		echo "<script>window.location.href = \"/wp-admin/admin.php?page=orders_manage\" </script>";//重新刷新页面
	}
	
}
		/**
     * Get the table data
     *
     * @return Array
     */
private function table_data()
    {
		$status = isset($_GET['status']) ? $_GET['status'] : false;//获取订单状态
		$keywork=isset($_GET['keyword'])?$_GET['keyword']:false;
		global $wpdb,$current_user;
		//$query ="SELECT * FROM $wpdb->order where";
		switch($status){
					case 'moderated': $query = "SELECT * FROM $wpdb->youpzt_order where order_status=1";break;
					case 'approved': $query = "SELECT * FROM $wpdb->youpzt_order where order_status=2";break;
					case 'yifahuo': $query = "SELECT * FROM $wpdb->youpzt_order where order_status=3";break;
					case 'yiwancheng': $query = "SELECT * FROM $wpdb->youpzt_order where order_status=4";break;
					case 'trash': $query = "SELECT * FROM $wpdb->youpzt_order where order_status=0";break;
					case 'product': {
											$productid = isset($_GET['product_id']) ? $_GET['product_id'] : false;//获取订单状态
											$query = "SELECT * FROM $wpdb->youpzt_order where product_id=".$productid;
										};break;
					case 'search': $query = "SELECT * FROM $wpdb->youpzt_order where order_number=".$keywork;break;
					default: $query = "SELECT * FROM $wpdb->youpzt_order where order_status not in (-1) and product_id>0";break;
		}

		//$query .= " WHERE post_status='publish' AND meta_key='".WPFP_META_KEY."' AND meta_value > 0 ORDER BY ROUND(meta_value) DESC LIMIT 0, $nums";
		$query.=' order by order_date desc;';
		$results = $wpdb->get_results($query);//客户查询的结果集
			$data=array();
		if ($results) {
			foreach ($results as $order):	
					array_push($data,array(
											'order_id' =>$order->order_id,
						          'product_id' => $order->product_id,
											'order_number'=>$order->order_number,
						          'consumer'=>$order->order_buyer,
						          'order_status'=>$order->order_status,
											'order_time'=>$order->order_date
									));
			endforeach;
			
        return $data;
		}
  }
	
	// Used to display the value of the id column
			/*
		Set The Column Data
		So far we have defined the columns and defined the data we can use but now we need to define what data each column will display. There are two ways of doing this you can create a method for each column column_{column_key_name}().	
			*/
		public function column_id($item)
		{
			return $item['id'];
		}
/**
     * Define what data to show on each column of the table
     *
     * @param  Array $item        Data
     * @param  String $column_name - Current column name
     *
     * @return Mixed
     */
    public function column_default( $item, $column_name )
    {
        switch( $column_name ) {
						case 'product_thumb':
								$post_id=$item['product_id'];
						   if( has_post_thumbnail($post_id) ){    //如果有缩略图，则显示缩略图
					        $timthumb_src_arr = wp_get_attachment_image_src(get_post_thumbnail_id($post_id),'full');
					        $timthumb_src=$timthumb_src_arr[0];
					      }else{
					      	$product_gallery=get_post_meta($post_id,'product_gallery',true);
						  				if ($product_gallery) {
														//$attachment_img=wp_get_attachment_image($product_gallery[0], 'large');
						  							$attachment_src=wp_get_attachment_image_src($product_gallery[0], 'full' );
						  							//$post_timthumb ='<img src="'.youpzt_timthumb($attachment_src[0],300,300).'" >';
						  							$timthumb_src=$attachment_src[0];
						  				}else{
						  					$timthumb_src=get_bloginfo("template_url").'/images/noimage-thumbnail.jpg';
						  				}
					      	
					      }
					      echo '<a href="admin.php?page=paimai_order_manage&status=product&productid='.$post_id.'" title="查询该产品订单"><img src="'.$timthumb_src.'" class="product_thumb" width="70" height="60">';
								break;

						case 'consumer':{
									return get_the_author_meta('display_name', $item['consumer']);
								}break;
						case 'total_price':{
										return get_order_meta($item['order_id'],'total_price',true).'元';
								}break;
						case 'product_count':{
										return get_order_meta($item['order_id'],'product_count',true);
								}break;
						case 'product_name':{
									$product_obj=get_post($item['product_id']);
									return '<a href="'.get_permalink( $item['product_id'] ).'" target="_blank">'.$product_obj->post_title.'</a>';
									}
									break;
            case 'order_status':{
									switch($item[ $column_name]){
										case -1: echo '<span class="color-info">已取消</span>';break;
										case 0: echo '<span class="color-info">购物车</span>';break;
										case 1: echo '<span class="color-warning">待付款</span>';break;
										case 2: echo '<span class="color-primary">待发货</span>';break;
										case 3: echo '<span class="color-warning">已发货</span>';break;
										case 4: echo '<span class="color-success">完成已收货</span>';break;
										default: echo '<span class="color-info">暂无</span>';break;
									}						
								}
								
							break;
							case 'youpzt_list_option':{
											return '<a href="/wp-admin/admin.php?page=orders_manage&order_id='.$item['order_id'].'">查看编辑</a>  ';
											//<a href="?page=paimai_order_manage&action=delete&order['.$item['id'].']"><abbr title="删除" rel="tooltip"><i class="iconfont icon-clean fb f20"></i></abbr></a>
										}
							break;
				            case 'user_id':
										case 'order_time':
				                return $item[ $column_name ];

				            default:
				                return print_r( $item, true ) ;
				        }
    }
//数据排序

/**
     * Allows you to sort the data by the variables set in the $_GET
     *
     * @return Mixed
     */
    private function sort_data( $a, $b )
    {
        // Set defaults
        $orderby = 'order_time';
        $order = 'desc';

        // If orderby is set, use this as the sort column
        if(!empty($_GET['orderby']))
        {
            $orderby = $_GET['orderby'];
        }

        // If order is set use this as the order
        if(!empty($_GET['order']))
        {
            $order = $_GET['order'];
        }

        $result = strnatcmp( $a[$orderby], $b[$orderby] );

        if($order === 'asc')
        {
            return $result;
        }

        return -$result;
    }

} //class