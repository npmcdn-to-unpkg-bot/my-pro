<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"> <i class="fa fa-info-sign"></i>
					</span>
					<h5>修改菜单</h5>
				</div>
				<div class="widget-content nopadding">
					<form class="form-horizontal" method="post" action="__ROOT__/{$Think.CONTROLLER_NAME}/modify" name="admin" id="admin_validate">
						<div class="control-group">
							<label class="control-label">姓名</label>
							<div class="controls">
								<input type="text" name="NAME" id="NAME"  class="span5" placeholder="请输入管理员真实姓名（必填）" value="{$data[0]['name']}"/>
							</div>
						</div>
						
						<div class="control-group">
			              <label class="control-label">性别</label>
			              <div class="controls">
			                <label class="fl span2">
			                  <input type="radio" name="SEX" value="00A" <if condition="$data[0]['sex'] eq '00A'">checked="checked"</if> />
			                  男
			                </label>
			                <label class="fl">
			                  <input type="radio" name="SEX" value="00B" <if condition="$data[0]['sex'] eq '00B'">checked="checked"</if> />
			                  女
			                </label>
			              </div>
			            </div>
			            
			            <if condition="$Think.session.adminType eq '00A'">
			            <div class="control-group">
			              <label class="control-label">管理员类型</label>
			              <div class="controls">
			                <label class="fl span2">
			                  <input type="radio" name="ADMIN_TYPE" value="00B" <if condition="$data[0]['admin_type'] eq '00B'">checked="checked"</if> />
			                  普通管理员
			                </label>
			                <label class="fl">
			                  <input type="radio" name="ADMIN_TYPE" value="00A" <if condition="$data[0]['admin_type'] eq '00A'">checked="checked"</if> />
			                  超级管理员
			                </label>
			              </div>
			            </div>
			            </if>
			            <div class="control-group">
							<label class="control-label">管理员角色</label>
							<div class="controls">
								<select  name="ROLE_ID" id="ROLE_ID" class="span5">
									<option value="NULL">请选择角色</option>
									<volist name="rData" id="vo">
									<option value="{$vo.id}" <if condition="$vo.id eq $rid">selected="selected" </if>>{$vo.role_name}</option>
									</volist>
								</select>
							</div>
						</div>
			            <div class="control-group">
							<label class="control-label">联系电话</label>
							<div class="controls">
								<input type="text" name="TEL_PHONE" id="TEL_PHONE"  class="span5" placeholder="请输入手机号码（必填）" value="{$data[0]['tel_phone']}"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Email</label>
							<div class="controls">
								<input type="text" name="EMAIL" id="EMAIL" class="span5" placeholder="请输入合法邮箱" value="{$data[0]['email']}"/>
							</div>
						
						<input type="hidden" name="m_id" value="{:I('m_id')}" /> 
						<input type="hidden" name="p_id" value="{:I('p_id')}" /> 
						<input type="hidden" name="id" value="{$data[0]['id']}" />
						<div class="form-actions">
							<button type="submit" value="确定" class="btn btn-success fa fa-save"> 确定</button>
							<button type="reset" class="btn btn-primary fa fa-edit"> 重置</button>
							<button type="button" class="btn btn-danger fa fa-reply" onclick="javascript:window.location='__ROOT__/{$Think.CONTROLLER_NAME}/show/m_id/{:I('m_id')}/p_id/{:I('p_id')}'"> 返回</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

</div>