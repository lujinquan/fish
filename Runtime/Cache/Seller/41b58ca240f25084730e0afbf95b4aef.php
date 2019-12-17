<?php if (!defined('THINK_PATH')) exit();?> <form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data">
     <input type="hidden" name="id" value="<?php echo ($group['id']); ?>" />

    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title"><?php if( !empty($group['id'])){ ?>编辑<?php  }else{ ?>添加<?php } ?>标签组</h4>
                </div>
                <div class="modal-body">
					<div class="form-group">
                        <label class="col-sm-2 control-label must">等级</label>
                        <div class="col-sm-9 col-xs-12">
							<select name="level" class="form-control">
								<option value="1" <?php if( !empty($group['level']) && $group['level'] == 1){ ?> selected<?php } ?>>1</option>
								<option value="2" <?php if( !empty($group['level']) && $group['level'] == 2){ ?> selected<?php } ?>>2</option>
								<option value="3" <?php if( !empty($group['level']) && $group['level'] == 3){ ?> selected<?php } ?>>3</option>
								<option value="4" <?php if( !empty($group['level']) && $group['level'] == 4){ ?> selected<?php } ?>>4</option>
								<option value="5" <?php if( !empty($group['level']) && $group['level'] == 5){ ?> selected<?php } ?>>5</option>
								<option value="6" <?php if( !empty($group['level']) && $group['level'] == 6){ ?> selected<?php } ?>>6</option>
								<option value="7" <?php if( !empty($group['level']) && $group['level'] == 7){ ?> selected<?php } ?>>7</option>
								<option value="8" <?php if( !empty($group['level']) && $group['level'] == 8){ ?> selected<?php } ?>>8</option>
								<option value="9" <?php if( !empty($group['level']) && $group['level'] == 9){ ?> selected<?php } ?>>9</option>
								<option value="10" <?php if( !empty($group['level']) && $group['level'] == 10){ ?> selected<?php } ?>>10</option>
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label must">等级名称</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" name="levelname" class="form-control" value="<?php echo ($group['levelname']); ?>" data-rule-required="true" />
                        </div>
						
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label must">等级折扣</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" name="discount" class="form-control" value="<?php echo ($group['discount']); ?>" data-rule-required="true" />
							<div class="help-block">请输入1~100之间的数字,值为空代表不设置折扣. 例如：填写80，即为打8折，会员价=商品价格*80%</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label must">等级升级金额</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" name="level_money" class="form-control" value="<?php echo ($group['level_money']); ?>" data-rule-required="true" />
                        </div>
                    </div>
                   

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">提交</button>
                    <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                </div>
            </div>
    </div>
</form>