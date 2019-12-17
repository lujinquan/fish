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
	.img-40 {
		width: 40px;
		height: 40px;
	}
	.daterangepicker select.ampmselect, .daterangepicker select.hourselect, .daterangepicker select.minuteselect{
		width:auto!important;
	}
</style>
</head>
<body layadmin-themealias="default">

<table id="demo" lay-filter="test"></table>


<div class="layui-fluid">
	<div class="layui-card">
		<div class="layui-card-header layui-elem-quote">当前位置：<span class="line-text">佣金申请列表</span></div>
		<div class="layui-card-body" style="padding:15px;">
			<form action="" method="get" class="form-horizontal form-search layui-form" role="form">
				<input type="hidden" name="c" value="communityhead" />
				<input type="hidden" name="a" value="distribulist" />
				
				<div class="layui-form-item">
				  <div class="layui-inline">
				  
				    <span class="layui-input-inline">
						<select name='searchtime' class='form-control' style="width:100px;padding:0 5px;"  id="searchtime">
							<option value=''>不按时间</option>
							<option value='create_time' <?php if( $_GPC['searchtime']=='create_time' ){ ?>selected<?php } ?>>申请时间</option>
						</select>
					</span>
					<div class="layui-input-inline" style="width:280px;">
						<?php echo tpl_form_field_daterange('time', array( 'starttime'=>date('Y-m-d H:i', $starttime),'endtime'=>date('Y-m-d H:i', $endtime) ,'sm'=>true, 'placeholder'=>'申请时间'),true);;?>
						
					</div>
					<div class="layui-input-inline" >
						<select name='comsiss_state' class='layui-input layui-unselect' style="width:80px;"  >
							<option value=''>状态</option>
							<option value='0' <?php if( $comsiss_state =='0'){ ?>selected<?php } ?>>未审核</option>
							<option value='1' <?php if( $comsiss_state =='1'){ ?>selected<?php } ?>>已审核</option>
							<option value='2' <?php if( $comsiss_state =='2'){ ?>selected<?php } ?>>拒绝通过</option>
						</select>
					</div>
					<div class="layui-input-inline" >
						<input type="text" class="layui-input"  name="keyword" value="<?php echo ($keyword); ?>" placeholder="申请订单id"/>
				
					</div>
					
					<div class="layui-input-inline">
						<button class="layui-btn layui-btn-sm" type="submit"> 搜索</button>
						<button type="submit" name="export" value="1" class="btn btn-success  layui-btn layui-btn-sm">导出</button>
					</div>
				  </div>
				</div>
			</form>
			<form action="" class="layui-form" lay-filter="example" method="post" >
       
	   
				
				
				<div class="row">
					<div class="col-md-12">
					
					 
					
						<div class="page-table-header">
							<input type='checkbox' name="checkall" lay-skin="primary" lay-filter="checkboxall"  />
							
							<div class="btn-group">
								<button class='btn btn-default btn-sm btn-op btn-operation'  type="button" data-toggle='batch' data-href="<?php echo U('communityhead/agent_check_apply',array('state'=>1));?>"  data-confirm='确认要审核通过，已打款?'>
									审核通过
								</button>
								<button class='btn btn-default btn-sm btn-op btn-operation' type="button"  data-toggle='batch' data-href="<?php echo U('communityhead/agent_check_apply',array('state'=>2));?>" data-confirm='确认要拒绝通过?'>
									拒绝通过
								</button>
							</div>
						</div>
						<table class="table table-responsive" lay-even lay-skin="line" lay-size="lg">
						
							<thead>
								<tr>
									<th style="width:25px;"></th>
									<th style="width:60px;">ID</th>
									<th style="">小区名称</th>
									<th style="width: 150px;">团长</th>
									<th style="">联系方式</th>
									 <th style="">打款银行</br>打款账户</br>真实姓名</th>
								   
									<th style=''>申请提现金额</br>手续费</br>到账金额</th>
									<th style="">申请时间</br>审核时间</th>
									<th style='width:170px;'>状态</th>
									<th style="width: 300px;text-align: center;">操作</th>
								</tr>
							</tr>
							</thead>
							<tbody>
							<?php foreach( $list as $row ){ ?>
								<tr>
									<td style="position: relative; ">
										<input type='checkbox' name="item_checkbox" class="checkone" lay-skin="primary" value="<?php echo ($row['id']); ?>"/>
									</td>
									<td>
										<?php echo ($row['id']); ?>
									</td>
									<td> 
									<?php echo ($row['community_head']['community_name']); ?>
									</td>
									<td style="overflow: visible">
										<?php echo ($row['community_head']['head_name']); ?>     
									</td>
									<td> 
									<?php echo ($row['community_head']['head_mobile']); ?>
									</td>
									<td>
										<?php if($row['type'] > 0){ ?>
											<?php if( $row['type'] == 1 ){ ?>
												会员余额
											<?php }else if($row['type'] == 2){ ?>
												微信零钱<br/>
												
												真实姓名：<br/>
												<a href='javascript:;' data-toggle='ajaxEdit' data-href="<?php echo U('distribution/changename',array('type'=>'bankusername','id'=>$row['id']));?>" >
									
												<text class='text-primary'><?php echo ($row['bankusername']); ?></text>
												</a>
											<?php }else if($row['type'] == 3){ ?>
												支付宝<br/>
												<text class='text-primary'>真实姓名：<?php echo ($row['bankusername']); ?></text><br/>
												<text class='text-danger'><?php echo ($row['bankaccount']); ?></text>
											<?php }else if($row['type'] == 4){ ?>
												银行卡<br/>
												<text class='text-primary'>开户行：<?php echo ($row['bankname']); ?></text><br/>
												<text class='text-danger'>卡号：<?php echo ($row['bankaccount']); ?></text><br/>
												<text class='text-danger'>持卡人姓名：<?php echo ($row['bankusername']); ?></text>
											<?php } ?>
										<?php }else{ ?>
										<?php echo ($row['community_head_commiss']['bankname']); ?><br/>
										<text class='text-primary'><?php echo ($row['community_head_commiss']['bankaccount']); ?></text><br/>
										<text class='text-danger'><?php echo ($row['community_head_commiss']['bankusername']); ?></text>
										<?php } ?>
									</td>
									<td> 
									<?php echo ($row['money']); ?><br/><text class='text-primary'><?php echo ($row['service_charge']); ?></text><br/>
									<text class='text-danger'><?php echo $row['money']-$row['service_charge'];?></text>
									</td>
									
									<td><?php echo date("Y-m-d",$row['addtime']);?><br/><?php echo date("H:i:s",$row['addtime']);?>
									<br/>
									<?php if( !empty($row['shentime'])){ ?>
										<?php echo date("Y-m-d",$row['shentime']);?><br/><?php echo date("H:i:s",$row['shentime']);?>
									<?php } ?>
									</td>
									
									<td>
										<?php if( $row[state] ==2 ){ ?>
											已拒绝
										<?php }elseif( $row[state] ==1 ){ ?>
											<text class='text-danger'>已打款</text>
										<?php  }else{ ?>
										
										<input type="checkbox" name="" lay-filter="statewsitch" data-href="<?php echo U('communityhead/agent_check_apply',array('id'=>$row['id']));?>" <?php if( $row[state]==1){ ?>checked<?php  }else{ } ?> lay-skin="switch" lay-text="已审核|未审核">
										
										<input type="checkbox" name="" lay-filter="statewsitchunable" data-href="<?php echo U('communityhead/agent_check_apply',array('id'=>$row['id']));?>" <?php if( $row['state']==1 ){ ?>checked<?php } ?> lay-skin="switch" lay-text="已拒绝|点击拒绝审核">
										
										<?php } ?>
									
									<br/>
									</td>
									
									<td style="overflow:visible;text-align: center;">
										<div class="btn-group">
											
										
											<a class="btn  btn-op " href="<?php echo U('order/index',array('headid' => $row['head_id']));;?>" >
												推广订单
												
											</a>
											<a class="btn  btn-op " href="<?php echo U('communityhead/goodslist',array('head_id' => $row['head_id']));;?>">
												
													查看在售商品
												
											</a>
											
										</div>
									</td>
								</tr>
							<?php } ?>
							</tbody>
							<tfoot>
							<tr>
								<td colspan="5">
									<div class="page-table-header">
										<input type="checkbox" name="checkall" lay-skin="primary" lay-filter="checkboxall">
										<div class="btn-group">
											<button class='btn btn-default btn-sm btn-op btn-operation' type="button" data-toggle='batch' data-href="<?php echo U('communityhead/agent_check_apply',array('state'=>1));?>"  data-confirm='确认要审核通过，已打款?'>
												审核通过
											</button>
											<button class='btn btn-default btn-sm btn-op btn-operation' type="button" data-toggle='batch' data-href="<?php echo U('communityhead/agent_check_apply',array('state'=>2));?>" data-confirm='确认要拒绝通过?'>
												拒绝通过
											</button>
										</div>
									</div>
								</td>
								<td colspan="4" style="text-align: right">
									<?php echo ($pager); ?>
								</td>
							</tr>
							</tfoot>
						</table>
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
  
  
	$('.deldom').click(function(){
		var s_url = $(this).attr('data-href');
		layer.confirm($(this).attr('data-confirm'), function(index){
					 $.ajax({
						url:s_url,
						type:'post',
						dataType:'json',
						success:function(info){
						
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
					})
				}); 
	})
	
	$(document).on("click", '[data-toggle="ajaxEdit"]', function(e) {
		var obj = $(this),
			url = obj.data('href') || obj.attr('href'),
			data = obj.data('set') || {},
			html = $.trim(obj.text()),
			required = obj.data('required') || true,
			edit = obj.data('edit') || 'input';
		var oldval = $.trim($(this).text());
		e.preventDefault();
		submit = function() {
			e.preventDefault();
			var val = $.trim(input.val());
			if (required) {
				if (val == '') {
					 layer.msg(tip.lang.empty);
					return
				}
			}
			if (val == html) {
				input.remove(), obj.html(val).show();
				return
			}
			if (url) {
				$.post(url, {
					value: val
				}, function(ret) {
					ret = eval("(" + ret + ")");
					if (ret.status == 1) {
						obj.html(val).show()
					} else {
						 layer.msg(ret.result.message, ret.result.url)
					}
					input.remove()
				}).fail(function() {
					input.remove(),  layer.msg(tip.lang.exception)
				})
			} else {
				input.remove();
				obj.html(val).show()
			}
			obj.trigger('valueChange', [val, oldval])
		}, obj.hide().html('<i class="fa fa-spinner fa-spin"></i>');
		var input = $('<input type="text" class="form-control input-sm" style="width: 80%;display: inline;" />');
		if (edit == 'textarea') {
			input = $('<textarea type="text" class="form-control" style="resize:none" rows=3 ></textarea>')
		}
		obj.after(input);
		input.val(html).select().blur(function() {
			submit(input)
		}).keypress(function(e) {
			if (e.which == 13) {
				submit(input)
			}
		})
	})
	
	
	$('.btn-operation').click(function(){
		var ids_arr = [];
		var obj = $(this);
		var s_toggle = $(this).attr('data-toggle');
		var s_url = $(this).attr('data-href');
		
		
		$("input[name=item_checkbox]").each(function() {
			
			if( $(this).prop('checked') )
			{
				ids_arr.push( $(this).val() );
			}
		})
		if(ids_arr.length < 1)
		{
			layer.msg('请选择要操作的内容');
		}else{
			var can_sub = true;
			if( s_toggle == 'batch-remove' )
			{
				can_sub = false;
				
				layer.confirm($(obj).attr('data-confirm'), function(index){
					 $.ajax({
						url:s_url,
						type:'post',
						dataType:'json',
						data:{ids:ids_arr},
						success:function(info){
						
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
					})
				}); 
			}else{
				$.ajax({
					url:s_url,
					type:'post',
					dataType:'json',
					data:{ids:ids_arr},
					success:function(info){
					
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
				})
			}
		}
	})

	form.on('switch(restwsitch)', function(data){
	  
	  var s_url = $(this).attr('data-href')
	  
	  var rest = 1;
	  if(data.elem.checked)
	  {
		rest = 1;
	  }else{
		rest = 0;
	  }
	  
	  $.ajax({
			url:s_url,
			type:'post',
			dataType:'json',
			data:{rest:rest},
			success:function(info){
			
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
		})
	}); 
	form.on('switch(enablewsitch)', function(data){
	  
	  var s_url = $(this).attr('data-href')
	  
	  var enable = 1;
	  if(data.elem.checked)
	  {
		enable = 1;
	  }else{
		enable = 0;
	  }
	  
	  $.ajax({
			url:s_url,
			type:'post',
			dataType:'json',
			data:{enable:enable},
			success:function(info){
			
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
		})
	}); 
	
	
	form.on('switch(statewsitchunable)', function(data){
	  
	  var s_url = $(this).attr('data-href')
	  
	  var state = 0;
	  if(data.elem.checked)
	  {
		state = 2;
	  }
	  
	  $.ajax({
			url:s_url,
			type:'post',
			dataType:'json',
			data:{state:state},
			success:function(info){
			
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
		})
	}); 
	
	form.on('switch(statewsitch)', function(data){
	  
	  var s_url = $(this).attr('data-href')
	  
	  var state = 1;
	  if(data.elem.checked)
	  {
		state = 1;
	  }else{
		state = 0;
	  }
	  
	  $.ajax({
			url:s_url,
			type:'post',
			dataType:'json',
			data:{state:state},
			success:function(info){
			
				if(info.status == 0)
				{
					layer.msg(info.result.msg,{icon: 1,time: 2000,
						end:function(){
						location.href = location.href;
					}});
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
		})
	});  
	form.on('checkbox(checkboxall)', function(data){
	  
	  if(data.elem.checked)
	  {
		$("input[name=item_checkbox]").each(function() {
			$(this).prop("checked", true);
		});
		$("input[name=checkall]").each(function() {
			$(this).prop("checked", true);
		});
		
	  }else{
		$("input[name=item_checkbox]").each(function() {
			$(this).prop("checked", false);
		});
		$("input[name=checkall]").each(function() {
			$(this).prop("checked", false);
		});
	  }
	  
	  form.render('checkbox');
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