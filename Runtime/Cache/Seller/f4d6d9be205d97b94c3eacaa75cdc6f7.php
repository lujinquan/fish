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
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
  <link href="/static/css/snailfish.css?v=2.0.0" rel="stylesheet">
 <style>
    .tab-content>.tab-pane {margin-top: 10px;}
    .tab-content>.tab-pane>.fui-list-group {border-bottom: 0;}
	.userNum, .goodsNum, .orderNum {
		height: 4.5rem;
		width: 4.5rem;
		margin: 0 auto;
		cursor: pointer;
		color:#000;
	}
	.nav {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		padding-left: 0;
		margin-bottom: 0;
		list-style: none;
	}
	.panel-1 .nav-left {
		height: 4.8rem;
		line-height: 4.8rem;
		margin-left: 0.2rem;
	}
	.panel-1 .nav-left span{ 
		font-size:14px;
	}
	.nav select {
		width: 50%;
		margin: 1rem 1rem;
		
	}
	.panel-1 {
		height: 13rem;
	}
	.panel {
		padding: 0 1rem;
		background: #fff;
	}
	.no-border{border:none;}
</style>

<style>
    .flex-items {
        display: flex;
    }

        .flex-items .flex-item {
            flex: 1;
        }

    .todayboxs {
        margin: 24px 0;
    }

        .todayboxs .flex-item {
            background-color: #fff;
            width: 100%;
            height: 104px;
             padding: 10px;
            display: flex;
            align-items: center;
             margin-right: 10px;
            color: #333;
            box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.05);
        }

            .todayboxs .flex-item:last-child {
                margin-right: 0;
            }

        .todayboxs .icon {
            width: 56px;
            margin-right: 16px;
        }

        .todayboxs .num {
            font-size: 24px;
        }

        .todayboxs .title {
            color: #747474;
        }

    .row-panel {
        margin-bottom: 24px;
        display: flex;
    }

        .row-panel .row-panel-7 {
            width: 50%;
            flex-shrink: 1;
        }

        .row-panel .row-panel-5 {
            width: 50%;
            margin-left: 24px;
            flex-shrink: 0;
        }

    .mypanel {
        position: relative;
        background-color: #fff;
        padding: 0 20px;
        box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.05);
    }

        .mypanel .mypanel-heading {
            font-size: 15px;
            font-weight: 600;
            border-bottom: 1px solid #f0f0f0;
            height: 48px;
            line-height: 48px;
        }

    .tasks .flex-item {
        height: 75px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-right: 20px;
        border-bottom: 1px solid #f0f0f0;
        color: #747474;
    }

        .tasks .flex-item:last-child {
            margin-right: 0;
        }

    .tasks .num {
        font-size: 15px;
        color: #9e9e9e;
        font-weight: 600;
    }

        .tasks .num.hasnum {
            color: #436be6;
        }

    .chat-box {
        width: 100%;
        height: 192px;
    }

    .tasks-panel .tasks:last-child .flex-item {
        border-bottom: none;
    }

    .quick-panel .mypanel-body, .total-panel .mypanel-body {
        padding: 20px 0;
    }

    .quick-nav .flex-item, .total-mes .flex-item {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        height: 68px;
        margin-bottom: 20px;
        margin-right: 20px;
        color: #747474;
    }

    .total-mes .flex-item {
        margin-bottom: 20px;
        height: 68px;
    }

        .quick-nav .flex-item:last-child, .total-mes .flex-item:last-child {
            margin-right: 0;
        }

    .total-mes .num {
        height: 48px;
        line-height: 48px;
        font-size: 15px;
        color: #333;
        font-weight: 600;
    }

    .quick-nav .flex-item:hover {
        color: #436be6;
    }

    .quick-nav .iconfont {
        height: 48px;
        line-height: 48px;
        font-size: 24px;
        display: block;
        transition: all 0.3s;
    }

    .quick-nav .flex-item:hover i {
        font-size: 48px;
    }
</style>
</head>
<body layadmin-themealias="default">
  <div class="layui-row">
	<div class="layui-row layui-col-space15">
		<div class="flex-items todayboxs">
				<?php if (!defined('ROLE') || ROLE != 'agenter' ) {?>
				<?php if(D('Seller/Menu')->check_seller_perm('user/index')){ ?>
				<a class="flex-item" href="<?php echo U('user/index'); ?>">
					<img class="icon" src="/static/images/Block-1.png">
					<div class="text">
						<div class="num today_member_count"></div>
						<div class="title">今日新增会员</div>
					</div>
				</a>
				<?php } ?>
				<?php } ?>
				
				<?php if(D('Seller/Menu')->check_seller_perm('order/index')){ ?>
				<a class="flex-item" href="<?php echo U('order/index'); ?>">
					<img class="icon" src="/static/images/Block-3.png">
					<div class="text">
					<div class="num today_pay_order_count"></div>
					<div class="title">今日付款订单</div>
					</div>
				</a>
				<?php } ?>
				
				<?php if(D('Seller/Menu')->check_seller_perm('order/index')){ ?>
				<a class="flex-item" href="<?php echo U('order/index'); ?>"> 
					<img class="icon" src="/static/images/Block-2.png">
					<div class="text">
					<div class="num today_pay_money"></div>
					<div class="title">今日付款金额</div>
					</div>
				</a>
				<?php } ?>
				
				
				<?php if (!defined('ROLE') || ROLE != 'agenter' ) {?>
				<a class="flex-item" href="<?php echo U('communityhead/distribulist'); ?>"> 
					<img class="icon" src="/static/images/Block-6.png">
					<div class="text">
						<div class="num total_tixian_money"></div>
						<div class="title">团长提现中金额</div>
					</div>
				</a>
				  
				<a class="flex-item" href="<?php echo U('communityhead/distribulist'); ?>"> 
					<img class="icon" src="/static/images/Block-7.png">
					<div class="text">
						<div class="num total_commiss_money"></div>
						<div class="title">团长总佣金</div>
					</div>
				</a>
				<?php } ?>
				
				<a class="flex-item" href="<?php echo U('order/index'); ?>"> 
					<img class="icon" src="/static/images/Block-5.png">
					<div class="text">
						<div class="num total_order_money"></div>
						<div class="title">订单金额</div>
					</div>
				</a>
				
		</div> 
		
		<div class="row-panel">
			<div class="row-panel-7">
				<div class="mypanel tasks-panel">
					<div class="mypanel-heading">待处理事务</div>
					<div class="mypanel-body">
						<div class="flex-items tasks">
							<?php if (!defined('ROLE') || ROLE != 'agenter' ) {?>
							<?php if(D('Seller/Menu')->check_seller_perm('goods/index')){ ?>
							<div class="flex-item">
								<div>商品库存报警</div>
								<a class="num hasnum goods_stock_notice_count" href="<?php echo U('goods/index', array('type' => 'stock_notice')); ?>"></a>
							</div>
							<?php } ?>
							<?php } ?>
							
							<?php if(D('Seller/Menu')->check_seller_perm('order/index')){ ?>
							<div class="flex-item"> 
								<div>待付款订单</div>
								<a class="num wait_pay_order_count" href="<?php echo U('order/index', array('order_status_id' => 3)); ?>"></a>
							</div>
							<?php } ?>
							
							<?php if(D('Seller/Menu')->check_seller_perm('order/index')){ ?>
							<div class="flex-item">
								<div>备货中订单</div>
								<a class="num hasnum wait_order_count" href="<?php echo U('order/index', array('order_status_id' => 1)); ?>"></a>
							</div>
							<?php } ?>
						</div>
						<?php if (!defined('ROLE') || ROLE != 'agenter' ) {?>
						
							<div class="flex-items tasks">
								<?php if(D('Seller/Menu')->check_seller_perm('order/index')){ ?>
								<div class="flex-item">
									<div>待处理退款</div>
									<a class="num hasnum after_sale_order_count" href="<?php echo U('order/orderaftersales'); ?>"></a>
								</div> 
								<?php } ?>
								<?php if(D('Seller/Menu')->check_seller_perm('order/index')){ ?>
								<div class="flex-item">
									<div>待评价订单</div>
									<a class="num wai_comment_order_count" href="<?php echo U('order/index', array('order_status_id' => 6)); ?>"></a>
								</div>
								<?php } ?>
								<?php if(D('Seller/Menu')->check_seller_perm('order/index')){ ?>
								<div class="flex-item">
									<div>待审核评价</div>
									<a class="num hasnum wait_shen_order_comment_count" href="<?php echo U('order/ordercomment'); ?>"></a>
								</div>
								<?php } ?>
							</div>
							<div class="flex-items tasks">
								<?php if(D('Seller/Menu')->check_seller_perm('goods/index')){ ?>
								<div class="flex-item">
									<div>仓库中商品</div>
									<a class="num hasnum stock_goods_count" href="<?php echo U('goods/index', array('type' => 'warehouse')); ?>"></a>
								</div> 
								<?php } ?>
								<?php if(D('Seller/Menu')->check_seller_perm('order/index')){ ?>
								<div class="flex-item">
									<div>待处理退货</div> 
									<a class="num after_sale_order_count" href="<?php echo U('order/orderaftersales'); ?>"></a>
								</div>
								<?php } ?>
								<?php if(D('Seller/Menu')->check_seller_perm('communityhead/index')){ ?>
								<div class="flex-item">
									<div>团长提现</div>
									<a class="num tixian_count" href="<?php echo U('communityhead/distribulist'); ?>">0</a>
								</div>
								<?php } ?>
							</div>
						<?php  }else{ ?>
							<div class="flex-items tasks">
								<div class="flex-item">
									<div>待处理退款</div>
									<a class="num hasnum after_sale_order_count" href="<?php echo U('order/orderaftersales'); ?>"></a>
								</div> 
								
								<div class="flex-item">
									<div>待处理退货</div> 
									<a class="num after_sale_order_count" href="<?php echo U('order/orderaftersales'); ?>"></a>
								</div>
								
							</div>
						<?php } ?>
						
					</div>
				</div>
			</div>
			<div class="row-panel-5">
				<div class="mypanel">
					<div class="mypanel-heading">交易统计</div>
					<div class="mypanel-body">
						<div class="ibox-loading" id="echarts-line-chart-loading"></div>
						<div class="chat-box" id="main"  style="-webkit-tap-highlight-color: transparent; user-select: none; position: relative;height: 225px;">
							<div class="layui-carousel layadmin-carousel layadmin-dataview" data-anim="fade" lay-filter="LAY-index-normline">
							  <div carousel-item id="LAY-index-normline">
								<div><i class="layui-icon layui-icon-loading1 layadmin-loading"></i></div>
							  </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row-panel">
        <div class="row-panel-7">
            <div class="mypanel total-panel">
                <div class="mypanel-heading">商城信息统计</div>
                <div class="mypanel-body">
					<?php if (!defined('ROLE') || ROLE != 'agenter' ) {?>
					<div class="flex-items total-mes">
                        <div class="flex-item">
                            <div class="num member_count"></div>
                            <div>会员总数</div>
                        </div>
                        <div class="flex-item">
                            <div class="num goods_count"></div>
                            <div>商品总数</div>
                        </div>
                        <div class="flex-item">
                            <div class="num community_head_count"></div>
                            <div>团长总数</div>
                        </div>
                    </div>
                    <div class="flex-items total-mes">
                        <div class="flex-item">
                            <div class="num seven_order_count"></div>
                            <div>近七天订单数</div>
                        </div>
                        <div class="flex-item">
                            <div class="num seven_pay_money"></div>
                            <div>近7天销售额（元）</div>
                        </div>
                        <div class="flex-item">
                            <div class="num seven_refund_money"></div>
                            <div>近7天退款金额（元）</div>
                        </div>
                    </div>
					<?php  }else{ ?>
					<div class="flex-items total-mes">
                        <div class="flex-item">
                            <div class="num seven_order_count"></div>
                            <div>近七天订单数</div>
                        </div>
                        <div class="flex-item">
                            <div class="num seven_pay_money"></div>
                            <div>近7天销售额（元）</div>
                        </div>
						<div class="flex-item">
                            <div class="num seven_refund_money"></div>
                            <div>近7天退款金额（元）</div>
                        </div>
                        <div class="flex-item">
                            <div class="num goods_count"></div>
                            <div>商品总数</div>
                        </div>
                       
                    </div>
                   
					<?php } ?>
                    
                </div>
            </div>
        </div>
        <div class="row-panel-5">
            <div class="mypanel quick-panel">
                <div class="mypanel-heading">快捷入口</div>
                <div class="mypanel-body">
					
				
					<?php if (!defined('ROLE') || ROLE != 'agenter' ) {?>
					<div class="flex-items quick-nav">
						<?php if(D('Seller/Menu')->check_seller_perm('goods/index')){ ?>
                        <a href="<?php echo U('goods/addgoods'); ?>" class="flex-item">
                            <i class="iconfont icon-p"></i> 
                            <div>发布商品</div>
                        </a>
						<?php } ?>
						
						<?php if(D('Seller/Menu')->check_seller_perm('order/index')){ ?>
                        <a href="<?php echo U('order/index'); ?>" class="flex-item">
                            <i class="iconfont icon--clipboard"></i>
                            <div>订单列表</div>
                        </a>
						<?php } ?>
						
						<?php if(D('Seller/Menu')->check_seller_perm('user/index')){ ?>
                        <a href="<?php echo U('user/index'); ?>" class="flex-item">
                            <i class="iconfont icon--users"></i>
                            <div>会员管理</div> 
                        </a>
						<?php } ?>
						
						<?php if(D('Seller/Menu')->check_seller_perm('communityhead/index')){ ?>
                        <a href="<?php echo U('communityhead/index'); ?>" class="flex-item">
                            <i class="iconfont icon--tree"></i>
                            <div>团长管理</div>
                        </a>
						<?php } ?>
						
						<?php if(D('Seller/Menu')->check_seller_perm('supply/index')){ ?>
                        <a href="<?php echo U('supply/index'); ?>" class="flex-item">
                            <i class="iconfont icon--truck"></i> 
                            <div>供应商管理</div>
                        </a>
						<?php } ?>
                    </div>
                    <div class="flex-items quick-nav">
						<?php if(D('Seller/Menu')->check_seller_perm('communityhead/distribulist')){ ?>
                        <a href="<?php echo U('communityhead/distribulist'); ?>" class="flex-item">
                            <i class="iconfont icon-p5"></i>
                            <div>提现申请</div>
                        </a>
						<?php } ?>
						<?php if(D('Seller/Menu')->check_seller_perm('communityhead/distributionpostal')){ ?>
                        <a href="<?php echo U('communityhead/distributionpostal'); ?>" class="flex-item">
                            <i class="iconfont icon--coin-yen"></i>
                            <div>提现设置</div>
                        </a>
						<?php } ?>
						<?php if(D('Seller/Menu')->check_seller_perm('configindex/slider')){ ?>
                        <a href="<?php echo U('configindex/slider'); ?>" class="flex-item">
                            <i class="iconfont icon-p6"></i>
                            <div>幻灯片管理</div> 
                        </a>
						
						<?php } ?>
						<?php if(D('Seller/Menu')->check_seller_perm('order/orderaftersales')){ ?>
                        <a href="<?php echo U('order/orderaftersales'); ?>" class="flex-item">
                            <i class="iconfont icon--stats-bars1"></i>
                            <div>售后处理</div>
                        </a>
						<?php } ?>
						<?php if(D('Seller/Menu')->check_seller_perm('config/index')){ ?>
                        <a href="<?php echo U('config/index'); ?>" class="flex-item">
                            <i class="iconfont icon-p7"></i>
                            <div>站点设置</div>
                        </a>
						<?php } ?>
                    </div>
					<?php  }else{ ?>
					<div class="flex-items quick-nav">
                        <a href="<?php echo U('goods/addgoods'); ?>" class="flex-item">
                            <i class="iconfont icon-p"></i> 
                            <div>发布商品</div>
                        </a>
                        <a href="<?php echo U('order'); ?>" class="flex-item">
                            <i class="iconfont icon--clipboard"></i>
                            <div>订单列表</div>
                        </a>
                        <a href="<?php echo U('order/orderaftersales'); ?>" class="flex-item">
                            <i class="iconfont icon--stats-bars1"></i>
                            <div>售后处理</div>
                        </a>
                    </div>
					<?php } ?>
                    
                </div>
            </div>
        </div>
    </div>
		<?php if (!defined('ROLE') || ROLE != 'agenter' ) {?>
		<div class="row-panel">
			<div class="row-panel-7">
				<div class="mypanel total-panel">
					<div class="mypanel-heading">最近7天会员增长情况</div>
					<div class="mypanel-body">
						<div id="echat_member_incr" style="height:460px;"></div>
					</div>
				</div>
			</div>
			<div class="row-panel-5">
				<div class="mypanel total-panel">
					<div class="mypanel-heading">最近7天团长增长情况</div>
					<div class="mypanel-body">
						<div id="echat_head_incr" style="height:460px;"></div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row-panel">
			<div class="row-panel-7">
				<div class="mypanel total-panel">
					<div class="mypanel-heading">本月团长销售排行</div>
					<div class="mypanel-body">
						<div id="echat_month_head_sales" style="height:460px;"></div>
					</div>
				</div>
			</div>
			<div class="row-panel-5">
				<div class="mypanel total-panel">
					<div class="mypanel-heading">上月团长销售排行</div>
					<div class="mypanel-body">
						<div id="echat_lastmonth_head_sales" style="height:460px;"></div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row-panel">
			<div class="row-panel-7">
				<div class="mypanel total-panel">
					<div class="mypanel-heading">本月商品销售排行</div>
					<div class="mypanel-body">
						<div id="echat_month_goods_sales" style="height:460px;"></div>
					</div>
				</div>
			</div>
			<div class="row-panel-5">
				<div class="mypanel total-panel">
					<div class="mypanel-heading">上月商品销售排行</div>
					<div class="mypanel-body">
						<div id="echat_lastmonth_goods_sales" style="height:460px;"></div>
					</div>
				</div>
			</div>
		</div>
	
		<?php } ?>
	</div>
  </div>

<script src="/layuiadmin/layui/layui.js"></script>
<script src="/layuiadmin/lib/extend/echarts.min.js"></script>

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


var  cur_type = 'normal';

layui.use(['jquery', 'layer'], function(){ 
  $ = layui.$;
  load_data();
  //后面就跟你平时使用jQuery一样
  loadEchartsLine();
  
   
  load_echat_member_incr();
  load_echat_head_incr();
  load_echat_month_head_sales();
  load_echat_lastmonth_head_sales();
  load_echat_month_goods_sales();
  load_echat_lastmonth_goods_sales();
  
});

function load_echat_member_incr()
{
	var hasLineChart = $("#echat_member_incr").length>0;
	if(hasLineChart){
		var lineChart = echarts.init(document.getElementById("echat_member_incr"));
	}
	window.onresize = function () {
		if(hasLineChart) {
			lineChart.resize();
		}
	};
	
	$.ajax({
		type: "GET",
		url: "<?php echo U('statistics/load_echat_member_incr');?>",
		dataType: "json",
		success: function (data) {
			if(data.code == 0)
			{
			
			//echo json_encode( array('code' => 0, 'date_arr' => $date_arr, 'member_count' => $member_count_arr ) );
		//die();
		
		
				var option = null;
				option = {
					color: ['#009688'],
					tooltip : {
						trigger: 'axis',
						axisPointer : {            // 坐标轴指示器，坐标轴触发有效
							type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
						}
					},
					grid: {
						left: '3%',
						right: '4%',
						bottom: '3%',
						containLabel: true
					},
					xAxis : [
						{
							type : 'category',
							data : data.date_arr,
							axisTick: {
								alignWithLabel: true
							}
						}
					],
					yAxis : [
						{
							type : 'value'
						}
					],
					series : [
						{
							name:'会员增长',
							type:'bar',
							label: {
								normal: {
									show: true,
									position: 'top'
								}
							},
							barWidth: '60%',
							itemStyle: {
								normal: {
									
									// 定制显示（按顺序）
									color: function(params) { 
										var colorList = ['#58b4ff','#f6bf00','#f3550e','#51c284','#7ebbd8', '#dbdd7c','#ee9992']; 
										return colorList[params.dataIndex] 
									}
								},
							},
							data:data.member_count
						}
					]
				};

				
				if (option && typeof option === "object") {
					lineChart.setOption(option, true);
				}
			}
		}
	})
	
	
}

function load_echat_head_incr()
{
	var hasLineChart = $("#echat_head_incr").length>0;
	if(hasLineChart){
		var lineChart = echarts.init(document.getElementById("echat_head_incr"));
	}
	window.onresize = function () {
		if(hasLineChart) {
			lineChart.resize();
		}
	};
	
	$.ajax({
		type: "GET",
		url: "<?php echo U('statistics/load_echat_head_incr');?>",
		dataType: "json",
		success: function (data) {
			if(data.code == 0)
			{
			
			//echo json_encode( array('code' => 0, 'date_arr' => $date_arr, 'member_count' => $member_count_arr ) );
		//die();
		
		
				var option = null;
				option = {
					color: ['#009688'],
					tooltip : {
						trigger: 'axis',
						axisPointer : {            // 坐标轴指示器，坐标轴触发有效
							type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
						}
					},
					grid: {
						left: '3%',
						right: '4%',
						bottom: '3%',
						containLabel: true
					},
					xAxis : [
						{
							type : 'category',
							data : data.date_arr,
							axisTick: {
								alignWithLabel: true
							}
						}
					],
					yAxis : [
						{
							type : 'value'
						}
					],
					series : [
						{
							name:'团长增长',
							type:'bar',
							label: {
								normal: {
									show: true,
									position: 'top'
								}
							},
							barWidth: '60%',
							itemStyle: {
								normal: {
									
									// 定制显示（按顺序）
									color: function(params) { 
										var colorList = ['#58b4ff','#f6bf00','#f3550e','#51c284','#7ebbd8', '#dbdd7c','#ee9992']; 
										return colorList[params.dataIndex] 
									}
								},
							},
							data:data.member_count
						}
					]
				};

				
				if (option && typeof option === "object") {
					lineChart.setOption(option, true);
				}
			}
		}
	})
}

function load_echat_month_head_sales()
{
	var hasLineChart = $("#echat_month_head_sales").length>0;
	if(hasLineChart){
		var lineChart = echarts.init(document.getElementById("echat_month_head_sales"));
	}
	window.onresize = function () {
		if(hasLineChart) {
			lineChart.resize();
		}
	};
	
	$.ajax({
		type: "GET",
		url: "<?php echo U('statistics/load_echat_month_head_sales', array('type' => 1));?>",
		dataType: "json",
		success: function (data) {
			if(data.code == 0)
			{
				
				var le_arr = [];
				var data_obj_arr  = [];
				
				for( var i in data.list )
				{
					le_arr.push(  data.list[i].head_name  );
					data_obj_arr.push({value:data.list[i].total, name:data.list[i].head_name });
				}
				
				
				
				
				var option = null;
				option = {
					title : {
						text: '销售金额'+data.total,
						subtext: data.month,
						x:'center'
					},
					tooltip : {
						trigger: 'item',
						formatter: "{a} <br/>{b} : {c} ({d}%)"
					},
					legend: {
						orient: 'vertical',
						left: 'left',
						data: le_arr
					},
					series : [
						{
							name: '销售金额',
							type: 'pie',
							radius : '55%',
							center: ['50%', '60%'],
							data:data_obj_arr,
							itemStyle: {
								emphasis: {
									shadowBlur: 10,
									shadowOffsetX: 0,
									shadowColor: 'rgba(0, 0, 0, 0.5)'
								}
							}
						}
					]
				};

				
				if (option && typeof option === "object") {
					lineChart.setOption(option, true);
				}
			}
		}
	})
	
	
}



function load_echat_month_goods_sales()
{
	var hasLineChart = $("#echat_month_goods_sales").length>0;
	if(hasLineChart){
		var lineChart = echarts.init(document.getElementById("echat_month_goods_sales"));
	}
	window.onresize = function () {
		if(hasLineChart) {
			lineChart.resize();
		}
	};
	
	$.ajax({
		type: "GET",
		url: "<?php echo U('statistics/load_echat_month_goods_sales', array('type' => 1));?>",
		dataType: "json",
		success: function (data) {
			if(data.code == 0)
			{
				
				var le_arr = [];
				var data_obj_arr  = [];
				
				for( var i in data.list )
				{
					le_arr.push(  data.list[i].name  );
					data_obj_arr.push({value:data.list[i].total, name:data.list[i].name });
				}
				
				
				
				
				var option = null;
				option = {
					title : {
						text: '销售金额'+data.total,
						subtext: '销售总数：'+data.total_quantity+' ('+data.month+')',
						x:'center'
					},
					tooltip : {
						trigger: 'item',
						formatter: "{a} <br/>{b} : {c} ({d}%)"
					},
					legend: {
						orient: 'vertical',
						left: 'left',
						data: le_arr
					},
					series : [
						{
							name: '销售金额',
							type: 'pie',
							radius : '55%',
							center: ['50%', '60%'],
							data:data_obj_arr,
							itemStyle: {
								emphasis: {
									shadowBlur: 10,
									shadowOffsetX: 0,
									shadowColor: 'rgba(0, 0, 0, 0.5)'
								}
							}
						}
					]
				};

				
				if (option && typeof option === "object") {
					lineChart.setOption(option, true);
				}
			}
		}
	})
	
	
}

function load_echat_lastmonth_goods_sales()
{
	var hasLineChart = $("#echat_lastmonth_goods_sales").length>0;
	if(hasLineChart){
		var lineChart = echarts.init(document.getElementById("echat_lastmonth_goods_sales"));
	}
	window.onresize = function () {
		if(hasLineChart) {
			lineChart.resize();
		}
	};
	
	$.ajax({
		type: "GET",
		url: "<?php echo U('statistics/load_echat_month_goods_sales', array('type' => 2));?>",
		dataType: "json",
		success: function (data) {
			if(data.code == 0)
			{
				
				var le_arr = [];
				var data_obj_arr  = [];
				
				for( var i in data.list )
				{
					le_arr.push(  data.list[i].name  );
					data_obj_arr.push({value:data.list[i].total, name:data.list[i].name });
				}
				
				
				
				
				var option = null;
				option = {
					title : {
						text: '销售金额'+data.total,
						subtext: '销售总数：'+data.total_quantity+'  ('+data.month+')',
						x:'center'
					},
					tooltip : {
						trigger: 'item',
						formatter: "{a} <br/>{b} : {c} ({d}%)"
					},
					legend: {
						orient: 'vertical',
						left: 'left',
						data: le_arr
					},
					series : [
						{
							name: '销售金额',
							type: 'pie',
							radius : '55%',
							center: ['50%', '60%'],
							data:data_obj_arr,
							itemStyle: {
								emphasis: {
									shadowBlur: 10,
									shadowOffsetX: 0,
									shadowColor: 'rgba(0, 0, 0, 0.5)'
								}
							}
						}
					]
				};

				
				if (option && typeof option === "object") {
					lineChart.setOption(option, true);
				}
			}
		}
	})
}


function load_echat_lastmonth_head_sales()
{
	var hasLineChart = $("#echat_lastmonth_head_sales").length>0;
	if(hasLineChart){
		var lineChart = echarts.init(document.getElementById("echat_lastmonth_head_sales"));
	}
	window.onresize = function () {
		if(hasLineChart) {
			lineChart.resize();
		}
	};
	
	$.ajax({
		type: "GET",
		url: "<?php echo U('statistics/load_echat_month_head_sales', array('type' => 2));?>",
		dataType: "json",
		success: function (data) {
			if(data.code == 0)
			{
				
				var le_arr = [];
				var data_obj_arr  = [];
				
				for( var i in data.list )
				{
					le_arr.push(  data.list[i].head_name  );
					data_obj_arr.push({value:data.list[i].total, name:data.list[i].head_name });
				}
				
				
				
				
				var option = null;
				option = {
					title : {
						text: '销售金额'+data.total,
						subtext: data.month,
						x:'center'
					},
					tooltip : {
						trigger: 'item',
						formatter: "{a} <br/>{b} : {c} ({d}%)"
					},
					legend: {
						orient: 'vertical',
						left: 'left',
						data: le_arr
					},
					series : [
						{
							name: '销售金额',
							type: 'pie',
							radius : '55%',
							center: ['50%', '60%'],
							data:data_obj_arr,
							itemStyle: {
								emphasis: {
									shadowBlur: 10,
									shadowOffsetX: 0,
									shadowColor: 'rgba(0, 0, 0, 0.5)'
								}
							}
						}
					]
				};

				
				if (option && typeof option === "object") {
					lineChart.setOption(option, true);
				}
			}
		}
	})
}


function loadEchartsLine()
{
	var hasLineChart = $("#main").length>0;
	if(hasLineChart){
		var lineChart = echarts.init(document.getElementById("main"));
	}
	window.onresize = function () {
		if(hasLineChart) {
			lineChart.resize();
		}
	};
		
	$.ajax({
	    type: "GET",
	    url: "<?php echo U('statistics/load_goods_chart'); ?>",
		data:{type:cur_type},
	    dataType: "json",
	    success: function (json) {
	        var option = {
	        	    title: {
	        	        text: ''
	        	    },
	        	    tooltip: {
	        	        trigger: 'axis',
	        	        formatter: function (a) {
	        	            var str = '';
	        	            a.forEach(function (item) {
	        	                str += item.seriesName + ':' + item.value + (item.seriesIndex > 2 ? '%' : '') + '<br/>';
	        	            });
	        	            return str;
	        	        }
	        	    },
	        	    legend: {
	        	        data: []
	        	    },
	        	    grid: {
	        	        left: 50,
	        	        right: 20,
	        	        top: 40,
	        	        bottom: 10,
	        	        containLabel: true
	        	    },

	        	    xAxis: {
	        	        type: 'category',
	        	        axisLabel: {
	        	            rotate: 30
	        	        },
	        	        boundaryGap: false,
	        	        data: []
	        	    },
	        	    yAxis: [
	        	        {
	        	            type: 'value',
	        	            name: '金额',
	        	        }
	        	    ],
	        	    series: [
	        	        {
	        	            areaStyle: { normal: {} },
	        	        },
	        	    ]
	        	};
			if(hasLineChart) {
				
				//var json = {"success":true,"data":{"date":"0001-01-01 00:00:00","visits":3080,"orderUsers":24,"orderCount":52,"orderProducts":69,"orderAmount":14986.83,"payUsers":16,"payOrders":25,"payProducts":36,"payAmount":4380.31,"refundProducts":4,"refundOrderCounts":8,"refundAmount":1899.04,"refundRate":32.00,"preOrderRate":175.21,"preProductRate":121.68,"jointRate":1.44,"orderRate":1.69,"payRate":48.08,"tradeRate":0.81,"payAmountRank":1,"brokerageAmount":0.00,"lines":{"payAmountLine":{"xAxisData":["12-01","12-02","12-03","12-04","12-05","12-06","12-07","12-08"],"seriesData":[{"data":[0.00,3196.00,0.20,162.14,379.01,642.96,0.00,0.0]}]},"payUserLine":{"xAxisData":["12-01","12-02","12-03","12-04","12-05","12-06","12-07","12-08"],"seriesData":[{"data":[0,1,2,2,6,5,0,0]}]},"payProductLine":{"xAxisData":["12-01","12-02","12-03","12-04","12-05","12-06","12-07","12-08"],"seriesData":[{"data":[0,3,2,13,10,8,0,0]}]},"orderRateLine":{"xAxisData":["12-01","12-02","12-03","12-04","12-05","12-06","12-07","12-08"],"seriesData":[{"data":[0.0,4.00,1.22,1.53,2.74,1.52,1.00,0.0]}]},"payRateLine":{"xAxisData":["12-01","12-02","12-03","12-04","12-05","12-06","12-07","12-08"],"seriesData":[{"data":[0.0,75.00,33.33,77.78,35.00,50.0,0.0,0.0]}]},"tradeRateLine":{"xAxisData":["12-01","12-02","12-03","12-04","12-05","12-06","12-07","12-08"],"seriesData":[{"data":[0.0,3.00,0.41,1.19,0.96,0.76,0.0,0.0]}]}}}};
				var lines = json.data.lines;
				
		        option.xAxis.data = lines.payAmountLine.xAxisData;
		        option.series = [];
		        option.series.push(buildLine("付款金额", lines.payAmountLine, 0));
				option.series.push(buildLine2("退款金额", lines.payAmountLine, 0));
		        
		        lineChart.setOption(option);
				lineChart.resize(); 
			}
			$("#echarts-line-chart-loading").hide();
			$("#main").show();	
		}
	})
}

function buildLine2(name, data, yIndex) {
    return {
        name: name,
        type: "line",
        areaStyle: { normal: {} },
        smooth: true,
        data: data.seriesData[1].data,
        yAxisIndex: yIndex
    };
}


function buildLine(name, data, yIndex) {
    return {
        name: name,
        type: "line",
        areaStyle: { normal: {} },
        smooth: true,
        data: data.seriesData[0].data,
        yAxisIndex: yIndex
    };
}

function load_goods_paihang()
{
	var s_index = $('#sale li.active').index();
	
	$.ajax({
		type: "GET",
		url: "<?php echo U('statistics/load_goods_paihang'); ?>",
		data:{type:cur_type,s_index:s_index},
		dataType: "json",
		success: function (data) {
			$('#sale_div .ibox-loading').hide();
			if(data.code ==0 )
			{
				$('#goods_rank_0 tbody').html( data.html );
			}
		}
	})
}

function load_order_buy_data()
{
	var s_index = $('#orderinfo li.active').index();
	
	$.ajax({
		type: "GET",
		url: "<?php echo U('statistics/order_buy_data'); ?>",
		data:{type:cur_type,s_index:s_index},
		dataType: "json",
		success: function (data) {
			$('#order_info_div .ibox-loading').hide();
			if(data.code ==0 )
			{
				$('.order_count_0').html( data.data.count );
				$('.order_price_0').html( data.data.total );
				$('.order_avg_0').html( data.data.per_money );
			}
		}
	})
}
function load_data()
{
	cur_type = $('#select_type').val();

	$.ajax({
		type: "GET",
		url: "<?php echo U('statistics/index_data'); ?>",
		data:{type:cur_type},
		dataType: "json",
		success: function (data) {
			
			if(data.code ==0 )
			{
				
				$('.today_member_count').html( data.data.today_member_count );
				$('.today_pay_order_count').html( data.data.today_pay_order_count );
				$('.today_pay_money').html( '<em>￥</em>'+data.data.today_pay_money );
				
				$('.total_tixian_money').html( '<em>￥</em>'+data.data.total_tixian_money );
				$('.total_commiss_money').html( '<em>￥</em>'+data.data.total_commiss_money );
				$('.total_order_money').html( '<em>￥</em>'+data.data.total_order_money );
				
				
				$('.goods_stock_notice_count').html( data.data.goods_stock_notice_count );
				$('.wait_pay_order_count').html( data.data.wait_pay_order_count );
				$('.wait_order_count').html( data.data.wait_order_count );
				$('.after_sale_order_count').html( data.data.after_sale_order_count );
				$('.wai_comment_order_count').html( data.data.wai_comment_order_count );
				
				$('.wait_shen_order_comment_count').html( data.data.wait_shen_order_comment_count );
				$('.stock_goods_count').html( data.data.stock_goods_count );
				$('.seven_order_count').html( data.data.seven_order_count );
				$('.seven_pay_money').html(data.data.seven_pay_money);
				$('.seven_refund_money').html(data.data.seven_refund_money);
				
				$('.community_head_count').html(data.data.community_head_count);
				$('.seven_order_count').html(data.data.seven_order_count);
				
				
				$('.member_count').html( data.data.member_count );
				$('.goods_count').html( data.data.goods_count );
				$('.order_count').html( data.data.order_count );
				$('.tixian_count').html( data.data.apply_count );
				
				
				
				$('.goods_totals').html( data.data.goods_stock_notice_count );
			}
		}
	})
	load_order_buy_data();
	load_goods_paihang();
	
	
}
</script> 


</body>
</html>