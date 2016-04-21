
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"> <i class="fa fa-info-sign"></i>
					</span>
					<h5>新增角色</h5>
				</div>
				<div class="widget-content nopadding">
					<form class="form-horizontal" method="post" action="__ROOT__/{$Think.CONTROLLER_NAME}/add" name="admin" id="roles_validate" >
						<div class="control-group">
							<label class="control-label">角色名称</label>
							<div class="controls">
								<input type="text" name="ROLE_NAME" id="ROLE_NAME"  class="span5" placeholder="请输入角色名称（必填）" />
							</div>
						</div>
						<div class="control-group">
			              <label class="control-label">角色类型</label>
			              <div class="controls">
			                <label class="fl span2">
			                  <input type="radio" name="ROLE_TYPE" value="00A" checked="checked"/>
			                  普通角色
			                </label>
			                <label class="fl">
			                  <input type="radio" name="ROLE_TYPE" value="00B"/>
			                  超级管理员角色
			                </label>
			              </div>
			            </div>
						<input type="hidden" name="m_id" value="{:I('m_id')}" /> <input
							type="hidden" name="p_id" value="{:I('p_id')}" />
						<div class="form-actions">
							<button type="submit" class="btn btn-success fa fa-save"> 确定</button>
							<button type="reset" class="btn btn-primary fa fa-edit"> 重置</button>
							<button type="button" class="btn btn-danger fa fa-reply" onclick="javascript:window.location='__ROOT__/{$Think.CONTROLLER_NAME}/show/m_id/{:I('m_id')}/p_id/{:I('p_id')}'"> 返回</button>
						</div>
					</form>
				</div>
				
				</div>
			</div>
		</div>
	</div>
</div>


