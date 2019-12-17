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
<style>
    tbody tr td{
        position: relative;
    }
    tbody tr  .icow-weibiaoti--{
        visibility: hidden;
        display: inline-block;
        color: #fff;
        height:18px;
        width:18px;
        background: #e0e0e0;
        text-align: center;
        line-height: 18px;
        vertical-align: middle;
    }
    tbody tr:hover .icow-weibiaoti--{
        visibility: visible;
    }
    tbody tr  .icow-weibiaoti--.hidden{
        visibility: hidden !important;
    }
    .full .icow-weibiaoti--{
        margin-left:10px;
    }
    .full>span{
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        vertical-align: middle;
        align-items: center;
    }
    tbody tr .label{
        margin: 5px 0;
    }
    .goods_attribute a{
        cursor: pointer;
    }
    .newgoodsflag{
        width: 22px;height: 16px;
        background-color: #ff0000;
        color: #fff;
        text-align: center;
        position: absolute;
        bottom: 70px;
        left: 57px;
        font-size: 12px;
    }
	.a{cursor: pointer;}
</style>
</head>
<body layadmin-themealias="default">

<div class="layui-fluid">
	<div class="layui-card">
		<div class="layui-card-header layui-elem-quote">当前位置：<span class="line-text">会员卡设置</span></div>
		<div class="layui-card-body" style="padding:15px;">
			<form action="" method="post" class="layui-form" lay-filter="component-layui-form-item" enctype="multipart/form-data" >
				
				
				<div class="layui-form-item">
                    <label class="layui-form-label">会员卡功能开关</label>
                    <div class="layui-input-block">
                        <label class='radio-inline'>
                            <input type='radio' name='data[is_open_vipcard_buy]' lay-filter="openvipcardbuy" value='0' <?php if( !empty($data) && $data['is_open_vipcard_buy'] ==0 ){ ?>checked <?php } ?> title="不开启" /> 
                        </label>
                        <label class='radio-inline'>
                            <input type='radio' name='data[is_open_vipcard_buy]' lay-filter="openvipcardbuy"  value='1' <?php if( empty($data) || $data['is_open_vipcard_buy'] ==1 ){ ?>checked <?php } ?> title="开启" /> 
                        </label>
                    </div>
                </div>
				
				
				
				<div class="layui-form-item">
        			<label class="layui-form-label">自定义会员卡名称</label>
        			<div class="layui-input-block">
        				<input type="text" name="data[modify_vipcard_name]" class="form-control" value="<?php echo ($data['modify_vipcard_name']); ?>" />
						 <span class='layui-form-mid'>未自定义，默认使用“天机会员”</span>
        			</div>
        		</div>
				
				<div class="layui-form-item" >
                    <label class="layui-form-label">自定义会员卡图标</label>
                    <div class="layui-input-block">
                        <?php echo tpl_form_field_image2('data[modify_vipcard_logo]', $data['modify_vipcard_logo']);?>
                        <span class='layui-form-mid'>未自定义，使用系统默认</span>
                    </div>
                </div>
				
				<div class="layui-form-item" id="vipcard_effect_headbg" <?php if( !empty($data) && $data['is_open_vipcard_buy'] ==0 ){ ?> style="display:none;"<?php } ?>>
                    <label class="layui-form-label">未开通会员头部背景</label>
                    <div class="layui-input-block">
                        <?php echo tpl_form_field_image2('data[vipcard_unopen_headbg]', $data['vipcard_unopen_headbg']);?>
                        <span class='layui-form-mid'></span>
                    </div>
                </div>
				
				<div class="layui-form-item" id="vipcard_effect_headbg" <?php if( !empty($data) && $data['is_open_vipcard_buy'] ==0 ){ ?> style="display:none;"<?php } ?>>
                    <label class="layui-form-label">会员有效期内头部背景</label>
                    <div class="layui-input-block">
                        <?php echo tpl_form_field_image2('data[vipcard_effect_headbg]', $data['vipcard_effect_headbg']);?>
                        <span class='layui-form-mid'></span>
                    </div>
                </div>
				
				<div class="layui-form-item" id="vipcard_afterefect_headbg" <?php if( !empty($data) && $data['is_open_vipcard_buy'] ==0 ){ ?> style="display:none;"<?php } ?>>
                    <label class="layui-form-label">会员已到期头部背景</label>
                    <div class="layui-input-block">
                        <?php echo tpl_form_field_image2('data[vipcard_afterefect_headbg]', $data['vipcard_afterefect_headbg']);?>
                        <span class='layui-form-mid'></span>
                    </div>
                </div>
				
				<div class="layui-form-item">
                    <label class="layui-form-label">显示专享特价商品</label>
                    <div class="layui-input-block">
                        <label class='radio-inline'>
                            <input type='radio' name='data[is_hide_vipcard_vipgoods]'  value='0' <?php if( !empty($data) && $data['is_hide_vipcard_vipgoods'] ==0 ){ ?>checked <?php } ?> title="显示" /> 
                        </label>
                        <label class='radio-inline'>
                            <input type='radio' name='data[is_hide_vipcard_vipgoods]'   value='1' <?php if( empty($data) || $data['is_hide_vipcard_vipgoods'] ==1 ){ ?>checked <?php } ?> title="不显示" /> 
                        </label>
                    </div>
                </div>
				
				<div class="layui-form-item">
				  <label class="layui-form-label"></label>
				  <div class="layui-input-block">
					<input type="submit" value="提交" lay-submit lay-filter="formDemo" class="btn btn-primary" />
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

layui.use(['jquery', 'layer','form','colorpicker'], function(){ 
  $ = layui.$;
  var form = layui.form;
  var colorpicker = layui.colorpicker;
 
  
  form.on('radio(openvipcardbuy)', function(data){
		if (data.value == 1) {
			$('#vipcard_price').show();
			
			$('#vipcard_effect_headbg').show();
			$('#vipcard_afterefect_headbg').show();
		} else {
			$('#vipcard_price').hide();
			
			$('#vipcard_effect_headbg').hide();
			$('#vipcard_afterefect_headbg').hide();
		}
	});
	
	
   //表单赋值
    colorpicker.render({
      elem: '#minicolors'
      ,color: '<?php echo ($data['nav_bg_color']); ?>'
      ,done: function(color){
        $('#test-colorpicker-form-input').val(color);
      }
    });
  
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