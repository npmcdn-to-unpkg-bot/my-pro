
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">

			<div class="widget-box">
				<div class="widget-title" style="padding: 5px">
					<div class="fl" style="margin-right: 10px;">
						<input type="text" id="NAME" class="span11 searchItems" placeholder="分类名称" value="" />
					</div>
					<button type="button" class="btn fa fa-search search_com">搜索</button>
					<a href="#mySearch" data-toggle="modal"><button class="btn fa fa-filter">高级检索</button></a>
					<button class="btn btn-danger  fr fa fa-trash" onclick="javascript:deleteItems();">删除</button>
					<a href="__ROOT__/{$Think.CONTROLLER_NAME}/viewAdd/m_id/{:I('m_id')}/p_id/{:I('p_id')}"><button class="btn btn-success  fr fa fa-plus">新增</button></a>
				</div>
				<div class="widget-content nopadding">
					<table class="table table-bordered  table-striped with-check">
						<thead>
							<tr>
								<th><input type="checkbox" id="title-checkbox" name="title-checkbox" /></th>
								<th width="20%">分类名称</th>
								<th width="8%">分类类型</th>
								<th width="20%">父级分类</th>
								<th width="30%">分类描述</th>
								<th width="8%">分类排序</th>
								<th width="15%">创建时间</th>
								<th width="10%">操作</th>
							</tr>
						</thead>
						<tbody>
							<volist name="list" id="vo">
							<tr>
								<td><input type="checkbox" name="checkBoxItems" value="{$vo.id}" /></td>
								<td>{$vo.name}</td>
								<td><if condition="$vo.pid eq ''">父级分类<elseif
										condition="$vo.pid neq ''" />子分类</if></td>
								<td>{$vo.pname}</td>
								<td title="{$vo.discription}">
								<?php 
								if(20 > strlen($vo['discription']))
									echo $vo['discription'];
								else
									echo msubstr($vo['discription'],0,20,"utf-8",true);
								?>
								</td>
								<td>{$vo.sort}</td>
								<td>{$vo.create_time}</td>
								<td>
									<div class="btn-group">
										<button data-toggle="dropdown" class="btn btn-mini dropdown-toggle ">
											单项操作<span class="caret"></span>
										</button>
										<ul class="dropdown-menu">
											<li><a
												href="__ROOT__/{$Think.CONTROLLER_NAME}/viewModify/m_id/{:I('m_id')}/p_id/{:I('p_id')}/id/{$vo.id}" class="fa fa-edit"> 修改</a></li>
											<li class="divider"></li>
											<li><a href="#myAlert" data-toggle="modal" onclick="javascript:deleteItem(0 , '{$vo.id}');" class="fa fa-trash"> 删除</a></li>
										</ul>
									</div>
								</td>
							</tr>
							</volist>
						</tbody>
					</table>
				</div>

				<!-- 确认删除弹出框 begin -->
				<div id="myAlert" class="modal hide">
					<div class="modal-header">
						<button data-dismiss="modal" class="close" type="button">×</button>
						<h3>温馨提示</h3>
					</div>
					<div class="modal-body">
						<p>确认删除本条记录？</p>
						<input type="hidden" id="deleteId" value="" />
					</div>
					<div class="modal-footer">
						<a class="btn btn-primary" href="#"
							onclick="javascript:deleteItem(1 , '');">确认</a> <a
							data-dismiss="modal" class="btn" href="#">取消</a>
					</div>
				</div>
				<!-- 确认搜索弹出框 begin -->

				<!-- 高级搜索弹出框 begin -->
				<div id="mySearch" class="modal hide">
					<div class="modal-header">
						<button data-dismiss="modal" class="close" type="button">×</button>
						<h3>高级检索</h3>
					</div>
					<div class="modal-body">
						<form action="__ROOT__/{$Think.CONTROLLER_NAME}/viewList/" method="get" id="searchFrom" class="form-horizontal">
							<div class="control-group">
								<label class="control-label">分类名称</label>
								<div class="controls">
									<input type="text" name="NAME" id="NAME_AD" class="span11" placeholder="分类名称" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">分类类型</label>
								<div class="controls">
									<label class="fl span4"> <input type="radio" name="PID" value="IS NULL" /> 父级分类</label>
									<label class="fl"> <input type="radio" name="PID" value="IS NOT NULL" /> 子分类</label>
								</div>
							</div>
							<input type="hidden" name="m_id" value="{:I('m_id')}" /> 
							<input type="hidden" name="p_id" value="{:I('p_id')}" />
						</form>
					</div>
					<div class="modal-footer">
						<a class="btn btn-primary search-btu" href="#" id="search_ad">确认</a>
						<a data-dismiss="modal" class="btn" href="#">取消</a>
					</div>
				</div>
				<!-- 高级搜索弹出框 end -->
			</div>
			<!-- 分页数据展示 begin -->
			<div class="pagination fr">{$pageData}</div>
			<!-- 分页数据展示 end -->

		</div>
	</div>
</div>
<script type="text/javascript">
	var deleteUrl = "__ROOT__/{$Think.CONTROLLER_NAME}/delete/";
	var mid = "{:I('m_id')}";
	var pid = "{:I('p_id')}";
</script>