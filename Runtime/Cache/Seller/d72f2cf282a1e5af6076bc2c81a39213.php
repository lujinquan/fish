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
        <div class="layui-card-header layui-elem-quote">当前位置：<span class="line-text">充值设置  <!-- <small>拖动可以排序</small> --></span></div>
        <div class="layui-card-body" style="padding:15px;">
            <div class="page-table-header">
                <span class="pull-right">
                    <a href="javascript:;" class="layui-btn layui-btn-sm" onclick='addCategory()'><i class="fa fa-plus"></i> 添加 </a>
                </span>
            </div>
            <form action="" method="post" class="layui-form" lay-filter="component-layui-form-item" enctype="multipart/form-data" >
                <table class="table  table-responsive">
                    <thead class="navbar-inner">
                        <tr>
                            <th style="width:60px;">ID</th>
                            <th style="width:200px;">充值面额</th>
                            <th style="width: 30px;"></th>
                            <th style="width:200px;">赠送</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id='tbody-items'>
						<?php foreach($list as $val){ ?>
                        <tr>
                            <td>
                                <?php echo $val['id']; ?><input type="hidden" name="catid[]" value="<?php echo $val['id']; ?>" >
                            </td>
                            <td>
                                <input type="text" class="form-control" name="money[]" value="<?php echo $val['money']; ?>" >
                            </td>
                            <td>送</td>
                            <td>
                                 <input type="text" class="form-control" name="give[]" value="<?php echo $val['send_money']; ?>" >
                            </td>
                            <td>
                                <a class='layui-btn layui-btn-xs deldom'  data-href="<?php echo U('Marketing/delrecharge', array('id' =>$val['id']));?>" data-confirm="确认删除吗？" href="javascript:;">
                                    <i class="layui-icon">&#xe640;</i>删除
                                </a>
                            </td>
                        </tr>
						<?php } ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">
                                <input type="submit" class="layui-btn" lay-submit lay-filter="formDemo" value="保存">
                            </td>
                        </tr>
                     </tfoot>
                </table>
            </form>
        </div>
    </div>
</div>



<script>
    function addCategory(){
        var html ='<tr>';
        html+='<td><i class="fa fa-plus"></i><input type="hidden" class="form-control" name="catid[]" value=""></td>';
        html+='<td><input type="text" class="form-control" name="money[]" value="" ></td>';
        html+='<td>送</td>';
        html+='<td><input type="text" class="form-control" name="give[]" value="" ></td>';
        html+='<td></td></tr>';
        $('#tbody-items').append(html);
    }
</script>
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
</html>