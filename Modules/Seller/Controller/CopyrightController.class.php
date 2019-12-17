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
 *
 */
namespace Seller\Controller;

class CopyrightController extends CommonController{
	
	protected function _initialize(){
		parent::_initialize();
		
	}
	
	public function account()
	{
		//parameter[s_uname]
		//parameter[s_passwd]
		
		$info = M('seller')->where( array('s_id' => SELLERUID) )->find();	
		if(IS_POST){
			$model=D('Admin/Seller');  
			$data=I('post.parameter');
			
			$data['s_id'] = SELLERUID;
			
			
			$return=$model->edit_seller_user($data);
			
			show_json(1, array('url' => $_SERVER['HTTP_REFERER']));
		}
		
		$this->info = $info;
		$this->display();
	}
	public function index()
	{
		
		if (IS_POST) {
			$data = I('request.parameter');
			
			$data = $data;
			$data['footer_copyright_desc'] = trim($data['footer_copyright_desc']);
			
			$data['footer_copyright_logo'] = save_media($data['footer_copyright_logo']);
			$data['footer_copyright_url'] = trim($data['footer_copyright_url']);
			$data['footer_copyright_dialing'] = trim($data['footer_copyright_dialing']);
			$data['footer_copyright_tel'] = trim($data['footer_copyright_tel']);
			
			D('Seller/Config')->update($data);

			// 更新缓存 Author Lucas 2019-12-17
			D('Seller/Config')->get_all_config(true);
			
			
			show_json(1, array('url' => $_SERVER['HTTP_REFERER']));
		}
		$data = D('Seller/Config')->get_all_config();
		$this->data = $data;
		
		$this->display();
	}
	
	public function about()
	{
		$_GPC = I('request.');
		
		if (IS_POST) {
			
			$data = ((is_array($_GPC['parameter']) ? $_GPC['parameter'] : array()));
			$data['personal_center_about_us'] = trim($data['personal_center_about_us']);
			$data['is_show_about_us'] = trim($data['is_show_about_us']);
			
			
			D('Seller/Config')->update($data);

			// 更新缓存 Author Lucas 2019-12-17
			D('Seller/Config')->get_all_config(true);
			
			
			show_json(1, array('url' => $_SERVER['HTTP_REFERER']));
		}
		$data = D('Seller/Config')->get_all_config();
		
		$this->data = $data;
		$this->display();
	}

	public function ordericon()
	{
		$_GPC = I('request.');
		
		if (IS_POST) {
			
			$data = ((is_array($_GPC['parameter']) ? $_GPC['parameter'] : array()));
			$param = array();
			$param['user_order_menu_icons'] = array();
			$param['user_order_menu_icons']['i1'] = trim($data['user_order_menu_icon1']);
			$param['user_order_menu_icons']['i2'] = trim($data['user_order_menu_icon2']);
			$param['user_order_menu_icons']['i3'] = trim($data['user_order_menu_icon3']);
			$param['user_order_menu_icons']['i4'] = trim($data['user_order_menu_icon4']);
			$param['user_order_menu_icons']['i5'] = trim($data['user_order_menu_icon5']);
			$param['user_order_menu_icons'] = serialize($param['user_order_menu_icons']);

			D('Seller/Config')->update($param);

			// 更新缓存 Author Lucas 2019-12-17
			D('Seller/Config')->get_all_config(true);
			
			show_json(1, array('url' => $_SERVER['HTTP_REFERER']));
		}
		$data = D('Seller/Config')->get_all_config();

		if(!is_array($data['user_order_menu_icons'])) $data['user_order_menu_icons'] = unserialize($data['user_order_menu_icons'] );
		
		$this->data = $data;
		
		$this->display();
	}
	
	
	
	public function icon()
	{
		$_GPC = I('request.');
		
		if (IS_POST) {
			
			$data = ((is_array($_GPC['parameter']) ? $_GPC['parameter'] : array()));
			
			$param = array();
			$param['user_order_menu_icons'] = array();
			$param['user_order_menu_icons']['i1'] = trim($data['user_order_menu_icon1']);
			$param['user_order_menu_icons']['i2'] = trim($data['user_order_menu_icon2']);
			$param['user_order_menu_icons']['i3'] = trim($data['user_order_menu_icon3']);
			$param['user_order_menu_icons']['i4'] = trim($data['user_order_menu_icon4']);
			$param['user_order_menu_icons']['i5'] = trim($data['user_order_menu_icon5']);
			$param['user_order_menu_icons'] = serialize($param['user_order_menu_icons']);

			$param['user_tool_icons'] = array();
			$param['user_tool_icons']['i1'] = trim($data['user_tool_icon1']);
			$param['user_tool_icons']['i2'] = trim($data['user_tool_icon2']);
			$param['user_tool_icons']['i3'] = trim($data['user_tool_icon3']);
			$param['user_tool_icons']['i4'] = trim($data['user_tool_icon4']);
			$param['user_tool_icons']['i5'] = trim($data['user_tool_icon5']);
			$param['user_tool_icons']['i6'] = trim($data['user_tool_icon6']);
			$param['user_tool_icons']['i7'] = trim($data['user_tool_icon7']);
			$param['user_tool_icons']['i8'] = trim($data['user_tool_icon8']);
			$param['user_tool_icons']['i9'] = trim($data['user_tool_icon9']);
			$param['user_tool_icons'] = serialize($param['user_tool_icons']);

			D('Seller/Config')->update($param);

			// 更新缓存 Author Lucas 2019-12-17
			D('Seller/Config')->get_all_config(true);
			
			show_json(1, array('url' => $_SERVER['HTTP_REFERER']));
		}
		$data = D('Seller/Config')->get_all_config();

		if(!is_array($data['user_order_menu_icons'])) $data['user_order_menu_icons'] = unserialize($data['user_order_menu_icons'] );
		if(!is_array($data['user_tool_icons'])) $data['user_tool_icons'] = unserialize($data['user_tool_icons'] );
		
		$this->data = $data;
		
		$this->display();
	}
	
}
?>