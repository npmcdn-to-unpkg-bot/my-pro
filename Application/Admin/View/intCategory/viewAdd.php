
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"> <i class="fa fa-info-sign"></i>
					</span>
					<h5>新增接口分类</h5>
				</div>
				<div class="widget-content nopadding">
					<form class="form-horizontal" method="post" action="__ROOT__/{$Think.CONTROLLER_NAME}/add" name="category" id="category_validate" novalidate="novalidate">
						<div class="control-group">
							<label class="control-label">接口分类名称</label>
							<div class="controls">
								<input type="text" class="span5" name="category_name" id="category_name" placeholder="请输入接口分类名称(必填)" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">父分类</label>
							<div class="controls">
								<select  name="pid" id="pid" class="span5">
									<option value="none">我就是父分类</option>
									<volist name="main_category" id="vo">
									<option value="{$vo.id}/{$vo.name}" sele>{$vo.name}</option>
									</volist>
								</select>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">排序</label>
							<div class="controls">
								<input type="text" name="sort" id="sort" class="span5" placeholder="请输入菜单排序（越大越前，必填）"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">分类描述</label>
							<div class="controls">
								<textarea  name="discription" id="discription" class="span11" placeholder="请输入分类描述" ></textarea>
							</div>
						</div>

						<input type="hidden" name="m_id" value="{:I('m_id')}" /> <input
							type="hidden" name="p_id" value="{:I('p_id')}" />
						<div class="form-actions">
							<button type="submit" class="btn btn-success fa fa-save"> 确定</button>
							<button type="reset" class="btn btn-primary fa fa-edit"> 重置</button>
							<button type="button" class="btn btn-danger fa fa-reply" onclick="javascript:window.location='__ROOT__/{$Think.CONTROLLER_NAME}/viewList/m_id/{:I('m_id')}/p_id/{:I('p_id')}'"> 返回</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

</div>

