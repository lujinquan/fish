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

<table id="demo" lay-filter="test"></table>


<div class="layui-fluid">
	<div class="layui-card">
		<div class="layui-card-header layui-elem-quote">当前位置：<span class="line-text">团长等级</span></div>
		<div class="layui-card-body" style="padding:15px;">
			
			<form action="" class="layui-form" lay-filter="example" method="post" >
       
				<div class="row">
					<div class="col-md-12">
						<div class="page-table-header">
							<span class="pull-right"> 
								<a  href="javascript:;" data-href="<?php echo U('communityhead/addlevel' , array('ok' => 1));?>" class="layui-btn layui-btn-sm ajaxModal"><i class="fa fa-plus"></i> 添加新等级</a>
								
							</span>
							
						</div>
						<table class="table table-responsive" lay-even lay-skin="line" lay-size="lg">
							<thead>
								 <tr>
									<th style='width:160px;'>等级名称</th>
									
									<?php if(!empty($community_money_type) && $community_money_type ==1){ ?>
									 <th>团长提成金额</th>
									<?php }else{ ?>
								    <th>团长提成比例</th>
									<?php } ?>
								   
									<th style="display:none;">升级条件</th>
									<th style="width: 265px;">操作</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach( $list as $row ){ ?>
								<tr <?php if( $row['id']=='default'){ ?>style='background:#f2f2f2'<?php } ?>>
									<td><?php echo ($row['levelname']); if( $row['id']=='default'){ ?>【默认等级】<?php } ?></td>
									
									<?php if(!empty($community_money_type) && $community_money_type ==1){ ?>
									<td><?php echo round((float)$row['commission'],2);?>元</td>
									<?php }else{ ?>
									<td><?php echo round((float)$row['commission'],2);?>%</td>
									<?php } ?>
									
									<td style="display:none;">	
										<?php if( $row['id']!='default'){ ?>
											<?php if( $row['ordermoney']>0){ ?>分销订单金额满 <?php echo ($row['ordermoney']); ?> 元 <?php  }else{ ?>不自动升级<?php } ?>
										<?php  }else{ ?>
										默认等级
										<?php } ?>
									</td>
									<td>
										<a  class='layui-btn layui-btn-xs ajaxModal' href="javascript:;" data-href="<?php echo U('communityhead/editlevel', array('id' => $row['id']));?>"  >
											<i class="layui-icon layui-icon-edit"></i>编辑
										</a>
										<?php if( $row['id']!='default'){ ?>
											<a  class='layui-btn layui-btn-xs deldom' href="javascript:;" data-href="<?php echo U('communityhead/deletelevel', array('id' => $row['id']));?>" data-confirm='确认删除此等级吗？?'>
												<i class="layui-icon">&#xe640;</i>删除
											</a>
										<?php } ?>
									</td>
								</tr>
								<?php } ?>
							</tbody>
							<tfoot>
							
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
  
	form.on('switch(statewsitch)', function(data){
	  
	  var s_url = $(this).attr('data-href')
	  
	  var s_value = 1;
	  if(data.elem.checked)
	  {
		s_value = 1;
	  }else{
		s_value = 0;
	  }
	  
	  $.ajax({
			url:s_url,
			type:'post',
			dataType:'json',
			data:{value:s_value},
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

<script>
var ajax_url = "";
$(function(){

	$(".ajaxModal").click(function () {
        var s_url = $(this).attr('data-href');
		ajax_url = s_url;
       $.ajax({
				url:s_url,
				type:"get",
				success:function(shtml){
					$('#ajaxModal').html(shtml);
					$("#ajaxModal").modal();
				}	
		})
    });
	$(document).delegate(".modal-footer .btn-primary","click",function(){
		var s_data = $('#ajaxModal form').serialize();
		$.ajax({
			url:ajax_url,
			type:'post',
			dataType:'json',
			data:s_data,
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
		return false;
	})
	
	
})
</script>
<div id="ajaxModal" class="modal fade" style="display: none;">

</div>

</body>