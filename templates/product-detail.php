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
    		<h2>智能飞行器</h2>
    		<p class="f12 mt-5"><a href="#">首页</a>/<a href="#">智能飞行器</a></p>
    </div>
    
    <!--商品详情-->
    <div class="primary-goods-information container mt-40">
    		<div>
    		<div class="primary-page-img fl">
			<div class="sp-loading"><img src="images/sp-loading.gif" alt=""><br>LOADING IMAGES</div>
			<div class="sp-wrap">
				<a href="images/small_4kc.png"><img src="images/medium_p1.jpg" alt=""></a>
				<a href="images/small_4kc.png"><img src="images/medium_p1.jpg" alt=""></a>
				<a href="images/small_4kc.png"><img src="images/medium_p1.jpg" alt=""></a>
				<a href="images/small_4kc.png"><img src="images/medium_p1.jpg" alt=""></a>
				<a href="images/small_4kc.png"><img src="images/medium_p1.jpg" alt=""></a>
				<a href="images/small_4kc.png"><img src="images/medium_p1.jpg" alt=""></a>
			</div>
		</div>
		<div class="primary-products-information fl">
			<h3>大疆无人机4K</h3>
			<p class="border-1 pb-20 color-6">
				相机支持4K超高清视频录像，1200万像素静态照片拍摄
				集成三轴云台，可以使相机保持稳定，成功捕捉平稳流畅的画面
				简单操控，支持智能飞行功能（热点跟随，航向锁定，航点飞行，返航锁定，兴趣点环绕）
				内置WiFi图传系统，遥控和图传距离最远达1.2 km，最大飞行时间约25分钟
				480P图传分辨率
				室内室外精准定位
				一键返航，电池电压检测及时空安全保护
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
					<input class="primary-category-goods-count" type="text" value="1"/>
					<input type="button" class="iconfont cp primary-category-goods-plus" value="&#xe60b;"/>
				</span>
			</div>
			<div class="primary-products-information-price mt-30">
				<span>价格：</span>
				<span class="ml-30 f24">	¥4999</span>
			</div>
			<div class="primary-products-information-btn mt-50">
				<span class="border-green radius5 mr-20">立即购买</span>
				<span class="border-blue radius5">加入购物车</span>
			</div>
		</div>
		<div class="cb"></div>
		</div>
		<!--商品描述-->
		<div class="primary-goods-information-describe mt-70 border-1 pb-20">
			<div id="tab_demo" class="HuiTab bt-1">
				<div class="tabBar cl">
					<span>商品详情</span>
					<span>商品评论</span>
					<div class="cb"></div>
				</div>
				<div class="tabCon p10 mt-5">
					<h3>商品描述</h3>
					<p class="f14 mt-40">相机支持4K超高清视频录像，1200万像素静态照片拍摄
				集成三轴云台，可以使相机保持稳定，成功捕捉平稳流畅的画面
				简单操控，支持智能飞行功能（热点跟随，航向锁定，航点飞行，返航锁定，兴趣点环绕）
				内置WiFi图传系统，遥控和图传距离最远达1.2 km，最大飞行时间约25分钟
				480P图传分辨率
				室内室外精准定位
				一键返航，电池电压检测及时空安全保护
					</p>
					<h3 class="mt-40">图片描述</h3>
					<p class="f14 mt-40">
						<img src="images/medium_p1.jpg" />
					</p>
					
				</div>
				<div class="tabCon">内容二</div>
			</div>
		</div>
		<!--相关商品-->
		<div class="primary-products-information-about">
			<h3 class="mt-40">相关产品</h3>
			<ul>
				<li class="col-sm-2">
					<img src="images/small_4kc.png" />
					<p>大疆无人机</p>
				</li>
				<li class="col-sm-2">
					<img src="images/small_4kc.png" />
					<p>大疆无人机</p>
				</li>
				<li class="col-sm-2">
					<img src="images/small_4kc.png" />
					<p>大疆无人机</p>
				</li>
				<li class="col-sm-2">
					<img src="images/small_4kc.png" />
					<p>大疆无人机</p>
				</li>
				<li class="col-sm-2">
					<img src="images/small_4kc.png" />
					<p>大疆无人机</p>
				</li>
				<li class="col-sm-2">
					<img src="images/small_4kc.png" />
					<p>大疆无人机</p>
				</li>
			</ul>
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