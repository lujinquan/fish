<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>配送服务单</title>
    <link rel="stylesheet" href="/Common/css/forms.css">
  </head>
  <body>
    <table width ="792px"  border="1"  cellpadding="0">
      <th colspan="6"><?php echo ($shop_name); ?>--配送服务单</th>
      <tr class="b">
        <td colspan="3">订单编号：<?php echo ($order_info["order_num_alias"]); ?></td>
        <td colspan="2">交易单号：<?php echo ($order_info["transaction_id"]); ?></td>
        <td colspan="1">付款方式：<?php if($order_info['payment_code'] == ''){ ?>未付款<?php } if($order_info['payment_code'] == 'yuer'){ ?>余额支付 <?php } if($order_info['payment_code'] == 'admin'){ ?>后台付款 <?php } if($order_info['payment_code'] == 'weixin'){ ?>微信支付 <?php } ?></td>
      </tr>
      <tr class="b">
        <td colspan="3"><?php if($order_info['delivery'] == 'tuanz_send'){ ?>送货地址：<?php echo ($order_info['tuan_send_address']); } ?>
		<?php if($order_info['delivery'] == 'pickup'){ ?>取货地址：<?php echo ($order_info['shipping_address']); } ?>
		<?php if($order_info['delivery'] == 'express'){ ?>收货人：<?php echo ($province_info['name']); echo ($city_info['name']); echo ($area_info['name']); echo ($order_info['shipping_address']); ?>, <?php echo ($order_info['shipping_name']); ?>, <?php echo ($order_info['shipping_tel']); ?> <?php } ?>
		</td>
        <td colspan="2">买家：<?php echo ($member['username']); ?></td>
        <td colspan="1">收货人：<?php echo ($order_info['shipping_name']); ?> </td>
      </tr>
      <tr  class="b">
        <td colspan="3">订单备注：<?php echo ($order_info['comment']); ?></td>
        <td colspan="2">联系电话：<?php echo ($order_info['shipping_tel']); ?> </td>
        <td colspan="1"></td>
      </tr>
      <tr class="a">
        <td class="td1">序号</td>
        <td class="td2">商品名称</td>
        <td class="td3">数量</td>
        <td class="td4">规格</td>
        <td class="td5">单价</td>
        <td class="td6">总价</td>
      </tr>
	  <?php $i =0; $total_quantity =0;$total_money =0; ?>
	  <?php foreach($need_order_goods as $goods){ ?>
      <tr class="a">
        <td class="num"><?php echo $i; ?></td>
        <td><?php echo ($goods['name']); ?></td>
		 <td><?php echo ($goods['quantity']); ?></td>
        <td><?php echo ($goods['option_sku']); ?></td>
        <td><?php echo sprintf("%.2f",$goods['price']);?></td>
        <td><?php echo sprintf("%.2f",$goods['total']);?></td>
      </tr>
	  <?php $i++; $total_quantity += $goods['quantity'];$total_money+=$goods['total']; } ?>
	  <tr class="a">
        <td class="num" colspan="2">合计</td>
        <td bgcolor="yellow"><?php echo $total_quantity; ?></td>
        <td></td>
        <td></td>
        <td bgcolor="yellow"><?php echo sprintf("%.2f",$total_money); ?></td>
      </tr>
      <tr>
        <td colspan="2">配货人签字：</td>
        <td colspan="2">送货人签字：</td>
        <td colspan="2">收货人签字：</td>
      </tr>
        <tr>
          <table width ="792px" border="1"  cellpadding="0" rules="rows">
            <td>第一联仓库存根</td>
            <td>第二联收货人存根</td>
            <td>第三联财务存根</td>
            <td>第四联物流存根</td>
          </table>
        </tr>
    </table>
  </body>
</html>