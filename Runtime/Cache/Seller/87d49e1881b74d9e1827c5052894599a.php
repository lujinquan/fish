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
</head>
<body layadmin-themealias="default">

<div class="layui-fluid">
	<div class="layui-card">
		<div class="layui-card-header layui-elem-quote">当前位置：<span class="line-text"><?php if( !empty($item['id'])){ ?>编辑<?php  }else{ ?>添加<?php } ?>供应商 <small><?php if( !empty($item['id'])){ ?>修改【<?php echo ($item['shopname']); ?>】<?php } ?></small></span></div>
		<div class="layui-card-body" style="padding:15px;">

			<div class="page-content">
				<form action="" method='post' class="layui-form" lay-filter="component-layui-form-item" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo ($item['id']); ?>">
					<div class="layui-form-item">
						<label class="layui-form-label must">供应商名称</label>
						<div class="layui-input-block">
							<input type="text" name="shopname" lay-verify="required" class="form-control" value="<?php echo ($item['shopname']); ?>"  />
							<span class='help-block'></span>
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label must">店铺名称</label>
						<div class="layui-input-block">
							<input type="text" name="storename" lay-verify="required" class="form-control" value="<?php echo ($item['storename']); ?>"  />
							<span class='help-block'></span>
						</div>
					</div>
					
					<div class="layui-form-item">
						<label class="layui-form-label must">关联会员</label>
						
						<div class="layui-input-block">
							<div class="input-group " style="margin: 0;">
								<input type="text" disabled value="<?php echo ($item['member_id']); ?>" class="form-control valid" name="member_id" placeholder="" id="member_id" >
								
								<span class="input-group-btn">
									<span data-input="#member_id" id="chose_member_id"  class="btn btn-default">选择会员</span>	
								</span>
							</div>
							<?php if( !empty($saler) ){ ?>
							<div class="input-group " style="margin: 0;">
								<div class="layadmin-text-center choose_user">
									<img style="" src="<?php echo ($saler['avatar']); ?>">
									<div class="layadmin-maillist-img" style=""><?php echo ($saler['nickname']); ?></div>
									<?php if(!empty($item['id'])){ ?>
									<?php }else{ ?>
									<button type="button" class="layui-btn layui-btn-sm" onclick="cancle_bind(this,'member_id')"><i class="layui-icon">&#xe640;</i></button>
									<?php } ?>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
					
					<div class="layui-form-item">
		                <label class="layui-form-label">供应商标志</label>
		                <div class="layui-input-block">
							<?php echo tpl_form_field_image2('logo', $item['logo']);?>
		                </div>
		            </div>
					 <div class="layui-form-item">
		                <label class="layui-form-label">店铺顶部图</label>
		                <div class="layui-input-block">
							<?php echo tpl_form_field_image2('banner', $item['banner']);?>
		                </div>
		            </div>
					<div class="layui-form-item">
						<label class="layui-form-label must">供应商联系人</label>
						<div class="layui-input-block">
							<input type="text" name="name" lay-verify="required" class="form-control" value="<?php echo ($item['name']); ?>"  />
							<span class='help-block'></span>
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label must"> 供应商手机号</label>
						<div class="layui-input-block">
							<input type="text" name="mobile" class="form-control" value="<?php echo ($item['mobile']); ?>" data-rule-required="true"  />
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">是否审核</label>
						<div class="layui-input-block" >
							<input type="radio" name="state" value="1" <?php if( $item['state'] == 1 || empty($item)){ ?>checked="true"<?php } ?> title="是" />
							<input type="radio" name="state" value="0" <?php if( $item['state'] == 0 && !empty($item)){ ?>checked="true"<?php } ?> title="否" />
						</div>
					</div>
					
					
					<?php if( !empty($item['id']) ){ ?>
					<div class="layui-form-item">
						<label class="layui-form-label">供应商类型</label>
						<div class="layui-input-block" >
							<input type="radio" name="type"  disabled value="0" <?php if( $item['type'] == 0 || empty($item) ){ ?>checked="true"<?php } ?> title="平台供应商" />
							<input type="radio" name="type"  disabled value="1" <?php if( !empty($item) && $item['type'] == 1 ){ ?>checked="true"<?php } ?> title="独立供应商"  />
						</div>
					</div>
					<?php }else{ ?>
					<div class="layui-form-item">
						<label class="layui-form-label">供应商类型</label>
						<div class="layui-input-block" >
							<input type="radio" name="type" value="0" <?php if( $item['type'] == 0 || empty($item) ){ ?>checked="true" <?php } ?> title="平台供应商" />
							<input type="radio" name="type" value="1" <?php if( !empty($item) && $item['type'] == 1 ){ ?>checked="true" <?php } ?> title="独立供应商"  />
						</div>
					</div>
					<?php } ?>
					
					<div class="layui-form-item">
						<label class="layui-form-label must"> 技术服务费</label>
						<div class="layui-input-block">
							<input type="text" name="commiss_bili" class="form-control" value="<?php echo ($item['commiss_bili']); ?>" data-rule-required="true"  />
							<span class='help-block'>请填写百分比,例如：6  那么平台抽成是6%。实付金额的百分比，扣除此比例 再扣除团长佣金，剩余货款归供应商</span>
						</div>
					</div>
					<blockquote class="layui-elem-quote" style="margin-left: 80px;">登录信息</blockquote>
					<div class="layui-form-item">
						<label class="layui-form-label must">登录账户</label>
						<div class="layui-input-block">
							<input type="text" name="login_name" class="form-control" value="<?php echo ($item['login_name']); ?>"   />
							<span class='help-block'></span>
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label must">登录密码</label>
						<div class="layui-input-block">
							<input type="text" name="login_password" class="form-control" value=""   />
							<span class='help-block'>留空则不修改密码</span>
						</div>
					</div>

					<div class="layui-form-item">
						<label class="layui-form-label"></label>
						<div class="layui-input-block">
							<input type="submit" name="submit" value="提交" lay-submit lay-filter="formDemo" class="btn btn-primary"  />
							
						</div>
					</div>
				</form>
			</div>
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
 
  
   //表单赋值
    colorpicker.render({
      elem: '#minicolors'
      ,color: '<?php echo ($data['nav_bg_color']); ?>'
      ,done: function(color){
        $('#test-colorpicker-form-input').val(color);
      }
    });
	
	$('#chose_member_id').click(function(){
		cur_open_div = $(this).attr('data-input');
		$.post("<?php echo U('user/zhenquery', array('ok' => 1));?>", {}, function(shtml){
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
						var backurl = "<?php echo U('supply/index',array('ok'=>'1'));?>";
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

</script>  
</body>
</html>