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
        'module': {'url' : '<?php if( defined('MODULE_URL') ) { ?>{MODULE_URL}<?php } ?>', 'name' : '<?php if (defined('IN_MODULE') ) { ?>{IN_MODULE}<?php } ?>'},
        'cookie': {'pre': ''},
        'account': <?php echo json_encode($_W['account']);?>,
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

  <style type="text/css">
  	.input-group .input-group-addon { padding: 0 5px; }
  </style>
</head>
<body layadmin-themealias="default">




<div class="layui-fluid">
	<div class="layui-card">
		<div class="layui-card-header layui-elem-quote">当前位置：<span class="line-text"><?php if(!empty($item['id'])){ ?>编辑<?php }else{ ?>添加<?php } ?>专题 <small><?php if(!empty($item['id'])){ ?>修改【<?php echo ($item['name']); ?>】<?php } ?></small></span></div>
		<div class="layui-card-body" style="padding:15px;">
			<form action="" method="post" class="layui-form" enctype="multipart/form-data" >
				<input type="hidden" name="id" value="<?php echo ($item['id']); ?>">
				<div class="layui-form-item">
					<label class="layui-form-label must">活动名称</label>
					<div class="layui-input-block">
						<input type="text" name="name" class="form-control" value="<?php echo ($item['name']); ?>" lay-verify="required"  />
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">活动首页入口图片</label>
					<div class="layui-input-block">
						<?php echo tpl_form_field_image2('cover', $item['cover'], '', array('extras'=>array('text'=>'placeholder="必填"')) );?>
						
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">活动首页入口样式</label>
					<div class="layui-input-block" >
						<input type="radio" name="type" value="0" <?php if(empty($item) || $item['type'] == 0){ ?>checked="true"<?php } ?> title="单图模式" />
						<input type="radio" name="type" value="1" <?php if(!empty($item) && $item['type'] == 1){ ?>checked="true"<?php } ?> title="单图+商品模式" />
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label must">活动页面主题标题</label>
					<div class="layui-input-block">
						<input type="text" name="special_title" class="form-control" value="<?php echo ($item['special_title']); ?>" data-rule-required="true"  />
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">活动页面主题图片</label>
					<div class="layui-input-block">
						<?php echo tpl_form_field_image2('special_cover', $item['special_cover']);?>
					</div>
				</div>
				
				<div class="layui-form-item">
					<label class="layui-form-label">活动页面背景颜色</label>
					<div class="layui-input-block">
						<div style="margin:0px;">
							<div class="layui-input-inline" style="width: 120px;">
							  <input type="text" name="bg_color" value="<?php echo ($item['bg_color']); ?>" placeholder="请选择颜色" class="layui-input" id="test-colorpicker-form-input">
							</div>
							<div class="layui-inline" style="left: -11px;">
							  <div id="minicolors"></div>
							</div>
					  	</div>
						<span class='help-block'>背景颜色值，有效值为十六进制颜色。默认色值：#F6F6F6</span>
					</div>
				</div>
				
				<div class="layui-form-item">
					<label class="layui-form-label">活动时间</label>
					<div class="layui-input-block">
						
						<?php echo tpl_form_field_daterange('time', array('starttime'=>date('Y-m-d H:i', $starttime),'endtime'=>date('Y-m-d H:i', $endtime)),true);;?>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">排序</label>
					<div class="layui-input-block">
						<input type="text" name="displayorder" class="form-control" value="<?php echo ($item['displayorder']); ?>"  />
						<span class='help-block'>数字越大越靠前</span>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">活动状态</label>
					<div class="layui-input-block" >
						<input type="radio" name="enabled" value="1" <?php if( $item['enabled'] == 1){ ?>checked="true"<?php } ?> title="开启" />
						<input type="radio" name="enabled" value="0" <?php if(empty($item['enabled']) || $item['enabled'] == 0){ ?>checked="true"<?php } ?> title="关闭" />
					</div>
				</div>
				
				
				<div class="layui-form-item">
					<label class="layui-form-label">首页显示</label>
					<div class="layui-input-block" >
						<input type="radio" name="is_index" value="1" <?php if($item['is_index'] == 1){ ?>checked="true"<?php } ?> title="是" />
						<input type="radio" name="is_index" value="0" <?php if(empty($item['is_index']) || $item['is_index'] == 0){ ?>checked="true"<?php } ?> title="否" />
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">展示模式</label>
					<div class="layui-input-block" >
						<input type="radio" name="show_type" value="0" <?php if(empty($item['show_type']) || $item['show_type'] == 0){ ?>checked="true"<?php } ?> title="小图" />
						<input type="radio" name="show_type" value="1" <?php if($item['show_type'] == 1){ ?>checked="true"<?php } ?> title="大图" />
					</div>
				</div>
				
				<div class="layui-form-item" id="goods_form_item">
					<label class="layui-form-label">选择推荐商品</label>
					<div class="layui-input-block">
						<div class="input-group " style="margin: 0;">
							<input type="text" disabled value="" class="form-control valid" name="" placeholder="" id="agent_id">
							<span class="input-group-btn">
								<span data-input="#agent_id" id="chose_agent_id"  class="btn btn-default">选择推荐商品</span>
							</span>
						</div>
						<?php if(!empty($limit_goods)){ ?>
						<?php foreach( $limit_goods as $goods ){ ?>
						<div class="input-group mult_choose_goodsid" data-gid="<?php echo ($goods['gid']); ?>" style="border-radius: 0;float: left;margin: 10px;margin-left:0px;width: 22%;">	
							<div class="layadmin-text-center choose_user">		
								<img style="" src="<?php echo ($goods['image']); ?>">		
								<div class="layadmin-maillist-img" style=""><?php echo ($goods['goodsname']); ?></div>		
								<button type="button" class="layui-btn layui-btn-sm" onclick="cancle_bind(this)">
									<i class="layui-icon"></i>
								</button>	
							</div>
						</div>
						<?php }} ?>
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label"></label>
					<div class="layui-input-block">
						<input type="hidden" name="limit_goods_list" value="<?php echo ($item['goodsids']); ?>" id="limit_goods_list" />
						<input type="submit" name="submit" value="提交" lay-submit lay-filter="formDemo" class="btn btn-primary col-lg-1"/>
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

layui.use(['jquery', 'layer','form','colorpicker'], function(){ 
  	$ = layui.$;
	
	
  	var colorpicker = layui.colorpicker;
  	//背景颜色
	var bg_color = '<?php echo ($item["bg_color"]); ?>';
	colorpicker.render({
	  elem: '#minicolors'
	  ,color: bg_color ? bg_color : '#F6F6F6'
	  ,done: function(color){
	    $('#test-colorpicker-form-input').val(color);
	  }
	});

	
	var form = layui.form;
	$('#chose_agent_id').click(function(){
		cur_open_div = $(this).attr('data-input');
		$.post("<?php echo U('goods/query_normal', array('template' => 'mult'));?>", {}, function(shtml){
		 layer.open({
			type: 1,
			area: '930px',
			content: shtml //注意，如果str是object，那么需要字符拼接。
		  });
		});
	})
	$('#chose_link').click(function(){
		cur_open_div = $(this).attr('data-input');
		$.post("<?php echo U('util/selecturl', array('ok' => 1));?>", {}, function(shtml){
		 layer.open({
			type: 1,
			area: '930px',
			content: shtml //注意，如果str是object，那么需要字符拼接。
		  });
		});
	})
	
	
  //监听提交
  form.on('submit(formDemo)', function(data){
	//mult_choose_goodsid limit_goods_list
	var gd_ar = [];
	var gd_str = '';
	$('.mult_choose_goodsid').each(function(){
		gd_ar.push( $(this).attr('data-gid') );
	})
	gd_str = gd_ar.join(',');
	
	data.field.limit_goods_list = gd_str;
	
	
	var cover = $("input[name='cover']").val();
	if(cover=='') {
		layer.msg('活动首页入口图片必须上传', {icon: 5});
		return false;
	}

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
						var backurl = "<?php echo U('marketing/special',array('ok'=>'1'));?>";
						location.href = backurl;
						// location.href = info.result.url;
					}
				}); 
			}
		}
	});
	
    return false;
  });
})

function cancle_bind(obj,sdiv)
{
	$('#'+sdiv).val('');
	$(obj).parent().parent().remove();
}

</script>   
</body>
</html>