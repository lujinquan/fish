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
 * @author    fish
 * 处理订单相关内容
 */
namespace Home\Controller;

class ApiuserController extends CommonController {
    protected function _initialize()
    {
    	parent::_initialize();
        $this->cur_page = 'apicheckout';
		$this->member_id = 1;
    }
	
	public function get_user_info()
	{
		$token = I('get.token');
		
		
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		$member_info =  M('member')->field('name,avatar,score,member_id,comsiss_flag,level_id,account_money')->where( array('member_id' => $member_id) )->find();
		$opencommiss = C('opencommiss');
		$is_open_integral = C('is_open_integral');				$level_name = C('member_default_levelname');		$member_info['level'] = 0;		
		if(!empty($member_info['level_id']) && $member_info['level_id'] > 0)		{		 	$level_info = M('member_level')->where( array('id' => $member_info['level_id']) )->find();			if( !empty($level_info) )			{				$level_name = $level_info['levelname'];			}			//level			$member_info['level'] = $level_info['level'];		}		$config_name = M('config')->where( array('name' => 'is_yue_open') )->find();		$member_level_is_open_arr = M('config')->where( array('name' => 'member_level_is_open') )->find();				$member_level_list = array();				if( $member_level_is_open_arr['value'] == 1)		{			$member_level_list =  M('member_level')->order('id asc')->select();			if( !empty($member_level_list) )			{				foreach( $member_level_list as $key => $val )				{					$val['discount'] = $val['discount'] / 10;					$member_level_list[$key] = $val;				}			}		}				
		echo json_encode( array('code' => 0,'member_level_list' => $member_level_list,'level_name' => $level_name,'member_level_is_open' => $member_level_is_open_arr['value'],'is_yue_open' => $config_name['value'], 'opencommiss' => $opencommiss,'data' =>$member_info ,'is_open_integral' => $is_open_integral) );		die();
	}	public function myask_detail()	{		$id = I('get.id');				$blog_info = M('blog')->where( array('blog_id' => $id) )->find();		$blog_content = M('blog_content')->where( array('blog_id' => $id) )->find();				$info = array();		$info['title'] = $blog_info['title'];		$info['update_time'] = $blog_info['update_time'];		$info['image'] = C('SITE_URL').'/Uploads/image/'. $blog_info['image'];				$qian = array(            "/Uploads/image"        );		$hou = array(            C('SITE_URL') . "/Uploads/image"        );		        $blog_content['content'] = str_replace($qian, $hou, $blog_content['content']);				$info['summary'] = $blog_content['summary'];		$info['content'] = htmlspecialchars_decode($blog_content['content']);				echo json_encode( array('code' => 0, 'info' => $info) );		die();	}		public function myask_list()    {        $type = I('get.type',1);        $page = I('get.page',1);        $pre_page = I('get.pre_page',15);        $offset = ($page -1) * $pre_page;        		        $condition = array('type' => 'question');                $list = M('blog')->where($condition)->order('blog_id desc')->limit($offset,$pre_page)->select();                $now_time = time();                foreach($list as $key => $val)        {			$val['create_time'] = date('Y.m.d H:i:s', $val['create_time']);            $list[$key] = $val;        }        $this->type = $type;        $this->list = $list;				if( empty($list) )		{			echo json_encode( array('code' =>1) );		}else {			echo json_encode( array('code' =>0, 'list' => $list) );		}    }		public function get_address_info()	{		$token = I('get.token');		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();	    $member_id = $weprogram_token['member_id'];				$id = I('get.id', 0);		$address_info = M('address')->where( array('address_id' => $id) )->find();				$province_info = M('area')->field('area_name')->where( array('area_id' => $address_info['province_id']) )->find();		$city_info = M('area')->field('area_name')->where( array('area_id' => $address_info['city_id']) )->find();		$country_info = M('area')->field('area_name')->where( array('area_id' => $address_info['country_id']) )->find();				$address_info['province_name'] = $province_info['area_name'];		$address_info['city_name'] = $city_info['area_name'];		$address_info['country_name'] = $country_info['area_name'];				echo json_encode( array('code' => 0 , 'info' =>$address_info) );		die();			}	public function set_default_address()	{		$token = I('get.token');		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();	    $member_id = $weprogram_token['member_id'];				$id = I('get.id', 0);				M('address')->where( array('member_id' => $member_id) )->save( array('is_default' => 0) );				M('address')->where( array('address_id' => $id) )->save( array('is_default' => 1) );				echo json_encode( array('code' => 0) );		die();			}	public function del_address()	{		$token = I('get.token');		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();	    $member_id = $weprogram_token['member_id'];				$id = I('get.id', 0);		M('address')->where( array('address_id' => $id) )->delete( );				echo json_encode( array('code' => 0) );		die();	}	public function getaddress()	{		$token = I('get.token');		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();	    $member_id = $weprogram_token['member_id'];			 		$address_list =  M('address')->where( array('member_id' => $member_id) )->order( "is_default desc , address_id desc " )->select();				foreach( $address_list as $key => $val )		{			//province_id  city_id country_id			$province_info =  M('area')->field('area_name')->where( array('area_id' => $val['province_id']) )->find();			$city_info =  M('area')->field('area_name')->where( array('area_id' => $val['city_id']) )->find();			$country_info =  M('area')->field('area_name')->where( array('area_id' => $val['country_id']) )->find();						$val['province_name'] = $province_info['area_name'];			$val['city_name'] = $city_info['area_name'];			$val['country_name'] = $country_info['area_name'];						$address_list[$key] = $val;		}				if( !empty($address_list) )		{			echo json_encode( array('code' => 0, 'list' => $address_list) );			die();		}else{			echo json_encode( array('code' => 1) );			die();		}			}	
	public function apply()
	{
		//token
		$token = I('get.token');
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		
		$result = array('code' => 0);
		$member_commiss_apply = M('member_commiss_apply')->where(array('member_id' =>$member_id, 'state' =>0))->find();
		
		if(!empty($member_commiss_apply)) {
			$result['code'] = 1;
			$result['msg'] = '您已经申请，等待审核!';
		} else {
			$data = array();
			$data['member_id'] = $member_id;
			$data['state'] = 0;
			$data['addtime'] = time();
			$res = M('member_commiss_apply')->add($data);
			if($res){
				
			} else {
				$result['code'] = 1;
				$result['msg'] = '提交失败';
			}
		}
		echo json_encode($result);
		die();
		
	}
	//member_formid
	public function get_member_form_id()
	{
		//token/' + token + '/from_id/' + from_id
		$token = I('get.token');
		$from_id = I('get.from_id');
		
		if($from_id != 'the formId is a mock one')
		{
			$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
			$member_id = $weprogram_token['member_id'];
			
			$member_formid_data = array();
			$member_formid_data['member_id'] = $member_id;
			$member_formid_data['state'] = 0;
			$member_formid_data['formid'] = $from_id;
			$member_formid_data['addtime'] = time();
			M('member_formid')->add($member_formid_data);
		}
		echo json_encode( array('code' => 1) );
		die();
	}
	
	public function get_user_addresslist()
	{
		$token = I('get.token');
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		$member_id = $weprogram_token['member_id'];
			
			//group ->group('user_id,test_time')
		$list=M('address')->where(array('member_id'=>$member_id))->group('province_id,country_id,city_id,address')->order('address_id desc ')->select();
		
		if(!empty($list)){		
			foreach ($list as $k => $v) {
				$list[$k]['id'] = $v['address_id'];
			}
		}
		
		if(!empty($list))
		{
			foreach($list as &$address)
			{
				$province_info = M('area')->where( array('area_id' => $address['province_id']) )->find();
				$city_info = M('area')->where( array('area_id' => $address['city_id']) )->find();
				$country_info = M('area')->where( array('area_id' => $address['country_id']) )->find();
				$address['province_name'] = $province_info['area_name'];
				$address['city_name'] = $city_info['area_name'];
				$address['country'] = $country_info['area_name'];
			}
		}
		
		if( !empty($list) )
		{
			echo json_encode( array('code' => 0 , 'data' => $list) );
			die();
		} else{
			echo json_encode( array('code' => 1) );
			die();
		}
	}
	
	public function group_orders()
	{
		$token = I('get.token');
		$type = I('get.type',0);
		$page = I('get.page',0);//当前第几页
		$pre_page = I('get.pre_page',10);//每页数量
		
		
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		
		$data_json = file_get_contents('php://input');		
		$data = json_decode($data_json, true);
		  
		
		
	    
	   
	    $offset = ($page -1) * $pre_page;
	     
	    $where = ' ';
	     
	    if($type == 1)
	    {
	        $where .= '  and p.state = 0 and p.end_time >'.time();
	    } else if($type == 2){
	        $where .= ' and p.state = 1 ';
	    } else if($type == 3){
			 
	        $where .= ' and (o.order_status_id != 5 && o.order_status_id != 3) and (p.state = 2 or  (p.state =0 and p.end_time <'.time().')) ';
	    }else if($type == 0){
			//$where .= ' and o.order_status_id != 3 ';
		}
	    
	    $sql = "select g.name,og.goods_images,g.price as orign_price,o.voucher_credit,g.fan_image,os.name as status_name,os.order_status_id,og.quantity,og.order_goods_id,p.need_count,p.state,p.is_lottery,p.lottery_state,p.end_time,o.delivery,o.lottery_win,o.total,o.shipping_fare,o.order_id,o.store_id,og.price,po.pin_id,o.order_status_id from ".C('DB_PREFIX')."order as o, ".C('DB_PREFIX')."order_goods as og, 
	        ".C('DB_PREFIX')."pin as p,".C('DB_PREFIX')."goods as g ,".C('DB_PREFIX')."order_status as os ,".C('DB_PREFIX')."pin_order as po   
	            where  po.order_id = o.order_id and o.order_status_id = os.order_status_id and  o.order_id = og.order_id and og.goods_id = g.goods_id and po.pin_id = p.pin_id 
	            and o.member_id = ".$member_id."  {$where} order by o.date_added desc limit {$offset},{$pre_page}";
	  
	    $list = M()->query($sql);
	    
		
	    foreach($list as $key => $val)
	    {
	        $val['price'] = round($val['price'],2);
			
			
			if($val['shipping_fare']<=0.001 || $val['delivery'] == 'pickup')
			{
				$val['shipping_fare'] = '免运费';
			}else{
				$val['shipping_fare'] = '运费:'.$val['shipping_fare'];
			}
			//delivery
			if($val['order_status_id'] == 10)
			{
				$val['status_name'] = '等待退款';
			}
			else if($val['order_status_id'] == 4 && $val['delivery'] =='pickup')
			{
				//delivery 6
				$val['status_name'] = '待自提';
				//已自提
			}
			else if($val['order_status_id'] == 6 && $val['delivery'] =='pickup')
			{
				//delivery 6
				$val['status_name'] = '已自提';
				
			}else if($val['order_status_id'] == 10)
			{
				$val['status_name'] = '等待退款';
			}else if($val['order_status_id'] == 1 && $val['type'] == 'lottery')
			{
				//等待开奖
				//一等奖
				if($val['lottery_win'] == 1)
				{
					$val['status_name'] = '一等奖';
				}else {
					$val['status_name'] = '等待开奖';
				}
			}
			
			//p.state,p.end_time
			$pin_type = $val['state'];
			
			if($pin_type == 0 && $val['end_time'] <= time() )
			{
				$pin_type = 2;
			}
			
			switch($pin_type)
			{
				case 0:
					if($val['order_status_id'] == 2)
					{
						$val['status_name']  = $val['status_name'];
					}else{
						$val['status_name']  = '拼团中，'.$val['status_name'];
					}
					
					break;
				case 1:
				//7
					if($val['order_status_id'] == 7)
					{
						$val['status_name']  = '拼团成功，售后已退款';
					}else if($val['order_status_id'] == 1)
					{
						$val['status_name']  = '拼团成功，待发货';
					}
					else{
						$val['status_name']  = '拼团成功，'.$val['status_name'];
					}
					
					break;
				case 2:
					$val['status_name']  = '拼团失败，'.$val['status_name'];
					//order_status_id 2
					if($val['order_status_id'] == 2)
					{
						$val['status_name']  = '拼团失败';
					}
					break;
			}
			
			
			$val['goods_images']= C('SITE_URL') .resize($val['goods_images'], C('common_image_thumb_width'), C('common_image_thumb_height'));
	            
				
			//s_true_name seller_id option_str
			$order_option_list = M('order_option')->where( array('order_goods_id' =>$val['order_goods_id']) )->select();
			foreach($order_option_list as $option)
			{
				$val['option_str'][] = $option['value'];
			}
			if( !isset($val['option_str']) )
			{
				$val['option_str'] = '';
			}else{
				$val['option_str'] = implode(',', $val['option_str']);
			}  
				
			$store_info = M('seller')->field('s_true_name,s_logo')->where('s_id='.$val['store_id'])->find();
				
			$store_info['s_logo'] = C('SITE_URL').'/Uploads/image/'.$store_info['s_logo'];
			
			$val['store_info'] = $store_info;
			
			unset($val['fan_image']);
			//unset($val['goods_images']);
			
			 $val['price'] = round($val['price'],2);
			 $val['total'] = round($val['total'],2);
			 
			 
			if($val['delivery'] == 'pickup')
			{
				$val['total'] = round($val['total'],2) - round($val['voucher_credit'],2);
			
			}else{
				$val['total'] = round($val['total'],2)+round($val['shipping_fare'],2) - round($val['voucher_credit'],2);
			
			}
	         $val['orign_price'] = round($val['orign_price'],2);
				
	        if($val['state'] == 0 && $val['end_time'] < time())
	        {
	            $val['state'] = 2;
	        }
	        $list[$key] = $val;
	    }
		
		$need_data = array();
		$need_data['code'] = 1;
		if( !empty($list) )
		{
			$need_data['code'] = 0;
			$need_data['data'] = $list;
		} 
		echo json_encode($need_data);
		die();
	}
	
	
	function fav_toggle()
	{
		$token = I('get.token');
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		if( empty($member_id) )
		{
			$result['code'] = 3;	
	        $result['msg'] = '登录失效';
	        echo json_encode($result);
	        die();
		}
		
		$goods_id = I('goods_id');
		
		$goods_model = D('Home/Goods');
		//1 取消收藏  2 添加收藏
         $code = $goods_model->user_fav_goods_toggle($goods_id, $member_id);
         echo json_encode( array('code' => $code) );
         die();
	}
	
	public function fav_storetoggle()
	{
		$token = I('get.token');
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		if( empty($member_id) )
		{
			$result['code'] = 3;	
	        $result['msg'] = '登录失效';
	        echo json_encode($result);
	        die();
		}
		
		 $store_id = I('store_id');
     
         $goods_model = D('Home/Goods');
       
         //1 取消收藏  2 添加收藏
         $code = $goods_model->user_fav_store_toggle($store_id, $member_id);
         echo json_encode( array('code' => $code) );
         die();
	}
	
	public function myfavshop()
	{
		$page = I('get.page',1);
        $pre_page = I('get.pre_page',6);
        $offset = ($page -1) * $pre_page;
		
		$token = I('get.token');
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		
		
		$list = M('user_favstore')->where( array('member_id' => $member_id) )->order('add_time desc')->limit($offset,$pre_page)->select();
        
        foreach($list as $key => $val)
        {
			$tp_store = M('seller')->field('s_true_name,s_logo')->where( array('s_id' => $val['store_id']) )->find();
			
			
				
			$tp_store['logo'] = C('SITE_URL').'Uploads/image/'. $tp_store['s_logo'];
			unset($tp_store['s_logo']);
			
			$store_goods =  M('goods')->field('goods_id,name,quantity,seller_count,virtual_count,image,price,danprice')->where( array('store_id' => $val['store_id'],'status'=>1,'quantity' =>array('gt',0)) )->order('is_index_show desc, seller_count desc')->limit(3)->select();
			
			foreach($store_goods as $kk => $vv)
			{
				$vv['image'] = C('SITE_URL').'Uploads/image/'. $vv['image'];
				$vv['seller_count'] = $vv['seller_count'] + $vv['virtual_count'];
				unset($vv['virtual_count']);
				$store_goods[$kk] = $vv;
			}
			
			$val['tp_store'] = $tp_store;
			$val['goods'] = $store_goods;
			//$val = 	$tp_goods;	
			
            $list[$key] = $val;
        }
		
		if( empty($list) )
		{
			echo json_encode( array('code' => 1) );
			die();
		} else {
			echo json_encode( array('code' => 0 , 'data' => $list) );
			die();
		}
		
	}
	
	public function myvoucherlist()
    {
        $type = I('get.type',1);
        $page = I('get.page',1);
        $pre_page = I('get.pre_page',4);
        $offset = ($page -1) * $pre_page;
        
		$token = I('get.token');
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		//$member_id = 1;
		//$type = 3;
		
		if( empty($member_id) )
		{
			$result['code'] = 3;	
	        $result['msg'] = '登录失效';
	        echo json_encode($result);
	        die();
		}
		
        $condition = "user_id=".$member_id;
        if($type == 1)
        {
            //未使用
            $condition .= " and consume= 'N' and end_time> ".time();
            
        } else if($type == 2){
            //已使用
            $condition .= " and (consume= 'Y' or end_time< ".time().")";
        }
        
        $list = M('voucher_list')->field('voucher_title,store_id,type,credit,limit_money,consume,begin_time,end_time')->where($condition)->order('add_time desc')->limit($offset,$pre_page)->select();
        
        $now_time = time();
        
        foreach($list as $key => $val)
        {
            
			$store_info = M('seller')->field('s_true_name,s_logo')->where( array('s_id' => $val['store_id']) )->find();
			$val['store_name'] = $store_info['s_true_name'];
				
			$store_info['s_logo'] = C('SITE_URL').'/Uploads/image/'.$store_info['s_logo'];
			
			$val['s_logo'] = $store_info['s_logo'];
			//now_time
			$val['is_over'] = 0;
			if($val['end_time'] < $now_time)
			{
				$val['is_over'] = 1;
			}
			if($val['consume'] == 'Y')
			{
				$val['is_over'] = 1;
			}
			
			$val['begin_time'] = date('Y.m.d H:i:s', $val['begin_time']);
			$val['end_time']   = date('Y.m.d H:i:s', $val['end_time']);
			
            $list[$key] = $val;
        }
        $this->type = $type;
        $this->list = $list;
		
		if( empty($list) )
		{
			echo json_encode( array('code' =>1) );
		}else {
			echo json_encode( array('code' =>0, 'list' => $list) );
		}
    }
	
	public function myscores()	{		$page = I('get.page',1);		$type = I('get.type','all');        $pre_page = I('get.pre_page',10);		$offset = ($page -1) * $pre_page;		$token = I('get.token');		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();	    $member_id = $weprogram_token['member_id'];		if( empty($member_id) )		{			$result['code'] = 3;		        $result['msg'] = '登录失效';	        echo json_encode($result);	        die();		}		$where = "";		if($type == 'all')		{					}else if($type =='in'){			$where = " and in_out = 'in' ";		}else if($type == 'out'){			$where = " and in_out = 'out' ";		}				$sql ="select * from ".C('DB_PREFIX')."integral_flow  where   member_id = {$member_id} {$where} and state = 1   				order by addtime desc limit {$offset},{$pre_page} ";		$list = M()->query($sql);		        foreach($list as $key => $val)        {		//type		//'goodsbuy','refundorder','system_add','system_del','orderbuy'		$val['score'] = intval($val['score']);			switch($val['type'])			{				case 'goodsbuy':					$val['typename'] = '商品购买奖励积分';					$val['score'] = '+'.$val['score'];					break;				case 'orderbuy':					$val['typename'] = '积分兑换商品';					$val['score'] = -$val['score'];					break;				case 'refundorder':					$val['typename'] = '订单退款';					$val['score'] = -$val['score'];					break;				case 'system_add':					$val['typename'] = '后台充值';					$val['score'] = '+'.$val['score'];					break;				case 'system_del':					$val['typename'] = '后台扣除';					$val['score'] = -$val['score'];					break;				//score			}			$val['addtime'] = date('Y-m-d H:i:s', $val['addtime']);            $list[$key] = $val;        }		//myscores		 $integral_rules = C('integral_description');		 $qian=array("\r\n");		 $hou=array("@F@");		 $integral_rules_str = str_replace($qian,$hou,$integral_rules); 		 $integral_rules_str = explode('@F@',$integral_rules_str);		 		if( empty($list) )		{			echo json_encode( array('code' => 1,'integral_rules_str' => $integral_rules_str) );			die();		} else {			echo json_encode( array('code' => 0 , 'data' => $list,'integral_rules_str' => $integral_rules_str) );			die();		}			}
	public function myfavgoods()
	{
		$page = I('get.page',1);
        $pre_page = I('get.pre_page',6);
		
        $offset = ($page -1) * $pre_page;
		
		$token = I('get.token');
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		//$member_id = 1;
		
		if( empty($member_id) )
		{
			$result['code'] = 3;	
	        $result['msg'] = '登录失效';
	        echo json_encode($result);
	        die();
		}
		
		$sql ="select g.goods_id,g.name,g.quantity,g.seller_count,g.virtual_count,g.image,g.price,g.danprice,f.* from 
				".C('DB_PREFIX')."user_favgoods as f , ".C('DB_PREFIX')."goods as g where  f.goods_id = g.goods_id and ( g.type ='pintuan' or g.type = 'lottery' ) and  f.member_id = {$member_id}    
				order by f.add_time desc limit {$offset},{$pre_page} ";
		$list = M()->query($sql);		
		//$list = M('user_favgoods')->where( array('member_id' => $member_id) )->order('add_time desc')->limit($offset,$pre_page)->select();
        
		$goods_model = D('Home/goods');
		
		
        foreach($list as $key => $val)
        {
			//$tp_goods = M('goods')->field('goods_id,name,quantity,seller_count,virtual_count,image,price,danprice')->where( array('goods_id' => $val['goods_id']) )->find();
			//if(empty($tp_goods))
			//{
			//	continue;
			//}
			$price_arr = $goods_model->get_goods_price($val['goods_id']);
		
		
			$val['seller_count'] = $val['seller_count'] + $val['virtual_count'];
			
			//danprice 
			$val['danprice'] = $price_arr['price'];
			
				
			$val['image'] = C('SITE_URL').'Uploads/image/'. $val['image'];
			
			//$val = 	$tp_goods;	
            
            $list[$key] = $val;
        }
		
		if( empty($list) )
		{
			echo json_encode( array('code' => 1) );
			die();
		} else {
			echo json_encode( array('code' => 0 , 'data' => $list) );
			die();
		}
		
	
		
	}
	
	public function order_comment()
	{
	    $order_id = I('get.order_id',0);
		$token = I('get.token');
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		if( empty($member_id) )
		{
			$result['code'] = 3;	
	        $result['msg'] = '登录失效';
	        echo json_encode($result);
	        die();
		}
		
		
	    $order_goods = M('order_goods')->where( array('order_id' => $order_id) )->find();
	    
		$order_option_list = M('order_option')->where( array('order_goods_id' =>$order_goods['order_goods_id']) )->select();
	            
		$order_goods['goods_images']= C('SITE_URL') .resize($order_goods['goods_images'], C('common_image_thumb_width'), C('common_image_thumb_height'));
		//price orign_price 
		$goods_filed =  M('goods')->field('price')->where( array('goods_id' => $order_goods['goods_id']) )->find();
		$order_goods['orign_price'] = $goods_filed['price'];
		
		foreach($order_option_list as $option)
		{
			$order_goods['option_str'][] = $option['value'];
		}
		if( !isset($order_goods['option_str']) )
		{
			$order_goods['option_str'] = '';
		}else{
			$order_goods['option_str'] = implode(',', $order_goods['option_str']);
		}
		$order_goods['price'] = round($order_goods['price'],2);
		$order_goods['orign_price'] = round($order_goods['orign_price'],2);
				
				
	    $goods_info = M('goods')->field('image')->where( array('goods_id' => $order_goods['goods_id']) )->find();
	    $goods_image = resize($goods_info['image'], C('common_image_thumb_width'), C('common_image_thumb_height'));
		
		if(!empty($goods_image['fan_image'])){
			$goods_image = C('SITE_URL'). resize($goods_info['fan_image'], C('common_image_thumb_width'), C('common_image_thumb_height'));
		}else {
			$goods_image = C('SITE_URL').resize($goods_info['image'], C('common_image_thumb_width'), C('common_image_thumb_height'));
		}
			
		echo json_encode( array('code' => 0 ,'order_goods' =>$order_goods, 'goods_image' => $goods_image,'goods_id' =>$order_goods['goods_id']) );
		die();	
	    //$this->goods_image = $goods_image;
	    //$this->order_goods = $order_goods;
	    //$this->display();
	}
	
	/**
	 * 提交评论信息
	 */
	public function sub_comment()
	{
		//cur_rel:cur_rel,cur2_rel:cur2_rel,cur3_rel:cur3_rel,imgs:imgs,
		
		$data_json = file_get_contents('php://input');		
		$data = json_decode($data_json, true);
		  
		  
	    $order_id =  $data['order_id'];
	    $goods_id = $data['goods_id'];
	    $cur_rel = empty($data['cur_rel']) ? 5:$data['cur_rel'];
		$cur2_rel = empty($data['cur2_rel']) ? 5:$data['cur2_rel'];
		$cur3_rel = empty($data['cur3_rel']) ? 5:$data['cur3_rel'];
		$imgs = $data['imgs'];
		
		
		
		$comment_content =  htmlspecialchars($data['comment_content']);
		
		$token = I('get.token');
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		if( empty($member_id) )
		{
			$result['code'] = 3;	
	        $result['msg'] = '登录失效';
	        echo json_encode($result);
	        die();
		}
		
		//goods_name
		//goods_image
		//order_num_alias
		//avatar
		//user_name
		$order_goods = M('order_goods')->field('name,goods_images')->where( array('order_id' => $order_id,'goods_id' => $goods_id) )->find();
		$order_info = M('order')->field('order_num_alias')->where( array('order_id' => $order_id) )->find();
		$member_info = M('member')->field('uname,avatar')->where( array('member_id' => $member_id) )->find();
		
	    $data = array();
	    $data['member_id'] = $member_id;
	    $data['order_id'] =  $order_id;
	    $data['goods_id'] =  $goods_id;
		
		$data['goods_name'] = $order_goods['name'];
		$data['goods_image'] = $order_goods['goods_images'];
		$data['order_num_alias'] = $order_info['order_num_alias'];
		$data['avatar'] = $member_info['avatar'];
		$data['user_name'] = $member_info['uname'];
		
	    $data['star'] =  $cur_rel;
	    $data['star2'] =  $cur2_rel;
	    $data['star3'] =  $cur3_rel;
	    $data['images'] =  serialize($imgs);
	    $data['is_picture'] =  empty($imgs) ? 0 :1;
		
	    $data['content'] = $comment_content;
	    $data['add_time'] = time();
	    
	    M('order_comment')->add($data);
	   //order_comment 	   	   $goods_info = M('goods')->field('store_id')->where( array('goods_id' => $goods_id) )->find();	   	    $group_info =  M('group')->field('seller_id')->where( array('seller_id' => $goods_info['store_id']) )->find();	   	   if( !empty($group_info) )	   {		   $quan_model = D('Home/Quan');					$post_data['member_id'] = $member_id;			$post_data['group_id'] = $group_info['seller_id'];			$post_data['goods_id'] = $goods_id;			$post_data['title'] = $comment_content;			$post_data['content'] =  serialize($imgs);			$rs =  $quan_model->send_group_post($post_data);	   }	    
	   
	    $order_history = array();
		$order_history['order_id'] = $order_id;
		$order_history['order_status_id'] = 11;
		$order_history['notify'] = 0;
		$order_history['comment'] = '用户提交评论,订单完成。';
		$order_history['date_added']=time();
		M('order_history')->add($order_history);
	    
	    M('order')->where( array('order_id' =>$order_id ) )->save( array('order_status_id' => 11) );
	    
	    echo json_encode( array('code' => 1) );
	    die();
	}
	
	
	/**
		获取订单金额
	**/
	public function get_order_money()
	{
		$token = I('get.token');
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		if( empty($member_id) )
		{
			$result['code'] = 0;	
	        $result['msg'] = '登录失效';
	        echo json_encode($result);
	        die();
		}
		$order_id = I('get.order_id');
		//total
		$order_info =  M('order')->field('total')->where( array('order_id' => $order_id ,'member_id' => $member_id) )->find();
		
		$order_info['total'] = round($order_info['total'], 2);
		echo json_encode( array('code' =>1, 'total' => $order_info['total']) );
		die();
	}
	
	/**
		退款提交
	**/
	public function refund_sub()
	{
		$token = I('get.token');
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		if( empty($member_id) )
		{
			$result['code'] = 0;	
	        $result['msg'] = '登录失效';
	        echo json_encode($result);
	        die();
		}
		
		
		$data_json = file_get_contents('php://input');		
		$data = json_decode($data_json, true);
		
		
		//$data = I('post.');
		
		$order_id = $data['order_id'];
		$order_info = M('order')->where( array('member_id' => $member_id, 'order_id' => $order_id) )->find();
		
		if(empty($order_info) )
		{
			$result['code'] = 0;	
	        $result['msg'] = '没有此订单';
	        echo json_encode($result);
	        die();
		}
		
		$result = array('code' => 0);
		
		$refdata = array();
		$refdata['order_id'] = intval($data['order_id']);
		$refdata['ref_type'] = intval($data['complaint_type']);
		$refdata['ref_money'] = floatval($data['complaint_money']);
		$refdata['ref_member_id'] = $member_id;
		$refdata['ref_name'] = htmlspecialchars($data['complaint_reason']);
		$refdata['ref_mobile'] = htmlspecialchars($data['complaint_mobile']);
		$refdata['ref_description'] = htmlspecialchars($data['complaint_desc']);
		$refdata['state'] = 0;
		$refdata['addtime'] = time();
		
		if($refdata['ref_money'] > $order_info['total'])
		{
			$result['msg'] = '退款金额不能大于订单总额';
			echo json_encode($result);
			die();
		}
		if(!empty($data['ref_id']))
		{
			$ref_id = intval($data['ref_id']);
			unset($refdata['order_id']);
			unset($refdata['ref_member_id']);
			unset($refdata['addtime']);
			M('order_refund')->where( array('ref_id' => $ref_id) )->save($refdata);
			
			$order_history = array();
			$order_history['order_id'] = $order_id;
			$order_history['order_status_id'] = $order_info['order_status_id'];
			$order_history['notify'] = 0;
			$order_history['comment'] = '用户修改退款资料';
			$order_history['date_added']=time();
			M('order_history')->add($order_history);
			
			
			$order_refund_history = array();
			$order_refund_history['order_id'] = $order_id;
			$order_refund_history['message'] = $refdata['ref_description'];
			$order_refund_history['type'] = 1;
			$order_refund_history['addtime'] = time();
			$orh_id = M('order_refund_history')->add($order_refund_history);
			
			if(!empty($data['complaint_images']))
			{
				foreach($data['complaint_images'] as $complaint_images)
				{
					$img_data = array();
					$img_data['orh_id'] = $orh_id;
					$img_data['image'] = htmlspecialchars($complaint_images);
					$img_data['addtime'] = time();
					M('order_refund_history_image')->add($img_data);
				}
			}
		}else {
			$ref_id = M('order_refund')->add($refdata);
			
			$up_order = array();
			$up_order['order_status_id'] = 12;
			M('order')->where( array('order_id' => $order_id) )->save($up_order);
			
			$order_history = array();
			$order_history['order_id'] = $order_id;
			$order_history['order_status_id'] = 12;
			$order_history['notify'] = 0;
			$order_history['comment'] = '用户申请退款中';
			$order_history['date_added']=time();
			M('order_history')->add($order_history);
			
			if(!empty($data['complaint_images']))
			{
				foreach($data['complaint_images'] as $complaint_images)
				{
					$img_data = array();
					$img_data['ref_id'] = $ref_id;
					$img_data['image'] = htmlspecialchars($complaint_images);
					$img_data['addtime'] = time();
					M('order_refund_image')->add($img_data);
				}
			}
		}
		
		
		
		$result['code'] = 1;
		echo json_encode($result);
		die();
	}
	
	/**
		退款详情
	**/
	
	public function refunddetail()
	{
		$token = I('get.token');
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		if( empty($member_id) )
		{
			$result['code'] = 0;	
	        $result['msg'] = '登录失效';
	        echo json_encode($result);
	        die();
		}
		
		
		$order_id = I('get.order_id',0);
		$order_info = M('order')->where( array('member_id' => $member_id, 'order_id' => $order_id) )->find();
		
		if(empty($order_info) )
		{
			$result['code'] = 0;	
	        $result['msg'] = '无此订单';
	        echo json_encode($result);
	        die();
		}
		
		$order_goods = M('order_goods')->where( array('order_id' => $order_id) )->find();
		
		$order_refund = M('order_refund')->where( array('order_id' => $order_id) )->find();
		$order_refund_history = M('order_refund_history')->where( array('order_id' => $order_id, 'type' => 2) )->order('addtime asc ')->find();
		
		
		$refund_reason = array(
							'97' =>'商品有质量问题',
							'98' =>'没有收到货',
							'99' =>'商品少发漏发发错',
							'100' =>'商品与描述不一致',
							'101' =>'收到商品时有划痕或破损',
							'102' =>'质疑假货',
							'111' =>'其他',
						);
		//ref_type
		$order_refund['ref_type'] = $order_refund['ref_type'] ==1 ? '仅退款': '退款退货';
		//$order_refund['ref_name'] = $refund_reason[$order_refund['ref_name']];
		
		$refund_state = array(
							0 => '申请中',
							1 => '商家拒绝',
							2 => '平台介入',
							3 => '退款成功',
							4 => '退款失败',
							5 => '撤销申请',
						);
		$order_refund['state'] = $refund_state[$order_refund['state']];
		$order_refund['addtime']  = date('Y-m-d H:i:s', $order_refund['addtime']);
		//$this->order_refund = $order_refund;
		$order_refund_image = M('order_refund_image')->where( array('ref_id' => $order_refund['ref_id']) )->select();
		$refund_images = array();
		
		if(!empty($order_refund_image))
		{
			foreach($order_refund_image as $refund_image)
			{
				$refund_image['thumb_image'] = C('SITE_URL').resize($refund_image['image'], 100, 100);
				$refund_images[] = $refund_image;
			}
		}
		
		
		$order_refund_historylist = M('order_refund_history')->where( array('order_id' => $order_id) )->order('addtime asc')->select();
		//.type ==3
		$pingtai_deal = 0;
		foreach($order_refund_historylist as $key => $val)
		{
			if($val['type'] ==3)
			{
				$pingtai_deal = 1;
			}
			$order_refund_history_image = M('order_refund_history_image')->where( array('orh_id' => $val['id']) )->select();
			if(!empty($order_refund_history_image))
			{
				foreach($order_refund_history_image as $kk => $vv)
				{
					$vv['thumb_image'] = resize($vv['image'], 100, 100);
					$order_refund_history_image[$kk] = $vv;
				}
			}
			$val['order_refund_history_image'] = $order_refund_history_image;
			$val['addtime'] = date('Y-m-d H:i:s', $val['addtime']);
			
			$order_refund_historylist[$key] = $val;
		}
		
		echo json_encode( array('code' => 1,'pingtai_deal' => $pingtai_deal,'order_refund' =>$order_refund, 'order_id' => $order_id ,'order_refund_history' => $order_refund_history,'order_refund_historylist' => $order_refund_historylist, 'refund_images' => $refund_images,'order_goods' => $order_goods ,'order_info' => $order_info) );
		die();
		//$this->refund_images = $refund_images;
		//$this->order_goods = $order_goods;
		//$this->order_info = $order_info;
		//$this->order_refund_historylist = $order_refund_historylist;
		//$this->order_refund_history = $order_refund_history;
		//$this->order_id = $order_id;
		
		//$this->display();
	}
	
	
	/**
		申请平台介入
	**/
	public function judgement_refund()
	{
		$result = array('code' => 0);
		
		$token = I('get.token');
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		$order_id = I('get.order_id');
		
		$order_info = M('order')->where( array('member_id' => $member_id, 'order_id' => $order_id) )->find();
		if(empty($order_info) )
		{
			$result['msg'] = '非法操作';
			echo json_encode($result);
			die();
		}
		M('order_refund')->where( array('order_id' => $order_id) )->save( array('state' => 2) );
		
		M('order')->where( array('member_id' => $member_id, 'order_id' => $order_id) )->save( array('order_status_id' => 13) );
		
		$order_history = array();
		$order_history['order_id'] = $order_id;
		$order_history['order_status_id'] = 13;
		$order_history['notify'] = 0;
		$order_history['comment'] = '申请平台介入';
		$order_history['date_added']=time();
		M('order_history')->add($order_history);
		
		$order_refund_history = array();
		$order_refund_history['order_id'] = $order_id;
		$order_refund_history['message'] = '申请平台介入';
		$order_refund_history['type'] = 1;
		$order_refund_history['addtime'] = time();
		M('order_refund_history')->add($order_refund_history);
		
		$result['code'] = 1;
		echo json_encode($result);
		die();
		
	}
	
	
	/**
		撤销退款
	**/
	public function cancel_refund()
	{
		$token = I('get.token');
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		$order_id = I('get.order_id');
		
		if( empty($member_id) )
		{
			$result['code'] = 0;	
	        $result['msg'] = '登录失效';
	        echo json_encode($result);
	        die();
		}
		
		$result = array('code' => 0);
		
		$order_info = M('order')->where( array('member_id' => $member_id, 'order_id' => $order_id) )->find();
		if(empty($order_info) )
		{
			$result['msg'] = '非法操作';
			echo json_encode($result);
			die();
		}
		M('order_refund')->where( array('order_id' => $order_id) )->save( array('state' => 5) );
		
		$order_history = array();
		$order_history['order_id'] = $order_id;
		$order_history['order_status_id'] = 4;
		$order_history['notify'] = 0;
		$order_history['comment'] = '用户撤销退款';
		$order_history['date_added']=time();
		M('order_history')->add($order_history);
		//	state
		M('order')->where( array('member_id' => $member_id, 'order_id' => $order_id) )->save( array('order_status_id' => 4) );
		
		$result['code'] = 1;
		echo json_encode($result);
		die();
	}
	
	/**
		物流快递
	**/
	public function goods_express()
	{
		$token = I('get.token');
		$order_id = I('get.order_id',0);
		
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		if( empty($member_id) )
		{
			$result['code'] = 2;	
	        $result['msg'] = '登录失效';
	        echo json_encode($result);
	        die();
		}
		
		$order_info = M('order')->where( array('order_id' => $order_id) )->find();
		//shipping_cha_time 86400 43200
		$now_time = time();
		if($now_time - $order_info['shipping_cha_time'] >= 43200)
		{
			//即时查询接口
			
			$seller_express = M('seller_express')->where( array('id' =>$order_info['shipping_method'] ) )->find();
		
		//$seller_express['jianma'] = 'YTO';
		//$order_info['shipping_no'] = '887406591556327434';
			if(!empty($seller_express['jianma']))
			{
				//887406591556327434  YTO
				
				//TODO...
				$ebuss_info = M('config')->where( array('name' => 'EXPRESS_EBUSS_ID') )->find();
				$exappkey = M('config')->where( array('name' => 'EXPRESS_APPKEY') )->find();
				
				$req_url = "http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx";
				$this->ebusinessid = $ebuss_info['value'];
				$this->appkey = $exappkey['value'];
				
				$requestData= "{'OrderCode':'".$order_id."','ShipperCode':'".$seller_express['jianma']."','LogisticCode':'". $order_info['shipping_no']."'}";
				
				$datas = array(
					'EBusinessID' => $ebuss_info['value'],
					'RequestType' => '1002',
					'RequestData' => urlencode($requestData) ,
					'DataType' => '2',
				);
				$datas['DataSign'] = $this->encrypt($requestData, $exappkey['value']);
				$result=$this->sendPost($req_url, $datas);	
				$result = json_decode($result);
				
				//根据公司业务处理返回的信息......
				//Traces
				if(!empty($result->Traces))
				{
					$order_info['shipping_traces'] = serialize($result->Traces);
					
					M('order')->where( array('order_id' => $order_id) )->save( array('shipping_cha_time' => time(), 'shipping_traces' => $order_info['shipping_traces']) );
				}					
					
				
			}
		}
		
		$order_goods = M('order_goods')->where( array('order_id' => $order_id) )->find();
		$goods_info = M('goods')->field('image')->where( array('goods_id' => $order_goods['goods_id']) )->find();
		$goods_info['image']=C('SITE_URL'). resize($goods_info['image'], C('common_image_thumb_width'), C('common_image_thumb_height'));
		
		$seller_express = M('seller_express')->where( array('id' =>$order_info['shipping_method'] ) )->find();
		
		//shipping_traces
		
		$order_info['shipping_traces'] =  unserialize($order_info['shipping_traces']) ; 
		
		echo json_encode( array('code' => 0, 'seller_express' => $seller_express, 'goods_info' => $goods_info, 'order_info' => $order_info) );
		die();
		
		//$this->seller_express = $seller_express;
		//$this->goods_info = $goods_info;
		//$this->order_info = $order_info;
		//$this->display();
	}
	
	/**
	 *  post提交数据 
	 * @param  string $url 请求Url
	 * @param  array $datas 提交的数据 
	 * @return url响应返回的html
	 */
	function sendPost($url, $datas) {
		$temps = array();	
		foreach ($datas as $key => $value) {
			$temps[] = sprintf('%s=%s', $key, $value);		
		}	
		$post_data = implode('&', $temps);
		$url_info = parse_url($url);
		if(empty($url_info['port']))
		{
			$url_info['port']=80;	
		}
		$httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
		$httpheader.= "Host:" . $url_info['host'] . "\r\n";
		$httpheader.= "Content-Type:application/x-www-form-urlencoded\r\n";
		$httpheader.= "Content-Length:" . strlen($post_data) . "\r\n";
		$httpheader.= "Connection:close\r\n\r\n";
		$httpheader.= $post_data;
		$fd = fsockopen($url_info['host'], $url_info['port']);
		fwrite($fd, $httpheader);
		$gets = "";
		$headerFlag = true;
		while (!feof($fd)) {
			if (($header = @fgets($fd)) && ($header == "\r\n" || $header == "\n")) {
				break;
			}
		}
		while (!feof($fd)) {
			$gets.= fread($fd, 128);
		}
		fclose($fd);  
		
		return $gets;
	}

	/**
	 * 电商Sign签名生成
	 * @param data 内容   
	 * @param appkey Appkey
	 * @return DataSign签名
	 */
	function encrypt($data, $appkey) {
		return urlencode(base64_encode(md5($data.$appkey)));
	}

	/**
		订单确认收货接口
	**/
	function receive_order()
	{
		
		$token = I('get.token');
		$order_id = I('get.order_id');
		
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		if( empty($member_id) )
		{
			$result['code'] = 2;	
	        $result['msg'] = '登录失效';
	        echo json_encode($result);
	        die();
		}
		
	     
	    $order_info = M('order')->where( array('member_id' => $member_id,'order_id' => $order_id) )->find();
	    if(empty($order_info)){
			$result['code'] = 1;	
	        $result['msg'] = '非法操作,会员不存在该订单';
	        echo json_encode($result);
	        die();
	    }
		
	    $model =  D('Home/Order');
	   
	    $model->receive_order($order_id);
	     
	    $result['code'] = 0;
	    echo json_encode($result);
	    die();
	}
	/**
		取消订单操作
	**/
	public function cancel_order()
	{
	    $token = I('get.token');
		$order_id = I('get.order_id');
		
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		if( empty($member_id) )
		{
			$result['code'] = 2;	
	        $result['msg'] = '登录失效';
	        echo json_encode($result);
	        die();
		}
		
	     
	    $order_info = M('order')->where( array('member_id' => $member_id,'order_id' => $order_id) )->find();
	    if(empty($order_info)){
			$result['code'] = 1;	
	        $result['msg'] = '非法操作,会员不存在该订单';
	        echo json_encode($result);
	        die();
	    }
	    
	    $model =  D('Home/Order');
	    $model->cancel_order($order_id);
	    
	    $result['code'] = 0;
	    echo json_encode($result);
	    die();
	   
	}
	
	function group_info()
	{
		$interface_get_time = time();
		$token = I('get.token');
		$order_id = I('get.order_id');
		
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
	    $is_show = 0;
	    //获取拼团商品信息
	    $order_goods_sql = "select name,goods_id,price,total,goods_images,quantity from ".C('DB_PREFIX')."order_goods
	    where order_id = {$order_id}  limit 1";
	     
	    $order_goods_arr = M()->query($order_goods_sql);
	     
	    if(empty($order_goods_arr))
	    {
			//未找到
			echo json_encode( array('code' =>1) );
			die();
	    }
	    $order_goods = $order_goods_arr[0];
		
		$order_goods['price'] = round($order_goods['price'],2);
		$order_goods['total'] = round($order_goods['total'],2);
			//"price": "0.0100",
            //"total": "0.0100",
			
	    $order_info = M('order')->field('member_id')->where( array('order_id' => $order_id) )->find();
	     
	     
	    $order_goods['image']=C('SITE_URL'). resize($order_goods['goods_images'], C('common_image_thumb_width'), C('common_image_thumb_height'));
	
		$order_goods['goods_images'] = C('SITE_URL').'Uploads/image/'.$order_goods['goods_images'];
	    
	    $goods_info = M('goods')->field('name,price,seller_count,virtual_count')->where( array('goods_id' => $order_goods['goods_id']) )->find();
		
		$goods_desc = M('goods_description')->field('share_group_title')->where( array('goods_id' => $order_goods['goods_id']) )->find();
		
		
		
		$goods_info['seller_count'] = $goods_info['seller_count'] + $goods_info['virtual_count'];
		unset($goods_info['virtual_count']);
		
	    //pin_price
	   // $pin_goods = M('pin_goods')->where( array('goods_id' => $order_goods['goods_id']) )->find();
	
	    //pin_price
	    //$pin_goods['pin_price_del'] = explode('.',$pin_goods['pin_price']);
		
		
			//price	
				
		//unset($pin_goods['customer_id']);
		
		
	    $water_image = '';
	
	
	    $pin_order = M('pin_order')->where( array('order_id' =>$order_id) )->find();
	
	    //获取拼团信息
	    $pin_info = M('pin')->where( array('pin_id' => $pin_order['pin_id']) )->find();
	     
	
	     
	    if($pin_info['state'] == 0 && $pin_info['end_time'] < time()){
	        $pin_info['state'] = 2;
	    }
	     
	    $tuanzhang_info = M('member')->where( array('member_id' => $pin_info['user_id']) )->find();
	     
	     
	     
	    $pin_order_sql = "select po.add_time,m.member_id,m.name,m.telephone,m.avatar from ".C('DB_PREFIX')."pin_order as po,".C('DB_PREFIX')."order as o,
	                      ".C('DB_PREFIX')."order_goods as og,".C('DB_PREFIX')."member as m
	                          where po.pin_id = ".$pin_info['pin_id']." and o.order_status_id in(1,2,4,6,7,8,9,10,11)
	                          and og.order_id = po.order_id and o.order_id = po.order_id and o.member_id= m.member_id order by po.add_time asc ";
	     
	    $pin_order_arr = M()->query($pin_order_sql);
	     
	    
	    $me_take_in = 0;
	    foreach($pin_order_arr as $key =>$val)
	    {
	        if($member_id == $val['member_id'])
	        {
	            $me_take_in = 1;
	        }
	        $pin_order_arr[$key] = $val;
	    }
	   
		if($pin_info['is_jiqi'] == 1)
		{
			$jia_list = M('jiapinorder')->where( array('pin_id' => $pin_info['pin_id']) )->select();
			foreach( $jia_list as $jia_val )
			{
				$tmp_arr = array();
				$tmp_arr['add_time'] = $jia_val['addtime'];
				$tmp_arr['member_id'] = 1;
				$tmp_arr['name'] = $jia_val['uname'];
				$tmp_arr['telephone'] = $jia_val['mobile'];
				$tmp_arr['avatar'] = $jia_val['avatar'];
				$pin_order_arr[] = $tmp_arr;
				//po.add_time,m.member_id,m.name,m.telephone,m.avatar
			}
			
		}
	    $is_me = 0;
		
	    if($order_info['member_id'] == $member_id)
	    {
	        $is_me = 1;
	    }
		
		$share_title = "不要错过~我".round($order_goods['price'],2)."元拼了".$goods_info['name'];
		
		if(!empty($goods_desc['share_group_title']) )
		{
			$share_title = $goods_desc['share_group_title'];
			$share_title = str_replace('{pin_price}',round($order_goods['price'],2),$share_title);
			$share_title = str_replace('{name}',$goods_info['name'],$share_title);
		}
		
	     
	    $this->is_me = $is_me;
	    $this->goods_info = $goods_info;
	    //$this->pin_goods = $pin_goods;
	    $this->pin_order = $pin_order;
	    $this->me_take_in = $me_take_in;
	    $this->pin_info = $pin_info;
	    $this->share_title = $share_title;
	     
	    $this->tuanzhang_info = $tuanzhang_info;
	    $this->pin_order_arr = $pin_order_arr;
	     
	    $this->order_goods = $order_goods;
	    $this->order_id = $order_id;
	    $this->group_order_id = $group_order_id;
	
	
	    
	    /* 商品规格begin */
	
	    //get_goods_options($goods_id)
	    $goods_model = D('Home/Goods');
	
	    //$this->options=$goods_model->get_goods_options($order_goods['goods_id']);
	
	    $goods_option_mult_value = M('goods_option_mult_value')->where( array('goods_id' =>$order_goods['goods_id']) )->order('id asc')->select();
	
	    $goods_option_mult_value_ref = array();
	
	    foreach($goods_option_mult_value as $key => $val)
	    {
	        $val['image'] = resize($val['image'],200,200);
	        $goods_option_mult_value[$key] = $val;
	         
	        $goods_option_mult_value_ref[ $val['rela_goodsoption_valueid'] ] = $val;
	    }
	
	    $this->goods_option_mult_value_ref = $goods_option_mult_value_ref;
		
	
	    /* 商品规格end */
		
		unset( $tuanzhang_info['reg_type'] );
		unset( $tuanzhang_info['openid'] );
		unset( $tuanzhang_info['we_openid'] );
		unset( $tuanzhang_info['bindmobile'] );
		unset( $tuanzhang_info['uname'] );
		unset( $tuanzhang_info['email'] );
		unset( $tuanzhang_info['pwd'] );
		unset( $tuanzhang_info['address_id'] );
		unset( $tuanzhang_info['share_id'] );
		unset( $tuanzhang_info['comsiss_flag'] );
		unset( $tuanzhang_info['bind_seller_id'] );
		unset( $tuanzhang_info['bind_seller_pickup'] );
		unset( $tuanzhang_info['cart'] );
		unset( $tuanzhang_info['wishlist'] );
		unset( $tuanzhang_info['id_cardreal_name'] );
		unset( $tuanzhang_info['id_card'] );
		unset( $tuanzhang_info['login_count'] );
		unset( $tuanzhang_info['last_login_ip'] );
		unset( $tuanzhang_info['last_ip_region'] );
		unset( $tuanzhang_info['create_time'] );
		unset( $tuanzhang_info['last_login_time'] );
		unset( $tuanzhang_info['status'] );
		
		
		$options = $goods_model->get_goods_options($order_goods['goods_id']);
		
		if( empty($goods_option_mult_value))
		{
			$options= array('list' => array() );
		}
		
		
		$need_data = array();
		
		$need_data['is_me'] = $is_me;
		$need_data['goods_info'] = $goods_info;
		//$need_data['pin_goods'] = $pin_goods;
		$need_data['pin_order'] = $pin_order;
		$need_data['me_take_in'] = $me_take_in;
		$need_data['share_title'] = $share_title;
		$need_data['pin_info'] = $pin_info;
		$need_data['tuanzhang_info'] = $tuanzhang_info;
		$need_data['pin_order_arr'] = $pin_order_arr;
		$need_data['order_goods'] = $order_goods;
		$need_data['order_id'] = $order_id;
		$need_data['group_order_id'] = $group_order_id;
		$need_data['options'] = $options;
		$need_data['interface_get_time'] = $interface_get_time;
		$need_data['del_count'] = $pin_info['need_count'] - count($pin_order_arr);
		//$need_data['goods_option_mult_value_ref'] = $goods_option_mult_value_ref;
		
	
	    echo json_encode( array('code' =>0, 'data' => $need_data) );
		die();
	}
	
	/**
		核销代码开始
	**/
	public function hexiao_pickup()
	{
		
		$token = I('get.token');
		
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		//$member_id = is_login();
		$member_info = M('member')->where( array('member_id' => $member_id) )->find();
		
		if($member_info['bind_seller_pickup'] <= 0)
		{
			echo json_encode( array('code' => 1,'msg' => '您不是核销人员') );
			die();
			
		}
		
		
		$pick_sn = I('get.pick_sn');
		
		$pick_order = M('pick_order')->where( array('pick_sn' => $pick_sn) )->find();
		
		$pick_member_info = M('pick_member')->where( array('member_id' => $member_id) )->find();
		
		if($pick_member_info['pick_up_id'] > 0 && $pick_member_info['pick_up_id'] != $pick_order['pick_id'])
		{
			echo json_encode( array('code' => 1,'msg' => '您无此门店核销权限') );
			die();
		}
		
		//pick_id
		
		
		//order_id  pick_id
		$order_id = $pick_order['order_id'];
		
		$order_goods = M('order_goods')->where( array('order_id' => $pick_order['order_id']) )->find();
		if($order_goods['store_id'] != $member_info['bind_seller_pickup'])
		{
			echo json_encode( array('code' => 1,'msg' => '您无此商家核销权限') );
			die();
		}
		
		$store_info = M('seller')->where('s_id='.$order_goods['store_id'])->find();
		
		
		
		$order_info = M('order')->where( array('order_id' => $order_id) )->find();
		$pick_up_info = array();
		$pick_order_info = array();
		
		
		if( $order_info['delivery'] == 'pickup' )
		{
			//查询自提点
			$pick_order_info = M('pick_order')->where( array('order_id' => $order_id) )->find();
			$pick_id = $pick_order_info['pick_id'];
			$pick_up_info = M('pick_up')->where( array('id' => $pick_id) )->find();
			
		}
		//$this->pick_up_info =  $pick_up_info;
		
	    $order_status_info = M('order_status')->where( array('order_status_id' => $order_info['order_status_id']) )->find();
	    //10 name
		if($order_info['order_status_id'] == 10)
		{
			$order_status_info['name'] = '等待退款';
		}
		else if($order_info['order_status_id'] == 1 && $order_info['type'] == 'lottery')
		{
			//等待开奖
			//一等奖
			if($order_info['lottery_win'] == 1)
			{
				$order_status_info['name'] = '一等奖';
			}else {
				$order_status_info['name'] = '等待开奖';
			}
			
		}
		
	    $shipping_province = M('area')->where( array('area_id' => $order_info['shipping_province_id']) )->find();
	    $shipping_city = M('area')->where( array('area_id' => $order_info['shipping_city_id']) )->find();
	    $shipping_country = M('area')->where( array('area_id' => $order_info['shipping_country_id']) )->find();
	    
	    $order_goods_list = M('order_goods')->where( array('order_id' => $order_id) )->select();
	    
	    foreach($order_goods_list as $key => $order_goods)
	    {
	        $order_option_info = M('order_option')->field('value')->where( array('order_id' =>$order_id,'order_goods_id' => $order_goods['order_goods_id']) )->select();
	         
	        foreach($order_option_info as $option)
	        {
	            $vv['option_str'][] = $option['value'];
	        }
			if(empty($vv['option_str']))
			{
				//option_str
				 $order_goods['option_str'] = '';
			}else{
				 $order_goods['option_str'] = implode(',', $vv['option_str']);
			}
	       //
		    $order_goods['shipping_fare'] = round($order_goods['shipping_fare'],2);
		    $order_goods['price'] = round($order_goods['price'],2);
		    $order_goods['total'] = round($order_goods['total'],2);
	        
	        $order_goods['image']=C('SITE_URL').resize($order_goods['goods_images'], C('common_image_thumb_width'), C('common_image_thumb_height'));
	        
			$order_goods['goods_images']= C('SITE_URL').'/Uploads/image/'.$order_goods['goods_images'];
	         			
			 
			 
			$store_info = M('seller')->field('s_true_name,s_logo')->where('s_id='.$order_goods['store_id'])->find();
				
			$store_info['s_logo'] = C('SITE_URL').'/Uploads/image/'.$store_info['s_logo'];
			
			$order_goods['store_info'] = $store_info;
			
			unset($order_goods['model']);
			unset($order_goods['rela_goodsoption_valueid']);
			unset($order_goods['comment']);
			
	        $order_goods_list[$key] = $order_goods;
	    }
	    
		unset($order_info['store_id']);
		unset($order_info['type']);
		unset($order_info['email']);
		unset($order_info['shipping_city_id']);
		unset($order_info['shipping_country_id']);
		unset($order_info['shipping_province_id']);
		unset($order_info['comment']);
		unset($order_info['voucher_id']);
		unset($order_info['voucher_credit']);
		unset($order_info['is_balance']);
		unset($order_info['lottery_win']);
		unset($order_info['ip']);
		unset($order_info['ip_region']);
		unset($order_info['user_agent']);
		
		$order_info['shipping_fare'] = round($order_info['shipping_fare'],2);	
		$order_info['total'] = round($order_info['total'],2);		
		$order_info['price'] = round($order_info['price'],2);	

			
		$order_info['date_added'] = date('Y-m-d H:i:s', $order_info['date_added']);
		$need_data = array();
		$need_data['order_info'] = $order_info;
		$need_data['order_status_info'] = $order_status_info;
		$need_data['shipping_province'] = $shipping_province;
		$need_data['shipping_city'] = $shipping_city;
		$need_data['shipping_country'] = $shipping_country;
		$need_data['order_goods_list'] = $order_goods_list;
		
		//$order_info['order_status_id'] 13  平台介入退款
		$order_refund_historylist = array();
		$pingtai_deal = 0;
		
		//判断是否已经平台处理完毕
		$order_refund_historylist = M('order_refund_history')->where( array('order_id' => $order_id) )->order('addtime asc')->select();
		
		foreach($order_refund_historylist as $key => $val)
		{
			if($val['type'] ==3)
			{
				$pingtai_deal = 1;
			}
		}
		
		//order_refund
		$order_refund = M('order_refund')->where( array('order_id' => $order_id) )->find();
		if(!empty($order_refund))
		{
			$order_refund['addtime'] = date('Y-m-d H:i:s', $order_refund['addtime']);
		}
		
		$need_data['pick_up'] = $pick_up_info;
		
		
		
		$need_data['pick_order_info'] = $pick_order_info;
		
		//https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=APPID&secret=APPSECRET
		
		//https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=ACCESS_TOKEN
		
		
		echo json_encode( array('code' => 0,'data' => $need_data,'pingtai_deal' => $pingtai_deal,'order_refund' => $order_refund ) );
		die();
		
		
		
	}
	
	
	/**
	核销
	**/
	public function pickup_pickage()
	{
		
		$token = I('get.token');
		
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		//$member_id = is_login();
		$member_info = M('member')->where( array('member_id' => $member_id) )->find();
		
		if($member_info['bind_seller_pickup'] <= 0)
		{
			echo json_encode( array('code' => 1,'msg' => '您不是核销人员') );
			die();
		}
		
		
		$pick_sn = I('get.pick_sn');
		
		$pick_order = M('pick_order')->where( array('pick_sn' => $pick_sn) )->find();
		
		$pick_member_info = M('pick_member')->where( array('member_id' => $member_id) )->find();
		
		if($pick_member_info['pick_up_id'] > 0 && $pick_member_info['pick_up_id'] != $pick_order['pick_id'])
		{
			echo json_encode( array('code' => 1,'msg' => '您无此门店核销权限') );
			die();
		}
		
		
		//order_id  pick_id
		$order_id = $pick_order['order_id'];
		
		$order_goods = M('order_goods')->where( array('order_id' => $pick_order['order_id']) )->find();
		if($order_goods['store_id'] != $member_info['bind_seller_pickup'])
		{
			echo json_encode( array('code' => 1,'msg' => '您无此商家核销权限') );
			die();
		}
		
		$pick_id = $pick_order['id'];
		
		//$pick_id = I('get.pick_id');
		$pick_order = M('pick_order')->where( array('id' => $pick_id) )->find();
		$member_id = is_login();
		$member_info = M('member')->where( array('member_id' => $member_id) )->find();
		$result = array('code' => 0,'msg' => '');
		
		
		$order_goods = M('order_goods')->where( array('order_id' => $pick_order['order_id']) )->find();
		//发送订单佣金
		//pick_member_id
		
		$res = M('pick_order')->where( array('id' => $pick_id) )->save( array('pick_member_id' => $member_id, 'state' => 1, 'tihuo_time' => time()) );
		if($res)
		{
			M('order')->where( array('order_id' => $pick_order['order_id']) )->save( array('order_status_id' => 6) );
			
			$fenxiao_model = D('Home/Fenxiao');
			$fenxiao_model->send_order_commiss_money($pick_order['order_id']);
			//准备发送订单的 send_order_score_dr($order_id)			$integral_model = D('Seller/Integral');			$integral_model->send_order_score_dr($pick_order['order_id']);		
			$history_data = array();
			$history_data['order_id']  = $pick_order['order_id'];
			$history_data['order_status_id']  = 6;
			$history_data['notify']  = 0;
			$history_data['comment']  = '用户提货，核销';
			$history_data['date_added']  = time();
			M('order_history')->add($history_data);
  
			$notify_model = D('Home/Weixinnotify');
			$notify_model->sendPickupsuccessMsg($pick_order['order_id']); 
			$result['code'] = 0;
		}
		echo json_encode($result);
		die();
	}
	/**
	  绑定自提订单核销管理员
	**/
	public function bind_pickup_order()
	{
		$seller_store_id = I('get.seller_store_id');
		$token = I('get.token');
		
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		//$member_id = is_login();
		$member_info = M('member')->where( array('member_id' => $member_id) )->find();
		
		if( empty($member_info) )
		{
			echo json_encode( array('code' => 1,'msg' => '您未登录') );
			die();
		}
		
		$seller_store_arr = explode('_', $seller_store_id);
		
		$seller_id = $seller_store_arr[0];
		$pick_up_id = $seller_store_arr[1];
		
		$seller_info = M('seller')->field('s_true_name')->where( array('s_id' => $seller_id) )->find();
		
		$store_name = '所有门店';
		
		if( $pick_up_id > 0 )
		{
			$pick_up_info =  M('pick_up')->where( array('id' => $pick_up_id) )->find();
			$store_name = $pick_up_info['pick_name'];
		}
		
        echo json_encode( array('code' => 0,'seller_name' => $seller_info['s_true_name'], 'store_name' => $store_name ) );
		die();
	}
	/**
	  解除绑定自提订单核销管理员
	**/
	public function unbind_pickup_order()
	{
		$seller_store_id = I('get.seller_store_id');
		$token = I('get.token');
		
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		//$member_id = is_login();
		$member_info = M('member')->where( array('member_id' => $member_id) )->find();
		
		if( empty($member_info) )
		{
			echo json_encode( array('code' => 1,'msg' => '您未登录') );
			die();
		}
		
		$seller_store_arr = explode('_', $seller_store_id);
		
		$seller_id = $seller_store_arr[0];
		$pick_up_id = $seller_store_arr[1];
		
		 
		$data = array();
        $data['bind_seller_pickup'] = 0;
		
		$res = M('member')->where( array('member_id' => $member_id) )->save($data); 
		 
        $this->display();
	}
	public function bind_pickup_post()
	{
		$seller_store_id = I('get.seller_store_id');
		$token = I('get.token');
		
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		
		$member_info = M('member')->where( array('member_id' => $member_id) )->find();
		
		if( empty($member_info) )
		{
			echo json_encode( array('code' => 1,'msg' => '您未登录') );
			die();
		}
		
		$seller_store_arr = explode('_', $seller_store_id);
		
		$seller_id = $seller_store_arr[0];
		$pick_up_id = $seller_store_arr[1];
        
        $data = array();
        $data['bind_seller_pickup'] = $seller_id;
        
        $res = M('member')->where( array('member_id' => $member_id) )->save($data);
		
		M('pick_member')->where( array('member_id' => $member_id) )->delete();
		
		$pick_member_data = array();
		$pick_member_data['member_id'] = $member_id;
		$pick_member_data['pick_up_id'] = $pick_up_id;
		$pick_member_data['state'] = 1;
		$pick_member_data['store_id'] = $seller_id;
		$pick_member_data['addtime'] = time();
		
		M('pick_member')->add($pick_member_data);
		
        $result = array('code' => 0);
        
        echo json_encode($result);
        die();
	}
	
	
	
	
	/**
		核销代码结束
	**/
	
	/**
		groupleaderindex
		分销商资料获取
	**/
	public function groupleaderindex()
	{
		$token = I('get.token');
		
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		$member_info = M('member')->where( array('member_id' => $member_id) )->find();
		
		if( empty($member_info) )
		{
			echo json_encode( array('code' => 1,'msg' => '您未登录') );
			die();
		}
		
		
		//查找一级数量
		$tuanyuan_arr = M('member')->field('member_id')->where( array('share_id' => $member_id) )->select();
		
		$tuanyuan_count = count($tuanyuan_arr);// $tuanyuan_count;
		
		//查找二级数量
		$second_tuanyuan_count = 0;
		$second_arr = array();
		if( !empty($tuanyuan_arr) )
		{
			$ids_arr = array();
			foreach($tuanyuan_arr as $val)
			{
				$ids_arr[] = $val['member_id'];
			}
			$second_arr =  M('member')->field('member_id')->where( array('share_id' => array('in', $ids_arr) ) )->select();
			$second_tuanyuan_count = count($second_arr);
		}
		$second_tuanyuan_count = $second_tuanyuan_count;
		
		//查找三级数量
		$three_tuanyuan_count = 0;
		
		if( !empty($second_arr) )
		{
			$ids_arr = array();
			foreach($second_arr as $val)
			{
				$ids_arr[] = $val['member_id'];
			}
			$three_tuanyuan_count =  M('member')->field('member_id')->where( array('share_id' => array('in', $ids_arr) ) )->count();
			
		}
		
		$three_tuanyuan_count = $three_tuanyuan_count;
		
		
		$member_commiss = M('member_commiss')->where( array('member_id' => $member_id) )->find();
		//$this->member_commiss = $member_commiss;
		
		$opencommiss_arr = M('config')->where( array('name' => 'opencommiss') )->find();
		$is_open_commiss = $opencommiss_arr['value'];
		
		$tuijian_ren = '平台';
		
		if($member_info['share_id'] > 0)
		{
			$tui_member = M('member')->field('uname')->where( array('member_id' => $member_info['share_id']) )->find();
			$tuijian_ren = $tui_member['uname'];
		}
		//$this->tuijian_ren = $tuijian_ren;
		//{{user_info.member_commiss.getmoney}} 
		//dongmoney getmoney money
		$member_model = D('Home/Member');
		
		//待确认收入
		$total_wait_where = array();
		$total_wait_where['member_id'] = $member_id;
		$total_wait_where['state'] = 0;
		$total_wait_commiss = $member_model->sum_member_commiss($total_wait_where);
		
		$all_commiss_money = $total_wait_commiss + $member_commiss['money'] +$member_commiss['getmoney']+$member_commiss['dongmoney'];
		
		$need_data = array();
		$need_data['tuanyuan_count'] = $tuanyuan_count;
		$need_data['all_commiss_money'] = $all_commiss_money;
		$need_data['second_tuanyuan_count'] = $second_tuanyuan_count;
		$need_data['three_tuanyuan_count'] = $three_tuanyuan_count;
		$need_data['member_commiss'] = $member_commiss;
		$need_data['is_open_commiss'] = $is_open_commiss;
		$need_data['tuijian_ren'] = $tuijian_ren;
		$need_data['member_info'] = $member_info;
		$need_data['commiss_level_num'] = C('commiss_level_num');
		
		echo json_encode( array('code' =>0 , 'data' => $need_data) );
		die();
	}
	
	/**
		获取佣金首页
	**/
	function tuanbonus_index()
    {
		$token = I('get.token');
		
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		$member_info = M('member')->where( array('member_id' => $member_id) )->find();
		
		
		
        //sum_member_commiss($where = array())
		$member_model = D('Home/Member');
		//今日收入
		$today_begin_time = strtotime( date('Y-m-d'.' 00:00:00') );
		$today_end_time = $today_begin_time + 86400;
		//$map['id'] = array('between','1,8');  $map['id'] = array('neq',100);
		$today_where = array();
		$today_where['member_id'] = $member_id;
		$today_where['state'] = array('neq',2);
		$today_where['addtime'] = array('between',$today_begin_time.','.$today_end_time);
		$today_commiss = $member_model->sum_member_commiss($today_where);
		
		//本月收入
		$month_begin_time = strtotime( date("Y-m-d ",mktime(0, 0 , 0,date("m"),1,date("Y"))).' 00:00:00' );
		$month_end_time = strtotime( date("Y-m-d ",mktime(23,59,59,date("m"),date("t"),date("Y"))).' 00:00:00' ) +86400;
		
		$month_where = array();
		$month_where['member_id'] = $member_id;
		$month_where['state'] = array('neq',2);
		$month_where['addtime'] = array('between',$month_begin_time.','.$month_end_time);
		$month_commiss = $member_model->sum_member_commiss($month_where);
		
		//累计收入
		$total_where = array();
		$total_where['member_id'] = $member_id;
		$total_where['state'] = array('neq',2);
		$total_commiss = $member_model->sum_member_commiss($total_where);
		
		//待确认收入
		$total_wait_where = array();
		$total_wait_where['member_id'] = $member_id;
		$total_wait_where['state'] = 0;
		$total_wait_commiss = $member_model->sum_member_commiss($total_wait_where);
		
		//可提现金额
		$member_commiss = M('member_commiss')->where( array('member_id' => $member_id) )->find();
		
		
		$this->today_commiss = round($today_commiss, 2);
		$this->month_commiss = round($month_commiss, 2);
		$this->total_commiss = round($total_commiss, 2);
		$this->total_wait_commiss = round($total_wait_commiss, 2);
		$can_tixian_money = 0;
		if(!empty($member_commiss)) {
			$can_tixian_money = $member_commiss['money'];
		}
		$this->can_tixian_money = round($can_tixian_money, 2);
		
		$comsiss_flag = $member_info['comsiss_flag'];
		if($member_info['comsiss_flag'] == 0)
		{
			//state
			$member_commiss_apply = M('member_commiss_apply')->where( array('member_id' =>$member_id, 'state' =>0) )
			->find();
			
			if(!empty($member_commiss_apply)) {
				$comsiss_flag = 2;
			}
		}
		$this->comsiss_flag = $comsiss_flag;
		
		$need_data = array();
		$need_data['today_commiss'] = round($today_commiss, 2);
		$need_data['month_commiss'] = round($month_commiss, 2);
		$need_data['total_commiss'] = round($total_commiss, 2);
		$need_data['total_wait_commiss'] = round($total_wait_commiss, 2);
		$need_data['can_tixian_money'] = round($can_tixian_money, 2);
		$need_data['comsiss_flag'] = $comsiss_flag;
		
		echo json_encode( array('code' =>0, 'data' => $need_data ) );
		die();
		
        //$this->display();
    }
	
	/**
		获取账单详情
	**/
	public function listorder()
	{
		$token = I('get.token');
		
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		$member_info = M('member')->where( array('member_id' => $member_id) )->find();
		
		
		
		//今日新增
		$today_begin_time = strtotime( date('Y-m-d'.' 00:00:00') );
		$today_end_time = $today_begin_time + 86400;
		$today_where = array();
		$today_where['member_id'] = $member_id;
		
		$today_where['addtime'] = array('between',$today_begin_time.','.$today_end_time);
		$today_count = M('member_commiss_order')->where( $today_where )->count();
		
		
		//昨日新增
		$yes_begin_time = $today_begin_time - 86400;
		$yes_end_time = $today_begin_time;
		
		$yes_where = array();
		$yes_where['member_id'] = $member_id;
		
		$yes_where['addtime'] = array('between',$yes_begin_time.','.$yes_end_time);
		$yes_count = M('member_commiss_order')->where( $yes_where )->count();
		
		//总订单量
		$total_where = array();
		$total_where['member_id'] = $member_id;
		$total_count = M('member_commiss_order')->where( $total_where )->count();
		
		
		
		$need_data = array();
		$need_data['today_count'] = $today_count;
		$need_data['yes_count'] = $yes_count;
		$need_data['total_count'] = $total_count;
		
		
		echo json_encode( array('code' =>0, 'data' => $need_data) );
		die();
		
		$this->display();	
	}
	
	/**
		获取账单详情列表
	**/
	public function listorder_list()
	{
		$token = I('get.token');
		
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		$member_info = M('member')->where( array('member_id' => $member_id) )->find();
		
		$per_page = 6;
	    $page = I('get.page',1);
	    
	    $offset = ($page - 1) * $per_page;
	    
	    $list = array();
		$where = '';
		$state = I('get.state',-1);
		//state
		if($state >=0)
		{
			$where = ' and mco.state = '.$state;
		}
		$commiss_level_num = C('commiss_level_num');
		
		$where = ' and mco.level <= '.$commiss_level_num;
		//$commiss_level_num = C('commiss_level_num'); level
		
		$this->state = $state;
		$sql = 'select mco.level, mco.money,mco.child_member_id,mco.addtime,mco.state,o.order_status_id,o.order_num_alias,o.total,og.goods_id,og.quantity,og.name,mco.store_id,m.uname from  '.C('DB_PREFIX')."member_commiss_order as mco , ".C('DB_PREFIX')."order_goods as og, ".C('DB_PREFIX')."order as o  , ".C('DB_PREFIX')."member as m  
			where  mco.order_id=og.order_id and mco.order_id = o.order_id and m.member_id=mco.child_member_id and mco.member_id=".$member_id." {$where} order by mco.id desc limit {$offset},{$per_page}";
		
		$list = M()->query($sql);
		
		$order_status_list = M('order_status')->select();
		$status_arr = array();
		foreach($order_status_list as $vv)
		{
			$status_arr[$vv['order_status_id']] = $vv['name'];
		}
		
		foreach($list as $key =>$val)
		{
			$val['total'] = round($val['total'],2);
			$val['money'] = round($val['money'],2);
			$val['status_name'] = $status_arr[$val['order_status_id']];
			$val['addtime'] = date('Y-m-d', $val['addtime']);
			$goods_info = M('goods')->field('image')->where( array('goods_id' => $val['goods_id']) )->find();
			$val['image']=C('SITE_URL'). resize($goods_info['image'], C('common_image_thumb_width'), C('common_image_thumb_height'));
			$list[$key] = $val;
		}
	    
	    $this->list = $list;
		
		if(empty($list))
		{
			echo json_encode( array('code' => 1) );
			die();
		}else {
			echo json_encode( array('code' => 0, 'data' => $list) );
			die();
		}
	}
	
	/**
		检测是否绑定了银行卡
	**/
	public function check_tixian()
	{
		$token = I('get.token');
		
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		$member_info = M('member')->where( array('member_id' => $member_id) )->find();
		
		$member_commiss = M('member_commiss')->where( array('member_id' => $member_id) )->find();
		
		
		if( empty($member_commiss['bankname']) || empty($member_commiss['bankaccount']) || empty($member_commiss['bankusername']))
		{
			
			echo json_encode( array('code' =>0) );
			die();
		}else{
			echo json_encode( array('code' => 1) );
			die();
		}
		
	}
	
	/**
		获取用户佣金信息
	**/
	public function get_tixian_info()
	{
		$token = I('get.token');
		
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		$limit_money =  C('commiss_money_limit');
		$member_info = M('member')->where( array('member_id' => $member_id) )->find();
		
		$member_commiss = M('member_commiss')->where( array('member_id' => $member_id) )->find();
		
		$member_commiss['limit_money'] = $limit_money;
		echo json_encode( array('code' =>0,'data' => $member_commiss) );
		die();
	}
	
	/**
		绑定银行卡
	**/
	public function bindcard()
	{
		$token = I('get.token');
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		
		$data_json = file_get_contents('php://input');		
		$datas = json_decode($data_json, true);
		
		$bankusername = $datas['bankusername'];//I('post.bankusername','','htmlspecialchars');
		$bankname = $datas['bankname'];//I('post.bankname','','htmlspecialchars');
		$bankaccount = $datas['bankaccount'];//I('post.bankaccount','','htmlspecialchars');
		
		$data = array();
		$data['bankusername'] = $bankusername;
		$data['bankname'] = $bankname;
		$data['bankaccount'] = $bankaccount;
		
		M('member_commiss')->where( array('member_id' => $member_id) )->save($data);
		
		echo json_encode( array('code' => 0) );
		die();
	}
	
	public function tixian_sub()
	{
		$token = I('get.token');
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		$member_info = M('member')->where( array('member_id' => $member_id) )->find();
		
		
		$result = array('code' => 1,'msg' => '提现失败');
		$member_commiss = M('member_commiss')->where( array('member_id' => $member_id) )->find();
		
		$data_json = file_get_contents('php://input');		
		$datas = json_decode($data_json, true);
		
		$money = $datas['money'];//I('post.money',0,'floatval');
		
		
		$commiss_money_limit = C('commiss_money_limit');
			
		if(!empty($commiss_money_limit) && $commiss_money_limit >0)
		{
			if($member_commiss['money'] < $commiss_money_limit)
			{
				$result['msg'] = '佣金满'.$commiss_money_limit.'才能提现';
				echo json_encode($result);
				die();
			}
		}
			
		if($money > 0 && $money <= $member_commiss['money'])
		{
			$data = array();
			$data['member_id'] = $member_id;
			$data['money'] = $money;
			$data['state'] = 0;
			$data['shentime'] = 0;
			$data['addtime'] = time();
			
			M('tixian_order')->add($data);
			
			$com_arr = array();
			$com_arr['money'] = $member_commiss['money'] - $money;
			$com_arr['dongmoney'] = $member_commiss['dongmoney'] + $money;
			
			M('member_commiss')->where( array('member_id' => $member_id) )->save($com_arr);
			
			$result['code'] = 0;
		} 
		echo json_encode($result);
		die();
	}
	
	/**
		提现记录
	**/
	public function tixian_record()
	{
		$token = I('get.token');
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		$member_info = M('member')->where( array('member_id' => $member_id) )->find();
		
		
		$per_page = 5;
		$page = I('get.page',1);
		
		$offset = ($page - 1) * $per_page;
		
		$list = array();
		
		$sql = "select * from ".C('DB_PREFIX')."tixian_order  
		where member_id=".$member_id." order by addtime desc limit {$offset},{$per_page}";
		$list = M()->query($sql);
		
		foreach($list as $key => $val)
		{
			$val['addtime'] = date('Y-m-d', $val['addtime']);
			$list[$key] = $val;
		}
		
		if( !empty($list) )
		{
			echo json_encode( array('code' =>0, 'data'=>$list) );
			die();
		}else{
			echo json_encode( array('code' => 1) );
			die();
		}
	}
	
	public function cons_member_common($member_id)
	{
		$member_common = array('member_id'=>$member_id,'qrcode_img' => '');
		M('member_common')->add($member_common);
		return $member_common;
	}
	/**
		团长二维码
	**/
	public function qrcode()
	{
		$member_common = M('member_common')->where( array('member_id' => UID) )->find();
		if(empty($member_common))
		{
			$member_common  = $this->cons_member_common(UID);
		}
		
		$is_tan = 1;
		
		$hashids = new \Lib\Hashids(C('PWD_KEY'), C('URL_ID'));
		$member_id = UID;
		$hash_member_id = $hashids->encode($member_id);
		
		$url = C('SITE_URL')."index.php?s=/index/index/rmid/{$hash_member_id}";
		
		if(empty($member_common['qrcode_img']))
		{
			$content = $url;
			$target  = C('SITE_URL').'Uploads/image/'.C('user_qrcode_image');
			
			$user_qrcodebg_x = C('user_qrcode_x');
			$user_qrcodebg_y = C('user_qrcode_y');
			if(empty($user_qrcodebg_x))
			{
				$user_qrcodebg_x = 0;
			}
			if(empty($user_qrcodebg_y))
			{
				$user_qrcodebg_y = 0;
			}

			$new_image = get_compare_qrcode($content,$target,$user_qrcodebg_x,$user_qrcodebg_y);
			
			$uarray = array( 'qrcode_img'=>$new_image);
			
			M('member_common')->where( array('member_id' => $member_id) )->save($uarray);
			
			$member_common['qrcode_img'] = $new_image;
			cookie('qrcode_tan', 1);
		} else {
			$tan_time = cookie('qrcode_tan'); 
			if(empty($tan_time))
			{
				cookie('qrcode_tan', 1);
			}else 
			{
				cookie('qrcode_tan', $tan_time+1);
				if($tan_time >=2)
				{
					$is_tan = 2;
				}
			}
			$new_image = $login_user['qrcode'];
		}
		
		$this->member_common = $member_common;
		$this->display();
		
	}
	
	function tuanyuan()
	{
		$token = I('get.token');
		$weprogram_token = M('weprogram_token')->field('member_id')->where( array('token' =>$token) )->find();
		
	    $member_id = $weprogram_token['member_id'];
		$member_info = M('member')->where( array('member_id' => $member_id) )->find();
		
		$per_page = 6;
	    $page = I('get.page',1);
	    
	    $offset = ($page - 1) * $per_page;
		//type 1 2 3 
		$type = I('get.type',1);
	    //6
		
	    $list = array();
		
		if($type == 1)
		{
			$sql = 'select * from  '.C('DB_PREFIX')."member  
				where share_id = ".$member_id." order by member_id desc limit {$offset},{$per_page}";
			
			
			$list = M()->query($sql);
			//var_dump($list, $sql);die();
		}else if( $type ==2 ){
			
			$sql = 'select member_id from  '.C('DB_PREFIX')."member  
				where share_id = ".$member_id;
			$first_list = M()->query($sql);
			
			$list = array();
			if( !empty($first_list) )
			{
				$ids_arr = array();
				foreach( $first_list as $val )
				{
					$ids_arr[] = $val['member_id'];
				}
				$ids_str = implode(',', $ids_arr);
				
				$sql = 'select * from  '.C('DB_PREFIX')."member  
					where share_id in (".$ids_str.") order by member_id desc limit {$offset},{$per_page}";
				$list = M()->query($sql);
			}
			
			
		} else if( $type ==3 ){
			$sql = 'select member_id from  '.C('DB_PREFIX')."member  
				where share_id = ".$member_id;
			$first_list = M()->query($sql);
			
			$list = array();
			if( !empty($first_list) )
			{
				$ids_arr = array();
				foreach( $first_list as $val )
				{
					$ids_arr[] = $val['member_id'];
				}
				$ids_str = implode(',', $ids_arr);
				
				$sql = 'select member_id from  '.C('DB_PREFIX')."member  
					where share_id in (".$ids_str.") ";
				$second_list = M()->query($sql);
				
				if( !empty($second_list) )
				{
					$ids_arr = array();
					foreach( $second_list as $val )
					{
						$ids_arr[] = $val['member_id'];
					}
					$ids_str = implode(',', $ids_arr);
					
					$sql = 'select * from  '.C('DB_PREFIX')."member  
					where share_id in (".$ids_str.") order by member_id desc limit {$offset},{$per_page}";
					$list = M()->query($sql);
				}
				
			}
		}
		
		//{$member_info.uname}
		foreach($list as $key => $val)
		{
			$parent_name = M('member')->field('name')->where( array('member_id' => $val['share_id']) )->find();
			$val['parent_name'] = $parent_name['name'];
			$val['create_time'] = date('Y-m-d H:i:s', $val['create_time']);
			$list[$key] = $val;
		}
		
		if( empty($list) )
		{
			echo json_encode( array('code' => 1) );
			die();
		} else{
			echo json_encode( array('code' =>0 , 'data' => $list) );
			die();
		}
		
	}
	
	public function yongjing()
	{
		$per_page = 10;
	    $page = I('get.page',1);
		$gid = I('get.gid',0);
		
	    $offset = ($page - 1) * $per_page;
	    
		$where = "";
		
		//danprice pin_price
		if( !empty($gid) && $gid >0 )
		{
			$goods_ids_arr = M('goods_to_category')->where("class_id1 ={$gid} or class_id2 ={$gid} or class_id3 = {$gid}  ")->field('goods_id')->select();
			
			$ids_arr = array();
			foreach($goods_ids_arr as $val){
				$ids_arr[] = $val['goods_id'];
			}
			$ids_str = implode(',',$ids_arr);
			
			if( !empty($ids_str) )
			{
				$where .= " and a.goods_id in ({$ids_str}) ";
				//a.goods_id
			} 
		}
		
		$sql = " SELECT a.goods_id,a.name,a.quantity,a.danprice,b.pin_price,a.commiss_one_dan_disc,( b.commiss_one_pin_disc * b.pin_price ) as pin_yong_money,( a.commiss_one_dan_disc * a.danprice ) as dan_yong_money, a.price,a.image   
		FROM ".C('DB_PREFIX')."goods as a left join ".C('DB_PREFIX')."pin_goods as b on a.goods_id = b.goods_id  WHERE  (a.commiss_one_dan_disc >0 or b.commiss_one_pin_disc >0)  and a.status = 1 {$where} and a.quantity >0 order by dan_yong_money desc, pin_yong_money desc 
		limit {$offset},{$per_page}";
	    /**
		$sql = 'select g.goods_id,g.name,g.quantity,g.pinprice,g.commiss_one_pin_disc,( g.pinprice * g.commiss_one_pin_disc ) as yong_money, g.price,g.image from  '.C('DB_PREFIX')."goods as g 
		
	        where  g.status =1 and g.quantity > 0 and g.commiss_one_pin_disc >0   order by yong_money desc  limit {$offset},{$per_page}";
	    **/
		$list = M()->query($sql);
		
		foreach ($list as $k => $v) {
		    $v['image']=C('SITE_URL'). resize($v['image'], C('spike_thumb_width'), C('spike_thumb_height'));
			
			$pin_yong_money = round( $v['pin_yong_money'] /100 , 2);
			$dan_yong_money = round( $v['dan_yong_money'] /100 , 2);
			
			if( $pin_yong_money > $dan_yong_money )
			{
				$v['yong_money'] = $pin_yong_money;
				$v['price'] = $v['pin_price'];
			} else {
				$v['yong_money'] = $dan_yong_money;
				$v['price'] = $v['danprice'];
			}
			//"danprice":"0.04","pin_price":"0.01",
		    $list[$k] = $v;
		}
		
		if( empty($list) )
		{
			echo json_encode( array('code' => 1) );
			die();
		} else {
			echo json_encode( array('code' =>0, 'data' => $list) );
			die();
		}
		
		/**
		SELECT a.goods_id, a.commiss_one_dan_disc, b.commiss_one_pin_disc  
		FROM `oscshop_goods` as a left join oscshop_pin_goods as b on a.goods_id = b.goods_id  WHERE  a.commiss_one_dan_disc >0  and a.status = 1 and a.quantity >0 order by a.goods_id desc
		**/
	}
	
}