<?php get_header();?>
    <!--购物车-->
    <div class="primary-goods-bags ud-container mt-40">
    		<div class="catbox">
				<div class="table-responsive">
					<table id="cartTable">
						<thead>
							<tr>
								<th class="primary-category-bags-disno "><label class="primary-category-bags-disno"><input class="check-all check" type="checkbox"/>&nbsp;全选</label></th>
								<th>商品详情</th>
								<th class="tc primary-category-bags-disno">单价</th>
								<th class="tc">数量</th>
								<th class="tc">小计</th>
								<th class="tc">操作</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="checkbox primary-category-bags-disno"><input class="check-one check" type="checkbox"/></td>
								<td class="primary-bags-goods"><img class="primary-category-bags-disno" src="images/small_4kc.png" alt=""/><span>Casio/卡西欧 EX-TR350</span></td>
								<td class="price primary-category-bags-disno">5999.88</td>
								<td class="count"><span class="primary-bags-count-reduce"></span><input class="count-input" type="text" value="1"/><span class="primary-bags-count-add">+</span></td>
								<td class="subtotal">5999.88</td>
								<td class="operation"><span class="primary-bags-delete">×</span></td>
							</tr>
							<tr>
								<td class="checkbox primary-category-bags-disno"><input class="check-one check" type="checkbox"/></td>
								<td class="primary-bags-goods"><img class="primary-category-bags-disno" src="images/small_4kc.png" alt=""/><span>Canon/佳能 PowerShot SX50 HS</span></td>
								<td class="price primary-category-bags-disno">3888.50</td>
								<td class="count"><span class="primary-bags-count-reduce"></span><input class="count-input" type="text" value="1"/><span class="primary-bags-count-add">+</span></td>
								<td class="subtotal">3888.50</td>
								<td class="operation"><span class="primary-bags-delete">×</span></td>
							</tr>
							
							
						</tbody>
					</table>
				</div>
		
		<div class="foot" id="foot">
			<label class="fl select-all"><input type="checkbox" class="check-all check"/>&nbsp;全选</label>
			<a class="fl delete" id="deleteAll" href="javascript:;"><i class="iconfont f20">&#xe602;</i></a>
			<div class="fr">
				<div class="fl selected" id="selected">已选商品<span id="selectedTotal">0</span>件<span class="arrow up"><!--︽--></span><span class="arrow down">︾</span></div>
				<div class="fl total">合计：￥<span id="priceTotal">0.00</span></div>
				
				<div class="selected-view">
					<div id="selectedViewList" class="clearfix">
						<div><img src="images/1.jpg"><span>取消选择</span></div>
					</div>
					<span class="arrow">◆<span>◆</span></span>
				</div>
				<div class="fr closing">结 算</div>
			</div>
		</div>

	</div>
</div>
<?php get_footer();?>