<?php
/**
 * 显示产品详情内容content
 *
 * @see 	    http://www.youpzt.com
 * @author 		优品主题
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<?php while ( have_posts() ) : the_post(); ?>
  <div>
  		<div class="primary-page-img fl">
		<div class="sp-loading"><img src="<?php echo UPSTORE_PLUGIN_ASSETS_URI;?>images/sp-loading.gif" alt=""><br>LOADING IMAGES</div>
		<div class="sp-wrap">
			<a href="<?php echo UPSTORE_PLUGIN_ASSETS_URI;?>images/small_4kc.png"><img src="<?php echo UPSTORE_PLUGIN_ASSETS_URI;?>images/medium_p1.jpg" alt=""></a>
			<a href="<?php echo UPSTORE_PLUGIN_ASSETS_URI;?>images/small_4kc.png"><img src="<?php echo UPSTORE_PLUGIN_ASSETS_URI;?>images/medium_p1.jpg" alt=""></a>
			<a href="<?php echo UPSTORE_PLUGIN_ASSETS_URI;?>images/small_4kc.png"><img src="<?php echo UPSTORE_PLUGIN_ASSETS_URI;?>images/medium_p1.jpg" alt=""></a>
			<a href="<?php echo UPSTORE_PLUGIN_ASSETS_URI;?>images/small_4kc.png"><img src="<?php echo UPSTORE_PLUGIN_ASSETS_URI;?>images/medium_p1.jpg" alt=""></a>
			<a href="<?php echo UPSTORE_PLUGIN_ASSETS_URI;?>images/small_4kc.png"><img src="<?php echo UPSTORE_PLUGIN_ASSETS_URI;?>images/medium_p1.jpg" alt=""></a>
			<a href="<?php echo UPSTORE_PLUGIN_ASSETS_URI;?>images/small_4kc.png"><img src="<?php echo UPSTORE_PLUGIN_ASSETS_URI;?>images/medium_p1.jpg" alt=""></a>
		</div>
	</div>
	<div class="primary-products-information fl">
		<h3><?php the_title();?></h3>
		<p class="border-1 pb-20 color-6">
			<?php the_excerpt();?>
		</p>
		<div class="primary-products-information-lists color-6 border-1 pb-15">
			<ul>
				<li>主机×1</li>
				<li>电池×1</li>
				<li>使用手册×1</li>
			</ul>
		</div>
		<div class="primary-products-information-count mt-30">
			<span>数量：</span>
			<span class="ml-30">
				<input type="button" class="iconfont cp primary-category-goods-minus" value="&#xe60a;"/>
				<input class="primary-category-goods-count required" type="text" value="1"/>
				<input type="button" class="iconfont cp primary-category-goods-plus" value="&#xe60b;"/>
			</span>
		</div>
		<div class="primary-products-information-price mt-30">
			<span>价格：</span>
			<span class="ml-30 f24">¥<?php echo youpzt_get_product_price($post->ID);?></span>
			<span class="f12 ml-20"><s>市场价：</s></span>
			<span class="f12"><s>¥<?php echo youpzt_get_product_price($post->ID,'old_price');?></s></span>
		</div>
		<div class="primary-products-information-btn mt-50">
			<span class="border-green radius5 mr-20 cp">立即购买</span>
			<span class="border-blue radius5 add_to_cart cp" data-productid="<?php the_ID();?>">加入购物车</span>
		</div>
		<!-- 添加购物车提示 -->
		<div class="primary-add-carts-success hide p10">
			<h3 class="border-1 pb-20">您已成功添加到购物车</h3>
			 <p><span class="primary-add-carts-success-continue cp p10 mt-25 disinblock f14 radius5 tc">继续购物</span><span class="primary-add-carts-success-see p10 mt-25 disinblock f14 radius5 tc fr"><a href="###">查看购物车</a></span></p>
		</div>
	</div>
	<div class="cb"></div>
	</div>
		<!--商品描述-->
		<div class="primary-goods-information-describe mt-70 border-1 pb-20">
			<div id="tab_demo" class="HuiTab bt-1">
				<div class="tabBar cl pb-15 border-1 mb-15">
					<span>商品详情</span>
					<span>商品评论</span>
					<div class="cb"></div>
				</div>
				<div class="tabCon p10 mt-5">
					<h3>商品描述</h3>
					<div class="f14 mt-40">
					<?php the_content();?>
					</div>
					<h3 class="mt-40">图片描述</h3>
					<p class="f14 mt-40">
						<img src="<?php echo UPSTORE_PLUGIN_ASSETS_URI;?>images/medium_p1.jpg" />
					</p>
					
				</div>
				<div class="tabCon">
						<div id="comments">
								<?php comments_template(); ?>
							</div>
				</div>
			</div>
		</div>
		<?php endwhile; // end of the loop. ?>
