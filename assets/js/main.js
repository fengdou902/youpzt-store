<!-- 
//window.onerror=function(){return true;} 
// --> 
$(document).ready(function(){
	/*
	*添加购物车
	*author:zjf
	*/
	$('.add_to_cart').on('click',function(){
				var product_id=$(this).attr('data-productid');
				//alert(product_id);
				jQuery.ajax({
					url:YOUPZT_HOME_URL,
					data: "ajax_var=add_to_cart&product_id="+product_id,      //传值    
					dataType: "html",                                
					type: "get",                  
					beforeSend:function(){
					},
					success:function(message){	
						alert(message);
						if (message=='1') {
		             	//内容为空

						};

					},
					error: function() {
									
								 },
					}); 
	});
	//顶部搜索
	$('.primary-search').on('click',function(e){
		e.stopPropagation();
		$('.primary-top-search').slideDown()
	});
	$(document).click(function(){
		$('.primary-top-search').slideUp();	
		$(".primary-top-search").click(function(e){
		e.stopPropagation();
		});	
	});
	//顶部购物袋
	$('.primary-bags').on('click',function(e){
		e.stopPropagation();
		$('.primary-top-bags').slideDown();
	});
	$(document).on('click',function(){
		$('.primary-top-bags').slideUp();
		$('.primary-top-bags').click(function(e){
			e.stopPropagation();
		})	
	})
	//登录弹出层
	$('#primary-top-login').on('click',function(){
		layer.closeAll();
		layer.open({
		    type: 1,
		    shift: 2,
		    closeBtn: 1,
		    shade:false,
		    
		    
		    title: false, //不显示标题
		    content: $('#primary-login'), //捕获的元素
		    cancel: function(index){
		        layer.close(index);
    			}
		});
	});
	//注册
	$('#primary-top-resginer').on('click',function(){
		layer.closeAll();
		layer.open({
		    type: 1,
		    shift: 2,
		    closeBtn: 1,
		    shade:false,
		    title: false, //不显示标题
		    content: $('#primary-resginer'), //捕获的元素
		    cancel: function(index){
		        layer.close(index);
    			}
		});
	});
	//收获地址新建
	$('#primary-address-new').on('click',function(){
		layer.closeAll();
		layer.open({
		    type: 1,
		    shift: 2,
		    closeBtn: 1,
		    shade:false,
		    title: false, //不显示标题
		    content: $('.primary-address-new'), //捕获的元素
		    cancel: function(index){
		        layer.close(index);
    			}
		});
	});
	//购物车tips
	$('.primary-category-bags').on("mouseover",function(){
		layer.tips('点击加入购物车', this,{
			tips:[1,'#44A05D'],
			time:1000,
		});
	});
	//我的地址tips
	$('.primary-address-edit-tips').on("mouseover",function(){
		layer.tips('修改信息', this,{
			tips:[1,'#44A05D'],
			time:1000,
		});
	});
	$('.primary-address-del-tips').on("mouseover",function(){
		layer.tips('删除这条地址', this,{
			tips:[1,'#44A05D'],
			time:1000,
		});
	});
	$('.primary-address-set-tips').on("mouseover",function(){
		layer.tips('设为默认地址', this,{
			tips:[1,'#44A05D'],
			time:1000,
		});
	});
	
	//商品详情图片放大
	$(window).load(function() {
		$('.sp-wrap').smoothproducts();
	});
	//商品详情页数量加
	$(".primary-category-goods-plus").on("click",function(){
		var n=$(".primary-category-goods-count").val();
		var num=parseInt(n)+1;
		if(num!=0){$(".primary-category-goods-minus").removeAttr("disabled")}
		$(".primary-category-goods-count").val(num);
	});
	//商品详情页数量减
	$(".primary-category-goods-minus").on("click",function(){
		var n=$(".primary-category-goods-count").val();
		var num=parseInt(n)-1;
		if(num==0){$(".primary-category-goods-minus").attr("disabled",true)}
		$(".primary-category-goods-count").val(num);
	});
	//选项卡
	jQuery.Huitab =function(tabBar,tabCon,class_name,tabEvent,i){
		var $tab_menu=$(tabBar);
		  // 初始化操作
		  $tab_menu.removeClass(class_name);
		  $(tabBar).eq(i).addClass(class_name);
		  $(tabCon).hide();
		  $(tabCon).eq(i).show();
		  
		  $tab_menu.bind(tabEvent,function(){
		  	$tab_menu.removeClass(class_name);
		      $(this).addClass(class_name);
		      var index=$tab_menu.index(this);
		      $(tabCon).hide();
		      $(tabCon).eq(index).show();
		  });
	}
	//选项卡调用
	$.Huitab("#tab_demo .tabBar span","#tab_demo .tabCon","current","click","0");
	
});

//登录验证
$().ready(function() {
 $("#login-validate").validate({
 	debug:true,
 	focusInValid:false,
 	rules:{
 		user_password:{
 			required:true,
 			minlength:6,
 			maxlength:15,
 		}
 	}
 });
 //注册验证
 $('#resginer-validate').validate({
 	debug:true,
 	rules:{
 		resginer_password:{
 			required:true,
 			minlength:6,
 			maxlength:15,
 		},
 		resginer_password_again:{
 			required:true,
 			equalTo:'#resginer_password',
 		}
 		
 	}
 });
 //地址修改验证
  $('#address-edit-validate').validate({
 	debug:true,
 	rules:{
 		resginer_password:{
 			required:true,
 			minlength:6,
 			maxlength:15,
 		},
 		resginer_password_again:{
 			required:true,
 			equalTo:'#resginer_password',
 		},
 		address_detailed:{
 			required:true,
 		},
 		address_tel:{
 			required:true,
 			minlength:11,
 			maxlength:11,
 			number:"手机号码只能为数字",
 		}
 		
 	}
 });
});
//购物车
/**
 * Created by an.han on 13-12-17.
 */
window.onload = function () {
    if (!document.getElementsByClassName) {
        document.getElementsByClassName = function (cls) {
            var ret = [];
            var els = document.getElementsByTagName('*');
            for (var i = 0, len = els.length; i < len; i++) {

                if (els[i].className.indexOf(cls + ' ') >=0 || els[i].className.indexOf(' ' + cls + ' ') >=0 || els[i].className.indexOf(' ' + cls) >=0) {
                    ret.push(els[i]);
                }
            }
            return ret;
        }
    }

    var table = document.getElementById('cartTable'); // 购物车表格
    var selectInputs = document.getElementsByClassName('check'); // 所有勾选框
    var checkAllInputs = document.getElementsByClassName('check-all') // 全选框
    var tr = table.children[1].rows; //行
    var selectedTotal = document.getElementById('selectedTotal'); //已选商品数目容器
    var priceTotal = document.getElementById('priceTotal'); //总计
    var deleteAll = document.getElementById('deleteAll'); // 删除全部按钮
    var selectedViewList = document.getElementById('selectedViewList'); //浮层已选商品列表容器
    var selected = document.getElementById('selected'); //已选商品
    var foot = document.getElementById('foot');

    // 更新总数和总价格，已选浮层
    function getTotal() {
		var seleted = 0;
		var price = 0;
		var HTMLstr = '';
		for (var i = 0, len = tr.length; i < len; i++) {
			if (tr[i].getElementsByTagName('input')[0].checked) {
				seleted += parseInt(tr[i].getElementsByTagName('input')[1].value);
				price += parseFloat(tr[i].cells[4].innerHTML);
				HTMLstr += '<div><img src="' + tr[i].getElementsByTagName('img')[0].src + '"><span class="del" index="' + i + '">取消选择</span></div>'
			}
			else {
				tr[i].className = '';
			}
		}
	
		selectedTotal.innerHTML = seleted;
		priceTotal.innerHTML = price.toFixed(2);
		selectedViewList.innerHTML = HTMLstr;
	
		if (seleted == 0) {
			foot.className = 'foot';
		}
	}

    // 计算单行价格
    function getSubtotal(tr) {
        var cells = tr.cells;
        var price = cells[2]; //单价
        var subtotal = cells[4]; //小计td
        var countInput = tr.getElementsByTagName('input')[1]; //数目input
        var span = tr.getElementsByTagName('span')[1]; //-号
        //写入HTML
        subtotal.innerHTML = (parseInt(countInput.value) * parseFloat(price.innerHTML)).toFixed(2);
        //如果数目只有一个，把-号去掉
        if (countInput.value == 1) {
            span.innerHTML = '';
        }else{
            span.innerHTML = '-';
        }
    }

    // 点击选择框
    for(var i = 0; i < selectInputs.length; i++ ){
        selectInputs[i].onclick = function () {
            if (this.className.indexOf('check-all') >= 0) { //如果是全选，则吧所有的选择框选中
                for (var j = 0; j < selectInputs.length; j++) {
                    selectInputs[j].checked = this.checked;
                }
            }
            if (!this.checked) { //只要有一个未勾选，则取消全选框的选中状态
                for (var i = 0; i < checkAllInputs.length; i++) {
                    checkAllInputs[i].checked = false;
                }
            }
            getTotal();//选完更新总计
        }
    }

//  // 显示已选商品弹层
//  selected.onclick = function () {
//      if (selectedTotal.innerHTML != 0) {
//          foot.className = (foot.className == 'foot' ? 'foot show' : 'foot');
//      }
//  }

    //已选商品弹层中的取消选择按钮
    selectedViewList.onclick = function (e) {
        var e = e || window.event;
        var el = e.srcElement;
        if (el.className=='del') {
            var input =  tr[el.getAttribute('index')].getElementsByTagName('input')[0]
            input.checked = false;
            input.onclick();
        }
    }

    //为每行元素添加事件
    for (var i = 0; i < tr.length; i++) {
        //将点击事件绑定到tr元素
        tr[i].onclick = function (e) {
            var e = e || window.event;
            var el = e.target || e.srcElement; //通过事件对象的target属性获取触发元素
            var cls = el.className; //触发元素的class
            var countInout = this.getElementsByTagName('input')[1]; // 数目input
            var value = parseInt(countInout.value); //数目
            //通过判断触发元素的class确定用户点击了哪个元素
            switch (cls) {
                case 'primary-bags-count-add': //点击了加号
                    countInout.value = value + 1;
                    getSubtotal(this);
                    break;
                case 'primary-bags-count-reduce': //点击了减号
                    if (value > 1) {
                        countInout.value = value - 1;
                        getSubtotal(this);
                    }
                    break;
                case 'primary-bags-delete': //点击了删除
                    var conf = confirm('确定删除此商品吗？');
                    if (conf) {
                        this.parentNode.removeChild(this);
                    }
                    break;
            }
            getTotal();
        }
        // 给数目输入框绑定keyup事件
        tr[i].getElementsByTagName('input')[1].onblur = function () {
            var val = parseInt(this.value);
            if (isNaN(val) || val <= 0) {
                val = 1;
            }
            if (this.value != val) {
                this.value = val;
            }
            getSubtotal(this.parentNode.parentNode); //更新小计
            getTotal(); //更新总数
        }
    }

    // 点击全部删除
    deleteAll.onclick = function () {
        if (selectedTotal.innerHTML != 0) {
            var con = confirm('确定删除所选商品吗？'); //弹出确认框
            if (con) {
                for (var i = 0; i < tr.length; i++) {
                    // 如果被选中，就删除相应的行
                    if (tr[i].getElementsByTagName('input')[0].checked) {
                        tr[i].parentNode.removeChild(tr[i]); // 删除相应节点
                        i--; //回退下标位置
                    }
                }
            }
        } else {
            alert('请选择商品！');
        }
        getTotal(); //更新总数
    }

    // 默认全选
    checkAllInputs[0].checked = true;
    checkAllInputs[0].onclick();
}

	//收获地址修改弹出层
	function primary_address_edit(){
		layer.closeAll();
		layer.open({
		    type: 1,
		    shift: 2,
		    closeBtn: 1,
		    shade:false,
		    title: false, //不显示标题
		    content: $('.primary-address-new'), //捕获的元素
		    
		});
	};
	/*
$(function(){
	$("#primary-city-secect").citySelect({
		prov:"江苏",
		nodata:"none"
	});
})
*/
