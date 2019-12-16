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
</head>
<body layadmin-themealias="default">

<div class="layui-fluid">
	<div class="layui-card">
		<div class="layui-card-header layui-elem-quote">当前位置：<span class="line-text">团长设置</span></div>
		<div class="layui-card-body" style="padding:15px;">
			<form action="" method="post" class="layui-form" lay-filter="component-layui-form-item" enctype="multipart/form-data" >
		
		
			<div class="layui-form-item">
				<label class="layui-form-label">团长佣金类型</label>
				<div class="layui-input-block">
					<label class='radio-inline'>
						<input type='radio' name='data[community_money_type]' value='0' <?php if(empty($data) || $data['community_money_type'] ==0){ ?>checked <?php } ?> title="比例" /> 
					</label>
					<label class='radio-inline'>
						<input type='radio' name='data[community_money_type]' value='1' <?php if(!empty($data) && $data['community_money_type'] ==1){ ?>checked <?php } ?> title="金额" /> 
					</label>
					<div class="help-block">比例：团长可得佣金 = 商品最终的成交价格 * 比例%，  金额：团长可得佣金 = 设置金额</div>
				</div>
					
			</div>
			
			
		<div class="layui-form-item">
			<label class="layui-form-label">团长提成比例</label>
			<div class="layui-input-block fixmore-input-group">
				<div class="input-group">
					<input type="text" name="data[default_comunity_money]" class="form-control valid" value="<?php echo empty($data['default_comunity_money'])?0:$data['default_comunity_money'];?>" />
					<span class="input-group-addon"><?php if(empty($data) || $data['community_money_type'] ==0){ ?>% <?php } if(!empty($data) && $data['community_money_type'] ==1){ ?>元 <?php } ?></span>
				</div>
				<div class="help-block"><?php if(empty($data) || $data['community_money_type'] ==0){ ?>预计团长可得佣金 = 商品最终的成交价格 * 比例% <?php } if(!empty($data) && $data['community_money_type'] ==1){ ?>预计团长可得佣金 = 团长佣金金额<?php } ?></div>	
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">社区距离限制</label>
			<div class="layui-input-block fixmore-input-group">
				<div class="input-group">
					<input type="text" name="data[default_comunity_limit_mile]" class="form-control valid" value="<?php echo empty($data['default_comunity_limit_mile'])?0:$data['default_comunity_limit_mile'];?>" />
					<span class="input-group-addon">公里 </span>
				</div>
				<div class="help-block">社区列表限制某个距离内显示, 0代表不限制</div>	
			</div>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">推荐现金奖励:</label>
			<div class="layui-input-block fixmore-input-group">
				<div class="input-group">
					<input type="text" name="data[zhi_tui_reward_money]" class="form-control valid" value="<?php echo empty($data['zhi_tui_reward_money'])?0:$data['zhi_tui_reward_money'];?>" />
					<span class="input-group-addon">元 </span>
				</div>
				<div class="help-block">被推荐团长审核后，发放奖励到推荐人的团长账户余额中</div>	
			</div>
		</div>
		
		<div class="layui-form-item">
            <label class="layui-form-label">前端添加核销会员</label>
            <div class="layui-input-block">
                <label class='radio-inline'>
                    <input type='radio' name='data[open_community_addhexiaomember]' value='0' <?php if( !empty($data) && $data['open_community_addhexiaomember'] ==0 ){ ?>checked <?php } ?> title="关闭" /> 
                </label>
                <label class='radio-inline'>
                    <input type='radio' name='data[open_community_addhexiaomember]' value='1' <?php if( empty($data) || $data['open_community_addhexiaomember'] ==1 ){ ?>checked <?php } ?> title="开启" /> 
                </label>
            </div>
        </div>
		
		<div class="layui-form-item">
            <label class="layui-form-label">前端显示详细地址</label>
            <div class="layui-input-block">
                <label class='radio-inline'>
                    <input type='radio' name='data[index_hide_headdetail_address]' value='0' <?php if( empty($data) || $data['index_hide_headdetail_address'] ==0 ){ ?>checked <?php } ?> title="显示" /> 
                </label>
                <label class='radio-inline'>
                    <input type='radio' name='data[index_hide_headdetail_address]' value='1' <?php if( !empty($data) && $data['index_hide_headdetail_address'] ==1 ){ ?>checked <?php } ?> title="隐藏" /> 
                </label>
            </div>
        </div>
		
		<div class="layui-form-item">
            <label class="layui-form-label">会员下单通知</label>
            <div class="layui-input-block">
                <label class='radio-inline'>
                    <input type='radio' name='data[template_order_success_notice]' value='0' <?php if( empty($data) || $data['template_order_success_notice'] ==0 ){ ?>checked <?php } ?> title="关闭" /> 
                </label>
                <label class='radio-inline'>
                    <input type='radio' name='data[template_order_success_notice]' value='1' <?php if( !empty($data) && $data['template_order_success_notice'] ==1 ){ ?>checked <?php } ?> title="开启" /> 
                </label>
            </div>
        </div>
		
		<div class="layui-form-item">
            <label class="layui-form-label">显示团长等级</label>
            <div class="layui-input-block">
                <label class='radio-inline'>
                    <input type='radio' name='data[is_show_head_level]' value='0' <?php if( empty($data) || $data['is_show_head_level'] ==0 ){ ?>checked <?php } ?> title="隐藏" /> 
                </label>
                <label class='radio-inline'>
                    <input type='radio' name='data[is_show_head_level]' value='1' <?php if( !empty($data) && $data['is_show_head_level'] ==1 ){ ?>checked <?php } ?> title="显示" /> 
                </label>
            </div>
        </div>
		
		<div class="layui-form-item" class="head_level_chose">
            <label class="layui-form-label">团长分销级数</label>
            <div class="layui-input-block">
                <label class='radio-inline'>
                    <input type='radio' title="关闭"  class="radi" name='data[open_community_head_leve]' value='0' <?php if( empty($data) || $data['open_community_head_leve'] ==0 ){ ?>checked <?php } ?> /> 
                </label>
                <label class='radio-inline'>
                    <input type='radio' class="radi" name='data[open_community_head_leve]' value='1' <?php if( !empty($data) && $data['open_community_head_leve'] ==1 ){ ?>checked <?php } ?> title="1级" /> 
                </label>
                <label class='radio-inline'>
                    <input type='radio' class="radi" name='data[open_community_head_leve]' value='2' <?php if( !empty($data) && $data['open_community_head_leve'] ==2 ){ ?>checked <?php } ?> title="2级" /> 
                </label>
                <label class='radio-inline'>
                    <input type='radio' class="radi" name='data[open_community_head_leve]' value='3' <?php if( !empty($data) && $data['open_community_head_leve'] ==3 ){ ?>checked <?php } ?> title="3级" /> 
                </label>
            </div>
        </div>
		
		
		<div class="layui-form-item community_head_commiss1" <?php if( !empty($data) && $data['open_community_head_leve'] >= 1 ){ ?> style="display:block;"<?php }else{ ?> style="display:none;"<?php } ?> >
			<label class="layui-form-label">1级:</label>
			<div class="layui-input-block fixmore-input-group">
				<div class="input-group">
					<input type="text" name="data[community_head_commiss1]" class="form-control valid" value="<?php echo empty($data['community_head_commiss1'])?0:$data['community_head_commiss1'];?>" />
					<span class="input-group-addon">% </span>
				</div>
				<div class="help-block">1级分佣比例</div>	
			</div>
		</div>
		<div class="layui-form-item community_head_commiss2" <?php if( !empty($data) && $data['open_community_head_leve'] >= 2 ){ ?> style="display:block;"<?php }else{ ?> style="display:none;"<?php } ?>>
			<label class="layui-form-label">2级:</label>
			<div class="layui-input-block fixmore-input-group">
				<div class="input-group">
					<input type="text" name="data[community_head_commiss2]" class="form-control valid" value="<?php echo empty($data['community_head_commiss2'])?0:$data['community_head_commiss2'];?>" />
					<span class="input-group-addon">% </span>
				</div>
				<div class="help-block">2级分佣比例</div>	
			</div>
		</div>
		<div class="layui-form-item community_head_commiss3" <?php if( !empty($data) && $data['open_community_head_leve'] >= 3 ){ ?> style="display:block;"<?php }else{ ?> style="display:none;"<?php } ?>>
			<label class="layui-form-label">3级:</label>
			<div class="layui-input-block fixmore-input-group">
				<div class="input-group">
					<input type="text" name="data[community_head_commiss3]" class="form-control valid" value="<?php echo empty($data['community_head_commiss3'])?0:$data['community_head_commiss3'];?>" />
					<span class="input-group-addon">% </span>
				</div>
				<div class="help-block">3级分佣比例</div>	
			</div>
		</div>
		
		<div class="layui-form-item">
            <label class="layui-form-label">团长申请页面内容</label>
            <div class="layui-input-block fixmore-input-group">
                <div class="">
                    <?php echo tpl_ueditor('data[communityhead_apply_page]',$data['communityhead_apply_page'],array('height'=>'300'));?>
                </div>
            </div>
        </div>
		
		
		
		        <div class="layui-form-item">
		            <label class="layui-form-label">团长申请开关</label>
		            <div class="layui-input-block">
		                <label class='radio-inline'>
		                    <input type='radio' name='data[close_community_apply_enter]' value='0' <?php if(!empty($data) && $data['close_community_apply_enter'] ==0){ ?>checked <?php } ?> title="开启" /> 
		                </label>
		                <label class='radio-inline'>
		                    <input type='radio' name='data[close_community_apply_enter]' value='1' <?php if( empty($data) || $data['close_community_apply_enter'] ==1 ){ ?>checked <?php } ?> title="关闭" /> 
		                </label>
		            </div>
		        </div>
		
		
		        <div class="layui-form-item">
		            <label class="layui-form-label">团长休息开关</label>
		            <div class="layui-input-block">
		                <label class='radio-inline'>
		                    <input type='radio' name='data[close_community_reset_btn]' value='0' <?php if( !empty($data) && $data['close_community_reset_btn'] ==0 ){ ?>checked <?php } ?> title="开启" /> 
		                </label>
		                <label class='radio-inline'>
		                    <input type='radio' name='data[close_community_reset_btn]' value='1' <?php if( empty($data) || $data['close_community_reset_btn'] ==1 ){ ?>checked <?php } ?> title="关闭" /> 
		                </label>
		            </div>
		        </div>
				
				
		        <div class="layui-form-item">
		            <label class="layui-form-label">社区用户待核销</label>
		            <div class="layui-input-block">
		                <label class='radio-inline'>
		                    <input type='radio' name='data[close_community_delivery_orders]' value='0' <?php if( empty($data) || $data['close_community_delivery_orders'] ==0 ){ ?> checked <?php } ?> title="开启" /> 
		                </label>
		                <label class='radio-inline'>
		                    <input type='radio' name='data[close_community_delivery_orders]' value='1' <?php if( !empty($data) && $data['close_community_delivery_orders'] ==1 ){ ?> checked <?php } ?> title="关闭" /> 
		                </label>
		            </div>
		        </div>
				
				
				<div class="layui-form-item">
		            <label class="layui-form-label">单团长模式</label>
		            <div class="layui-input-block">
		                <label class='radio-inline'>
		                    <input type='radio' name='data[open_danhead_model]' value='0' <?php if( empty($data) || $data['open_danhead_model'] ==0 ){ ?>checked <?php } ?> title="关闭" /> 
		                </label>
		                <label class='radio-inline'>
		                    <input type='radio' name='data[open_danhead_model]' value='1' <?php if( !empty($data) && $data['open_danhead_model'] ==1 ){ ?>checked <?php } ?> title="开启" /> 
		                </label>
						
						<div class="help-block">
							开启单团长模式后，小程序端只有一个默认的团长(前往团长列表，选择默认团长)，不能切换其他团长
						</div>	
		            </div>
					
		        </div>
				
				<div class="layui-form-item">
					<label class="layui-form-label"> </label>
					<div class="layui-input-block">
						<input type="submit" value="提交" lay-submit lay-filter="formDemo" class="btn btn-primary"  />
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a class="btn btn-default" style='margin-left:10px;display:none;' href="<?php echo U('config/configindex.notice',array('ok'=>'1'));?>">返回列表</a>
						
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

var cur_open_div;

layui.use(['jquery', 'layer','form'], function(){ 
  $ = layui.$;
  var form = layui.form;
  
	form.on('radio(linktype)', function(data){
		if (data.value == 2) {
			$('#typeGroup').show();
		} else {
			$('#typeGroup').hide();
		}
	});  

	
	$('#chose_link').click(function(){
		cur_open_div = $(this).attr('data-input');
		$.post("<?php echo U('util.selecturl', array('ok' => 1));?>", {}, function(shtml){
		 layer.open({
			type: 1,
			area: '930px',
			content: shtml //注意，如果str是object，那么需要字符拼接。
		  });
		});
	})
		
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

<script>
$(function(){
	
	$('.radi').click(function(){
		var open_community_head_leve = $(this).val();
		
		if( open_community_head_leve == 0 )
		{
			$('.community_head_commiss1').hide();
			$('.community_head_commiss2').hide();
			$('.community_head_commiss3').hide();
		}else if( open_community_head_leve == 1 ){
			$('.community_head_commiss1').show();
			$('.community_head_commiss2').hide();
			$('.community_head_commiss3').hide();
		}else if(open_community_head_leve == 2){
			$('.community_head_commiss1').show();
			$('.community_head_commiss2').show();
			$('.community_head_commiss3').hide();
		}else if(open_community_head_leve == 3){
			$('.community_head_commiss1').show();
			$('.community_head_commiss2').show();
			$('.community_head_commiss3').show();
		}
		
	})
	
	$('#clear_member_qrcode').click(function(){
		$.ajax({
			url:"<?php echo U('distribution/clear_user_member_qrcode');?>",
			type:'get',
			dataType:'json',
			success:function(){
				tip.msgbox.suc('清空成功');
			}
		})
	})
	
})
</script>
</body>