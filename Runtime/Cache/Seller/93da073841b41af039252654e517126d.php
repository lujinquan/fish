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
        <div class="layui-card-header layui-elem-quote">当前位置：<span class="line-text">资金流水列表</span></div>
		
        <div class="layui-card-body" style="padding:15px;">
        <div class="page-content">
            <form action="" method="get" class="form-horizontal form-search layui-form" role="form">
        		<input type="hidden" name="c" value="supply" />
                <input type="hidden" name="a" value="floworder" />
                
                <div class="layui-form-item">
    				<div class="layui-input-inline layui-btn-group">
    					<button type="submit" name="export" value="1" class="layui-btn layui-btn-sm layui-btn-warm">导出</button>
    				</div>
                </div>
            </form>
            <form action="" class="layui-form" lay-filter="example" method="post" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-table-header">
                            <?php $commiss_level = D('Home/Front')->get_config_by_name('commiss_level'); ?>
                        </div>
                        <table class="table table-responsive" lay-even lay-skin="line" lay-size="lg">
                            <thead>
                                <tr>
            						<th style="width:25px;"></th>
										<th style="width:60px;">ID</th>
										<th style="">订单id</th>
										<th style="">商品名称</th>
										
										<th style="">金额</th>
										<?php if( !empty($commiss_level) && $commiss_level >0){ ?>
										<th style="">会员佣金</th>
										<?php } ?>
										<th style="">团长佣金</th>
										<th style="">服务费</th>
										<th style="">实收金额</th>
										<th style='width:100px;'>状态</th>
									</tr>
                                </tr>
                            </thead>
                            <tbody>
        					<?php foreach( $list as $row ){ ?>
        						<tr>
                            <td style="position: relative; ">
                               
							</td>
							<td>
								<?php echo ($row['id']); ?>
							</td>
							<td> 
								<?php echo ($row['order_id']); ?>
                            </td>
							<td>
								<?php echo ($row['goods_name']); ?> <?php echo ($row['option_sku']); ?>
							</td>
							
							<td> 
								￥<?php echo ($row['total_money']); ?>
                            </td>
							<?php if( !empty($commiss_level) && $commiss_level >0){ ?>
							<td> 
								-￥<?php echo ($row['member_commiss_money']); ?>
                            </td>
							<?php } ?>
							<td> 
								-￥<?php echo ($row['head_commiss_money']); ?>
                            </td>
							<td> 
								比例：<?php echo ($row['comunity_blili']); ?>%&nbsp;&nbsp;
								<br/>
								服务费：-￥<?php echo round($row['total_money']*$row['comunity_blili']/100,2); ?>
                            </td>
							<td> 
								￥<?php echo ($row['money']); ?>
                            </td>
							<td>
								<?php if( $row[state] ==2 ){ ?>
									订单取消
								<?php }else if($row[state] ==1){ ?>
									<text class='text-danger'>已结算</text>
								<?php  }else{ ?>
									待结算
								<?php } ?>
							<br/>
							</td>
                        </tr>
        					<?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                  
                                    <td colspan="8" style="text-align: right">
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