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
            <div class="layui-card-header layui-elem-quote">当前位置：<span class="line-text"><?php if( !empty($item['id']) ){ ?>编辑<?php }else{ ?>添加<?php } ?>菜谱<?php if( !empty($item['id']) ){ ?>(<?php echo ($item['title']); ?>)<?php } ?></span></div>
            <div class="layui-card-body" style="padding:15px;">
                <form action="" method="post" class="layui-form" lay-filter="component-layui-form-item" enctype="multipart/form-data" >
                    <input type="hidden" name="data[id]" value="<?php echo ($item['id']); ?>"/>
                    
					<div class="layui-form-item">
                        <label class="layui-form-label"><font color="red">*</font>菜谱名称</label>
                        <div class="layui-input-block">
                            <input type="text" id='recipe_name' name="data[recipe_name]" class="form-control" value="<?php echo ($item['recipe_name']); ?>" required  lay-verify="required" >
                        </div>
                    </div>
					
					<div class="layui-form-item">
						<label class="layui-form-label">菜谱简介</label>
						<div class="layui-input-block">
							<textarea  name="sub_name" id="sub_name" rows="5"  class="form-control" data-parent=".sub_name" maxlength="100" data-rule-maxlength="100"><?php echo ($item['sub_name']); ?></textarea>
							<div class="layui-form-mid layui-word-aux">介绍菜谱的卖点、特色，建议100个字以内</div>
						</div>
					</div>
					
					<div class="layui-form-item">
						<label class="layui-form-label must">*  菜谱主图</label>
						<div class="layui-input-block gimgs">
							<?php echo tpl_form_field_image2('data[images]',$item['images']); ?>
							<span class="layui-form-mid layui-word-aux image-block"></span>
						</div>
					</div>
						
					<div class="layui-form-item">
						<label class="layui-form-label must">菜谱视频</label>
						<div class="layui-input-block gimgs">
								<?php echo tpl_form_field_video('data[video]',$item['video'] );?>
							<span class="layui-form-mid layui-word-aux image-block">
								请输入视频链接地址或者选择上传视频(支持抖音视频地址)<br/>
								视频时长建议9-30秒，视频大小不超过30MB，建议宽高比例5：4，支持的视频格式MP4<br/>
								当视频有填写，优先调用视频做为列表图。
							</span>
						</div>
					</div>	
					<div class="layui-form-item">
					   <label class="layui-form-label">启用</label>
						<div class="layui-input-block ">
							<input type="checkbox" id="state" lay-filter="state" lay-skin="primary" name="state" class="form-control valid" <?php if( empty($item) || $item['state'] ==1 ){ ?>checked<?php } ?> value="1" />
						</div>
					</div>
						
					 
					<div class="layui-form-item">
						<label class="layui-form-label must">关联会员</label>
						
						<div class="layui-input-block">
							<div class="input-group " style="margin: 0;">
								<input type="text" disabled value="<?php echo ($item['member_id']); ?>" class="form-control valid" name="data[member_id]" placeholder="" id="member_id" >
								<?php if( !empty($item['id']) ){ ?>
								<span class="input-group-btn">
									<span class="btn btn-default">会员</span>	
								</span>
								<?php }else{ ?>
								<span class="input-group-btn">
									<span data-input="#member_id" id="chose_member_id"  class="btn btn-default">选择会员</span>	
								</span>
								<?php } ?>
							</div>
							<?php if( !empty($saler) ){ ?>
							<div class="input-group " style="margin: 0;">
								<div class="layadmin-text-center choose_user">
									<img style="" src="<?php echo ($saler['avatar']); ?>">
									<div class="layadmin-maillist-img" style=""><?php echo ($saler['nickname']); ?></div>
									<button type="button" class="layui-btn layui-btn-sm" onclick="cancle_bind(this,'member_id')"><i class="layui-icon">&#xe640;</i></button>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
					
					<div class="layui-form-item">
						<label class="layui-form-label">菜谱分类</label>
						<div class="layui-input-block">
							<select id="cates"   name='data[cate_id]'  class="form-control select2"  >
								<?php foreach($category as $c){ ?>
								<option value="<?php echo ($c['id']); ?>" <?php if( $c['id']==$item['cate_id'] ){ ?>selected<?php } ?> ><?php echo ($c['name']); ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					
					<div class="layui-form-item">
                        <label class="layui-form-label">菜谱时间</label>
                        <div class="layui-input-block">
                            <input type="text" id='make_time' name="data[make_time]" class="form-control" value="<?php echo ($item['make_time']); ?>" >
                        </div>
                    </div>
                    
					<div class="layui-form-item">
						<label class="layui-form-label">菜谱难度</label>
						<div class="layui-input-block">
							<label class="radio-inline"><input type="radio" name="diff_type" value="1" <?php if( !isset($item['diff_type']) || $item['diff_type'] == 1 ){ ?>checked="true"<?php } ?> title="简单" /> </label>
							<label class="radio-inline"><input type="radio" name="diff_type" value="2" <?php if( isset($item['diff_type']) && $item['diff_type'] == 2 ){ ?>checked="true"<?php } ?> title="容易" /> </label>
							<label class="radio-inline"><input type="radio" name="diff_type" value="3" <?php if( isset($item['diff_type']) && $item['diff_type'] == 3 ){ ?>checked="true"<?php } ?> title="困难" /> </label>
							<div class="layui-form-mid layui-word-aux"></div>
						</div>
					</div>
					
					<div class="layui-form-item" >
						<label class="layui-form-label">全部食材</label>
						<div class="layui-input-block">
							<input name="button" type="button" class="btn btn-default" value="添加食材" onclick='addCaipu()'>
						</div>
					</div>
					
					<div id="caipu_div">
						<?php if(!empty($ing_list)){ ?>
							<?php foreach( $ing_list as $ing ){ ?>
							<div class="layui-form-item">	
								<label class="layui-form-label">名称&nbsp;<i class="layui-icon" onclick="cans_this(this)" style="cursor: pointer;"></i></label>	
								<div class="layui-input-block">		
									<input type="text" name="" data-id="<?php echo $ing['id']; ?>" class="form-control make_time" value="<?php echo $ing['title']; ?>">	
								</div>
							</div>
							<div class="layui-form-item">	
								<label class="layui-form-label">商品</label>	
								<div class="layui-input-block">		
									
									<div class="input-group " style="margin: 0;">			
										<input type="text" disabled="" value="" class="form-control valid" name="" placeholder="" id="agent_idr<?php echo $ing['id']; ?>">			
										<span class="input-group-btn">				
											<span data-input="#agent_idr<?php echo $ing['id']; ?>" class="btn btn-default agentid">选择商品</span>			
										</span>		
									</div>
									<?php foreach( $ing['limit_goods'] as $goods ){ ?>
									<div class="input-group mult_choose_goodsid" data-gid="<?php echo ($goods['gid']); ?>" style="border-radius: 0;float: left;margin: 10px;margin-left:0px;width: 22%;">	
										<div class="layadmin-text-center choose_user">		
											<img style="" src="<?php echo ($goods['image']); ?>">		
											<div class="layadmin-maillist-img" style=""><?php echo ($goods['goodsname']); ?></div>		
											<button type="button" class="layui-btn layui-btn-sm" onclick="cancle_bind(this)"><i class="layui-icon"></i></button>	
										</div>
									</div>
									<?php } ?>
									
								</div>
							</div>
						
							<?php } ?>
						<?php } ?>
					</div>
					
					<div class="layui-form-item">
                        <label class="layui-form-label">菜谱详情/步骤</label>
                        <div class="layui-input-block">
                            <?php echo tpl_ueditor('data[content]',$item['content'],array('height'=>'300'));?>
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
	var rant=0;
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
		
		$('#chose_member_id').click(function(){
			cur_open_div = $(this).attr('data-input');
			$.post("<?php echo U('user/zhenquery', array('limit' => 0));?>", {}, function(shtml){
			 layer.open({
				type: 1,
				area: '930px',
				content: shtml //注意，如果str是object，那么需要字符拼接。
			  });
			});
		})

        $('#chose_agent_id2').click(function(){ 
			cur_open_div = $(this).attr('data-input');
			$.post("<?php echo U('goods/query_normal', array('template' => 'mult','is_recipe' => 1, 'unselect_goodsid' => $id));?>", {}, function(shtml){
			 layer.open({
				type: 1,
				area: '930px',
				content: shtml //注意，如果str是object，那么需要字符拼接。
			  });
			});
		})
		
		$(document).delegate(".agentid","click",function(){
			cur_open_div = $(this).attr('data-input');
			$.post("<?php echo U('goods/query_normal', array('template' => 'mult', 'unselect_goodsid' => $id));?>", {}, function(shtml){
			 layer.open({
				type: 1,
				area: '930px',
				content: shtml //注意，如果str是object，那么需要字符拼接。
			  });
			});
		});

		
		
		$('.agent_id').click(function(){ 
			cur_open_div = $(this).attr('data-input');
			$.post("<?php echo U('goods/query_normal', array('template' => 'mult', 'is_recipe' => 1, 'unselect_goodsid' => $id));?>", {}, function(shtml){
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

        form.verify({
          title: [
            /^[\S]{1,}$/,'标题不能为空'
          ] 
        });
            
        //监听提交
        form.on('submit(formDemo)', function(data){
		
			var gd_ar = [];
			
			
			 
			//data-id="0"
			var s_flag = true;
			$('.make_time').each(function(){
				
				var need_obj = {};
				
				var obj = $(this);
				
				var cai_name = $(obj).val();
				var car_id = $(obj).attr('data-id');
				
				if( cai_name == '' )
				{
					s_flag = false;
				}
				var s_parent = $(obj).parent().parent();
				
				var s_next_obj = $(s_parent).next();
				
				var gd_obj = $(s_next_obj).children('.layui-input-block').children('.mult_choose_goodsid');
				
				var gd_arr = [];
				
				$(gd_obj).each(function(){
					gd_arr.push( $(this).attr('data-gid') );
				})
				
				need_obj.id = car_id;
				need_obj.cai_name = cai_name;
				need_obj.goods_ids = gd_arr;
				
				gd_ar.push( need_obj );
			})
		
			if( !s_flag )
			{
				layer.msg('请填写食材名称');
				return false;
			}
			
			data.field.limit_goods_list = gd_ar;
	
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
                                var backurl = "<?php echo U('recipe/index',array('ok'=>'1'));?>";
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
	
	function cans_this( obj )
	{
		var par_obj = $(obj).parent().parent();
		
		$(par_obj).next().remove();
		$(par_obj).remove();
	}
	
	function addCaipu()
	{
		rant++;
		var s_html = '';
		
		s_html +='<div class="layui-form-item">';
		s_html +='	<label class="layui-form-label">名称';
		s_html +='&nbsp;<i class="layui-icon" onclick="cans_this(this)" style="cursor: pointer;"></i>';
		s_html +='</label>';
		
		
		s_html +='	<div class="layui-input-block">';
		s_html +='		<input type="text" name="" data-id="0" class="form-control make_time" value="" >';
		s_html +='	</div>';
		s_html +='</div>';
		
		s_html +='<div class="layui-form-item">';
		s_html +='	<label class="layui-form-label">商品</label>';
		s_html +='	<div class="layui-input-block">';
		s_html +='		<div class="input-group " style="margin: 0;">';
		s_html +='			<input type="text" disabled value="" class="form-control valid" name="" placeholder="" id="agent_id'+rant+'">';
		s_html +='			<span class="input-group-btn">';
		s_html +='				<span data-input="#agent_id'+rant+'"   class="btn btn-default agentid">选择商品</span>';
		s_html +='			</span>';
		s_html +='		</div>';
		s_html +='	</div>';
		s_html +='</div>';
		
		$('#caipu_div').append(s_html);
	}
	
	function addsp(){
		
        
    }
    $(function(){
		$(document).delegate('.btn-del','click',function(){
			var $btntr = $(this).parents('tr');
			$btntr.remove();
		})
    });
	
	function cancle_bind(obj,sdiv)
	{
		$('#'+sdiv).val('');
		$(obj).parent().parent().remove();
	}
    </script>  
</body>
</html>