<?php if (!defined('THINK_PATH')) exit();?>    <form action="<?php if( empty($level['id'])){ echo U('communityhead/addlevel'); }else{ echo U('communityhead/editlevel'); } ?>" method="post"  class="form-horizontal form-validate" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo ($level['id']); ?>" />

	  <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title"><?php if( !empty($level['id'])){ ?>编辑<?php  }else{ ?>添加<?php } ?>团长等级</h4>
            </div>
			
			
            <div class="modal-body">
				<?php if( $has_notice == 0){ ?>
				 <div class="form-group">
					<label class="col-sm-9 control-label " style="color:red;">此操作将启用等级全局提成，原商品比例失效，可到商品编辑“等级/分销”单独设置</label>
				 </div>
				 <?php } ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label must">等级名称</label>
                    <div class="col-sm-9 col-xs-12">
						
                        <input type="text" name="levelname" class="form-control" value="<?php echo ($level['levelname']); ?>" data-rule-required='true'/>
						
                    </div>
                </div>
               
			    
			   <?php if(!empty($community_money_type) && $community_money_type ==1){ ?>
			   <div class="form-group">
					 <label class="col-sm-2 control-label">团长提成金额</label>
					  <div class="col-sm-9 col-xs-12">
							<div class='input-group'>
						<input type="text" name="commission" class="form-control" value="<?php echo ($level['commission']); ?>" />
							<div class='input-group-addon'>元</div>
						</div>
						
					</div>
                </div>
			   <?php  }else{ ?>
                <div class="form-group">
					 <label class="col-sm-2 control-label">团长提成比例</label>
					  <div class="col-sm-9 col-xs-12">
							<div class='input-group'>
						<input type="text" name="commission" class="form-control" value="<?php echo ($level['commission']); ?>" />
							<div class='input-group-addon'>%</div>
						</div>
						
					</div>
                </div>
               <?php } ?>
				<?php if( $level['id']!='default'){ ?>
				<div class="form-group">
					 <label class="col-sm-2 control-label">团长自动升级</label>
					  <div class="col-sm-9 col-xs-12">
						<label class='radio-inline'>
		                    <input type='radio' name='auto_upgrade'  value='0' <?php if( empty($level) || $level['auto_upgrade'] ==0 ){ ?>checked <?php } ?> title="关闭" />关闭
		                </label>
		                <label class='radio-inline'>
		                    <input type='radio' name='auto_upgrade'  value='1' <?php if( !empty($level) && $level['auto_upgrade'] ==1 ){ ?>checked <?php } ?> title="开启" /> 开启
		                </label>
					 </div>
                </div>
				<div class="form-group" id="auto_condition" <?php if( empty($level) || $level['auto_upgrade'] ==0 ){ ?> style="display:none;" <?php } ?>>
					 <label class="col-sm-2 control-label">自动升级条件</label>
					  <div class="col-sm-9 col-xs-12">
						<label class='radio-inline'>
		                    <input type='radio' name='condition_type'  value='0' <?php if( empty($level) || $level['condition_type'] ==0 ){ ?>checked <?php } ?> title="" /> 订单总金额
		                </label>
		                <label class='radio-inline'>
		                    <input type='radio' name='condition_type'  value='1' <?php if( !empty($level) && $level['condition_type'] ==1 ){ ?>checked <?php } ?> title="" /> 累计社区用户
		                </label>
					 </div>
                </div>
				<div class="form-group" id="condition_one" <?php if( (!empty($level) && $level['auto_upgrade'] ==1) && (empty($level) || $level['condition_type'] ==0) ){ ?> style="display:block;"<?php }else{ ?> style="display:none;"<?php } ?> >
					 <label class="col-sm-2 control-label">订单总金额</label>
					  <div class="col-sm-9 col-xs-12">
						<div class='input-group'>
							<input type="text" name="condition_one" class="form-control" value="<?php echo ($level['condition_one']); ?>" />
							<div class='input-group-addon'>元</div>
						</div>
						<div class="help-block">累计社区用户完成订单总金额</div>
					</div>
                </div>
				<div class="form-group" id="condition_two" <?php if( (!empty($level) && $level['auto_upgrade'] ==1) && (!empty($level) && $level['condition_type'] ==1) ){ ?> style="display:block;"<?php }else{ ?> style="display:none;"<?php } ?> >
					 <label class="col-sm-2 control-label">累计社区用户</label>
					  <div class="col-sm-9 col-xs-12">
						<div class='input-group'>
							<input type="text" name="condition_two" class="form-control" value="<?php echo ($level['condition_two']); ?>" />
							<div class='input-group-addon'>人</div>
						</div>
						<div class="help-block">累计社区用户数量</div>
					</div>
                </div>
				<?php } ?>
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">提交</button>
                <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
            </div>
        </div>
</form>

<script>
  
  $(function(){
	$('input[name=auto_upgrade]').click(function(){
		var s_val = $(this).val();
		if(s_val == 0)
		{
			$('#auto_condition').hide();
			$('#condition_one').hide();
			$('#condition_two').hide();
			
		}else{
			$('#auto_condition').show();
			var sc_val = $('input[name=condition_type]:checked').val();
			if(sc_val == 0)
			{
				$('#condition_one').show();
				$('#condition_two').hide();
			}else{
				$('#condition_one').hide();
				$('#condition_two').show();
			}
			
		}
	})
	
	$('input[name=condition_type]').click(function(){
	
		var s_val = $(this).val();
		if(s_val == 0)
		{
			$('#condition_one').show();
			$('#condition_two').hide();
		}else{
			$('#condition_one').hide();
			$('#condition_two').show();
		}
	
	})
	
  })
 


</script>