<?php
/**
 * lionfish 商城系统
 *
 * ==========================================================================
 * @link      http://www.liofis.com/
 * @copyright Copyright (c) 2015 liofis.com. 
 * @license   http://www.liofis.com/license.html License
 * ==========================================================================
 *
 * @author    Lucas by 2019-12-19
 *
 */
namespace Seller\Model;
use Think\Model;

class GoodsdiscountmemberModel extends Model{
	
	protected $trueTableName = 'lionfish_comshop_goods_discount_member';
	
	public function get_goods_discount_member_info($id)
	{
		
//$data = 1;
		
		
			//更新
			$data = M('lionfish_comshop_goods_discount_member')->where( array('id' => $id) )->select();
			
			dump($data);exit;
		

			
	}

}
?>