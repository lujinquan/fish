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
		<div class="layui-card-header layui-elem-quote">当前位置：<span class="line-text">提现设置</span></div>
		<div class="layui-card-body" style="padding:15px;">
			<form action="" method="post" class="layui-form" lay-filter="component-layui-form-item" enctype="multipart/form-data" >
				
				<div class="layui-form-item" >
					<label class="layui-form-label">最小提现金额</label>
					<div class="layui-input-block">
						<div class="input-group">
							<input type="text" name="data[commiss_min_tixian_money]" class="form-control" value="<?php echo empty($data['commiss_min_tixian_money'])?0.01:$data['commiss_min_tixian_money']; ?>" >
							<span class="input-group-addon">元</span>
						</div>
						<span class="help-block">分销商的佣金达到此额度时才能提现，最低0.01元</span>
					</div>
				</div>
				
				<div class="layui-form-item" >
					<label class="layui-form-label">提现手续费</label>
					<div class="layui-input-block">
						<div class="input-group">
							<input type="text" name="data[commiss_tixian_bili]" class="form-control" value="<?php echo empty($data['commiss_tixian_bili'])?0:$data['commiss_tixian_bili']; ?>" >
							<span class="input-group-addon">%</span>
						</div>
						<span class="help-block">会员提现手续费比例，设置0即为无手续费</span>
					</div>
				</div>
				
				<div class="layui-form-item" style="display:none;">
					<label class="layui-form-label">审核设置</label>
					<div class="layui-input-block">
						<label class="radio-inline"><input type="radio" lay-filter="reviewed" class="radi"  name="data[commiss_tixian_reviewed]" value="0" <?php if($data['commiss_tixian_reviewed'] ==0){ ?> checked="checked"<?php } ?> title="手动" /> </label>
						<label class="radio-inline"><input type="radio" lay-filter="reviewed" class="radi"  name="data[commiss_tixian_reviewed]" value="1" <?php if($data['commiss_tixian_reviewed'] ==1){ ?> checked="checked"<?php } ?> title="自动" /> </label>
						
					</div>
				</div> 
				<div class="layui-form-item community_commiss1" id="form_div_input2" <?php if( empty($data) || $data['commiss_tixian_reviewed'] == 0 ){ ?> style="display:block;"<?php }else{ ?> style="display:none;"<?php } ?> >
					<label class="layui-form-label" style="display:none;"></label>
					<div class="layui-input-block fixmore-input-group" style="display:none;">
						<div class="layui-inline">
							<label class="layui-form-label" style="width:90px;">金额小于</label>
							<div class="layui-input-inline">
								<input type="text" name="data[commiss_canauto_min_moeny]" value="<?php echo empty($data['commiss_canauto_min_moeny'])?0:$data['commiss_canauto_min_moeny']; ?>" class="layui-input">
							</div>
							<label class="layui-form-label" style="width:100px;">元无需审核</label>
						</div>
					</div>
				</div>
				
				<div class="layui-form-item">
					<label class="layui-form-label">提现方式设置</label>
					<div class="layui-input-block">
						<label class="radio-inline"><input lay-ignore type="checkbox" name="data[commiss_tixianway_yuer]" value="2" <?php if(!isset($data['commiss_tixianway_yuer']) || ( isset($data['commiss_tixianway_yuer']) && $data['commiss_tixianway_yuer'] ==2)){ ?> checked="checked" <?php } ?> title="" /> 到余额</label>
						<label class="radio-inline"><input lay-ignore type="checkbox" name="data[commiss_tixianway_weixin]" value="2" <?php if(!isset($data['commiss_tixianway_weixin']) || (isset($data['commiss_tixianway_weixin']) && $data['commiss_tixianway_weixin'] ==2)){ ?> checked="checked" <?php } ?> title="" /> 微信</label>
						<label class="radio-inline"><input lay-ignore type="checkbox" name="data[commiss_tixianway_alipay]" value="2" <?php if(!isset($data['commiss_tixianway_alipay']) || (isset($data['commiss_tixianway_alipay']) && $data['commiss_tixianway_alipay'] ==2)){ ?> checked="checked" <?php } ?> title="" /> 支付宝</label>
						<label class="radio-inline"><input lay-ignore type="checkbox" name="data[commiss_tixianway_bank]" value="2" <?php if( !isset($data['commiss_tixianway_bank']) || (isset($data['commiss_tixianway_bank']) && $data['commiss_tixianway_bank'] ==2 ) ){ ?> checked="checked" <?php } ?> title="" /> 银行卡</label>
						
					</div>
				</div>
				
				<div class="layui-form-item">
					<label class="layui-form-label">提现说明</label>
					<div class="layui-input-block fixmore-input-group">
						<div class="">
							<?php echo tpl_ueditor('data[commiss_tixian_publish]',$data['commiss_tixian_publish'],array('height'=>'300'));?>
						</div>
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
		$('#load_ifram_url').click(function(){
			console.log(12);
			
			layer.open({
			  type: 2, 
			  area: ['100%', '100%'],
			  content: '<?php echo U('distribution/addForm');?>'
			});
		})
		form.on('radio(reviewed)', function(data){
            if (data.value == 1) {
                $('#form_div_input').hide();
            } else {
                $('#form_div_input').show();
            }
        }); 
		form.on('radio(radi_share_form)', function(data){
            if (data.value == 1) {
                $('#share_div').show();
            } else {
                $('#share_div').hide();
            }
        }); 		

        
       
		form.on('radio(radi)', function(data){
			var open_community_leve = data.value ;
    		console.log(open_community_leve);
    		if( open_community_leve == 0 )
    		{
    			$('.community_commiss1').hide();
    			$('.community_commiss2').hide();
    			$('.community_commiss3').hide();
    		}else if( open_community_leve == 1 ){
    			$('.community_commiss1').show();
    			$('.community_commiss2').hide();
    			$('.community_commiss3').hide();
    		}else if(open_community_leve == 2){
    			$('.community_commiss1').show();
    			$('.community_commiss2').show();
    			$('.community_commiss3').hide();
    		}else if(open_community_leve == 3){
    			$('.community_commiss1').show();
    			$('.community_commiss2').show();
    			$('.community_commiss3').show();
    		}
		});  

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
                                var backurl = "<?php echo U('distribution/withdraw_config',array('ok'=>'1'));?>";
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
    
<script>
$(function(){
	
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
    function addCategory(){
        var html ='<tr>';
        html+='<td style="width:200px;">';
        html+='<input type="text" class="form-control" name="data[value][]" value="">';
        html+='</td>';
		html+='<td style="width: 45px;">';
		html+='		<a href="javascript:void(0);" class="btn btn-default btn-del btn-op btn-operation" data-confirm="确认删除此标签?">';
		html+='<span data-toggle="tooltip" data-placement="top" title="" data-original-title="删除">';
		html+='<i class="icow icow-shanchu1"></i>';
		html+='</span>';
		html+='</a>';
         html+='</td>';
        html+='</tr>';
        $('#tbody-items').append(html);
    }
    $(function(){
		$(document).delegate('.btn-del','click',function(){
			var $btntr = $(this).parents('tr');
			$btntr.remove();
		})
    });
</script>   

</body>
</html>