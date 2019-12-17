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
		<div class="layui-card-header layui-elem-quote">当前位置：<span class="line-text">商品设置</span></div>
		<div class="layui-card-body" style="padding:15px;">
			<form action="" method="post" class="layui-form" lay-filter="component-layui-form-item" enctype="multipart/form-data" >
		
				<div class="layui-form-item">
			<label class="layui-form-label">商品库存预警</label>
			<div class="layui-input-block">
				<input type="text" name="parameter[goods_stock_notice]" class="form-control" value="<?php echo ($data['goods_stock_notice']); ?>" />
			</div>
		</div>
		<div class="layui-form-item">
            <label class="layui-form-label">购买记录</label>
            <div class="layui-input-block">
                <label class='radio-inline'>
                    <input type='radio' name='parameter[is_show_buy_record]' value='0' <?php if( !empty($data) && $data['is_show_buy_record'] ==0 ){ ?>checked <?php } ?> title="不显示" /> 
                </label>
                <label class='radio-inline'>
                    <input type='radio' name='parameter[is_show_buy_record]' value='1' <?php if( empty($data) || $data['is_show_buy_record'] ==1 ){ ?>checked <?php } ?> title="显示" /> 
                </label>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">商品评价</label>
            <div class="layui-input-block">
                <label class='radio-inline'>
                    <input type='radio' name='parameter[is_show_comment_list]' value='0' <?php if( !empty($data) && $data['is_show_comment_list'] ==0 ){ ?>checked <?php } ?> title="不显示" /> 
                </label>
                <label class='radio-inline'>
                    <input type='radio' name='parameter[is_show_comment_list]' value='1' <?php if( empty($data) || $data['is_show_comment_list'] ==1 ){ ?>checked <?php } ?> title="显示" /> 
                </label>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">首页商品倒计时</label>
            <div class="layui-input-block">
                <label class='radio-inline'>
                    <input type='radio' name='parameter[is_show_list_timer]' value='0' <?php if( !empty($data) && $data['is_show_list_timer'] ==0 ){ ?>checked <?php } ?> title="不显示" /> 
                </label>
                <label class='radio-inline'>
                    <input type='radio' name='parameter[is_show_list_timer]' value='1' <?php if( empty($data) || $data['is_show_list_timer'] ==1 ){ ?>checked <?php } ?> title="显示" /> 
                </label>
            </div>
        </div>
		
		<div class="layui-form-item">
            <label class="layui-form-label">首页商品排序方式</label>
            <div class="layui-input-block">
                <label class='radio-inline'>
                    <input type='radio' name='parameter[index_sort_method]' value='0' <?php if( empty($data) || $data['index_sort_method'] ==0 ){ ?>checked <?php } ?> title="使用置顶排序" /> 
                </label>
                <label class='radio-inline'>
                    <input type='radio' name='parameter[index_sort_method]' value='1' <?php if( !empty($data) && $data['index_sort_method'] ==1 ){ ?>checked <?php } ?> title="使用排序大小排序(从大到小)" /> 
                </label>
            </div>
        </div>
		
		
		
        <div class="layui-form-item">
            <label class="layui-form-label">首页商品销量</label>
            <div class="layui-input-block">
                <label class='radio-inline'>
                    <input type='radio' name='parameter[is_show_list_count]' value='0' <?php if( !empty($data) && $data['is_show_list_count'] ==0 ){ ?>checked <?php } ?> title="不显示" /> 
                </label>
                <label class='radio-inline'>
                    <input type='radio' name='parameter[is_show_list_count]' value='1' <?php if( empty($data) || $data['is_show_list_count'] ==1 ){ ?>checked <?php } ?> title="显示" /> 
                </label>
            </div>
        </div>
		
		 <div class="layui-form-item">
            <label class="layui-form-label">新人专享</label>
            <div class="layui-input-block">
                <label class='radio-inline'>
                    <input type='radio' name='parameter[is_show_new_buy]' value='0' <?php if(!empty($data) && $data['is_show_new_buy'] ==0){ ?>checked <?php } ?> title="不显示" /> 
                </label>
                <label class='radio-inline'>
                    <input type='radio' name='parameter[is_show_new_buy]' value='1' <?php if(empty($data) || $data['is_show_new_buy'] ==1){ ?>checked <?php } ?> title="显示" /> 
                </label>
            </div>
        </div>
		<div class="layui-form-item">
			<label class="layui-form-label">限时秒杀</label>
			<div class="layui-input-block">
				<label class='radio-inline'>
					<input type='radio' name='parameter[is_show_spike_buy]' value='0' <?php if(!empty($data) && $data['is_show_spike_buy'] ==0){ ?>checked <?php } ?> title="不显示" /> 
				</label>
				<label class='radio-inline'>
					<input type='radio' name='parameter[is_show_spike_buy]' value='1' <?php if(empty($data) || $data['is_show_spike_buy'] ==1){ ?>checked <?php } ?> title="显示" /> 
				</label>
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">大家常买</label>
			<div class="layui-input-block">
				<label class='radio-inline'>
					<input type='radio' name='parameter[is_show_guess_like]' value='0' <?php if(!empty($data) && $data['is_show_guess_like'] ==0){ ?>checked <?php } ?> title="不显示" /> 
				</label>
				<label class='radio-inline'>
					<input type='radio' name='parameter[is_show_guess_like]' value='1' <?php if(empty($data) || $data['is_show_guess_like'] ==1){ ?>checked <?php } ?> title="显示" /> 
				</label>
			</div>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">猜你喜欢</label>
			<div class="layui-input-block">
				<label class='radio-inline'>
					<input type='radio' name='parameter[show_goods_guess_like]' value='0' <?php if( !empty($data) && $data['show_goods_guess_like'] ==0 ){ ?>checked <?php } ?> title="不显示" /> 
				</label>
				<label class='radio-inline'>
					<input type='radio' name='parameter[show_goods_guess_like]' value='1' <?php if( empty($data) || $data['show_goods_guess_like'] ==1 ){ ?>checked <?php } ?> title="显示" /> 
				</label>
			</div>
		</div>
		 <div class="layui-form-item">
			<label class="layui-form-label">猜你喜欢展示数量</label>
			<div class="layui-input-block fixmore-input-group">
			<div class="input-group">
				<input type="text" name="parameter[num_guess_like]" class="form-control valid" value="<?php echo ($data['num_guess_like']); ?>" />
			</div>
				<div class="help-block">默认：8个</div> 
			</div>
		</div>
		
		<div class="layui-form-item">
            <label class="layui-form-label">自提时间</label>
            <div class="layui-input-block">
                <label class='radio-inline'>
                    <input type='radio' name='parameter[is_show_ziti_time]' value='0' <?php if(!empty($data) && $data['is_show_ziti_time'] ==0){ ?>checked <?php } ?> title="不显示" /> 
                </label>
                <label class='radio-inline'>
                    <input type='radio' name='parameter[is_show_ziti_time]' value='1' <?php if(empty($data) || $data['is_show_ziti_time'] ==1){ ?>checked <?php } ?> title="显示" /> 
                </label>
            </div>
        </div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">支持商品仅快递</label>
			<div class="layui-input-block">
				<label class='radio-inline'>
					<input type='radio' name='parameter[is_open_only_express]' value='0' <?php if(empty($data) || $data['is_open_only_express'] ==0 ){ ?>checked <?php } ?> title="否" /> 
				</label>
				<label class='radio-inline'>
					<input type='radio' name='parameter[is_open_only_express]' value='1' <?php if(!empty($data) && $data['is_open_only_express'] ==1){ ?>checked <?php } ?> title="是" /> 
				</label>
			</div>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">开启商品关联商品</label>
			<div class="layui-input-block">
				<label class='radio-inline'>
					<input type='radio' name='parameter[is_open_goods_relative_goods]' value='0' <?php if(empty($data) || $data['is_open_goods_relative_goods'] ==0){ ?>checked <?php } ?> title="否" /> 
				</label>
				<label class='radio-inline'>
					<input type='radio' name='parameter[is_open_goods_relative_goods]' value='1' <?php if(!empty($data) && $data['is_open_goods_relative_goods'] ==1){ ?>checked <?php } ?> title="是" /> 
				</label>
			</div>
		</div>
		
		
		<div class="layui-form-item">
			<label class="layui-form-label">关闭详情计时</label>
			<div class="layui-input-block">
				<label class='radio-inline'>
					<input type='radio' name='parameter[is_close_details_time]' value='0' <?php if( empty($data) || $data['is_close_details_time'] ==0 ){ ?>checked <?php } ?> title="否" />
				</label>
				<label class='radio-inline'>
					<input type='radio' name='parameter[is_close_details_time]' value='1' <?php if( !empty($data) && $data['is_close_details_time'] ==1 ){ ?>checked <?php } ?> title="是" />
				</label>
			</div>
		</div>
		
		<div class="layui-form-item">
			<label class="layui-form-label">加入购物车背景色</label>
			<div class="layui-input-block">
				<div style="margin:0px;">
					<div class="layui-input-inline" style="width: 120px;">
					  <input type="text" name="parameter[goodsdetails_addcart_bg_color]" value="<?php echo ($data['goodsdetails_addcart_bg_color']); ?>" placeholder="请选择颜色" class="layui-input" id="test-colorpicker-form-input">
					</div>
					<div class="layui-inline" style="left: -11px;">
					  <div id="minicolors"></div>
					</div>
				  </div>
				<span class='layui-form-mid'>背景颜色值，有效值为十六进制颜色，默认：#f9c706</span>
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">立即购买背景色</label>
			<div class="layui-input-block">
				<div style="margin:0px;">
					<div class="layui-input-inline" style="width: 120px;">
					  <input type="text" name="parameter[goodsdetails_buy_bg_color]" value="<?php echo ($data['goodsdetails_buy_bg_color']); ?>" placeholder="请选择颜色" class="layui-input" id="test-colorpicker-form-input1">
					</div>
					<div class="layui-inline" style="left: -11px;">
					  <div id="minicolors1"></div>
					</div>
				  </div>
				<span class='layui-form-mid'>背景颜色值，有效值为十六进制颜色，默认：#ff5041</span>
			</div>
		</div>
		
		
			
		<div class="layui-form-item">
			<label class="layui-form-label">服务说明</label>
		    <div class="layui-input-block">
		        <div class="">
		            <?php echo tpl_ueditor('parameter[instructions]',$data['instructions'],array('height'=>'300'));?>
		        </div>
		    </div>
		</div>
		
		 <div class="layui-form-item">
			<label class="layui-form-label">显示团长信息</label>
			<div class="layui-input-block">
				<label class='radio-inline'>
					<input type='radio' name='parameter[is_show_goodsdetails_communityinfo]' value='0' <?php if( empty($data) || $data['is_show_goodsdetails_communityinfo'] ==0 ){ ?>checked <?php } ?> title="否" /> 
				</label>
				<label class='radio-inline'>
					<input type='radio' name='parameter[is_show_goodsdetails_communityinfo]' value='1' <?php if( !empty($data) && $data['is_show_goodsdetails_communityinfo'] ==1 ){ ?>checked <?php } ?> title="是" /> 
				</label>
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">显示预计佣金信息</label>
			<div class="layui-input-block">
				<label class='radio-inline'>
					<input type='radio' name='parameter[is_show_goodsdetails_commiss_money]' value='0' <?php if( empty($data) || $data['is_show_goodsdetails_commiss_money'] ==0 ){ ?>checked <?php } ?> title="否" /> 
				</label>
				<label class='radio-inline'>
					<input type='radio' name='parameter[is_show_goodsdetails_commiss_money]' value='1' <?php if( !empty($data) && $data['is_show_goodsdetails_commiss_money'] ==1 ){ ?>checked <?php } ?> title="是" /> 
				</label>
			</div>
			<span class='layui-form-mid' style="margin-left: 50px;">普通会员不显示，团长或分销身份时显示，既是团长又是分销，仅显示团长佣金</span>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">预售、提货时间显示</label>
			<div class="layui-input-block">
				<label class='radio-inline'>
					<input type="radio" name="parameter[ishow_index_pickup_time]" value="0" title="隐藏" <?php if( empty($data) || $data['ishow_index_pickup_time'] ==0 ){ ?>checked <?php } ?> />
				</label>
				<label class='radio-inline'>
					<input type="radio" name="parameter[ishow_index_pickup_time]" value="1" title="显示" <?php if( !empty($data) && $data['ishow_index_pickup_time'] ==1 ){ ?>checked <?php } ?> />
				</label>
			  <br>
			  <span class='layui-form-mid' style="margin-left: 20px;">首页商品列表预售、提货时间显示，默认隐藏。</span>
			</div>
		</div>

				
		
		<blockquote class="layui-elem-quote">商品详情域名替换</blockquote>		
			<div class="layui-form-item">
				
				<label class="layui-form-label">旧的域名</label>
				<div class="layui-input-block">
					<input type="text"  name="present_realm_name"  class="form-control" /> <!--readonly="readonly"-->
					域名格式为 http://域名 ， 如 https://www.baidu.com </br>
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">新的域名</label>
				<div class="layui-input-block">
					<input type="text" name="new_realm_name" class="form-control"  />
					填写‘旧的域名’与‘新的域名’后开始替换域名，不填写无效
				</div>
			</div>	

		<blockquote class="layui-elem-quote">分享群信息</blockquote>
		<div class="layui-form-item">
			<label class="layui-form-label">团长群分享</label>
			<div class="layui-input-block">
				<label class='radio-inline'>
					<input type='radio' name='parameter[isopen_community_group_share]' value='1' <?php if(!empty($data) && $data['isopen_community_group_share'] ==1){ ?>checked <?php } ?> title="开启" />
				</label>
				<label class='radio-inline'>
					<input type='radio' name='parameter[isopen_community_group_share]' value='0' <?php if(empty($data) || $data['isopen_community_group_share'] ==0){ ?>checked <?php } ?> title="关闭" />
				</label>
			</div>
		</div>	
		
			<div class="layui-form-item">
				<label class="layui-form-label">头像</label>
				<div class="layui-input-block">
					<?php echo tpl_form_field_image2('parameter[group_share_avatar]', $data['group_share_avatar']);?>
					<span class='layui-form-mid'>正方型图片</span>
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">标题</label>
				<div class="layui-input-block">
					<input type="text" name="parameter[group_share_title]" class="form-control" value="<?php echo ($data['group_share_title']); ?>" />
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">描述</label>
				<div class="layui-input-block">
					<input type="text" name="parameter[group_share_desc]" class="form-control" value="<?php echo ($data['group_share_desc']); ?>" />
				</div>
			</div>
		
				
				<div class="layui-form-item">
					<label class="layui-form-label"> </label>
					<div class="layui-input-block">
						<input type="submit" value="提交" lay-submit lay-filter="formDemo" class="btn btn-primary"  />
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						
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
  var form = layui.form;
  var colorpicker = layui.colorpicker;

  
	form.on('radio(linktype)', function(data){
		if (data.value == 2) {
			$('#typeGroup').show();
		} else {
			$('#typeGroup').hide();
		}
	});  

	
	//表单赋值
    var goodsdetails_addcart_bg_color = '<?php echo ($data["goodsdetails_addcart_bg_color"]); ?>';
    colorpicker.render({
      elem: '#minicolors'
      ,color: goodsdetails_addcart_bg_color ? goodsdetails_addcart_bg_color : '#f9c706'
      ,done: function(color){
        $('#test-colorpicker-form-input').val(color);
      }
    });

    //表单赋值
    var goodsdetails_buy_bg_color = '<?php echo ($data["goodsdetails_buy_bg_color"]); ?>';
    colorpicker.render({
      elem: '#minicolors1'
      ,color: goodsdetails_buy_bg_color ? goodsdetails_buy_bg_color : '#ff5041'
      ,done: function(color){
        $('#test-colorpicker-form-input1').val(color);
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
</body>