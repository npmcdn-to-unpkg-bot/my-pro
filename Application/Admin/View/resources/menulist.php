
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">

			<div class="widget-box">
				<div class="widget-title" style="padding:5px">
				<div class="fl" style="margin-right:10px;">
					<input type="text" id="MENU_NAME" class="span11 searchItems" placeholder="菜单名称" value=""/>
				</div>
				<button type="button" class="btn fa fa-search search_com font-size-15"> 搜索</button>
				<a href="#mySearch" data-toggle="modal"><button class="btn fa fa-filter font-size-15"> 高级检索</button></a>
		            <button class="btn btn-danger  fr fa fa-trash" onclick="javascript:deleteItems();"> 删除菜单</button>
					<a href="__ROOT__/{$Think.CONTROLLER_NAME}/menuadd/m_id/{:I('m_id')}/p_id/{:I('p_id')}" ><button class="btn btn-success  fr fa fa-plus"> 新增菜单</button></a>
				</div>
				<div class="widget-content nopadding">
					<table class="table table-bordered  table-striped with-check">
						<thead>
							<tr>
								<th><input type="checkbox" id="title-checkbox"	name="title-checkbox" /></th>
								<th width="20%">菜单名称</th>
								<th width="15%">父菜单名称</th>
								<th width="15%">URI</th>
								<th width="16%">菜单排序</th>
								<th width="13%">菜单ICON</th>
								<th width="15%">创建时间</th>
								<th width="10%">操作</th>
							</tr>
						</thead>
						<tbody>
							<volist name="list" id="vo">
							<tr>
								<td><input type="checkbox" name="checkBoxItems" value="{$vo.id}"/></td>
								<td>{$vo.menu_name}</td>
								<td <if condition="$vo.pname eq null"> class="font_red" </if>>
								<if condition="$vo.pname neq null">{$vo.pname}<else />一级菜单</if>
								</td>
								<td>{$vo.uri}</td>
								<td class="center">
									<div id="sort_btu_{$vo.id}">
										<button class="btn btn-mini" style="width:100px;" id="btu_{$vo.id}" onclick="javascript:showInput('{$vo.id}');">{$vo.sort}</button>
									</div>
									<div class="controls" id="intpu_{$vo.id}" style="display: none;">
										<input type="text" placeholder="{$vo.sort}" data-title="请输入数字" class="span11 tip" data-original-title="" style="width: 100px;" id="content_{$vo.id}" onblur="javascript:lostfocus();"/>
										<button class="btn btn-mini" onclick="javascript:updateSort('{$vo.id}');">确定</button>
									</div>
								</td>
								<td><i class="fa {$vo.menu_icon}" style="margin-right: 10px;"></i>{$vo.menu_icon}</td>
								<td>{$vo.create_time}</td>
								<td>
									<div class="btn-group">
										<button data-toggle="dropdown" class="btn btn-mini dropdown-toggle ">
											单项操作<span class="caret"></span>
										</button>
										<ul class="dropdown-menu">
											<li><a href="__ROOT__/resources/menumodify/m_id/{:I('m_id')}/p_id/{:I('p_id')}/id/{$vo.id}" class="fa fa-edit"> 修改</a></li>
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
				
				<div id="myAlert" class="modal hide">
	              <div class="modal-header">
	                <button data-dismiss="modal" class="close" type="button">×</button>
	                <h3>温馨提示</h3>
	              </div>
	              <div class="modal-body">
	                <p>确认删除本条记录？</p>
	                <input type="hidden" id="deleteId" value="" />
	              </div>
	              <div class="modal-footer"> <a class="btn btn-primary" href="#" onclick="javascript:deleteItem(1 , '');">确认</a> <a data-dismiss="modal" class="btn" href="#">取消</a> </div>
	            </div>
	            
	            
	            <div id="mySearch" class="modal hide">
	              <div class="modal-header">
	                <button data-dismiss="modal" class="close" type="button">×</button>
	                <h3>高级检索</h3>
	              </div>
	              <div class="modal-body">
			          <form action="__ROOT__/{$Think.CONTROLLER_NAME}/menulist/" method="get" id="searchFrom" class="form-horizontal">
			            <div class="control-group">
			              <label class="control-label">菜单名称</label>
			              <div class="controls">
			                <input type="text" name="MENU_NAME" id="MENU_NAME_AD" class="span11" placeholder="菜单名称" />
			              </div>
			            </div>
			            <div class="control-group">
			              <label class="control-label">父菜单名称</label>
			              <div class="controls">
			                <input type="text" name="PNAME" class="span11" placeholder="父菜单名称" />
			              </div>
			            </div>
			            <div class="control-group">
								<label class="control-label">菜单类型</label>
								<div class="controls">
									<label class="fl span4"> <input type="radio" name="PID" value="IS NULL" /> 一级菜单</label>
									<label class="fl"> <input type="radio" name="PID" value="IS NOT NULL" /> 子菜单</label>
								</div>
							</div>
			            <input type="hidden" name="m_id" value="{:I('m_id')}"/>
			            <input type="hidden" name="p_id" value="{:I('p_id')}"/>
			          </form>
	              </div>
	              <div class="modal-footer"> <a class="btn btn-primary search-btu" href="#"  id="search_ad">确认</a> <a data-dismiss="modal" class="btn" href="#">取消</a> </div>
	            </div>
	            
			</div>
			<div class="pagination fr">
					{$pageData}
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
		var deleteUrl = "__ROOT__/{$Think.CONTROLLER_NAME}/menuDelete/";
		var mid = "{:I('m_id')}";
		var pid = "{:I('p_id')}";
		
		function showInput(id){
			$("#sort_btu_"+id).hide();
			$("#intpu_"+id).show();
		}

		function updateSort(id){
			
			var oldSort = $("#content_"+id).attr('placeholder');
			var newSort = $("#content_"+id).val();
			if(!isNaN(newSort)){
				var param = "id="+id+"&sort="+newSort;
				$.ajax({
					type: "POST",
					dataType:"json",
					url: "__ROOT__/{$Think.CONTROLLER_NAME}/modifySort/",
					data: param,
					success: function(msg){
	 					if('success' == msg['result']){
	 						$("#content_"+id).attr('placeholder' , newSort);
		 					$("#intpu_"+id).hide();
		 					$("#sort_btu_"+id).show();
		 					$("#btu_"+id).text(newSort);
		 				}
	 					else{
	 						alert(msg['msg']);
		 				}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
						 alert(XMLHttpRequest.status);
						 alert(XMLHttpRequest.readyState);
						 alert(textStatus);
					}
				});
			}
			else{
				alert('请输入数字');
			}
		}

		function lostFocus(){
			alert('ss');
		}
   </script>