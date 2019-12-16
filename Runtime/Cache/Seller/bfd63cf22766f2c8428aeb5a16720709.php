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
		<div class="layui-card-header layui-elem-quote">当前位置：<span class="line-text">小程序tabbar设置</span></div>
		<div class="layui-card-body" style="padding:15px;">
			<form action="" method="post" class="layui-form" lay-filter="component-layui-form-item" enctype="multipart/form-data" >
				
				<div class="layui-form-item">
					<label class="layui-form-label">首页标题</label>
					<div class="layui-input-block">
						<input type="text" name="parameter[wepro_tabbar_text1]" class="layui-input" value="<?php echo ($data['wepro_tabbar_list']['t1']); ?>" />
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">未选中图标</label>
					<div class="layui-input-block">
						<?php echo tpl_form_field_image2('parameter[wepro_tabbar_iconPath1]', $data['wepro_tabbar_list']['i1']);?>
						<span class="layui-form-mid">此图为导航栏未选中状态图标，尺寸为81*81</span>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">选中图标</label>
					<div class="layui-input-block">
						<?php echo tpl_form_field_image2('parameter[wepro_tabbar_selectedIconPath1]', $data['wepro_tabbar_list']['s1']);?>
						<span class="layui-form-mid">此图为导航栏选中状态图标，尺寸为81*81</span>
					</div>
				</div>
				<hr>
				<div class="layui-form-item">
					<label class="layui-form-label">分类标题</label>
					<div class="layui-input-block">
						<input type="text" name="parameter[wepro_tabbar_text4]" class="layui-input" value="<?php echo ($data['wepro_tabbar_list']['t4']); ?>" />
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">未选中图标</label>
					<div class="layui-input-block">
						<?php echo tpl_form_field_image2('parameter[wepro_tabbar_iconPath4]', $data['wepro_tabbar_list']['i4']);?>
						<span class="layui-form-mid">此图为导航栏未选中状态图标，尺寸为81*81</span>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">选中图标</label>
					<div class="layui-input-block">
						<?php echo tpl_form_field_image2('parameter[wepro_tabbar_selectedIconPath4]', $data['wepro_tabbar_list']['s4']);?>
						<span class="layui-form-mid">此图为导航栏选中状态图标，尺寸为81*81</span>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">是否开启分类</label>
					<div class="layui-input-block">
						<label class='radio-inline'>
							<input type='radio' name='parameter[open_tabbar_type]' title="关闭" value='0' <?php if( !empty($data) && $data['open_tabbar_type'] ==0 ){ ?>checked <?php } ?> />
						</label>
						<label class='radio-inline'>
							<input type='radio' name='parameter[open_tabbar_type]' title="开启" value='1' <?php if( empty($data) || $data['open_tabbar_type'] ==1 ){ ?>checked <?php } ?> />
						</label>
					</div>
				</div>
				<hr>
				<div class="layui-form-item">
					<label class="layui-form-label">外部跳转标题</label>
					<div class="layui-input-block">
						<input type="text" name="parameter[wepro_tabbar_text5]" class="layui-input" value="<?php echo ($data['wepro_tabbar_list']['t5']); ?>" />
					</div>
				</div>
				
				<div class="layui-form-item">
					<label class="layui-form-label">链接类型</label>
					<div class="layui-input-block">
						<label class='radio-inline'>
							<input type='radio' name='parameter[tabbar_out_type]' title="webview外链" lay-filter="linktype" value=0 <?php if($data['tabbar_out_type']==0 || empty($data)){ ?>checked<?php } ?> /> 
						</label>
						<label class='radio-inline'>
							<input type='radio' name='parameter[tabbar_out_type]' title="本小程序链接" lay-filter="linktype" value=1 <?php if($data['tabbar_out_type']==1 && !empty($data)){ ?>checked<?php } ?> /> 
						</label>
						<label class='radio-inline'>
							<input type='radio' name='parameter[tabbar_out_type]' title="外部小程序链接" lay-filter="linktype" value=2 <?php if($data['tabbar_out_type']==2 && !empty($data)){ ?>checked<?php } ?> />
						</label>
						<label class='radio-inline'>
							<input type='radio' name='parameter[tabbar_out_type]' title="拼团" lay-filter="linktype" value="3" <?php if($data['tabbar_out_type']==3 && !empty($data)){ ?>checked<?php } ?> />
						</label>
						<label class='radio-inline'>
							<input type='radio' name='parameter[tabbar_out_type]' title="菜谱" lay-filter="linktype" value="4" <?php if( $data['tabbar_out_type']==4 && !empty($data) ){ ?>checked<?php } ?> />
						</label>
						
						<label class='radio-inline'>
							<input type='radio' name='parameter[tabbar_out_type]' title="视频列表" lay-filter="linktype" value="5" <?php if( $data['tabbar_out_type']==5 && !empty($data) ){ ?>checked<?php } ?> />
						</label>
						
					</div>
				</div>
				
				
				<div class="layui-form-item" id="appidGroup" style="<?php if( $data['tabbar_out_type']!=2 ){ ?>display: none;<?php } ?>">
					<label class="layui-form-label">跳转小程序appID</label>
					<div class="layui-input-block">
						<input type="text" name="parameter[tabbar_out_appid]" class="layui-input" value="<?php echo ($data['tabbar_out_appid']); ?>" />
					</div>
				</div> 
				<div class="layui-form-item" id="linkGroup" style="<?php if( $data['tabbar_out_type']==3 || $data['tabbar_out_type']==4 ){ ?>display: none;<?php } ?>">
					<label class="layui-form-label">跳转链接</label>
					<div class="layui-input-block">
						<input type="text" name="parameter[tabbar_out_link]" class="layui-input" value="<?php echo ($data['tabbar_out_link']); ?>" />
					</div>
				</div>
				
				
				<div class="layui-form-item">
					<label class="layui-form-label">未选中图标</label>
					<div class="layui-input-block">
						<?php echo tpl_form_field_image2('parameter[wepro_tabbar_iconPath5]', $data['wepro_tabbar_list']['i5']);?>
						<span class="layui-form-mid">此图为导航栏未选中状态图标，尺寸为81*81</span>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">选中图标</label>
					<div class="layui-input-block">
						<?php echo tpl_form_field_image2('parameter[wepro_tabbar_selectedIconPath5]', $data['wepro_tabbar_list']['s5']);?>
						<span class="layui-form-mid">此图为导航栏选中状态图标，尺寸为81*81</span>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">是否开启跳转按钮</label>
					<div class="layui-input-block">
						<label class='radio-inline'>
							<input type='radio' name='parameter[open_tabbar_out_weapp]' title="关闭" value='0' <?php if( !empty($data) && $data['open_tabbar_out_weapp'] ==0 ){ ?>checked <?php } ?> /> 
						</label>
						<label class='radio-inline'>
							<input type='radio' name='parameter[open_tabbar_out_weapp]' title="开启" value='1' <?php if( empty($data) || $data['open_tabbar_out_weapp'] ==1 ){ ?>checked <?php } ?> /> 
						</label>
					</div>
				</div>
				<hr>
				<div class="layui-form-item">
					<label class="layui-form-label">购物车标题</label>
					<div class="layui-input-block">
						<input type="text" name="parameter[wepro_tabbar_text2]" class="layui-input" value="<?php echo ($data['wepro_tabbar_list']['t2']); ?>" />
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">未选中图标</label>
					<div class="layui-input-block">
						<?php echo tpl_form_field_image2('parameter[wepro_tabbar_iconPath2]', $data['wepro_tabbar_list']['i2']);?>
						<span class="layui-form-mid">此图为导航栏未选中状态图标，尺寸为81*81</span>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">选中图标</label>
					<div class="layui-input-block">
						<?php echo tpl_form_field_image2('parameter[wepro_tabbar_selectedIconPath2]', $data['wepro_tabbar_list']['s2']);?>
						<span class="layui-form-mid">此图为导航栏选中状态图标，尺寸为81*81</span>
					</div>
				</div>
				<hr>
				<div class="layui-form-item">
					<label class="layui-form-label">个人中心标题</label>
					<div class="layui-input-block">
						<input type="text" name="parameter[wepro_tabbar_text3]" class="layui-input" value="<?php echo ($data['wepro_tabbar_list']['t3']); ?>" />
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">未选中图标</label>
					<div class="layui-input-block">
						<?php echo tpl_form_field_image2('parameter[wepro_tabbar_iconPath3]', $data['wepro_tabbar_list']['i3']);?>
						<span class="layui-form-mid">此图为导航栏未选中状态图标，尺寸为81*81</span>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">选中图标</label>
					<div class="layui-input-block">
						<?php echo tpl_form_field_image2('parameter[wepro_tabbar_selectedIconPath3]', $data['wepro_tabbar_list']['s3']);?>
						<span class="layui-form-mid">此图为导航栏选中状态图标，尺寸为81*81</span>
					</div>
				</div>
				
				
				<div class="layui-form-item" >
					<label class="layui-form-label">选中字体颜色</label>
					<div class="layui-input-block">
						<div class="" style="margin:0px;">
							<div class="layui-input-inline" style="width: 120px;">
							  <input type="text" name="parameter[wepro_tabbar_selectedColor]" value="<?php echo ($data['wepro_tabbar_selectedColor']); ?>" placeholder="请选择颜色" class="layui-input" id="test-colorpicker-form-input">
							</div>
							<div class="layui-inline" style="left: -11px;">
							  <div id="minicolors"></div>
							</div>
						  </div>
						<span class='layui-form-mid'>颜色值，有效值为十六进制颜色。默认色值：<font color="#F75451">#F75451</font></span>
					</div>
				</div>
				
				<div class="layui-form-item">
					<label class="layui-form-label"> </label>
					<div class="layui-input-block">
					
						<input type="hidden" name="wepro_tabbar_version" value="<?php if( !empty($data['wepro_tabbar_version']) ){ echo $data['wepro_tabbar_version']+1; }else{ ?>0<?php } ?>">
						
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

layui.use(['jquery', 'layer','form','colorpicker'], function(){ 
  $ = layui.$;
  var form = layui.form;
  
  
  	var colorpicker = layui.colorpicker;
  
    //表单赋值
    var wepro_tabbar_selectedColor = '<?php echo ($data["wepro_tabbar_selectedColor"]); ?>';
    colorpicker.render({
      elem: '#minicolors'
      ,color: wepro_tabbar_selectedColor ? wepro_tabbar_selectedColor : '#F75451'
      ,done: function(color){
        $('#test-colorpicker-form-input').val(color);
      }
    });
  
   form.on('radio(linktype)', function(data){
		if (data.value == 2) {
			$('#linkGroup').show();
			$('#appidGroup').show();
		} else if(data.value == 3 || data.value == 4 ){
			$('#linkGroup').hide();
			$('#appidGroup').hide();
		} else {
			$('#linkGroup').show();
			$('#appidGroup').hide();
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