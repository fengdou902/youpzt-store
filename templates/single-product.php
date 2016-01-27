<?php
/**
 * 显示产品详情内容
 *
 * @see 	    http://www.youpzt.com
 * @author 		优品主题
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>
<script type="text/javascript">
	var YOUPZT_HOME_URL="<?php echo home_url();?>";//首页url
	
</script>
	<?php
		do_action( 'youpztStore_before_main_content' );
	?>
<div class="content-area twentysixteen">
 <!--商品详情-->
    <div class="primary-goods-information ud-container pt-20">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php youpztStore_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>
				<!--相关商品-->
		<?php 
		$args = array(
				'posts_per_page' =>6,
				'columns'        => 2,
				'orderby'        =>'rand',
			);

		$defaults = array(
			'posts_per_page' => 2,
			'columns'        => 2,
			'orderby'        => 'rand'
		);

		$args = wp_parse_args( $args, $defaults );
		youpztStore_get_template( 'single-product/related.php', $args );?>
    </div>
</div>
	<?php
		/**
		 * 后置内容
		 */
		do_action( 'youpztStore_after_main_content' );
	?>

	<?php
		/**
		 * 加载侧边栏内容
		 */
	get_sidebar();
	?>

<?php get_footer(); ?>
