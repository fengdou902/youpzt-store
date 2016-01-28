
   <div class="primary-goods-bags ud-container mt-20 pb-20">
    		
    		<div class="col-sm-12 mt-10 p10">
    			<h4 class="border-1 pb-15">收获地址</h4>
    			<div class="primary-user-center-list f14 mt-40">
				<ul>
					<li class="col-sm-12  mb-20 pr">
						<div class="col-sm-1">李雷</div>
						<div class="col-sm-2">13999999999</div>
						<div class="col-sm-6">山东省济南市高新区</div>
						<div class="col-sm-3 tr address-select-phone"><input class="check-one check" type="radio" name="address_select"/div>
						<div class="cb"></div>
					</li>
					<li class="col-sm-12 mb-20 pr">
						<div class="col-sm-1">李雷</div>
						<div class="col-sm-2">13999999999</div>
						<div class="col-sm-6">山东省济南市高新区</div>
						<div class="col-sm-3 tr address-select-phone"><input class="check-one check" type="radio" name="address_select"/></div>
						<div class="cb"></div>
					</li>
					<div class="cb"></div>
				</ul>
				<div class="disinblock p10 border-green radius5 cp fl" id="primary-address-new">新增收获地址</div>
				<div class="disinblock p10 border-green radius5 cp fl ml-20"><a href="<?php echo youpztStore_get_tab_url('my-address');?>">管理收获地址</a></div>
				<div class="cb"></div>
    			</div>
    			<!--收获地址新建修改-->
    			<div class="primary-address-new pb-20">
    				<form id="address-edit-validate" method="post" action="" class="form-horizontal form" novalidate="novalidate">
			    		<div class="primary-login-title color-white f20">新建	收获地址</div>
			    		<div class="p10">
						<label class="form-label tr col-sm-4 col-sm-3 mt-20">收获地区：</label>
						<div class="formControls col-sm-8 col-sm-9">
							<div id="primary-city-secect" class="mt-10">
  								<select class="prov"></select> 
    								<select class="city" disabled="disabled"></select>
        							<select class="dist" disabled="disabled"></select>
    							</div>
						</div>
					</div>
					<div class="p10">
						<label class="form-label tr col-sm-4 col-sm-3 mt-20">详细地址：</label>
						<div class="formControls col-sm-8 col-sm-9">
							
							<textarea class="textarea radius5 mb-5 p10 mt-10" name="address_detailed"></textarea>
						</div>
					</div>
					<div class="p10">
						<label class="form-label tr col-sm-4 col-sm-3 mt-20">收件人：</label>
						<div class="formControls col-sm-8 col-sm-9">
							<input type="text" name="resginer_name" class="mb-5 input-text radius5 p10 mt-10 required" autocomplete="off" placeholder="请输入收件人姓名">
						</div>
					</div>
					<div class="p10">
						<label class="form-label tr col-sm-4 col-sm-3 mt-20">联系电话：</label>
						<div class="formControls col-sm-8 col-sm-9">
							<input type="text" name="address_tel" class="mb-5 input-text radius5 p10 mt-10 required" autocomplete="off" placeholder="请输入收件人联系电话">
						</div>
					</div>
					<div class="p10">
						<label class="form-label tr col-sm-4 col-sm-3 mt-20"></label>
						<div class="formControls col-sm-8 col-sm-9 mt-10">
							<label class="f14"><input class="check-one check" type="checkbox"/>设为默认收获地址</label>
						</div>
					</div>
					<div class="p10">
						<label class="form-label col-sm-4 col-sm-3 "></label>
						<div class="formControls col-sm-8 col-sm-9 mt-20">
							<input class="btn btn-default radius5" type="submit" value="确定">
						</div>
					</div>
		  </form>
    			</div>
    		</div>
    		<div class="col-sm-12 mt-50 p10">
    			<h4 class="border-1 pb-15">订单信息</h4>
    			<div class="primary-user-center-list f14 border-1">
    				<table>
    					<thead>
    						<tr>
    							<th class="tl">商品详情</th>
    							<th>数量</th>
    							<th>订单总额</th>
    							
    							
    						</tr>
    					</thead>
    					<tbody>
    						<tr class="tc">
    							<td class="tl">
    								<img class="fl" src="<?php echo UPSTORE_PLUGIN_ASSETS_URI;?>images/small_4kc.png" />
    								<div class="fl mt-10">
    									<p class="f14">大疆无人机4K智能飞行器</p>
    									<p class="color-8"><span class="mr-10">白色</span><span>标准版</span></p>
    								</div>
    							</td>
    							<td>1</td>
    							<td>¥4999</td>
    							
    							
    						</tr>
    						<tr class="tc">
    							<td class="tl">
    								<img class="fl" src="<?php echo UPSTORE_PLUGIN_ASSETS_URI;?>images/small_4kc.png" />
    								<div class="fl mt-10">
    									<p class="f16">大疆无人机4K智能飞行器</p>
    									<p class="color-8"><span class="mr-10">白色</span><span>标准版</span></p>
    								</div>
    							</td>
    							<td>1</td>
    							<td>¥4999</td>
    							
    							
    						</tr>
    					</tbody>
    				</table>
    			</div>
    			<div class="tr mt-30">
    				<span class="mr-40"><a href="#">返回购物修改</a></span>
    				<span>应付总额：<span class="color-green f20">¥4999</span></span>
    			</div>
    			<div class="tr mt-20 border-green p10-40 radius5 disinblock fr"><a class="show" href="#">结算</a></div>
    		</div>
            <div class="cb"></div>
    </div>