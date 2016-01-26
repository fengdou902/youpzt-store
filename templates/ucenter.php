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
    		<h2>个人中心</h2>
    		<p class="f12 mt-5"><a href="#">首页</a>/<a href="#">个人中心</a></p>
    </div>
    
    <!--购物车-->
    <div class="primary-goods-bags container mt-20">
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
    			<h4 class="border-1 pb-15">全部订单</h4>
    			<div class="primary-user-center-list f14">
    				<table>
    					<thead>
    						<tr>
    							<th>订单信息</th>
    							<th>单价</th>
    							<th>数量</th>
    							<th>订单总额</th>
    							<th>订单状态</th>
    							<th>操作</th>
    						</tr>
    					</thead>
    					<tbody>
    						<tr class="tc">
    							<td class="tl">
    								<img class="fl" src="images/small_4kc.png" />
    								<div class="fl mt-10">
    									<p class="f16">大疆无人机4K智能飞行器</p>
    									<p class="color-8"><span class="mr-10">白色</span><span>标准版</span></p>
    								</div>
    							</td>
    							<td>¥4999</td>
    							<td>1</td>
    							<td>¥4999</td>
    							<td>待发货</td>
    							<td class="cp"><i class="iconfont f20">&#xe602;</i></td>
    							
    						</tr>
    						<tr class="tc">
    							<td class="tl">
    								<img class="fl" src="images/small_4kc.png" />
    								<div class="fl mt-10">
    									<p class="f16">大疆无人机4K智能飞行器</p>
    									<p class="color-8"><span class="mr-10">白色</span><span>标准版</span></p>
    								</div>
    							</td>
    							<td>¥4999</td>
    							<td>1</td>
    							<td>¥4999</td>
    							<td>待发货</td>
    							<td class="cp"><i class="iconfont f20">&#xe602;</i></td>
    							
    						</tr>
    					</tbody>
    				</table>
    				<div class="priary-pagenav tc">
    					<ul class="disinblock">
    						<li><a href="#">1</a></li>
    						<li><a href="#">2</a></li>
    						<li><a href="#">3</a></li>
    						<li><a href="#">4</a></li>
    						<li><a href="#">></a></li>
    					</ul>
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