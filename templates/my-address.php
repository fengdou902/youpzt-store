    <div class="primary-goods-bags ud-container mt-20 pb-20">
    		<div class="col-sm-2 primary-user-center">
    			<ul>
    				<li><a href="#"><i class="iconfont">&#xe605;</i>全部订单</a></li>
    				<li><a href="#"><i class="iconfont">&#xe60c;</i>待发货</a></li>
    				<li><a href="#"><i class="iconfont">&#xe604;</i>已发货</a></li>
    				<li><a href="#"><i class="iconfont">&#xe608;</i>待付款</a></li>
    				<li><a href="#"><i class="iconfont">&#xe60e;</i>待收货</a></li>
    				<li><a href="#"><i class="iconfont">&#xe609;</i>已完成</a></li>
    			</ul>
    			<ul class="mt-40">
    				<li><a href="#"><i class="iconfont">&#xe603;</i>收获地址</a></li>
    			</ul>
    		</div>
    		<div class="col-sm-10 mt-10">
    			<h4 class="border-1 pb-15">收获地址</h4>
    			<div class="primary-user-center-list f14 mt-40">
				<ul>
					<li class="col-sm-12  mb-20">
						<div class="col-sm-1">李雷</div>
						<div class="col-sm-2">13999999999</div>
						<div class="col-sm-6">山东省济南市高新区</div>
						<div class="col-sm-3 "><i class="iconfont fr f20 cp primary-address-del-tips">&#xe613;</i><i class="iconfont fr f20 cp mr-10 primary-address-set-tips">&#xe60f;</i><i class="iconfont fr f20 mr-10 cp primary-address-edit-tips" onclick="primary_address_edit()">&#xe611;</i></div>
						<div class="cb"></div>
					</li>
					<li class="col-sm-12 mb-20">
						<div class="col-sm-1">李雷</div>
						<div class="col-sm-2">13999999999</div>
						<div class="col-sm-6">山东省济南市高新区</div>
						<div class="col-sm-3"><i class="iconfont fr f20 cp primary-address-del-tips">&#xe613;</i><i class="iconfont fr f20 cp mr-10 primary-address-set-tips">&#xe60f;</i><i class="iconfont fr f20 mr-10 cp primary-address-edit-tips" onclick="primary_address_edit()">&#xe611;</i></div>
						<div class="cb"></div>
					</li>
					<div class="cb"></div>
				</ul>
				<div class="disinblock p10 border-green radius5 cp" id="primary-address-new">新增收获地址</div>
    			</div>
    			<!--收获地址新建修改-->
    			<div class="primary-address-new pb-20">
    				<form id="address-edit-validate" method="post" action="" class="form-horizontal form" novalidate="novalidate">
			    		<div class="primary-login-title color-white f20">修改收获地址</div>
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
						<label class="form-label col-sm-4 col-sm-3 "></label>
						<div class="formControls col-sm-8 col-sm-9 mt-20">
							<input class="btn btn-default radius5" type="submit" value="修改">
						</div>
					</div>
		  </form>
    			</div>
    		</div>
    		<div class="cb"></div>
    </div>