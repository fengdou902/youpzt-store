<?php
// 产品展示
function post_type_products() {
register_post_type(
		 'product', 
		 array( 'labels'=>array(
				'name' => _x('产品', 'post type general name'),
				'singular_name' => _x('所有产品', 'post type singular name'),
				'add_new' => _x('添加产品', 'addProducts'),
				'add_new_item' => __('添加产品'),
				'edit_item' => __('编辑产品'),
				'new_item' => __('新的产品'),
				'view_item' => __('预览产品'),
				'search_items' => __('搜索产品'),
				'not_found' =>  __('您还没有发布产品'),
				'not_found_in_trash' => __('回收站中没有产品'), 
				'parent_item_colon' => ''
				),
				'description'=>'发布产品',
				'public' => true,
				'publicly_queryable' => true,
				'hierarchical' => false,
				 'show_ui' => true,
				 'menu_icon'=>'dashicons-cart',
				 'menu_position'=>8,
				'supports' => array(
						'title',
						//'author', 
						'excerpt',
						'thumbnail',
						//'trackbacks',
						'editor', 
						'comments'
						//'custom-fields',
						//'revisions'	
						) ,
				) 
		  ); 

} 
add_action('init', 'post_type_products');

function create_products_taxonomy() 
{
  $labels = array(
		  'name' => _x( '产品分类', 'taxonomy general name' ),
		  'singular_name' => _x( 'product_cat', 'taxonomy singular name' ),
		  'search_items' =>  __( '搜索分类' ),
		  'all_items' => __( '全部分类' ),
		  'parent_item' => __( '父级分类目录' ),
		  'parent_item_colon' => __( '父级分类目录:' ),
		  'edit_item' => __( '编辑产品分类' ), 
		  'update_item' => __( '更新' ),
		  'add_new_item' => __( '添加新产品分类' ),
		  'new_item_name' => __( 'New Genre Name' ),
); 
  
  register_taxonomy('product_cat',array('product'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'product_cat' ),
  ));
// Tags
	register_taxonomy(
		'product_tag','product',
		array(
			'hierarchical' => false,//提示：'hierarchical' => false 是指将分类（categories）转化成标签（tags）。
			'label' => '产品标签',
			'query_var' => true,
			'rewrite' => true
		)
	);
}
add_action( 'init', 'create_products_taxonomy', 0 );
//定义文章列表列
add_filter( 'manage_edit-product_columns', 'set_custom_edit_product_columns',1);
add_action( 'manage_product_posts_custom_column' , 'custom_product_column', 10, 2 );

function set_custom_edit_product_columns($columns) {
    unset( $columns['author'] );
	$newcolumns = array(
        'cb' => $columns['cb'],
        'product_thumb'=>'缩略图',
				'title'=>'产品名',
				'product_author'=>'作者',
        'product_cat' => __( '产品分类' ),
        'product_tag' => __( '产品标签' ),
        'product_type' => __( '产品类型' ),
				'id'=>'编号'
    );
    return $newcolumns;
}

function custom_product_column( $column, $post_id ) {
    switch ( $column ) {
    		case 'product_thumb':
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
		      echo '<a href="admin.php?page=paimai_order_manage&status=product&productid='.$post_id.'" title="查询该产品订单"><img src="'.$timthumb_src.'" class="product_thumb" width="150" height="130">';
		     break;
		case 'id':
		      echo $post_id;
		     break;
		case 'product_author':
		      $author_id=get_post($post_id)->post_author;
		      echo '<a href="edit.php?post_type=product&author='.$author_id.'">'.get_the_author_meta('display_name',$author_id).'</a>';
		     break;
		case 'product_cat':
			$productcat = get_the_terms($post_id,'product_cat');
			if ( $productcat && ! is_wp_error( $productcat ) ) : 
			foreach ( $productcat as $term ) {//遍历输出分类
				echo '<a href="edit.php?post_type=product&product_cat='.$term->slug.'">'.$term->name.'</a>';
			}
			endif;
			break;
		case 'product_tag':
			$producttag = get_the_terms($post_id,'product_tag');
			if ( $producttag && ! is_wp_error( $producttag ) ) : 
			foreach ( $producttag as $term ) {//遍历输出标签
				echo '<a href="edit.php?post_type=product&product_tag='.$term->slug.'">'.$term->name.'</a>，';
			}
			endif;
			break;
    case 'product_type' :
    			$product_type=get_post_meta($post_id,'product_type',true);
          if ($product_type=='in'||!$product_type) {
          	echo '站内商品';
          }elseif ($product_type=='out') {
          	$product_out_url=get_post_meta($post_id,'product_out_url',true);
          	echo '<a href="'.$product_out_url.'">站外商品</a>';
          }
          break;	

    }
}

?>