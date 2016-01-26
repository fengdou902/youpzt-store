<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>优的电商插件</title>
    <link rel="stylesheet" href="css/normalize.css" />
    <link href="css/h-ui.css" rel="stylesheet">
    	<link rel="stylesheet" href="css/base.css" />
    <link rel="stylesheet" href="css/icheck/icheck.css" />
    <link rel="stylesheet" href="css/smoothproducts.css" /><!--商品放大显示-->
    	<link rel="stylesheet" href="css/style.css" />
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <header class="primary-top w">
    		<div class="container p15 f14 color-white">
	    		<ul class=" fr">
	    			<li class="pr cp"><i class="iconfont mr-20 f16 primary-search">&#xe601;</i>
	    				<div class="primary-top-search pa"><form><input type="text" placeholder="搜索..."/></form></div>
	    			</li>
	    			<li class="pr cp"><i class="primary-bags iconfont mr-20 f16">&#xe600;</i>
	    				<div class="primary-top-bags pa">
	    					<ul>
	    						<li>大疆无人机4K</li>
	    						<li>大疆无人机2.7k</li>
	    					</ul>
	    					<div class="primary-top-bags-btn mt-25"><span class="radius5 mr-20 tc"><a href="###">查看购物车</a></span><span class="radius5 tc"><a href="###">结算</a></span></div>
	    				</div>
	    			</li>
	    			<li class="mr-5 cp" id="primary-top-login">登录</li>
	    			<li class="cp" id="primary-top-resginer">注册</li>
	    			
	    		</ul>
	    		<div class="cb"></div>
	    	</div>	
	    	<!--登录注册-->
	    	<div class="primary-login hide" id="primary-login">
	    	  <form id="login-validate" method="post" action="" class="form-horizontal form" novalidate="novalidate">
	    		<div class="primary-login-title color-white f20">登录</div>
	    		<div class="p10">
				<label class="form-label tr col-sm-4 col-sm-3 mt-20">用户名：</label>
				<div class="formControls col-sm-8 col-sm-9">
					<input type="text" name="user_name" class="mb-5 input-text radius5 p10 mt-10 required email" autocomplete="off" placeholder="请输入用户名">
				</div>
			</div>
			<div class="p10">
				<label class="form-label tr col-sm-4 col-sm-3 mt-20">密码：</label>
				<div class="formControls col-sm-8 col-sm-9">
					<input type="password" name="user_password" class="mb-5 input-text radius5 p10 mt-10" autocomplete="off" placeholder="请输入密码">
				</div>
			</div>
			<div class="p10">
				<label class="form-label col-sm-4 col-sm-3 "></label>
				<div class="formControls col-sm-8 col-sm-9 mt-20 skin-minimal">
					<input type="checkbox" id="checkbox-1">
    					<label for="checkbox-1">记住密码</label>
				</div>
			</div>
			<div class="p10 ">
				<label class="form-label col-sm-4 col-sm-3 "></label>
				<div class="formControls col-sm-8 col-sm-9 mt-20">
					<input class="btn btn-default radius5" type="submit" value="登录">
				</div>
			</div>
		  </form>
	    	</div>
	    	<!--注册-->
	    		<div class="primary-login hide" id="primary-resginer">
	    	  <form id="resginer-validate" method="post" action="" class="form-horizontal form" novalidate="novalidate">
	    		<div class="primary-login-title color-white f20">注册</div>
	    		<div class="p10">
				<label class="form-label tr col-sm-4 col-sm-3 mt-20">邮箱：</label>
				<div class="formControls col-sm-8 col-sm-9">
					<input type="text" name="resginer_email" class="mb-5 input-text radius5 p10 mt-10 required email" autocomplete="off" placeholder="请输入邮箱">
				</div>
			</div>
			<div class="p10">
				<label class="form-label tr col-sm-4 col-sm-3 mt-20">用户名：</label>
				<div class="formControls col-sm-8 col-sm-9">
					<input type="text" name="resginer_name" class="mb-5 input-text radius5 p10 mt-10 required" autocomplete="off" placeholder="请输入用户名">
				</div>
			</div>
			<div class="p10">
				<label class="form-label tr col-sm-4 col-sm-3 mt-20">密码：</label>
				<div class="formControls col-sm-8 col-sm-9">
					<input type="password" id="resginer_password" name="resginer_password" class="mb-5 input-text radius5 p10 mt-10" autocomplete="off" placeholder="请输入密码">
				</div>
			</div>
			<div class="p10">
				<label class="form-label tr col-sm-4 col-sm-3 mt-20">确认密码：</label>
				<div class="formControls col-sm-8 col-sm-9">
					<input type="password" name="resginer_password_again" class="mb-5 input-text radius5 p10 mt-10" autocomplete="off" placeholder="请确认密码">
				</div>
			</div>
			<div class="p10">
				<label class="form-label col-sm-4 col-sm-3 "></label>
				<div class="formControls col-sm-8 col-sm-9 mt-20 skin-minimal">
					<input type="checkbox" id="checkbox-1">
    					<label for="checkbox-1">已阅读</label><a class="f12" href="#">用户协议</a>
				</div>
			</div>
			<div class="p10 ">
				<label class="form-label col-sm-4 col-sm-3 "></label>
				<div class="formControls col-sm-8 col-sm-9 mt-20">
					<input class="btn btn-default radius5" type="submit" value="注册">
				</div>
			</div>
		  </form>
	    	</div>
    </header>
    <div class="primary-top-occupy"></div>
    <!--用户导航栏-->
    <nav class="user-nav"><div class="container tr color-white">导航</div></nav>
    <!--标题栏＋面包屑-->
    <div class="primary-title container mt-30 border-1 pb-15">
    		<h2>购物车</h2>
    		<p class="f12 mt-5"><a href="#">首页</a>/<a href="#">购物袋</a></p>
    </div>
    
    <!--购物车-->
    <div class="primary-goods-bags container mt-40">
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
    
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/layer/layer.js"></script>
    <script type="text/javascript" src="js/jquery.icheck.min.js" ></script>
    <script type="text/javascript" src="js/jquery.validate.min.js" ></script>
    <script type="text/javascript" src="js/validate-methods.js" ></script>
    <script type="text/javascript" src="js/messages_zh.min.js" ></script>
    <script type="text/javascript" src="js/smoothproducts.min.js" ></script><!--商品放大显示-->
    <script type="text/javascript" src="js/main.js" ></script>
    
  </body>
</html>