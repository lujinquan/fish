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
   
<script type="text/javascript" src="/static/js/dist/area/cascade.js"></script>
<script type="text/javascript" src="/static/js/dist/select2/select2.min.js"></script>

<link rel="stylesheet" href="/static/js/dist/select2/select2-bootstrap.css">
<link rel="stylesheet" href="/static/js/dist/select2/select2.css">


<script type="text/javascript" src="/web/resource/js/lib/moment.js"></script>
<link rel="stylesheet" href="/web/resource/components/datetimepicker/jquery.datetimepicker.css">
<link rel="stylesheet" href="/web/resource/components/daterangepicker/daterangepicker.css">
<style type='text/css'>
    .tabs-container .layui-form-item {overflow: hidden;}
    .tabs-container .tabs-left > .nav-tabs {}
    .tab-goods .nav li {float:left;}
    .spec_item_thumb {position: relative; width: 30px; height: 20px; padding: 0; border-left: none;}
    .spec_item_thumb i {position: absolute; top: -5px; right: -5px;}
	.input-group .spec_item_thumb{padding:0px;}
	
    .multi-img-details, .multi-audio-details {margin-top:.5em;max-width: 700px; padding:0; }
    .multi-audio-details .multi-audio-item {width:155px; height: 40px; position:relative; float: left; margin-right: 5px;}
	.region-goods-details {
		background: #f8f8f8;
		margin-bottom: 10px;
		padding: 0 10px;
	}
	.region-goods-left{
		text-align: center;
		font-weight: bold;
		color: #333;
		font-size: 14px;
		padding: 20px 0;
	}
	.region-goods-right{
		border-left: 3px solid #fff;
		padding: 10px 10px;
	}
	.input-group .input-group-btn .btn:hover{background-color:#5bc0de}
	.layui-form-select{display:none;}
	.daterangepicker select.ampmselect, .daterangepicker select.hourselect, .daterangepicker select.minuteselect {
		width: auto!important;
	}
.input-group .input-group-addon{}
</style>

</head>
<body layadmin-themealias="default">

<div class="layui-fluid">
	<div class="layui-card">
		<div class="layui-card-header layui-elem-quote">当前位置：<span class="line-text"><?php if( !empty($item['id'])){ ?>编辑<?php  }else{ ?>添加<?php } ?>商品 <small><?php if( !empty($item['id'])){ ?>修改【<span class="text-info"><?php echo ($item['goodsname']); ?></span>】<?php } ?></small></span></div>
		<div class="layui-card-body" style="padding:15px;">
			<form action="" method="post" class="layui-form" lay-filter="component-layui-form-item" enctype="multipart/form-data" >
	
				
				<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
				  <ul class="layui-tab-title">
					<li  <?php if( empty($_GPC['tab']) || $_GPC['tab']=='basic'){ ?>class="layui-this"<?php } ?>>基本信息</li>
					<li  <?php if( $_GPC['tab']=='option'){ ?>class="layui-this"<?php } ?> >规格库存</li>
					<li <?php if( $_GPC['tab']=='des'){ ?>class="layui-this"<?php } ?> >商品详情</li>
					
					
					<?php $commiss_level = D('Home/Front')->get_config_by_name('commiss_level'); ?>
					
					<?php if( !empty($community_head_level) && count($community_head_level) > 1 || ($commiss_level > 0) ){ ?>
					<li <?php if( $_GPC['tab']=='community_head_level'){ ?>class="layui-this"<?php } ?> >等级/分销</li>
					<?php } ?>
					
					<?php if( !empty($is_open_goods_relative_goods) && $is_open_goods_relative_goods == 1 ){ ?>
					<li <?php if( $_GPC['tab']=='goods_relative_goods'){ ?>class="layui-this"<?php } ?> >推荐商品</li>
					<?php } ?>
				  </ul>
				  <div class="layui-tab-content" >
					
					<div class="layui-tab-item   <?php if( empty($_GPC['tab']) || $_GPC['tab']=='basic'){ ?>layui-show<?php } ?>" >
						<!---- 基本信息begin --->
						<div class="region-goods-details layui-row">
							
							<div class="layui-form-item">
								<div class="layui-form-item" style="padding-top:10px;">
									<label class="layui-form-label must">商品名称</label>
								  
									<div class="layui-input-block"  style="padding-right:0;" >
										<input type="text" name="goodsname" id="goodsname" class="form-control" value="<?php echo ($item['goodsname']); ?>" data-rule-required="true" />
									</div>
									
								</div>
								<div class="layui-form-item">
									<label class="layui-form-label">商品分类</label>
									<div class="layui-input-block">
										<select id="cates"  multiple="multiple"  name='cates[]'  class="form-control select2"  >
											<?php foreach( $category as $c ){ ?>
											<option value="<?php echo ($c['id']); ?>" <?php if( is_array($item['cates']) && in_array($c['id'],$item['cates'])){ ?>selected<?php } ?> ><?php echo ($c['name']); ?></option>
											<?php } ?>
										</select>
										
									</div>
								</div>
								<div class="layui-form-item">
									<label class="layui-form-label">商品简介</label>
									<div class="layui-input-block">
										<textarea  name="subtitle" id="subtitle" rows="5"  class="form-control" data-parent=".subtitle" maxlength="100" data-rule-maxlength="100"><?php echo ($item['subtitle']); ?></textarea>
										<div class="layui-form-mid layui-word-aux">副标题的长度请控制在100字以内</div>
									</div>
								</div>

								
								
								<div class="layui-form-item">
								   <label class="layui-form-label">默认商品预达简介</label>
									<div class="layui-input-block ">
										<input type="checkbox" lay-skin="primary" name="is_show_arrive" class="form-control valid" <?php if( empty($item) || $item['is_show_arrive'] ==1 || !isset($item['is_show_arrive']) ){ ?>checked<?php } ?> value="1" title="展示预达时间" />
										<br/>
										<div class="layui-form-mid layui-word-aux">“商品预达简介”为商品名称下方的“预计送达时间”。例如："现在下单 预计（12点前下单，预计当天送达）可自提" 默认开启，关闭后不进行显示。</div>
									</div>
								</div>
								<div class="layui-form-item">
									<label class="layui-form-label">商品自定义预达简介</label>
									<div class="layui-input-block">
										<label class="radio-inline"><input type="radio" name="diy_arrive_switch" value="0" <?php if( !isset($item['diy_arrive_switch']) || $item['diy_arrive_switch'] == 0 ){ ?>checked="true"<?php } ?> title="关闭" /> </label>
										<label class="radio-inline"><input type="radio" name="diy_arrive_switch" value="1" <?php if( isset($item['diy_arrive_switch']) && $item['diy_arrive_switch'] == 1 ){ ?>checked="true"<?php } ?> title="开启" /> </label>
										<div class="layui-form-mid layui-word-aux">“商品自定义预达简介”为商品名称下方“预计送达时间”，配合“商品预达简介”使用默认关闭状态，在“商品预达简介”描述不精确的情况下建议使用此项，如果使用此项建议关闭“商品预达简介”。</div>
									</div>
								</div>
								<div class="layui-form-item">
									<label class="layui-form-label"></label>
									<div class="layui-input-block">
										<textarea  name="diy_arrive_details" id="diy_arrive_details" rows="3"  class="form-control" maxlength="35" data-rule-maxlength="35"><?php echo ($item['diy_arrive_details']); ?></textarea>
										<div class="layui-form-mid layui-word-aux">文字的长度请控制在35字以内</div>
									</div>
								</div>

								
								<div class="layui-form-item">
									<label class="layui-form-label">商品简短标题</label>
									<div class="layui-input-block">
										<input type="text" name="print_sub_title" id="print_sub_title" class="form-control" value="<?php echo ($item['print_sub_title']); ?>" />
										<div class="layui-form-mid layui-word-aux">小票打印机使用，请控制字数，未填写默认截取商品标题(无须打印的可以不填写)</div>
									</div>
								</div>
								
								<div class="layui-form-item">
									<label class="layui-form-label must">商品视频</label>
									<div class="layui-input-block gimgs">
											<?php echo tpl_form_field_video('video',$item['video'] );;?>
										<span class="layui-form-mid layui-word-aux image-block">
											请输入视频链接地址或者选择上传视频(支持抖音视频地址)
										</span>
									</div>
								</div>
								
								<div class="layui-form-item">
									<label class="layui-form-label must">首页商品（大图）</label>
									<div class="layui-input-block gimgs">
										<?php echo tpl_form_field_image2('big_img',$item['big_img']);?>
										<span class="layui-form-mid layui-word-aux image-block">此图为首页商品大图模式封面图，最佳尺寸:710*400</span>
									</div>
								</div>
							
								<div class="layui-form-item">
									<label class="layui-form-label must">商品图片<label style="color:red;font-size:16px;font-weight:900">*</label></label>
									<div class="layui-input-block gimgs" id="gimgs_mult">
										<?php echo tpl_form_field_multi_image3('thumbs',$item['piclist']);?>
										
										<span class="layui-form-mid layui-word-aux image-block">第一张为缩略图，建议为正方型图片，其他为详情页面图片，尺寸建议宽度为640，并保持图片大小一致，可拖拽改变图片顺序</span>
										
									</div>
								</div>
								
								
								<div class="layui-form-item">
									<label class="layui-form-label">分享标题</label>
									<div class="layui-input-block">
										<input type="text" name="share_title" class="form-control" value="<?php echo ($item['share_title']); ?>" />
										<div class="layui-form-mid layui-word-aux"></div>
									</div>
								</div>
								
								<div class="layui-form-item">
									<label class="layui-form-label ">分享图片</label>
									<div class="layui-input-block gimgs">
										<?php echo tpl_form_field_image2('goods_share_image',$item['goods_share_image']);?>
										<span class="layui-form-mid layui-word-aux image-block">此图为商品详情页分享图片（比例为长宽比5:4）</span>
									</div>
								</div>
								<?php if($is_updown){ ?>
								<div class="layui-form-item">
									<label class="layui-form-label">商品状态</label>
									<div class="layui-input-block">
										<label class="radio-inline"><input type="radio" name="grounding" value="1" <?php if( !isset($item['grounding']) || $item['grounding'] == 1){ ?>checked="true"<?php } ?> title="上架" /> </label>
										<label class="radio-inline"><input type="radio" name="grounding" value="0" <?php if( isset($item['grounding']) && $item['grounding'] == 0){ ?>checked="true"<?php } ?> title="下架" /> </label>
									</div>
								</div>
								<?php } ?>
								<?php if($is_index){ ?>
								<div class="layui-form-item">
									<label class="layui-form-label">首页推荐</label>
									<div class="layui-input-block">
										<label class="radio-inline"><input type="radio" name="is_index_show" value="1" <?php if( !isset($item['is_index_show']) || $item['is_index_show'] == 1){ ?>checked="true"<?php } ?> title="是" /> </label>
										<label class="radio-inline"><input type="radio" name="is_index_show" value="0" <?php if( isset($item['is_index_show']) && $item['is_index_show'] == 0){ ?>checked="true"<?php } ?> title="否" /> </label>
									</div>
								</div>
								<?php } ?>
								
								<?php if( !empty($is_open_vipcard_buy) && $is_open_vipcard_buy == 1 ){ ?>
								<div class="layui-form-item" >
									<label class="layui-form-label">参与会员价</label>
									<div class="col-sm-10 col-xs-12" > 
										<div class="radio-inline">
											<input type="checkbox"  lay-skin="primary"  name="is_take_vipcard" <?php if( isset($item['is_take_vipcard']) && $item['is_take_vipcard'] ==1 ){ ?> checked <?php } ?> value="1" />
											
											<div style="clear:both;"></div>
											<span class="layui-form-mid layui-word-aux">开启会员价，该商品会员卡会员下单享会员价</span>
										</div>
									</div>
								</div>
								<?php } ?>
								
								
								<div class="layui-form-item" style="display:none;">
									<label class="layui-form-label">分享描述</label>
									<div class="layui-input-block">
										<input type="text" name="share_description" class="form-control" value="<?php echo ($item['share_description']); ?>" />
										<div class="layui-form-mid layui-word-aux">公众号才有的，小程序没有这个描述</div>
									</div>
								</div>
								<div class="layui-form-item price" >
									<label class="layui-form-label">商品价格<label style="color:red;font-size:16px;font-weight:900">*</label></label>
									<div class="layui-input-block">
										
										<div class="input-group">
											<input type="text" name="price" id="price" class="form-control" value="<?php echo ($item['price']); ?>" <?php if($item['hasoption']!=1){ ?> lay-verify="required"<?php } ?> />
											<?php if( !empty($is_open_vipcard_buy) && $is_open_vipcard_buy == 1 ){ ?>
											<span class="input-group-addon">元 会员价</span>
											<input type="text" name="card_price" id="card_price" class="form-control" value="<?php echo ($item['card_price']); ?>" <?php if( $item['hasoption']!=1 ){ ?>lay-verify="required"<?php } ?> placeholder="请填写会员价"/>
											<?php } ?>
											<span class="input-group-addon">元 原价</span>
											<input type="text" name="productprice" id="productprice" class="form-control" value="<?php echo ($item['productprice']); ?>" <?php if($item['hasoption']!=1){ ?>lay-verify="required" <?php } ?> />
											<span class="input-group-addon">元 （市场价、划线价）成本价</span>
											<input type="text" name="costprice" id="costpriceprice" class="form-control" value="<?php echo ($item['costprice']); ?>"  placeholder="请填写商品成本价"/>
										</div>
										<span class='layui-form-mid layui-word-aux'>如未启用商品规格，请填写商品价格</span>
										
									</div>
								</div>
								
								
								<?php if($is_vir_count){ ?>
								<div class="layui-form-item" >
									<label class="layui-form-label">已出售数</label>
									<div class="layui-input-block">
										<div class="input-group">
											<input type="text" name="sales" id="sales" class="form-control" value="<?php echo ($item['sales']); ?>" />
											<span class="input-group-addon">备注：前台销量=虚拟销量+实际销量</span>
										</div>
									</div>
								</div>
								<?php } ?>
								<div class="layui-form-item" >
									<label class="layui-form-label">提货时间</label>
									<div class="col-sm-10 col-xs-12" id="radPickupDateTip"> 
										<?php $item['pick_up_type'] = isset($item['pick_up_type']) ? $item['pick_up_type'] : 1; ?>
										<label class="radio-inline"><input type="radio"  name="pick_up_type" <?php if( !isset($item['pick_up_type']) || $item['pick_up_type'] ==0 ){ ?> checked <?php } ?> value="0" title="当日达" /><span class="fake-radio"></span></label>
										<label  class="radio-inline"><input type="radio"  name="pick_up_type" <?php if( isset($item['pick_up_type']) && $item['pick_up_type'] ==1 ){ ?> checked <?php } ?> value="1" title="次日达" /><span class="fake-radio"></span></label>
										<label  class="radio-inline"><input type="radio"  name="pick_up_type" <?php if( isset($item['pick_up_type']) && $item['pick_up_type'] ==2 ){ ?> checked <?php } ?> value="2" title="隔日达" /><span class="fake-radio"></span></label>
										<label  class="radio-inline"><input type="radio"  name="pick_up_type" <?php if( isset($item['pick_up_type']) && $item['pick_up_type'] ==3 ){ ?> checked <?php } ?> value="3" title="自定义" /><span class="fake-radio"></span></label>
										
										<input class="form-control " id="txtPickupDateTip" name="pick_up_modify" style="vertical-align: sub; <?php if( isset($item['pick_up_type']) && $item['pick_up_type'] ==3){ ?>display:inline-block;<?php  }else{ ?>display: none;<?php } ?>width: 120px;" type="text" value="<?php echo ($item['pick_up_modify']); ?>">
										
									  
										<div style="clear:both;"></div>
										<span class="layui-form-mid layui-word-aux">系统会根据当前日期自动生成具体提货时间，或直接显示自定义内容</span>
									</div>
								</div>
								
								<div class="layui-form-item" style="display:none;">
									<label class="layui-form-label"></label>
									<div class="layui-input-block">
										<label class="checkbox-inline"><input type="checkbox" name="showsales" value="1" <?php if( $item['showsales'] == 1){ ?>checked="true"<?php } ?>   /> 显示销量</label>
										<span class="layui-form-mid layui-word-aux"></span>
									</div>
								</div>
								<div class="layui-form-item" style="display:none;">
									<label class="layui-form-label">标签</label>
									<div class="layui-input-block">
										<label class="checkbox-inline"><input type="checkbox" name="quality" value="1" <?php if( !empty($item['quality'])){ ?>checked="true"<?php } ?>   /> 正品保证</label>
										<label class="checkbox-inline"><input type="checkbox" name="seven" value="1" <?php if( !empty($item['seven'])){ ?>checked="true"<?php } ?>   /> 7天无理由退换</label>
										<label class="checkbox-inline"><input type="checkbox" name="repair" value="1" <?php if( !empty($item['repair'])){ ?>checked="true"<?php } ?>   /> 保修</label>
									</div>
								</div>
								
								
								<div class="layui-form-item">
									<label class="layui-form-label">自定义标签</label>
									
									<div class="layui-input-block">
										<div class="input-group " style="margin: 0;">
											<input type="text" disabled value="<?php echo ($item['label']['id']); ?>" class="form-control valid" name="labelname" placeholder="" id="label_id">
											<span class="input-group-btn">
												<span data-input="#label_id" id="chose_label_id"  class="btn btn-default">选择标签</span>
											</span>
										</div>
										<?php if( $item['label']){ ?>
										<div class="input-group " style="margin: 0;">
											<div class="layadmin-text-center choose_user">
												
												<div class="" style=""><?php echo ($item['label']['tagname']); ?></div>
												<button type="button" class="layui-btn layui-btn-sm" onclick="cancle_bind(this,'label_id')"><i class="layui-icon">&#xe640;</i></button>
											</div>
										</div>
										<?php } ?>
									</div>
								</div>
								<?php if($is_open_only_express == 1){ ?>
								<div class="layui-form-item" >
									<label class="layui-form-label">仅快递</label>
									<div class="col-sm-10 col-xs-12" > 
										<input type="checkbox"  lay-skin="primary"  name="is_only_express" <?php if(isset($item['is_only_express']) && $item['is_only_express'] ==1 ){ ?> checked <?php } ?> value="1" />
										
										<div style="clear:both;"></div>
										<span class="layui-form-mid layui-word-aux">开启仅快递后，该商品只会快递商品一起下单</span>
									</div>
								</div>
								<?php } ?>
								
								
								<?php if( $delivery_type_express == 1){ ?>
								<div class="layui-form-item dispatch_info">
									<label class="layui-form-label">运费设置</label>
									<div class="layui-input-block" style='padding-left:0'>
										
										<div class="input-group">
											<span class='input-group-addon' style='border:none;padding:0px;'><label class="radio-inline" style='margin-top:-7px;' ><input type="radio" name="dispatchtype" value="0" <?php if( empty($item['dispatchtype'])){ ?>checked="true"<?php } ?> title="运费模板"  /> </label></span>
											<select class="form-control tpl-category-parent select2" id="dispatchid" name="dispatchid">
												
												<?php foreach( $dispatch_data as $dispatch_item ){ ?>
												<option value="<?php echo ($dispatch_item['id']); ?>" <?php if( $item['dispatchid'] == $dispatch_item['id']){ ?>selected="true"<?php } ?>><?php echo ($dispatch_item['name']); ?></option>
												<?php } ?>
											</select>
										</div>
										
									</div>
								</div>
								<div class="layui-form-item dispatch_info">
									<label class="layui-form-label"></label>
									<div class="layui-input-block" style='padding-left:0'>
										<div class="input-group">
											<span class='input-group-addon' style='border:none;padding:0px;'><label class="radio-inline"  style='margin-top:-7px;' >
											<input type="radio"name="dispatchtype" value="1" <?php if( $item['dispatchtype'] == 1){ ?>checked="true"<?php } ?> title="统一邮费"  /> </label></span>
											<input type="text" name="dispatchprice" id="dispatchprice" class="form-control" value="<?php echo ($item['dispatchprice']); ?>" />
											<span class="input-group-addon">元</span>
										</div>

									</div>
								</div>
								<?php } ?>
								
								<?php  $is_show_fullre = true; if (defined('ROLE') && ROLE == 'agenter' ) { $supper_info = get_agent_logininfo(); if($supper_info['type'] == 1) { $is_show_fullre = false; } } ?>
								<?php if( $is_show_fullre && !empty($is_open_fullreduction) && $is_open_fullreduction == 1){ ?>
								
								<div class="layui-form-item" >
									<label class="layui-form-label">满减活动</label>
									<div class="col-sm-10 col-xs-12"> 
										<label class="radio-inline"><input type="radio"  name="is_take_fullreduction" <?php if( !isset($item['is_take_fullreduction']) || $item['is_take_fullreduction'] ==1 ){ ?> checked <?php } ?> value="1" title="参与" /><span class="fake-radio"></span></label>
										<label  class="radio-inline"><input type="radio"  name="is_take_fullreduction" <?php if( isset($item['is_take_fullreduction']) && $item['is_take_fullreduction'] ==0 ){ ?> checked <?php } ?> value="0" title="不参与" /><span class="fake-radio"></span></label>
									</div>
								</div>
								<?php } ?>
								
								
								<?php if($supply_can_goods_sendscore == 1){ ?>
								<div class="layui-form-item" >
									<label class="layui-form-label">下单送积分</label>
									<div class="col-sm-10 col-xs-12" id="send_score_div"> 
										
											<input type="checkbox" lay-filter="is_modify_sendscore" lay-skin="primary"  name="is_modify_sendscore" <?php if(isset($item['is_modify_sendscore']) && $item['is_modify_sendscore'] ==1){ ?> checked <?php } ?> value="1" />
											
										<input class="form-control " id="send_score_divTip" name="send_socre" style="vertical-align: sub; <?php if(isset($item['is_modify_sendscore']) && $item['is_modify_sendscore'] ==1){ ?>display:inline;<?php }else{ ?>display: none;<?php } ?>width: 120px;" type="text" value="<?php echo ($item['send_socre']); ?>">
										
										<div style="clear:both;"></div>
										<span class="layui-form-mid layui-word-aux">赠送数量 = 商品数量 * 下单送积分数量（未开启，则使用系统全局设置）</span>
									</div>
								</div>
								<?php } ?>
								
								<?php if($index_sort_method == 1){ ?>
								<div class="layui-form-item" >
									<label class="layui-form-label">首页排序</label>
									<div class="layui-input-block">
										<div class="input-group">
											<input type="text" name="index_sort" id="index_sort" class="form-control" value="<?php echo ($item['index_sort']); ?>" />
											<span class="input-group-addon">备注：排序越大显示越靠前</span>
										</div>
									</div>
								</div>
								<?php } ?>
								
							</div>
							
							
						</div>




						<div class="region-goods-details ">
							
							<div class="layui-form-item">
								<div class="layui-form-item">
									<label class="layui-form-label">团购时间</label>
									<div class="layui-input-block">
										<?php echo tpl_form_field_daterange('time', array('starttime'=>date('Y-m-d H:i', $item['begin_time']),'endtime'=>date('Y-m-d H:i', $item['end_time'])),true);;?>
									</div>
								</div>
								
							</div>
						</div>

						<div class="region-goods-details ">
							<div class="layui-form-item">
								
								<div class="layui-form-item">
									<label class="layui-form-label">单次限购</label>
									<div class="layui-input-block">
										
										<input type="text" name="one_limit_count" class="form-control " value="<?php echo ($item['one_limit_count']); ?>" />
										
										<div class="layui-form-mid layui-word-aux">用户单次提交订单最多可购买数，默认为0表示不限制</div>
									</div>
								</div>
								<div class="layui-form-item">
									<label class="layui-form-label">历史限购</label>
									<div class="layui-input-block">
										
										<input type="text" name="total_limit_count" class="form-control" value="<?php echo ($item['total_limit_count']); ?>" />
										
										<div class="layui-form-mid layui-word-aux">用户历史累积最多可购买数，默认为0表示不限制</div>
									</div>
								</div>
							</div>
						</div>
						<div class="region-goods-details ">
							
							<div class="region-goods-right col-sm-10">
								<?php if( empty($community_head_level) || count($community_head_level) ==1){ ?>
								<div class="layui-form-item">
								   <label class="layui-form-label">团长提成</label>
								  
								   <?php if( !empty($community_money_type) && $community_money_type ==1 ){ ?>
									<div class="layui-col-sm-10 ">
										<div class="input-group">
											<input type="text" name="community_head_commission" id="community_head_commission" class="form-control valid" value="<?php if(empty($item)){ echo ($communityhead_commission); }else{ echo ($item['community_head_commission']); } ?>" />
											<span class="input-group-addon">元 </span>
										</div>
										<div class="layui-form-mid layui-word-aux">预计团长可得佣金¥<font ><?php if(isset($item['community_head_commission'])){ echo round( $item['community_head_commission'] ,2) ; }else{ ?>0.00<?php } ?></font></div>	
									</div>
									<?php }else{ ?>
									<div class="layui-col-sm-10 ">
										<div class="input-group">
											<input type="text" name="community_head_commission" id="community_head_commission" class="form-control valid" value="<?php if( empty($item)){ echo ($communityhead_commission); }else{ echo ($item['community_head_commission']); } ?>" />
											<span class="input-group-addon">% </span>
										</div>
										<div class="layui-form-mid layui-word-aux">预计团长可得佣金¥<font id="precommiss_head_money_tip"><?php if( isset($item['community_head_commission'])){ echo round( ($item['community_head_commission']*$item['price'])/100 ,2); }else{ ?>0.00<?php } ?></font>，将根据商品最终的成交价格来计算佣金</div>	
									</div>
									<?php } ?>
									
									
								</div>
								<?php } ?>
								<div class="layui-form-item">
								   <label class="layui-form-label">所有团长可销售</label>
									<div class="layui-input-block ">
										<input type="checkbox" lay-skin="primary" name="is_all_sale" class="form-control valid" <?php if( empty($item) || $item['is_all_sale'] ==1 || !isset($item['is_all_sale'])){ ?>checked<?php } ?> value="1" />
											
									</div>
								</div>
								<?php if($is_newbuy){ ?>
								<div class="layui-form-item">
								   <label class="layui-form-label">新人专享</label>
									<div class="layui-input-block ">
										<input type="checkbox" id="xinrenckbox" lay-filter="xinrenckbox" lay-skin="primary" name="is_new_buy" class="form-control valid" <?php if( !empty($item) && $item['is_new_buy'] ==1 ){ ?>checked<?php } ?> value="1" />
									</div>
									<div class="layui-form-mid layui-word-aux" style="margin-left:15px;">未付款过的用户。勾选后，只在首页新人专区显示</div>
								</div>
								<?php } ?>
								
								
								<?php if( $seckill_is_open == 1 ){ ?>
								<div class="layui-form-item">
								   <label class="layui-form-label">整点秒杀</label>
									<div class="layui-input-block ">
										<input type="checkbox" id="is_seckill" lay-filter="is_seckill" lay-skin="primary" name="is_seckill" class="form-control valid" <?php if( !empty($item) && $item['is_seckill'] ==1 ){ ?>checked<?php } ?> value="1" />
									</div>
									<div class="layui-form-mid layui-word-aux" style="margin-left:15px;">勾选后，只在首页限时秒杀显示</div>
								</div>
								<?php } ?>
								
								
								
								<?php if($is_goodsspike){ ?>
								<div class="layui-form-item">
								   <label class="layui-form-label">限时秒杀</label>
									<div class="layui-input-block ">
										<input type="checkbox" id="xianshickbox" lay-filter="xianshickbox" lay-skin="primary" name="is_spike_buy" class="form-control valid" <?php if(!empty($item) && $item['is_spike_buy'] ==1){ ?>checked<?php } ?> value="1" />
									</div>
									<div class="layui-form-mid layui-word-aux" style="margin-left:15px;">
										勾选后，商品团购时间设置整点，后台——营销——整点秒杀勾选这个整点，系统会自动调用显示到“整点秒杀”方块以及该页面中。该整点开始前设置好这些，才会调用。
									</div>
								</div>
								<?php } ?>
								
							</div>
						</div>

						<?php if( !defined('ROLE') ){ ?>		
						<div class="region-goods-details ">
							
							<div class="layui-form-item">
							   <label class="layui-form-label">选择供应商</label>
							   
								<div class="layui-input-block">
									<div class="input-group " style="margin: 0;">
										<input type="text" disabled value="<?php echo ($item['supply_id']); ?>" class="form-control valid" name="supply_id" placeholder="" id="member_id">
										<span class="input-group-btn">
											<span data-input="#member_id" id="chose_member_id"  class="btn btn-default">选择供应商</span>
										</span>
									</div>
									<?php if( $item['supply_info']){ ?>
									<div class="input-group " style="margin: 0;">
										<div class="layadmin-text-center choose_user">
											<img style="" src="<?php echo tomedia($item['supply_info']['logo']);?>">
											<div class="layadmin-maillist-img" style=""><?php echo ($item['supply_info']['shopname']); ?></div>
											<button type="button" class="layui-btn layui-btn-sm" onclick="cancle_bind(this,'member_id')"><i class="layui-icon">&#xe640;</i></button>
										</div>
									</div>
									<?php } ?>
								</div>
					
								
							</div>
								
							
						</div>	    
						<?php } ?>    
						<script language="javascript">
							
							$(function () {
								$('#price').blur(function(){
									var price = parseFloat( $("#price").val() );

									  var community_head_commission = parseFloat( $("#community_head_commission").val() );
									  if(price > 0 && community_head_commission >0)
									  {
											$('#precommiss_head_money_tip').html( ( (price * community_head_commission) /100 ).toFixed(2) );
									  }else{
										$('#precommiss_head_money_tip').html('0.00');
									  }
								})
								
								$("#community_head_commission").blur(function(){
								  var price = parseFloat( $("#price").val() );

								  var community_head_commission = parseFloat( $(this).val() );
								  if(price > 0 && community_head_commission >0)
								  {
										$('#precommiss_head_money_tip').html( ( (price * community_head_commission) /100 ).toFixed(2) );
								  }else{
									$('#precommiss_head_money_tip').html('0.00');
								  }
								  
								});
								
								$('#radPickupDateTip input[type=radio]').click(function(){
									var s_val = $(this).val();
									if(s_val == 3)
									{
										$('#txtPickupDateTip').css('display','inline-block');
									}else{
										$('#txtPickupDateTip').css('display', 'none');
									}
								 })
								$("input[name=isstatustime]").off('click').on('click',function () {
									if($(this).val()==1){
										$("#shelves").show()
									}else{
										$("#shelves").hide();
									}
								})
							})
						</script>
						<!--- 基本信息 end -->
					</div>
					<div class="layui-tab-item  <?php if( $_GPC['tab']=='option'){ ?>layui-show<?php } ?>" >
						<!--规格begin-->
						
						<div class="region-goods-details ">
							<div class="region-goods-left col-sm-2">规格库存</div>
							<div class="region-goods-right col-sm-10">
								<div class="layui-form-item">
									<label class="layui-form-label">商品编码</label>
									<div class="layui-input-block">
										<input type="text" name="codes" class="form-control" value="<?php echo ($item['codes']); ?>" />
										<div class="help-block">商品编码 用部分商家用于统计</div>
									</div>
								</div>
								
								<div class="layui-form-item">
									<label class="layui-form-label">重量</label>
									<div class="layui-input-block">
										<div class="input-group fixsingle-input-group">
											<input type="text" name="weight" id="weight" <?php if( $item['hasoption']){ ?>readonly<?php } ?> class="form-control hasoption" value="<?php echo ($item['weight']); ?>"/>
											<span class="input-group-addon">克</span>
										</div>
									</div>
								</div>

								<div class="layui-form-item">
									<label class="layui-form-label">库存</label>
									<div class="layui-input-block">
										<input type="text" name="total" id="total" class="form-control hasoption" value="<?php echo ($item['total']); ?>"  style="width:150px;display: inline;margin-right: 20px;" <?php if( $item['hasoption']){ ?>readonly<?php } ?>/>
										<span class="help-block">商品的剩余数量, 如启用多规格，则此处设置无效.</span>
									</div>
								</div>

								
							</div>

						</div>




						<div class="region-goods-details ">
							<div class="region-goods-left  col-sm-2">
								规格
							</div>
							<div class="region-goods-right  col-sm-10">
								<div class="layui-form-item">
									<div class="layui-row" style=''>
									
										
										
											<input type="checkbox" lay-skin="primary" title="启用商品规格" lay-filter="hasoption" value="1" name="hasoption" <?php if( $item['hasoption']==1){ ?>checked<?php } ?> />
									
										<span class="help-block">启用商品规格后，商品的价格及库存以商品规格为准,库存设置为0则会到”已售罄“中，手机也不会显示, -1为不限制</span>

										
									</div>
								</div>

								<div id='tboption' style="padding-left:15px;<?php if( $item['hasoption']!=1){ ?>display:none<?php } ?>" >
									<div class="alert alert-info" style="display:none;">
										1. 拖动规格可调整规格显示顺序, 更改规格及规格项后请点击下方的【刷新规格项目表】来更新数据。<br/>
										2. 每一种规格代表不同型号，例如颜色为一种规格，尺寸为一种规格，如果设置多规格，手机用户必须每一种规格都选择一个规格项，才能添加购物车或购买。
									</div>
									<div id='specs'>
										<?php foreach( $item['allspecs'] as $spec ){ ?>
										<!--spec-->
										 <div class='spec_item spec_class_<?php echo ($cur_cate_id); ?>' id="spec_<?php echo ($spec['id']); ?>" >
											 <div style='border:1px solid #e7eaec;padding:10px;margin-bottom: 10px;' >
												<input name="spec_id[]" type="hidden" class="form-control spec_id" value="<?php echo ($spec['id']); ?>"/>
												<div class="form-group">
													<div class="col-sm-12">
														<div class='input-group'>
															<input name="spec_title[<?php echo ($spec['id']); ?>]" type="text" class="form-control  spec_title" value="<?php echo ($spec['title']); ?>" placeholder="规格名称 (比如: 颜色)"/>
															<div class='input-group-btn'>
																<a href="javascript:;" id="add-specitem-<?php echo ($spec['id']); ?>" specid='<?php echo ($spec['id']); ?>' class='btn btn-info add-specitem' onclick="addSpecItem('<?php echo ($spec['id']); ?>')"><i class="fa fa-plus"></i> 添加规格项</a>
																<a href="javascript:void(0);" class='btn btn-danger' onclick="removeSpec('<?php echo ($spec['id']); ?>')"><i class="fa fa-remove"></i></a>
															</div>
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="col-md-12">
														<div id='spec_item_<?php echo ($spec['id']); ?>' class='spec_item_items'>
														<?php foreach( $spec['items'] as $specitem ){ ?>
															 <!--spec_item begin-->
															<div class="spec_item_item" style="float:left;margin:5px;width:250px; position: relative">
																<input type="hidden" class="form-control spec_item_show" name="spec_item_show_<?php echo ($spec['id']); ?>[]" value="<?php echo ($specitem['show']); ?>" />
																<input type="hidden" class="form-control spec_item_id" name="spec_item_id_<?php echo ($spec['id']); ?>[]" value="<?php echo ($specitem['id']); ?>" />
																
																<div class="input-group">
																	<span class="input-group-addon">
																		<input type="checkbox" lay-skin="primary" <?php if( $specitem['id']>0){ ?>checked<?php } ?> value="1" onclick='showItem(this)'>
																	</span>
																	<input type="text" class="form-control spec_item_title" onblur="refreshOptions()" name="spec_item_title_<?php echo ($spec['id']); ?>[]" VALUE="<?php echo ($specitem['title']); ?>" />
																	
																	<span class="input-group-addon spec_item_thumb <?php if( !empty($specitem['thumb'])){ ?>has_thumb<?php } ?>">
																				   <input type='hidden'  name="spec_item_thumb_<?php echo ($spec['id']); ?>[]" value="<?php echo ($specitem['thumb']); ?>"
																					/>
																			<img onclick="selectSpecItemImage(this)"  
																				 src="<?php if( empty($specitem['thumb'])){ }else{ echo resize($specitem['thumb'],100); } ?>" style='width:100%;'
																				 <?php if( !empty($specitem['thumb'])){ ?>
																						data-toggle='popover'
																						data-html ='true'
																						data-placement='top'
																						data-trigger ='hover'
																						data-content="<img src='<?php echo tomedia($specitem['thumb']);?>' style='width:100px;height:100px;' />"
																				  <?php } ?>
																				 >
																			<i class="fa fa-times-circle" <?php if( empty($specitem['thumb'])){ ?>style="display:none"<?php } ?>></i> 
																	</span>
																	
																	<span class="input-group-addon">
																		<a href="javascript:;" onclick="removeSpecItem(this)" title='删除'><i class="fa fa-times"></i></a>
																		<a href="javascript:;" class="fa fa-arrows" title="拖动调整显示顺序" ></a>
																	</span>
																</div>
															  
																			
															</div>
															 <!--spec_item end-->
														<?php } ?>
														</div>
													</div>
												</div>
										   </div> 
										</div>

										<!--end spec-->
										<?php } ?>
									</div>
									
									<table class="table">
										<tr>
											<td>
											<div class="layui-form-item">
												<label class="col-sm-2 control-label">选择规格</label>
												<div class="col-sm-8 col-xs-12">
													<select id="cates2"   name='options[]' class="form-control select2" style='width:605px;' multiple='' >
														<?php foreach( $spec_list as $c ){ ?>
														<option value="<?php echo ($c['id']); ?>" data-names="<?php echo ($c['value_str']); ?>"><?php echo ($c['name']); ?></option>
														<?php } ?>
													</select>
													
												</div>
											</div>
											<td>
										</tr>
										<tr>
											<td>
												<h4>
													<a href="javascript:;" class='btn btn-primary' id='add-spec' onclick="addSpec()" style="margin-top:10px;margin-bottom:10px;" title="添加规格"><i class='fa fa-plus'></i> 添加规格</a>
													<a style="display:none;" href="javascript:;" onclick="refreshOptions();" title="刷新规格项目表" class="btn btn-primary"><i class="fa fa-refresh"></i> 刷新规格项目表</a>
												</h4>
											</td>
										</tr>
										<tr style="display: none;" >
											<td>
												<div class="alert alert-danger">警告：规格数据有变动，请重新点击上方 [刷新规格项目表] 按钮！</div>
											</td>
										</tr>
									</table>
								
									<div class="alert alert-info wholesalewarning"  style="display:none;">
									
									</div>
								<div id="options" style="padding:0;"><?php echo ($item['html']); ?></div>
							</div>

							
							</div>
						</div>
						<input type="hidden" name="optionArray" value=''>
						<input type="hidden" name="isdiscountDiscountsArray" value=''>
						<input type="hidden" name="discountArray" value=''>
						<input type="hidden" name="commissionArray" value=''>
						

						<!--规格end-->
					</div>
					
					
					<div class="layui-tab-item <?php if( $_GPC['tab']=='des'){ ?>layui-show<?php } ?>"  > 
						<div class="region-goods-details row">
							<div class="region-goods-left col-sm-2">商品详情</div>
							<div class=" region-goods-right col-sm-10">
								<div class="" >
								  
									<?php echo tpl_ueditor('content',htmlspecialchars_decode($item['content']),array('height'=>'300'));?>
									
								</div>
							</div>
						</div>


					</div>
					
				
					
					<?php if( (!empty($community_head_level) && count($community_head_level) > 1) || ($commiss_level > 0) ){ ?>
					<!---团长分销begin --->
					<div class="layui-tab-item <?php if( $_GPC['tab']=='community_head_level'){ ?>layui-show<?php } ?>" > 
						
						<?php if( (!empty($community_head_level) && count($community_head_level) > 1) || ($commiss_level > 0) ){ ?>
						<div class="region-goods-details row">
							<div class="region-goods-left col-sm-2">团长提成</div>
							<div class="region-goods-right col-sm-10">
								<div class="form-group">
									<label class="col-sm-2 control-label">独立规则</label>
									<div class="col-sm-9 col-xs-12">
										
											<input type="checkbox" id="is_modify_head_commission" lay-skin="primary" value="1" name="is_modify_head_commission" lay-filter="is_modify_head_commission" <?php if( $item['is_modify_head_commission']==1){ ?>checked<?php } ?> title="启用独立团长提成" />
										
										<span class="help-block">默认使用团长等级提成设置，启用独立团长提成设置，此商品拥有独自的团长提成比例,不受团长等级比例及默认设置限制</span>
									</div>
								</div>
								<div id="head_commission_div" <?php if( empty($item['is_modify_head_commission'])){ ?>style="display:none"<?php } ?> >
									<?php foreach($community_head_level as $head_level){ ?>
									
									<div class="form-group">
										<label class="col-sm-2 control-label"><?php echo $head_level['levelname']; ?></label>
										<div class="col-sm-4 col-xs-12">
											<div class="input-group">
												<input type="text" name="head_level<?php echo $head_level['id']; ?>"  class="form-control" value="<?php echo $item['head_level'.$head_level['id']]; ?>" />
												<?php if( !empty($community_money_type) && $community_money_type ==1 ){ ?>
												<div class="input-group-addon">元 </div>
												<?php }else{ ?>
												<div class="input-group-addon">%<?php echo ($community_money_type); ?></div>
												<?php } ?>
											</div>
										</div>
									</div>
									<?php } ?>
								</div>
							</div>
							
							<?php } ?>
							
							
							<?php if($commiss_level > 0){ ?>
							<div class="region-goods-details row">					
								<div class="region-goods-left col-sm-2">会员分销</div>
								<div class="region-goods-right col-sm-10">
								
									<div class="form-group">
										<label class="col-sm-2 control-label">是否参与分销</label>
										<div class="col-sm-9 col-xs-12">
											
												<input type="radio"  value="0" name="nocommission" <?php if($item['nocommission']==0){ ?>checked<?php } ?> title="参与分销" /> 
											
												<input type="radio"  value="1" name="nocommission" <?php if($item['nocommission']==1){ ?>checked<?php } ?> title="不参与分销" /> 
											
												<span class="help-block">如果不参与分销，则不产生分销佣金</span>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">独立规则</label>
										<div class="col-sm-9 col-xs-12">
										   
											<input type="checkbox" lay-filter="hascommission" lay-skin="primary" id="hascommission"  value="1" name="hascommission" <?php if($item['hascommission']==1){ ?>checked<?php } ?> title="启用独立佣金比例" />
											
											<span class="help-block">启用独立佣金设置，此商品拥有独自的佣金比例,不受分销商等级比例及默认设置限制</span>
										   
										</div>
									</div>
									<div style="clear:both;"></div>
									<div id="commission_div" <?php if(empty($item['hascommission'])){ ?>style="display:none"<?php } ?> >


										<div id="commission_0"  <?php if($commission_type!=0){ ?> style="display:none;" <?php } ?>>
										<div class='alert alert-danger'>
											如果比例为空，则使用固定规则，如果都为空则无分销佣金，都填写则以比例优先
										</div>
										
										<?php if($set['commiss_level']>=1){ ?>
										<div class="form-group">
											<label class="col-sm-2 control-label">一级分销</label>
											<div class="col-sm-4 col-xs-12">
											   
												<div class="input-group">
													<input type="text" name="commission1_rate" id="commission1_rate" class="form-control" value="<?php echo ($item['commission1_rate']); ?>" />
													<div class="input-group-addon">% 固定</div>
													<input type="text" name="commission1_pay" id="commission1_pay" class="form-control" value="<?php echo ($item['commission1_pay']); ?>" />
													<div class="input-group-addon">元</div>
												</div>
												
											</div>
										</div>
										<?php } ?>
										<?php if($set['commiss_level']>=2){ ?>
										
										<div class="form-group">
											<label class="col-sm-2 control-label">二级分销</label>
											<div class="col-sm-4 col-xs-12">
												
												<div class="input-group">
													<input type="text" name="commission2_rate" id="commission2_rate" class="form-control" value="<?php echo ($item['commission2_rate']); ?>" />
													<div class="input-group-addon">% 固定</div>
													<input type="text" name="commission2_pay" id="commission2_pay" class="form-control" value="<?php echo ($item['commission2_pay']); ?>" />
													<div class="input-group-addon">元</div>
												</div>
												
											</div>
										</div>
										<?php } ?>
										<?php if($set['commiss_level']>=3){ ?>
										<div class="form-group">
											<label class="col-sm-2 control-label">三级分销</label>
											<div class="col-sm-4 col-xs-12">
												<div class="input-group">
													<input type="text" name="commission3_rate" id="commission3_rate" class="form-control" value="<?php echo ($item['commission3_rate']); ?>" />
													<div class="input-group-addon">% 固定</div>
													<input type="text" name="commission3_pay" id="commission3_pay" class="form-control" value="<?php echo ($item['commission3_pay']); ?>" />
													<div class="input-group-addon">元</div>
												</div>
											</div>
										</div>
										<?php } ?>
									</div>
									
								</div>
								</div>
								
							</div>
							<?php } ?>
						
							
							<?php if($mb_level > 0){ ?>
							<div class="region-goods-details row">					
								<div class="region-goods-left col-sm-2">会员等级折扣</div>
								<div class="region-goods-right col-sm-10">
								
									<div class="form-group">
										<label class="col-sm-2 control-label">是否参与会员折扣</label>
										<div class="col-sm-9 col-xs-12">
											
												<input type="radio" lay-filter="is_mb_level_buy" value="1" name="is_mb_level_buy" class="is_mb_level_buy" <?php if(!isset($item['is_mb_level_buy']) || $item['is_mb_level_buy']==1){ ?>checked<?php } ?> title="参与" /> 
											
												<input type="radio" lay-filter="is_mb_level_buy" value="0" name="is_mb_level_buy" class="is_mb_level_buy" <?php if($item['is_mb_level_buy']==0){ ?>checked<?php } ?> title="不参与" /> 

												<input type="radio" lay-filter="is_mb_level_buy" value="2" name="is_mb_level_buy" class="is_mb_level_buy" <?php if($item['is_mb_level_buy']==2){ ?>checked<?php } ?> title="自定义" />
											
												<span class="help-block">如果不参与会员折扣，则不打折</span>
										</div>
									</div>
									<!-- --------- 会员等级折扣 Start ------ Author Lucas by 2019-12-19 15:20------------- -->
									<div style="clear:both;"></div>
									<?php foreach($goods_discounts as $goods_discount){ ?>
										<div class="form-group j-member-discount" >
											<label class="col-sm-2 control-label"><?php echo ($goods_discount['levelname']); ?></label>
											<div class="col-sm-4 col-xs-12">
												<div class="input-group">
													<input type="text" name="member_level_<?php echo ($goods_discount['member_level']); ?>" id="commission1_rate" class="form-control" value="<?php echo ($goods_discount['discount']); ?>" />
													<div class="input-group-addon">% 折扣（100%为不打折）</div>
												</div>
											</div>
										</div>
									<?php }; ?>
									<!-- --------- 会员等级折扣 End ---------------------------------------------------------- -->
										
									</div>
								</div>
								</div>
								
									<div id="commission_div" <?php if(empty($item['hascommission'])){ ?>style="display:none"<?php } ?> >


										<div id="commission_0"  <?php if($commission_type!=0){ ?> style="display:none;" <?php } ?>>
										<div class='alert alert-danger'>
											如果比例为空，则使用固定规则，如果都为空则无分销佣金，都填写则以比例优先
										</div>
										
										
			
							<?php } ?>
							
					</div>
					<!--团长分销end--->
					
					
					
				  </div>
				  <?php } ?>
					
				  
				  <div class="layui-tab-item <?php if( $_GPC['tab']=='goods_relative_goods'){ ?>layui-show<?php } ?>"  > 
						<div class="region-goods-details row">
							<div class="region-goods-left col-sm-2">推荐商品</div>
							<div class=" region-goods-right col-sm-10">
								<div class="input-group " style="margin: 0;">
									<input type="text" disabled value="" class="form-control valid" name="" placeholder="" id="agent_id">
									<span class="input-group-btn">
										<span data-input="#agent_id" id="chose_agent_id2"  class="btn btn-default">选择商品</span>
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
					</div>
				</div> 
				
				<script>
					$(function(){
						$(".select2").select2({
							 placeholder:'请选择',
							 allowClear:true
						})
					})
				</script>
				<div class="layui-form-item">
					<label class="layui-form-label"> </label>
					<div class="layui-input-block">
						<input type="submit" value="提交" lay-submit lay-filter="formDemo" class="btn btn-primary"  />
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a class="btn btn-default" style='margin-left:10px;' href="<?php echo U('goods/index' , array( 'ok' => 1));?>">返回列表</a>
						
					</div>
				</div>
			</form>
		</div>
</div>
</div>

<script src="/layuiadmin/layui/layui.js"></script>

<script type="text/javascript" src="/static/js/jquery-migrate-1.1.1.js"></script>
<script src="/static/js/jquery-ui.min.js"></script>
<style>
.multi-img-details{width:100%;}
</style>
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
var form;

layui.use(['jquery', 'layer','form'], function(){ 
  $ = layui.$;
	form = layui.form;
  
	form.on('radio(linktype)', function(data){
		if (data.value == 2) {
			$('#typeGroup').show();
		} else {
			$('#typeGroup').hide();
		}
	});


	//--------- 会员等级折扣 Start ------ Author Lucas by 2019-12-19 17:48-------------
	var is_mb_level_buy = $("input[name='is_mb_level_buy']:checked").val();
	console.log('是否参与会员折扣：' , is_mb_level_buy);
	if(is_mb_level_buy == 2){
		$('.j-member-discount').show();
	}else{
		$('.j-member-discount').hide();
	}
	form.on('radio(is_mb_level_buy)', function(data){
		var is_mb_level_buy1 = $("input[name='is_mb_level_buy']:checked").val();
		console.log('是否参与会员折扣：' , is_mb_level_buy1);
		if(is_mb_level_buy1 == 2){
			$('.j-member-discount').show();
		}else{
			$('.j-member-discount').hide();
		}
	});
	//--------- 会员等级折扣 End ----------------------------------------------------------

	

	

	 
	
	form.on('checkbox(is_modify_sendscore)', function(data){
		console.log(data.elem.checked)
	  if (data.elem.checked) {
			console.log(12);
			$("#send_score_divTip").css('display','inline');
		} else {
			console.log(33);
			$("#send_score_divTip").hide();
		}
		form.render('checkbox');
	});
	
	form.on('checkbox(xinrenckbox)', function(data){
	  if (data.elem.checked) {
			$("#xianshickbox").removeAttr("checked");
		} else {
			
		}
		form.render('checkbox');
	});
	
	form.on('checkbox(xianshickbox)', function(data){
		if (data.elem.checked) {
			$("#xinrenckbox").removeAttr("checked");
		} else {
			
		}
		form.render('checkbox');
	});
	
	form.on('checkbox(hascommission)', function(data){
		
		if (data.elem.checked) {
			$('#commission_div').show();
		} else {
			$('#commission_div').hide();
		}
	})
	//hascommission
							
									
	$('#chose_label_id').click(function(){
		cur_open_div = $(this).attr('data-input');
		$.post("<?php echo U('goods/labelquery', array('ok' => 1));?>", {}, function(shtml){
		 layer.open({
			type: 1,
			area: '930px',
			content: shtml //注意，如果str是object，那么需要字符拼接。
		  });
		});
	})
	
	$('#chose_member_id').click(function(){
		cur_open_div = $(this).attr('data-input');
		$.post("<?php echo U('supply/zhenquery', array('ok' => 1));?>", {}, function(shtml){
		 layer.open({
			type: 1,
			area: '930px',
			content: shtml //注意，如果str是object，那么需要字符拼接。
		  });
		});
	})
	$('#chose_agent_id').click(function(){
		cur_open_div = $(this).attr('data-input');
		$.post("<?php echo U('communityhead/query_head_user', array('ok' => 1));?>", {}, function(shtml){
		 layer.open({
			type: 1,
			area: '930px',
			content: shtml //注意，如果str是object，那么需要字符拼接。
		  });
		});
	})
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
	
	$('.layui-tab-title li').click(function(){
		form.render('radio');
		form.render('checkbox');
	})
	
		
  //监听提交
  form.on('submit(formDemo)', function(data){
	var s_cates = $('#cates').val();
	var cate_mult = [];
	for(var i in s_cates)
	{
		cate_mult.push(s_cates[i]);
	}
	data.field.cate_mult = cate_mult;
	
	<?php if( !empty($is_open_goods_relative_goods) && $is_open_goods_relative_goods == 1 ){ ?>
	var gd_ar = [];
	var gd_str = '';
	$('.mult_choose_goodsid').each(function(){
		gd_ar.push( $(this).attr('data-gid') );
	})
	gd_str = gd_ar.join(',');
	
	data.field.limit_goods_list = gd_str;
	<?php } ?>
	
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
  
  
  form.on('checkbox(hasoption)', function(data){
									
		if(data.elem.checked)
		{
			$('#goodssn').attr('readonly',true);
			$('#productsn').attr('readonly',true);
			$('#weight').attr('readonly',true);
			$('#total').attr('readonly',true);

			$("#tboption").show();
			$("#tbdiscount").show();
			$("#isdiscount_discounts").show();
			$("#isdiscount_discounts_default").hide();
			$("#commission").show();
			$("#commission_default").hide();
			$("#discounts_type1").show().parent().show();
			refreshOptions();
		}else{
			$('#weight').removeAttr('readonly');
			$('#total').removeAttr('readonly');
			$("#tboption").hide();
			refreshOptions();

			$("#isdiscount_discounts").hide();
			var isdiscount_discounts = $("#isdiscount_discounts").html();
			$("#isdiscount_discounts").html('');
			
			$("#isdiscount_discounts").html(isdiscount_discounts);
			

			$("#tbdiscount").hide();
			$("#isdiscount_discounts_default").show();

			$("#commission_default").show();

			$('#goodssn').removeAttr('readonly');
			$('#productsn').removeAttr('readonly');

			$("#discounts_type1").hide().parent().hide();
			$("#discounts_type0").click();	
			$(this).prop("checked", false);
		}
		
		form.render('checkbox');
	});	
	
	$('#chose_agent_id2').click(function(){
		cur_open_div = $(this).attr('data-input');
		$.post("<?php echo U('goods/query_normal', array('template' => 'mult', 'unselect_goodsid' => $id));?>", {}, function(shtml){
		 layer.open({
			type: 1,
			area: '930px',
			content: shtml //注意，如果str是object，那么需要字符拼接。
		  });
		});
	})
	
	
	form.on('checkbox(is_modify_head_commission)', function(data){
    
		if(data.elem.checked)
		{
			$("#head_commission_div").show();
		}else{
			$("#head_commission_div").hide();	
		}
		
		form.render('checkbox');
	});
	  
})


function cancle_bind(obj,sdiv)
{
	$('#'+sdiv).val('');
	$(obj).parent().parent().remove();
}

</script> 


<script>
    $(function () {
        // 拖拽时开始滚动的间距
        var scrollingSensitivity = 20
        // 拖拽时滚动速度
        let scrollingSpeed = 20
        // 拖拽前的父级节点
        let dragBeforeParentNode = null
        // 初始化拖拽函数
        $('.multi-img-details').sortable({
            // 自适应placeholder的大小
            forceHelperSize: true,
            // 拖拽时的鼠标形状
            cursor: '-webkit-grabbing',
            // 拖拽的父级节点(该节点一定要注意，配置错误会导致当前屏幕外的元素没法自动滚动拖拽，两列之间拖拽的滚动也会出问题)
            appendTo: '.layui-form-item',
            // 拖拽时的倾斜度
            rotate: '5deg',
            // 延迟时间(毫秒)，避免和click同时操作时出现的冲突
            delay: 0,
            // 以clone方式拖拽
            helper: 'clone',
            // 拖拽到边框出现滚动的间距，
            scrollSensitivity: scrollingSensitivity,
            // 应用于拖拽空白区域的样式
            placeholder: 'portlet-placeholder ui-state-highlight',
            // 允许拖拽预留空白区域
            forcePlaceholderSize: false,
            // 多个列表之间的拖拽的dom元素
            connectWith: '.multi-img-details',
            // 鼠标到区域则填充
            tolerance: "pointer",
            // 可以拖拽的项
            items: '.multi-item',
            // 填充动画
            revert: 0,
            // 拖拽结束函数
            stop: (e, ui) => {
                // 当前拽入的元素
                let item = $(ui.item)
                // 当前拽入元素的下标
                let index = item.index()
                let kid = ''
                // xxxx 这里面可以操作数据更新
            },
            // 开始拖拽时的函数
            start: (e, ui) => {
                // 拖拽前的父级节点
                dragBeforeParentNode = ui.item[0].parentNode
                // 让placeholder和源高度一致
                ui.helper.addClass('item').width(110)
                // xxxx  这里可以记录一些拖拽前的元素属性
            },
            // 处理两列滚动条问题
            sort: function (event, ui) {
                var scrollContainer = ui.placeholder[0].parentNode
                // 设置拽入的列表的滚动位置
                var overflowOffset = $(scrollContainer).offset()
                if ((overflowOffset.top + scrollContainer.offsetHeight) - event.pageY <
                    scrollingSensitivity) {
                    scrollContainer.scrollTop = scrollContainer.scrollTop + scrollingSpeed
                } else if (event.pageY - overflowOffset.top < scrollingSensitivity) {
                    scrollContainer.scrollTop = scrollContainer.scrollTop - scrollingSpeed
                }
            }
        }).disableSelection()
    })
</script>



<script language="javascript">
						var chose_cate = -1;
						var chose_cate_id_arr = [];
							$(function(){
								

								$('#cates2').on('change',function(){
									var s_length = $("#cates2 option:selected").length -1;
									var options_name = $("#cates2 option:selected:eq("+s_length+")").text();
									var options_str =  $("#cates2 option:selected:eq("+s_length+")").attr('data-names');
									
									if(s_length > chose_cate)
									{
										chose_cate++;
										var cur_cate_id = '';
										$("#cates2 option:selected").each(function(){
											var tmp_cate_id = parseInt($(this).val());
											if( $.inArray( tmp_cate_id, chose_cate_id_arr ) == -1)
											{
												chose_cate_id_arr.push( parseInt(tmp_cate_id) );
												cur_cate_id = tmp_cate_id;
											}
										})
										addSpecList(options_name,options_str,cur_cate_id);
									}else{
										chose_cate--;
										var new_chose_cate_id_arr = [];
										if(chose_cate_id_arr.length == 1)
										{
											$('.spec_class_'+chose_cate_id_arr[0]).remove();
										}
										
										$("#cates2 option:selected").each(function(){
											var tmp_cate_id = parseInt( $(this).val() );
											if( $.inArray( tmp_cate_id, chose_cate_id_arr ) != -1)
											{
												new_chose_cate_id_arr.push( parseInt(tmp_cate_id) );
												chose_cate_id_arr.splice($.inArray( tmp_cate_id, chose_cate_id_arr ), 1);
											}
										})
										if(chose_cate_id_arr.length == 1)
										{
											$('.spec_class_'+chose_cate_id_arr[0]).remove();
										}
										
										chose_cate_id_arr = new_chose_cate_id_arr;
										refreshOptions();
									}
									
									
								})
								$(document).on('input propertychange change', '#specs input', function () {
									
									window.optionchanged = true;
									$('#optiontip').show();
								});
								
								$(document).on('input propertychange change', '#specs input', function () {
								
									window.optionchanged = true;
									$('#optiontip').show();
								});


								$(".spec_item_thumb").find('i').click(function(){
									var group  =$(this).parent();
									group.find('img').attr('src',"{SNAILFISH_LOCAL}static/images/nopic100.jpg");
									group.find(':hidden').val('');
									$(this).hide();
									group.find('img').popover('destroy');
								});

								
									
								
							});
							function selectSpecItemImage(obj){
								util.image('',function(val){
									$(obj).attr('src',val.url).popover({
										trigger: 'hover',
										html: true,
										container: $(document.body),
										content: "<img src='" + val.url  + "' style='width:100px;height:100px;' />",
										placement: 'top'
									});

									var group  =$(obj).parent();

									group.find(':hidden').val(val.attachment), group.find('i').show().unbind('click').click(function(){
										$(obj).attr('src',"{SNAILFISH_LOCAL}static/images/nopic100.jpg");
										group.find(':hidden').val('');
										group.find('i').hide();
										$(obj).popover('destroy');
									});
								});
							}
							function addSpecList(options_name,spec_str, cur_cate_id)
							{
							
								var len = $(".spec_item").length;
								$("#add-spec").html("正在处理...").attr("disabled", "true").toggleClass("btn-primary");
								var url = "<?php echo U('goods/mult_tpl',array('tpl'=>'spec'));?>";
								$.ajax({
									"url": url,
									type:'post',
									data:{options_name:options_name,spec_str:spec_str,cur_cate_id:cur_cate_id},
									success:function(data){
										$("#add-spec").html('<i class="fa fa-plus"></i> 添加规格').removeAttr("disabled").toggleClass("btn-primary"); ;
										$('#specs').append(data);
										var len = $(".add-specitem").length -1;
										$(".add-specitem:eq(" +len+ ")").focus();
										refreshOptions();
									}
								});
							}
							
							function addSpec(){
								var len = $(".spec_item").length;
								$("#add-spec").html("正在处理...").attr("disabled", "true").toggleClass("btn-primary");
								var url = "<?php echo U('goods/tpl',array('tpl'=>'spec'));?>";
								$.ajax({
									"url": url,
									success:function(data){
										$("#add-spec").html('<i class="fa fa-plus"></i> 添加规格').removeAttr("disabled").toggleClass("btn-primary"); ;
										$('#specs').append(data);
										var len = $(".add-specitem").length -1;
										$(".add-specitem:eq(" +len+ ")").focus();
										refreshOptions();
									}
								});
							}
							function removeSpec(specid){
								if (confirm('确认要删除此规格?')){
									$("#spec_" + specid).remove();
									refreshOptions();
								}
							}
							function addSpecItem(specid){
									 $("#add-specitem-" + specid).html("正在处理...").attr("disabled", "true");
								var url = "<?php echo U('goods/tpl',array('tpl'=>'specitem'));?>" + "&specid=" + specid;
								$.ajax({
									"url": url,
									success:function(data){
										$("#add-specitem-" + specid).html('<i class="fa fa-plus"></i> 添加规格项').removeAttr("disabled");
										$('#spec_item_' + specid).append(data);
										var len = $("#spec_" + specid + " .spec_item_title").length -1;
										$("#spec_" + specid + " .spec_item_title:eq(" +len+ ")").focus();
										refreshOptions
																								if(type==3 && virtual==0){
																											$(".choosetemp").show();
																								 }
									}
								});
							}
							function removeSpecItem(obj){
								$(obj).closest('.spec_item_item').remove();
								refreshOptions();
							}

							function refreshOptions(){
								// 刷新后重置
								window.optionchanged = false;
								$('#optiontip').hide();


						 var html = '<table class="table table-bordered table-condensed"><thead><tr class="active">';
							var specs = [];
								 if($('.spec_item').length<=0){
									 $("#options").html('');
									 $("#discount").html('');
									 $("#isdiscount_discounts").html('');
									 $("#commission").html('');
									
									 return;
								 }
							$(".spec_item").each(function(i){
								var _this = $(this);

								var spec = {
									id: _this.find(".spec_id").val(),
									title: _this.find(".spec_title").val()
								};

								var items = [];
								_this.find(".spec_item_item").each(function(){
									var __this = $(this);
									var item = {
										id: __this.find(".spec_item_id").val(),
										title: __this.find(".spec_item_title").val(),
																								virtual: __this.find(".spec_item_virtual").val(),
										show:__this.find(".spec_item_show").get(0).checked?"1":"0"
									}
									items.push(item);
								});
								spec.items = items;
								specs.push(spec);
							});
							specs.sort(function(x,y){
								if (x.items.length > y.items.length){
									return 1;
								}
								if (x.items.length < y.items.length) {
									return -1;
								}
							});

							var len = specs.length;
							var newlen = 1;
							var h = new Array(len);
							var rowspans = new Array(len);
							for(var i=0;i<len;i++){
								html+="<th>" + specs[i].title + "</th>";
								var itemlen = specs[i].items.length;
								if(itemlen<=0) { itemlen = 1 };
								newlen*=itemlen;

								h[i] = new Array(newlen);
								for(var j=0;j<newlen;j++){
									h[i][j] = new Array();
								}
								var l = specs[i].items.length;
								rowspans[i] = 1;
								for(j=i+1;j<len;j++){
									rowspans[i]*= specs[j].items.length;
								}
							}

							html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;">库存</div><div class="input-group"><input type="text" class="form-control  input-sm option_stock_all" VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_stock\');"></a></span></div></div></th>';
							

							
							html += '<th class="type-4"><div class=""><div style="padding-bottom:10px;text-align:center;">现价</div><div class="input-group"><input type="text" class="form-control  input-sm option_marketprice_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_marketprice\');"></a></span></div></div></th>';
							html+='<th class="type-4"><div class=""><div style="padding-bottom:10px;text-align:center;">原价</div><div class="input-group"><input type="text" class="form-control  input-sm option_productprice_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_productprice\');"></a></span></div></div></th>';
							
							<?php if( !empty($is_open_vipcard_buy) && $is_open_vipcard_buy == 1 ){ ?>
							html+='<th class="type-4"><div class=""><div style="padding-bottom:10px;text-align:center;">会员价</div><div class="input-group"><input type="text" class="form-control  input-sm option_cardprice_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_cardprice\');"></a></span></div></div></th>';
							<?php } ?>
							
							html+='<th class="type-4"><div class=""><div style="padding-bottom:10px;text-align:center;">成本价</div><div class="input-group"><input type="text" class="form-control  input-sm option_costprice_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_costprice\');"></a></span></div></div></th>';
							html+='<th><div class=""><div style="padding-bottom:10px;text-align:center;">编码</div><div class="input-group"><input type="text" class="form-control  input-sm option_goodssn_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_goodssn\');"></a></span></div></div></th>';
							
							html+='<th><div class=""><div style="padding-bottom:10px;text-align:center;">重量（克）</div><div class="input-group"><input type="text" class="form-control  input-sm option_weight_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_weight\');"></a></span></div></div></th>';
							html+='</tr></thead>';

							for(var m=0;m<len;m++){
								var k = 0,kid = 0,n=0;
								for(var j=0;j<newlen;j++){
									var rowspan = rowspans[m];
									if( j % rowspan==0){
										h[m][j]={title: specs[m].items[kid].title, virtual: specs[m].items[kid].virtual,html: "<td class='full' rowspan='" +rowspan + "'>"+ specs[m].items[kid].title+"</td>\r\n",id: specs[m].items[kid].id};
									}
									else{
									
											h[m][j]={title:specs[m].items[kid].title,virtual: specs[m].items[kid].virtual, html: "",id: specs[m].items[kid].id};
									}	
									n++;
									if(n==rowspan){
									kid++; if(kid>specs[m].items.length-1) { kid=0; }
									n=0;
									}
								}
							}

							var hh = "";
							for(var i=0;i<newlen;i++){
								hh+="<tr>";
								var ids = [];
								var titles = [];
															var virtuals = [];
								for(var j=0;j<len;j++){
									hh+=h[j][i].html;
									ids.push( h[j][i].id);
									titles.push( h[j][i].title);
												   virtuals.push( h[j][i].virtual);
								}
								ids =ids.join('_');
								titles= titles.join('+');

								var val ={ id : "",title:titles, stock : "",presell : "",costprice : "",productprice : "",<?php if( !empty($is_open_vipcard_buy) && $is_open_vipcard_buy == 1 ){ ?>cardprice:"",<?php } ?>marketprice : "",weight:"",productsn:"",goodssn:"",virtual:virtuals };
								
								
								if( $(".option_id_" + ids).length>0){
									val ={
										id : $(".option_id_" + ids+":eq(0)").val(),
										title: titles,
										stock : $(".option_stock_" + ids+":eq(0)").val(),
										presell : $(".option_presell_" + ids+":eq(0)").val(),
										costprice : $(".option_costprice_" + ids+":eq(0)").val(),
										<?php if( !empty($is_open_vipcard_buy) && $is_open_vipcard_buy == 1 ){ ?>
										cardprice : $(".option_cardprice_" + ids+":eq(0)").val(),
										<?php } ?>
										productprice : $(".option_productprice_" + ids+":eq(0)").val(),
										marketprice : $(".option_marketprice_" + ids +":eq(0)").val(),
															goodssn : $(".option_goodssn_" + ids +":eq(0)").val(),
															productsn : $(".option_productsn_" + ids +":eq(0)").val(),
										weight : $(".option_weight_" + ids+":eq(0)").val(),
														  virtual : virtuals
									}
								}

								hh += '<td>'
							
								hh += '<input name="option_stock_' + ids +'" type="text" class="form-control option_stock option_stock_' + ids +'" value="' +(val.stock=='undefined'?'':val.stock )+'"/></td>';
							
								hh += '<input name="option_id_' + ids+'" type="hidden" class="form-control option_id option_id_' + ids +'" value="' +(val.id=='undefined'?'':val.id )+'"/>';
								hh += '<input name="option_ids[]" type="hidden" class="form-control option_ids option_ids_' + ids +'" value="' + ids +'"/>';
								hh += '<input name="option_title_' + ids +'" type="hidden" class="form-control option_title option_title_' + ids +'" value="' +(val.title=='undefined'?'':val.title )+'"/></td>';
								hh += '<input name="option_virtual_' + ids +'" type="hidden" class="form-control option_virtual option_virtual_' + ids +'" value="' +(val.virtual=='undefined'?'':val.virtual )+'"/></td>';
								hh += '</td>';
								//hh += '<td class="type-4"><input data-name="option_presell_' + ids+'" type="text" class="form-control option_presell option_presell_' + ids +'" value="' +(val.presell=='undefined'?'':val.presell )+'"/></td>';
								hh += '<td class="type-4"><input name="option_marketprice_' + ids+'" type="text" class="form-control option_marketprice option_marketprice_' + ids +'" value="' +(val.marketprice=='undefined'?'':val.marketprice )+'"/></td>';
								hh += '<td class="type-4"><input name="option_productprice_' + ids+'" type="text" class="form-control option_productprice option_productprice_' + ids +'" " value="' +(val.productprice=='undefined'?'':val.productprice )+'"/></td>';
								<?php if( !empty($is_open_vipcard_buy) && $is_open_vipcard_buy == 1 ){ ?>
								hh += '<td class="type-4"><input name="option_cardprice_' + ids+'" type="text" class="form-control option_cardprice option_cardprice_' + ids +'" " value="' +(val.cardprice=='undefined'?'':val.cardprice )+'"/></td>';
								<?php } ?>
								hh += '<td class="type-4"><input name="option_costprice_' +ids+'" type="text" class="form-control option_costprice option_costprice_' + ids +'" " value="' +(val.costprice=='undefined'?'':val.costprice )+'"/></td>';
								hh += '<td><input name="option_goodssn_' +ids+'" type="text" class="form-control option_goodssn option_goodssn_' + ids +'" " value="' +(val.goodssn=='undefined'?'':val.goodssn )+'"/></td>';
								//hh += '<td><input data-name="option_productsn_' +ids+'" type="text" class="form-control option_productsn option_productsn_' + ids +'" " value="' +(val.productsn=='undefined'?'':val.productsn )+'"/></td>';
								hh += '<td><input name="option_weight_' + ids +'" type="text" class="form-control option_weight option_weight_' + ids +'" " value="' +(val.weight=='undefined'?'':val.weight )+'"/></td>';
								hh += "</tr>";
							}
							html+=hh;
							html+="</table>";
							$("#options").html(html);
								refreshDiscount();
								refreshIsDiscount();
								

								if(window.type=='4'){
									$('.type-4').hide();
								}else{
									$('.type-4').show();
								}
						}

							function refreshDiscount() {
								var html = '<table class="table table-bordered table-condensed"><thead><tr class="active">';
								var specs = [];

								$(".spec_item").each(function (i) {
									var _this = $(this);

									var spec = {
										id: _this.find(".spec_id").val(),
										title: _this.find(".spec_title").val()
									};

									var items = [];
									_this.find(".spec_item_item").each(function () {
										var __this = $(this);
										var item = {
											id: __this.find(".spec_item_id").val(),
											title: __this.find(".spec_item_title").val(),
											virtual: __this.find(".spec_item_virtual").val(),
											show: __this.find(".spec_item_show").get(0).checked ? "1" : "0"
										}
										items.push(item);
									});
									spec.items = items;
									specs.push(spec);
								});
								specs.sort(function (x, y) {
									if (x.items.length > y.items.length) {
										return 1;
									}
									if (x.items.length < y.items.length) {
										return -1;
									}
								});

								var len = specs.length;
								var newlen = 1;
								var h = new Array(len);
								var rowspans = new Array(len);
								for (var i = 0; i < len; i++) {
									html += "<th>" + specs[i].title + "</th>";
									var itemlen = specs[i].items.length;
									if (itemlen <= 0) {
										itemlen = 1
									}
									;
									newlen *= itemlen;

									h[i] = new Array(newlen);
									for (var j = 0; j < newlen; j++) {
										h[i][j] = new Array();
									}
									var l = specs[i].items.length;
									rowspans[i] = 1;
									for (j = i + 1; j < len; j++) {
										rowspans[i] *= specs[j].items.length;
									}
								}

								<?php foreach( $levels as $level ){ ?>
								<?php if( $level['key']=='default'){ ?>
								html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;"><?php echo ($level['levelname']); ?></div><div class="input-group"><input type="text" class="form-control  input-sm discount_<?php echo ($level["key"]); ?>_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'discount_<?php echo ($level["key"]); ?>\');"></a></span></div></div></th>';
								<?php  }else{ ?>
								html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;"><?php echo ($level['levelname']); ?></div><div class="input-group"><input type="text" class="form-control  input-sm discount_level<?php echo ($level['id']); ?>_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'discount_level<?php echo ($level['id']); ?>\');"></a></span></div></div></th>';
								<?php } ?>
								<?php } ?>
								html += '</tr></thead>';

								for (var m = 0; m < len; m++) {
									var k = 0, kid = 0, n = 0;
									for (var j = 0; j < newlen; j++) {
										var rowspan = rowspans[m];
										if (j % rowspan == 0) {
											h[m][j] = {
												title: specs[m].items[kid].title,
												virtual: specs[m].items[kid].virtual,
												html: "<td class='full' rowspan='" + rowspan + "'>" + specs[m].items[kid].title + "</td>\r\n",
												id: specs[m].items[kid].id
											};
										}
										else {
											h[m][j] = {
												title: specs[m].items[kid].title,
												virtual: specs[m].items[kid].virtual,
												html: "",
												id: specs[m].items[kid].id
											};
										}
										n++;
										if (n == rowspan) {
											kid++;
											if (kid > specs[m].items.length - 1) {
												kid = 0;
											}
											n = 0;
										}
									}
								}

								var hh = "";
								for (var i = 0; i < newlen; i++) {
									hh += "<tr>";
									var ids = [];
									var titles = [];
									var virtuals = [];
									for (var j = 0; j < len; j++) {
										hh += h[j][i].html;
										ids.push(h[j][i].id);
										titles.push(h[j][i].title);
										virtuals.push(h[j][i].virtual);
									}
									ids = ids.join('_');
									titles = titles.join('+');
									var val = {
										id: "",
										title: titles,
										<?php foreach( $levels as $level ){ ?>
										<?php if( $level['key']=='default'){ ?>
										level<?php echo ($level['key']); ?>: '',
										<?php  }else{ ?>
										level<?php echo ($level['id']); ?>: '',
										<?php } ?>
										<?php } ?>
										costprice: "",
										presell: "",
										productprice: "",
										<?php if( !empty($is_open_vipcard_buy) && $is_open_vipcard_buy == 1 ){ ?>
										cardprice: "",
										<?php } ?>
										marketprice: "",
										weight: "",
										productsn: "",
										goodssn: "",
										virtual: virtuals
									};

									var val ={ id : "",title:titles,<?php foreach( $levels as $level ){ if( $level['key']=='default'){ ?> level<?php echo ($level['key']); ?>: '',<?php  }else{ ?> level<?php echo ($level['id']); ?>: '',<?php } } ?>costprice : "",productprice : "",marketprice : "",weight:"",productsn:"",goodssn:"",virtual:virtuals };
									if ($(".discount_id_" + ids).length > 0) {
										val = {
											id: $(".discount_id_" + ids + ":eq(0)").val(),
											title: titles,
											<?php foreach( $levels as $level ){ ?>
										<?php if( $level['key']=='default'){ ?>
											level<?php echo ($level['key']); ?>: $(".discount_<?php echo ($level['key']); ?>_" + ids + ":eq(0)").val(),
										<?php  }else{ ?>
											level<?php echo ($level['id']); ?>: $(".discount_level<?php echo ($level['id']); ?>_" + ids + ":eq(0)").val(),
										<?php } ?>
											<?php } ?>
											costprice: $(".discount_costprice_" + ids + ":eq(0)").val(),
											presell: $(".discount_presell_" + ids + ":eq(0)").val(),
											productprice: $(".discount_productprice_" + ids + ":eq(0)").val(),
											<?php if( !empty($is_open_vipcard_buy) && $is_open_vipcard_buy == 1 ){ ?>
											cardprice: $(".discount_cardprice_" + ids + ":eq(0)").val(),
											<?php } ?>
											marketprice: $(".discount_marketprice_" + ids + ":eq(0)").val(),
											presell: $(".discount_presell_" + ids + ":eq(0)").val(),
											goodssn: $(".discount_goodssn_" + ids + ":eq(0)").val(),
											productsn: $(".discount_productsn_" + ids + ":eq(0)").val(),
											weight: $(".discount_weight_" + ids + ":eq(0)").val(),
											virtual: virtuals
										}
									}

									<?php foreach( $levels as $level ){ ?>
									hh += '<td>'
									<?php if( $level['key']=='default'){ ?>
									hh += '<input data-name="discount_level_<?php echo ($level['key']); ?>_' + ids +'"type="text" class="form-control discount_<?php echo ($level['key']); ?> discount_<?php echo ($level['key']); ?>_' + ids +'" value="' +(val.level<?php echo ($level['key']); ?>=='undefined'?'':val.level<?php echo ($level['key']); ?> )+'"/>';
									<?php  }else{ ?>
									hh += '<input data-name="discount_level_<?php echo ($level['id']); ?>_' + ids +'"type="text" class="form-control discount_level<?php echo ($level['id']); ?> discount_level<?php echo ($level['id']); ?>_' + ids +'" value="' +(val.level<?php echo ($level['id']); ?>=='undefined'?'':val.level<?php echo ($level['id']); ?> )+'"/>';
									<?php } ?>
									hh += '</td>';
									<?php } ?>
									hh += '<input data-name="discount_id_' + ids+'"type="hidden" class="form-control discount_id discount_id_' + ids +'" value="' +(val.id=='undefined'?'':val.id )+'"/>';
									hh += '<input data-name="discount_ids"type="hidden" class="form-control discount_ids discount_ids_' + ids +'" value="' + ids +'"/>';
									hh += '<input data-name="discount_title_' + ids +'"type="hidden" class="form-control discount_title discount_title_' + ids +'" value="' +(val.title=='undefined'?'':val.title )+'"/></td>';
									hh += '<input data-name="discount_virtual_' + ids +'"type="hidden" class="form-control discount_virtual discount_virtual_' + ids +'" value="' +(val.virtual=='undefined'?'':val.virtual )+'"/></td>';
									hh += "</tr>";
								}
								html += hh;
								html += "</table>";
								$("#discount").html(html);
							}

							function refreshIsDiscount() {
								var html = '<table class="table table-bordered table-condensed"><thead><tr class="active">';
								var specs = [];

								$(".spec_item").each(function (i) {
									var _this = $(this);

									var spec = {
										id: _this.find(".spec_id").val(),
										title: _this.find(".spec_title").val()
									};

									var items = [];
									_this.find(".spec_item_item").each(function () {
										var __this = $(this);
										var item = {
											id: __this.find(".spec_item_id").val(),
											title: __this.find(".spec_item_title").val(),
											virtual: __this.find(".spec_item_virtual").val(),
											show: __this.find(".spec_item_show").get(0).checked ? "1" : "0"
										}
										items.push(item);
									});
									spec.items = items;
									specs.push(spec);
								});
								specs.sort(function (x, y) {
									if (x.items.length > y.items.length) {
										return 1;
									}
									if (x.items.length < y.items.length) {
										return -1;
									}
								});

								var len = specs.length;
								var newlen = 1;
								var h = new Array(len);
								var rowspans = new Array(len);
								for (var i = 0; i < len; i++) {
									html += "<th>" + specs[i].title + "</th>";
									var itemlen = specs[i].items.length;
									if (itemlen <= 0) {
										itemlen = 1
									}
									;
									newlen *= itemlen;

									h[i] = new Array(newlen);
									for (var j = 0; j < newlen; j++) {
										h[i][j] = new Array();
									}
									var l = specs[i].items.length;
									rowspans[i] = 1;
									for (j = i + 1; j < len; j++) {
										rowspans[i] *= specs[j].items.length;
									}
								}

								<?php foreach( $levels as $level ){ ?>
								<?php if( $level['key']=='default'){ ?>
								html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;"><?php echo ($level['levelname']); ?></div><div class="input-group"><input type="text" class="form-control  input-sm isdiscount_discounts_<?php echo ($level['key']); ?>_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'isdiscount_discounts_<?php echo ($level['key']); ?>\');"></a></span></div></div></th>';
								<?php  }else{ ?>
								html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;"><?php echo ($level['levelname']); ?></div><div class="input-group"><input type="text" class="form-control  input-sm isdiscount_discounts_level<?php echo ($level['id']); ?>_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'isdiscount_discounts_level<?php echo ($level['id']); ?>\');"></a></span></div></div></th>';
								<?php } ?>
								<?php } ?>
								html += '</tr></thead>';

								for (var m = 0; m < len; m++) {
									var k = 0, kid = 0, n = 0;
									for (var j = 0; j < newlen; j++) {
										var rowspan = rowspans[m];
										if (j % rowspan == 0) {
											h[m][j] = {
												title: specs[m].items[kid].title,
												virtual: specs[m].items[kid].virtual,
												html: "<td class='full' rowspan='" + rowspan + "'>" + specs[m].items[kid].title + "</td>\r\n",
												id: specs[m].items[kid].id
											};
										}
										else {
											h[m][j] = {
												title: specs[m].items[kid].title,
												virtual: specs[m].items[kid].virtual,
												html: "",
												id: specs[m].items[kid].id
											};
										}
										n++;
										if (n == rowspan) {
											kid++;
											if (kid > specs[m].items.length - 1) {
												kid = 0;
											}
											n = 0;
										}
									}
								}

								var hh = "";
								for (var i = 0; i < newlen; i++) {
									hh += "<tr>";
									var ids = [];
									var titles = [];
									var virtuals = [];
									for (var j = 0; j < len; j++) {
										hh += h[j][i].html;
										ids.push(h[j][i].id);
										titles.push(h[j][i].title);
										virtuals.push(h[j][i].virtual);
									}
									ids = ids.join('_');
									titles = titles.join('+');
									var val = {
										id: "",
										title: titles,
									<?php foreach( $levels as $level ){ ?>
									<?php if( $level['key']=='default'){ ?>
									level<?php echo ($level['key']); ?>: '',
									<?php  }else{ ?>
									level<?php echo ($level['if']); ?>: '',
									<?php } ?>
									<?php } ?>
									costprice: "",
											presell: "",
											productprice: "",
											marketprice: "",
											weight: "",
											productsn: "",
											goodssn: "",
											virtual: virtuals
								};

									var val ={ id : "",title:titles,<?php foreach( $levels as $level ){ if( $level['key']=='default'){ ?> level<?php echo ($level['key']); ?>: '',<?php  }else{ ?> level<?php echo ($level['id']); ?>: '',<?php } } ?>costprice : "",productprice : "",marketprice : "",weight:"",productsn:"",goodssn:"",virtual:virtuals };
									if ($(".isdiscount_discounts_id_" + ids).length > 0) {
										val = {
											id: $(".isdiscount_discounts_id_" + ids + ":eq(0)").val(),
											title: titles,
										<?php foreach( $levels as $level ){ ?>
										<?php if( $level['key']=='default'){ ?>
										level<?php echo ($level['key']); ?>: $(".isdiscount_discounts_<?php echo ($level['key']); ?>_" + ids + ":eq(0)").val(),
										<?php  }else{ ?>
										level<?php echo ($level['id']); ?>: $(".isdiscount_discounts_level<?php echo ($level['id']); ?>_" + ids + ":eq(0)").val(),
										<?php } ?>
										<?php } ?>
										costprice: $(".isdiscount_discounts_costprice_" + ids + ":eq(0)").val(),
												productprice: $(".isdiscount_discounts_productprice_" + ids + ":eq(0)").val(),
												marketprice: $(".isdiscount_discounts_marketprice_" + ids + ":eq(0)").val(),
												presell: $(".isdiscount_discounts_presell_" + ids + ":eq(0)").val(),
												goodssn: $(".isdiscount_discounts_goodssn_" + ids + ":eq(0)").val(),
												productsn: $(".isdiscount_discounts_productsn_" + ids + ":eq(0)").val(),
												weight: $(".isdiscount_discounts_weight_" + ids + ":eq(0)").val(),
												virtual: virtuals
									}
									}

									<?php foreach( $levels as $level ){ ?>
									hh += '<td>'
									<?php if( $level['key']=='default'){ ?>
									hh += '<input data-name="isdiscount_discounts_level_<?php echo ($level['key']); ?>_' + ids +'"type="text" class="form-control isdiscount_discounts_<?php echo ($level['key']); ?> isdiscount_discounts_<?php echo ($level['key']); ?>_' + ids +'" value="' +(val.level<?php echo ($level['key']); ?>=='undefined'?'':val.level<?php echo ($level['key']); ?> )+'"/>';
									<?php  }else{ ?>
									hh += '<input data-name="isdiscount_discounts_level_<?php echo ($level['id']); ?>_' + ids +'"type="text" class="form-control isdiscount_discounts_level<?php echo ($level['id']); ?> isdiscount_discounts_level<?php echo ($level['id']); ?>_' + ids +'" value="' +(val.level<?php echo ($level['id']); ?>=='undefined'?'':val.level<?php echo ($level['id']); ?> )+'"/>';
									<?php } ?>
									hh += '</td>';
									<?php } ?>
									hh += '<input data-name="isdiscount_discounts_id_' + ids+'"type="hidden" class="form-control isdiscount_discounts_id isdiscount_discounts_id_' + ids +'" value="' +(val.id=='undefined'?'':val.id )+'"/>';
									hh += '<input data-name="isdiscount_discounts_ids"type="hidden" class="form-control isdiscount_discounts_ids isdiscount_discounts_ids_' + ids +'" value="' + ids +'"/>';
									hh += '<input data-name="isdiscount_discounts_title_' + ids +'"type="hidden" class="form-control isdiscount_discounts_title isdiscount_discounts_title_' + ids +'" value="' +(val.title=='undefined'?'':val.title )+'"/></td>';
									hh += '<input data-name="isdiscount_discounts_virtual_' + ids +'"type="hidden" class="form-control isdiscount_discounts_virtual isdiscount_discounts_virtual_' + ids +'" value="' +(val.virtual=='undefined'?'':val.virtual )+'"/></td>';
									hh += "</tr>";
								}
								html += hh;
								html += "</table>";
								$("#isdiscount_discounts").html(html);
							}

							function refreshCommission() {
								var commission_level = <?php echo json_encode($commission_level);?>;
								var html = '<table class="table table-bordered table-condensed"><thead><tr class="active">';
								var specs = [];

								$(".spec_item").each(function (i) {
									var _this = $(this);

									var spec = {
										id: _this.find(".spec_id").val(),
										title: _this.find(".spec_title").val()
									};

									var items = [];
									_this.find(".spec_item_item").each(function () {
										var __this = $(this);
										var item = {
											id: __this.find(".spec_item_id").val(),
											title: __this.find(".spec_item_title").val(),
											virtual: __this.find(".spec_item_virtual").val(),
											show: __this.find(".spec_item_show").get(0).checked ? "1" : "0"
										}
										items.push(item);
									});
									spec.items = items;
									specs.push(spec);
								});
								specs.sort(function (x, y) {
									if (x.items.length > y.items.length) {
										return 1;
									}
									if (x.items.length < y.items.length) {
										return -1;
									}
								});

								var len = specs.length;
								var newlen = 1;
								var h = new Array(len);
								var rowspans = new Array(len);
								for (var i = 0; i < len; i++) {
									html += "<th>" + specs[i].title + "</th>";
									var itemlen = specs[i].items.length;
									if (itemlen <= 0) {
										itemlen = 1
									}
									;
									newlen *= itemlen;

									h[i] = new Array(newlen);
									for (var j = 0; j < newlen; j++) {
										h[i][j] = new Array();
									}
									var l = specs[i].items.length;
									rowspans[i] = 1;
									for (j = i + 1; j < len; j++) {
										rowspans[i] *= specs[j].items.length;
									}
								}

								$.each(commission_level,function (key,level) {
									html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;">'+level.levelname+'</div></div></th>';
								})
								html += '</tr></thead>';

								for (var m = 0; m < len; m++) {
									var k = 0, kid = 0, n = 0;
									for (var j = 0; j < newlen; j++) {
										var rowspan = rowspans[m];
										if (j % rowspan == 0) {
											h[m][j] = {
												title: specs[m].items[kid].title,
												virtual: specs[m].items[kid].virtual,
												html: "<td class='full' rowspan='" + rowspan + "'>" + specs[m].items[kid].title + "</td>\r\n",
												id: specs[m].items[kid].id
											};
										}
										else {
											h[m][j] = {
												title: specs[m].items[kid].title,
												virtual: specs[m].items[kid].virtual,
												html: "",
												id: specs[m].items[kid].id
											};
										}
										n++;
										if (n == rowspan) {
											kid++;
											if (kid > specs[m].items.length - 1) {
												kid = 0;
											}
											n = 0;
										}
									}
								}
								var hh = "";
								for (var i = 0; i < newlen; i++) {
									hh += "<tr>";
									var ids = [];
									var titles = [];
									var virtuals = [];
									for (var j = 0; j < len; j++) {
										hh += h[j][i].html;
										ids.push(h[j][i].id);
										titles.push(h[j][i].title);
										virtuals.push(h[j][i].virtual);
									}
									ids = ids.join('_');
									titles = titles.join('+');

									var val = {
										id: "",
										title: titles,
									<?php foreach( $commission_level as $level ){ ?>
									<?php if( $level["key"] == "default"){ ?>
									level<?php echo ($level['key']); ?>: '',
									<?php  }else{ ?>
									level<?php echo ($level['id']); ?>: '',
									<?php } ?>
									<?php } ?>
									costprice: "",
											presell: "",
											productprice: "",
											marketprice: "",
											weight: "",
											productsn: "",
											goodssn: "",
											virtual: virtuals
								};

									var val ={ id : "",title:titles,<?php foreach( $commission_level as $level ){ ?> <?php if( $level["key"] == "default"){ ?>level<?php echo ($level['key']); ?>: '',<?php  }else{ ?>level<?php echo ($level['id']); ?>: '',<?php } } ?>costprice : "",productprice : "",marketprice : "",weight:"",productsn:"",goodssn:"",virtual:virtuals };
									<?php foreach( $commission_level as $level ){ ?>
									<?php if( $level["key"] == "default"){ ?>
									var level<?php echo ($level['key']); ?> = new Array(3);
									$(".commission_<?php echo ($level['key']); ?>_"+ ids).each(function(index,val){
										level<?php echo ($level['key']); ?>[index] = val;
									})
									<?php  }else{ ?>
									var level<?php echo ($level['id']); ?> = new Array(3);
									$(".commission_level<?php echo ($level['id']); ?>_"+ ids).each(function(index,val){
										level<?php echo ($level['id']); ?>[index] = val;
									})
									<?php } ?>
									<?php } ?>
									if ($(".commission_id_" + ids).length > 0) {
										val = {
											id: $(".commission_id_" + ids + ":eq(0)").val(),
											title: titles,
											costprice: $(".commission_costprice_" + ids + ":eq(0)").val(),
											presell: $(".commission_presell_" + ids + ":eq(0)").val(),
												productprice: $(".commission_productprice_" + ids + ":eq(0)").val(),
												marketprice: $(".commission_marketprice_" + ids + ":eq(0)").val(),
												goodssn: $(".commission_goodssn_" + ids + ":eq(0)").val(),
												productsn: $(".commission_productsn_" + ids + ":eq(0)").val(),
												weight: $(".commission_weight_" + ids + ":eq(0)").val(),
												virtual: virtuals
										}
									}
									<?php foreach( $commission_level as $level ){ ?>
									hh += '<td>';
									var level_temp = <?php if( $level['key'] == 'default'){ ?>level<?php echo ($level['key']); }else{ ?>level<?php echo ($level['id']); } ?>;
									if (len >= i && typeof (level_temp) != 'undefined')
									{
										if('<?php echo ($level['key']); ?>' == 'default')
										{
											for (var li = 0; li<<?php echo ($shopset_level); ?>;li++)
											{
												if (typeof (level_temp[li])!= "undefined")
												{
													hh += '<input data-name="commission_level_<?php echo ($level['key']); ?>_' +ids+ '"  type="text" class="form-control commission_<?php echo ($level['key']); ?> commission_<?php echo ($level['key']); ?>_' +ids+ '" value="' +$(level_temp[li]).val()+ '" style="display:inline;width: '+96/parseInt(<?php echo ($shopset_level); ?>)+'%;"/> ';
												}
												else
												{
													hh += '<input data-name="commission_level_<?php echo ($level['key']); ?>_' +ids+ '"  type="text" class="form-control commission_<?php echo ($level['key']); ?> commission_<?php echo ($level['key']); ?>_' +ids+ '" value="" style="display:inline;width: '+96/parseInt(<?php echo ($shopset_level); ?>)+'%;"/> ';
												}
											}
										}
										else
										{
											for (var li = 0; li<<?php echo ($shopset_level); ?>;li++)
											{
												if (typeof (level_temp[li])!= "undefined")
												{
													hh += '<input data-name="commission_level_<?php echo ($level['id']); ?>_' +ids+ '"  type="text" class="form-control commission_level<?php echo ($level['id']); ?> commission_level<?php echo ($level['id']); ?>_' +ids+ '" value="' +$(level_temp[li]).val()+ '" style="display:inline;width: '+96/parseInt(<?php echo ($shopset_level); ?>)+'%;"/> ';
												}
												else
												{
													hh += '<input data-name="commission_level_<?php echo ($level['id']); ?>_' +ids+ '"  type="text" class="form-control commission_level<?php echo ($level['id']); ?> commission_level<?php echo ($level['id']); ?>_' +ids+ '" value="" style="display:inline;width: '+96/parseInt(<?php echo ($shopset_level); ?>)+'%;"/> ';
												}
											}
										}
									}
									else
									{
										if('<?php echo ($level['key']); ?>' == 'default')
										{
											for (var li = 0; li<<?php echo ($shopset_level); ?>;li++)
											{
												if (typeof (level_temp[li])!= "undefined")
												{
													hh += '<input data-name="commission_level_<?php echo ($level['key']); ?>_' +ids+ '"  type="text" class="form-control commission_<?php echo ($level['key']); ?> commission_<?php echo ($level['key']); ?>_' +ids+ '" value="' +$(level_temp[li]).val()+ '" style="display:inline;width: '+96/parseInt(<?php echo ($shopset_level); ?>)+'%;"/> ';
												}
												else
												{
													hh += '<input data-name="commission_level_<?php echo ($level['key']); ?>_' +ids+ '"  type="text" class="form-control commission_<?php echo ($level['key']); ?> commission_<?php echo ($level['key']); ?>_' +ids+ '" value="" style="display:inline;width: '+96/parseInt(<?php echo ($shopset_level); ?>)+'%;"/> ';
												}
											}
										}
										else
										{
											for (var li = 0; li<<?php echo ($shopset_level); ?>;li++)
											{
												if (typeof (level_temp[li])!= "undefined")
												{
													hh += '<input data-name="commission_level_<?php echo ($level['id']); ?>_' +ids+ '"  type="text" class="form-control commission_level<?php echo ($level['id']); ?> commission_level<?php echo ($level['id']); ?>_' +ids+ '" value="' +$(level_temp[li]).val()+ '" style="display:inline;width: '+96/parseInt(<?php echo ($shopset_level); ?>)+'%;"/> ';
												}
												else
												{
													hh += '<input data-name="commission_level_<?php echo ($level['id']); ?>_' +ids+ '"  type="text" class="form-control commission_level<?php echo ($level['id']); ?> commission_level<?php echo ($level['id']); ?>_' +ids+ '" value="" style="display:inline;width: '+96/parseInt(<?php echo ($shopset_level); ?>)+'%;"/> ';
												}
											}
										}
									}
									hh += '</td>';
									<?php } ?>
									hh += '<input data-name="commission_id_' + ids+'"type="hidden" class="form-control commission_id commission_id_' + ids +'" value="' +(val.id=='undefined'?'':val.id )+'"/>';
									hh += '<input data-name="commission_ids"type="hidden" class="form-control commission_ids commission_ids_' + ids +'" value="' + ids +'"/>';
									hh += '<input data-name="commission_title_' + ids +'"type="hidden" class="form-control commission_title commission_title_' + ids +'" value="' +(val.title=='undefined'?'':val.title )+'"/></td>';
									hh += '<input data-name="commission_virtual_' + ids +'"type="hidden" class="form-control commission_virtual commission_virtual_' + ids +'" value="' +(val.virtual=='undefined'?'':val.virtual )+'"/></td>';
									hh += "</tr>";
								}
								html += hh;
								html += "</table>";
								$("#commission").html(html);
							}

						function setCol(cls){
							$("."+cls).val( $("."+cls+"_all").val());
						}
						function showItem(obj){
							var show = $(obj).get(0).checked?"1":"0";
							$(obj).parents('.spec_item_item').find('.spec_item_show:eq(0)').val(show);
						}
						function nofind(){
							var img=event.srcElement;
							img.src="./resource/image/module-nopic-small.jpg";
							img.onerror=null;
						}

							function choosetemp(id){
							$('#modal-module-chooestemp').modal();
							$('#modal-module-chooestemp').data("temp",id);
						}
						function addtemp(){
							var id = $('#modal-module-chooestemp').data("temp");
							var temp_id = $('#modal-module-chooestemp').find("select").val();
							var temp_name = $('#modal-module-chooestemp option[value='+temp_id+']').text();
							//alert(temp_id+":"+temp_name);
							$("#temp_name_"+id).val(temp_name);
							$("#temp_id_"+id).val(temp_id);
							$('#modal-module-chooestemp .close').click();
							refreshOptions()
						}

						function setinterval(type)
						{
							var intervalfloor =$('#intervalfloor').val();
							if(intervalfloor=="")
							{
								intervalfloor=0;
							}
							intervalfloor = parseInt(intervalfloor);

							if(type=='plus')
							{
								if(intervalfloor==3)
								{
									tip.msgbox.err("最多添加三个区间价格");
									return;
								}
								intervalfloor=intervalfloor+1;
							}
							else if(type=='minus')
							{
								if(intervalfloor==0)
								{
									tip.msgbox.err("请最少添加一个区间价格");
									return;
								}
								intervalfloor=intervalfloor-1;
							}else
							{
								return;
							}

							if(intervalfloor<1)
							{

								$('#interval1').hide();
								$('#intervalnum1').val("");
								$('#intervalprice1').val("");
							}else
							{
								$('#interval1').show();
							}

							if(intervalfloor<2)
							{

								$('#interval2').hide();
								$('#intervalnum2').val("");
								$('#intervalprice2').val("");
							}else
							{
								$('#interval2').show();
							}

							if(intervalfloor<3)
							{

								$('#interval3').hide();
								$('#intervalnum3').val("");
								$('#intervalprice3').val("");
							}else
							{
								$('#interval3').show();
							}


							$('#intervalfloor').val(intervalfloor);

						}


						</script>
						<script language="javascript">
							$(function() {
								
								
									
								
							})
						</script>
</body>