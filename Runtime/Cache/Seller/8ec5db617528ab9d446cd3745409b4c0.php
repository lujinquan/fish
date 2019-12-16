<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <?php $shoname_name = D('Home/Front')->get_config_by_name('shoname'); ?>
  <title><?php echo $shoname; ?></title>
  <link rel="shortcut icon" href="" />
        
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">

  <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
 
<!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
<!--[if lt IE 9]>
  <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
  <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->  

<link href="./resource/css/bootstrap.min.css?v=201903260001" rel="stylesheet">
<link href="./resource/css/common.css?v=201903260001" rel="stylesheet">
<script type="text/javascript">
            window.sysinfo = {
            <?php if (!empty($_W['uniacid']) ){ ?>'uniacid': '<?php echo ($_W['uniacid']); ?>',<?php } ?>
			
            <?php if( !empty($_W['acid']) ){ ?>'acid': '<?php echo ($_W['acid']); ?>',<?php } ?>
			
            <?php if (!empty($_W['openid']) ) { ?>'openid': '<?php echo ($_W['openid']); ?>',<?php } ?>
			
            <?php if( !empty($_W['uid']) ) { ?>'uid': '<?php echo ($_W['uid']); ?>',<?php } ?>
			
            'isfounder': <?php if (!empty($_W['isfounder']) ) { ?>1<?php  }else{ ?>0<?php } ?>,
			
            'siteroot': '<?php echo ($_W['siteroot']); ?>',
                    'siteurl': '<?php echo ($_W['siteurl']); ?>',
                    'attachurl': '<?php echo ($_W['attachurl']); ?>',
                    'attachurl_local': '<?php echo ($_W['attachurl_local']); ?>',
                    'attachurl_remote': '<?php echo ($_W['attachurl_remote']); ?>',
                    'module' : {'url' : '<?php if( defined('MODULE_URL') ) { ?>{MODULE_URL}<?php } ?>', 'name' : '<?php if (defined('IN_MODULE') ) { ?>{IN_MODULE}<?php } ?>'},
            'cookie' : {'pre': ''},
            'account' : <?php echo json_encode($_W['account']);?>,
            };
        </script>


		
<script type="text/javascript" src="./resource/js/lib/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="./resource/js/lib/bootstrap.min.js"></script>
<script type="text/javascript" src="./resource/js/app/util.js?v=201903260001"></script>
<script type="text/javascript" src="./resource/js/app/common.min.js?v=201903260001"></script>
<script type="text/javascript" src="./resource/js/require.js?v=201903260001"></script>
<script type="text/javascript" src="./resource/js/lib/jquery.nice-select.js?v=201903260001"></script>
<link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
<link href="/static/css/snailfish.css" rel="stylesheet">
   
<link href="/static/css/minapp.css" rel="stylesheet">
</head>
<body layadmin-themealias="default">

<div class="layui-fluid">
	<div class="layui-card">
		<div class="layui-card-header layui-elem-quote">当前位置：<span class="line-text">个人中心图标设置</span></div>
		<div class="layui-card-body" style="padding:15px;">
			<form action="" method="post" class="layui-form" lay-filter="component-layui-form-item" enctype="multipart/form-data" >
				<div class="clearfix">
					<div class="col-xs-6 col-md-5">
						<div class="minapp">
							<div class="titlebar"><img src="/static/images/minappbar.jpg"></div>
							<div class="user">
								<div class="user-top">
									<div class="avatar">头像</div>
									<div class="username">xxx</div>
								</div>
								<div class="order">
									<div class="order-title">我的订单</div>
									<div class="orderTab">
										<div class="order_status">
											<?php echo tpl_form_field_image_sin('parameter[user_order_menu_icon1]', $data['user_order_menu_icons']['i1'], '', array('class_extra'=>'order_menu_icon'));?>
											<div class="order_status_name">待付款</div>
										</div>
										<div class="order_status">
											<?php echo tpl_form_field_image_sin('parameter[user_order_menu_icon2]', $data['user_order_menu_icons']['i2'], '', array('class_extra'=>'order_menu_icon'));?>
											<div class="order_status_name">待配送</div>
										</div>
										<div class="order_status">
											<?php echo tpl_form_field_image_sin('parameter[user_order_menu_icon3]', $data['user_order_menu_icons']['i3'], '', array('class_extra'=>'order_menu_icon'));?>
											<div class="order_status_name">待提货</div>
										</div>
										<div class="order_status">
											<?php echo tpl_form_field_image_sin('parameter[user_order_menu_icon4]', $data['user_order_menu_icons']['i4'], '', array('class_extra'=>'order_menu_icon'));?>
											<div class="order_status_name">已提货</div>
										</div>
										<div class="order_status">
											<?php echo tpl_form_field_image_sin('parameter[user_order_menu_icon5]', $data['user_order_menu_icons']['i5'], '', array('class_extra'=>'order_menu_icon'));?>
											<div class="order_status_name">售后服务</div>
										</div>
									</div>
								</div>
								<div class="tool">
									<div class="toolList">
										<div class="item-main">
											<?php echo tpl_form_field_image_sin('parameter[user_tool_icon1]', $data['user_tool_icons']['i1'], '', array('class_extra'=>'tool_icon'));?>
											<span>余额</span>
										</div>
										<div class="item-main">
											<?php echo tpl_form_field_image_sin('parameter[user_tool_icon2]', $data['user_tool_icons']['i2'], '', array('class_extra'=>'tool_icon'));?>
											<span>积分</span>
										</div>
										<div class="item-main">
											<?php echo tpl_form_field_image_sin('parameter[user_tool_icon3]', $data['user_tool_icons']['i3'], '', array('class_extra'=>'tool_icon'));?>
											<span>优惠券</span>
										</div>
										<div class="item-main">
											<?php echo tpl_form_field_image_sin('parameter[user_tool_icon4]', $data['user_tool_icons']['i4'], '', array('class_extra'=>'tool_icon'));?>
											<span>核销管理</span>
										</div>
										<div class="item-main">
											<?php echo tpl_form_field_image_sin('parameter[user_tool_icon5]', $data['user_tool_icons']['i5'], '', array('class_extra'=>'tool_icon'));?>
											<span>团长中心</span>
										</div>
										<div class="item-main">
											<?php echo tpl_form_field_image_sin('parameter[user_tool_icon6]', $data['user_tool_icons']['i6'], '', array('class_extra'=>'tool_icon'));?>
											<span>供应商</span>
										</div>
										<div class="item-main">
											<?php echo tpl_form_field_image_sin('parameter[user_tool_icon7]', $data['user_tool_icons']['i7'], '', array('class_extra'=>'tool_icon'));?>
											<span>常见帮助</span>
										</div>
										<div class="item-main">
											<?php echo tpl_form_field_image_sin('parameter[user_tool_icon8]', $data['user_tool_icons']['i8'], '', array('class_extra'=>'tool_icon'));?>
											<span>联系客服</span>
										</div>
										<div class="item-main">
											<?php echo tpl_form_field_image_sin('parameter[user_tool_icon9]', $data['user_tool_icons']['i9'], '', array('class_extra'=>'tool_icon'));?>
											<span>关于我们</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-6 col-md-7 user-details">
						<div class="details-title">备注：</div>
						<p>1.订单图标大小为56*56；</p>
						<p>2.菜单图标大小为40*40。</p>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label"> </label>
					<div class="layui-input-block">
						<input type="submit" value="提交" lay-submit lay-filter="formDemo" class="btn btn-primary"  />
					</div>
				</div>
			</form>
		</div>
</div>
</div>


<script src="/layuiadmin/layui/layui.js"></script>

<script>
	layui.config({
		base: '/layuiadmin/' //静态资源所在路径
	}).extend({
		index: 'lib/index' //主入口模块
	}).use('index');
</script>

<script>
//由于模块都一次性加载，因此不用执行 layui.use() 来加载对应模块，直接使用即可：
var layer = layui.layer;
var $;

layui.use(['jquery', 'layer','form'], function(){ 
  	$ = layui.$;
  	var form = layui.form;
  	
	//监听提交
	form.on('submit(formDemo)', function(data){
	
		$.ajax({
			url: data.form.action,
			type: data.form.method,
			data: data.field,
			dataType:'json',
			success: function (info) {
			  
				if(info.status == 0)
				{
					layer.msg(info.result.message,{icon: 1,time: 2000});
				}else if(info.status == 1){
					var go_url = location.href;
					if( info.result.hasOwnProperty("url") )
					{
						go_url = info.result.url;
					}
					
					layer.msg('操作成功',{time: 1000,
						end:function(){
							location.href = info.result.url;
						}
					}); 
				}
			}
		});
		
	    return false;
  	});
})

</script>  
</body>