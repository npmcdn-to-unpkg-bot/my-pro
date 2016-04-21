
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">

			<div class="widget-box">
				<div class="widget-title" style="padding: 5px">
					<div class="fl" style="margin-right: 10px;">
						<input type="text" id="NAME" class="span11 searchItems"
							placeholder="姓名" value="" />

					</div>
					<button type="button" class="btn fa fa-search search_com">搜索</button>
					<a href="#mySearch" data-toggle="modal"><button
							class="btn fa fa-filter">高级检索</button></a>
					<button class="btn btn-danger  fr fa fa-trash"
						onclick="javascript:deleteItems();">删除</button>
					<a
						href="__ROOT__/{$Think.CONTROLLER_NAME}/add/m_id/{:I('m_id')}/p_id/{:I('p_id')}"><button
							class="btn btn-success  fr fa fa-plus">新增</button></a>
				</div>
				<div class="widget-content nopadding">
					<table class="table table-bordered  table-striped with-check">
						<thead>
							<tr>
								<th><input type="checkbox" id="title-checkbox"
									name="title-checkbox" /></th>
								<th width="20%">姓名</th>
								<th width="15%">性别</th>
								<th width="12%">联系电话</th>
								<th width="12%">登录帐号</th>
								<th width="13%">状态</th>
								<th width="13%">登录时间</th>
								<th width="15%">创建时间</th>
								<th width="10%">操作</th>
							</tr>
						</thead>
						<tbody>
							<volist name="list" id="vo">
							<tr>
								<td><input type="checkbox" name="checkBoxItems" value="{$vo.id}" /></td>
								<td>{$vo.name}</td>
								<td><if condition="$vo.sex eq '00A'">男<elseif
										condition="$vo.sex eq '00B'" />女</if></td>
								<td>{$vo.tel_phone}</td>
								<td>{$vo.account}</td>
								<td><if condition="$vo.state eq '00A'">正常<elseif
										condition="$vo.state eq '00B'" />已冻结</if></td>
								<td>{$vo.last_login}</td>
								<td>{$vo.create_time}</td>
								<td>
									<div class="btn-group">
										<button data-toggle="dropdown"
											class="btn btn-mini dropdown-toggle ">
											单项操作<span class="caret"></span>
										</button>
										<ul class="dropdown-menu">
											<li><a href="#detail" class="fa fa-file-o" data-toggle="modal" onclick="javascrpt:loadDetail('{$vo.id}');"> 详情</a></li>
											<li><a href="__ROOT__/{$Think.CONTROLLER_NAME}/modify/m_id/{:I('m_id')}/p_id/{:I('p_id')}/id/{$vo.id}" class="fa fa-edit"> 修改</a></li>
											<li class="divider"></li>
											<li><a href="__ROOT__/{$Think.CONTROLLER_NAME}/pswreset/m_id/{:I('m_id')}/p_id/{:I('p_id')}/id/{$vo.id}" class="fa fa-key"> 密码重置</a></li>
											<li><a href="__ROOT__/{$Think.CONTROLLER_NAME}/frozen/m_id/{:I('m_id')}/p_id/{:I('p_id')}/id/{$vo.id}" class="fa fa-key"> 冻结帐号</a></li>
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
						<form action="__ROOT__/{$Think.CONTROLLER_NAME}/show/" method="get" id="searchFrom" class="form-horizontal">
							<div class="control-group">
								<label class="control-label">姓名</label>
								<div class="controls">
									<input type="text" name="NAME" id="NAME_AD" class="span11"
										placeholder="管理员姓名" />
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">联系电话</label>
								<div class="controls">
									<input type="text" name="TEL_PHONE" id="TEL_PHONE_AD"
										class="span11" placeholder="联系电话" />
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">性别</label>
								<div class="controls">
									<label class="fl span3"> <input type="radio" name="SEX"
										id="SEX_AD" value="00A" /> 男
									</label> <label class="fl"> <input type="radio" name="SEX"
										value="00B" /> 女
									</label>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">状态</label>
								<div class="controls">
									<label class="fl span3"> <input type="radio" name="STATE"
										value="00A" /> 正常
									</label> <label class="fl"> <input type="radio" name="STATE"
										value="00B" /> 冻结
									</label>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">登录帐号</label>
								<div class="controls">
									<input type="text" name="ACCOUNT" class="span11"
										placeholder="登录帐号" />
								</div>
							</div>

							<input type="hidden" name="m_id" value="{:I('m_id')}" /> <input
								type="hidden" name="p_id" value="{:I('p_id')}" />
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
<!-- 详情弹出面板 begin -->

<div id="detail" class="modal hide">
	<div class="widget-box">
		<div class="widget-title bg_ly">
			<span class="icon"><i class="fa fa-spinner fa-spin pull-left " id="loading-detail"></i><i class="fa fa-chevron-down hide" id="finish-loading"></i></span>
			<h5  id="name"></h5>
		</div>
		<div class="widget-content nopadding collapse in" id="collapseG2">
			<ul class="recent-posts">
				<li>
					<div class="article-post">
						<p><i class="fa fa-heart" style="margin-right: 10px;"></i><span>性别：</span><span class="user-info" id="sex"><i class="fa fa-spinner fa fa-spin pull-left "></i></span></p>
						<p><i class="fa fa-lock" style="margin-right: 14px;"></i><span>帐号状态：</span><span class="user-info" id="state"><i class="fa fa-spinner fa fa-spin pull-left "></i></span></p>
						<p><i class="fa fa-group" style="margin-right: 10px;"></i><span>帐号类型：</span><span class="user-info" id="type"><i class="fa fa-spinner fa fa-spin pull-left "></i></span></p>
						<p><i class="fa fa-tablet" style="margin-right: 10px;"></i><span>联系电话：</span><span class="user-info"  id="tel"><i class="fa fa-spinner fa fa-spin pull-left "></i></span></p>
						<p><i class="fa fa-envelope" style="margin-right: 10px;"></i><span>联系邮箱：</span><span class="user-info" id="email"><i class="fa fa-spinner fa fa-spin pull-left "></i></span></p>
						<p><i class="fa fa-user" style="margin-right: 10px;"></i><span>登录帐号：</span><span class="user-info" id="account"><i class="fa fa-spinner fa fa-spin pull-left "></i></span></p>
						<p><i class="fa fa-retweet" style="margin-right: 10px;"></i><span>最近登录：</span><span class="user-info" id="login"><i class="fa fa-spinner fa fa-spin pull-left "></i></span></p>
						<p><i class="fa fa-clock-o" style="margin-right: 10px;"></i><span>创建时间：</span><span class="user-info"  id="create"><i class="fa fa-spinner fa fa-spin pull-left "></i></span></p>					
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>
<!-- 详情弹出面板 end -->
<script type="text/javascript">
	var deleteUrl = "__ROOT__/{$Think.CONTROLLER_NAME}/delete/";
	var mid = "{:I('m_id')}";
	var pid = "{:I('p_id')}";
	
	//加载指定详细信息
	function loadDetail(id){

		$('#loading-detail').removeClass('hide');
		$('#finish-loading').addClass('hide');
		$('#name,#sex,#state,#type,#tel,#email,#account,#login,#create').each(function(i){
			$(this).html("<i class=\"fa fa-spinner fa fa-spin pull-left \"></i>");
		});
		var param = "id="+id;
		$.ajax({
			type: "POST",
			dataType:"json",
			url: "__ROOT__/{$Think.CONTROLLER_NAME}/getDetail/",
			data: param,
			success: function(msg){
				$('#name').html(msg['data']['name']+"的信息详情");
				if(msg['data']['sex'] == '00A')
					$('#sex').html('男');
				else
					$('#sex').html('女');
				
				if(msg['data']['sex'] == '00A')
					$('#state').html('正常');
				else
					$('#state').html('冻结');
				if(msg['data']['admin_type'] == '00A')
					$('#type').html('超级管理员');
				else
					$('#type').html('普通管理员');
				$('#tel').html(msg['data']['tel_phone']);
				$('#email').html(msg['data']['email']);
				$('#account').html(msg['data']['account']);
				$('#login').html(msg['data']['last_login']);
				$('#create').html(msg['data']['create_time']);
				$('#loading-detail').addClass('hide');
				$('#finish-loading').removeClass('hide');
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				 alert(XMLHttpRequest.status);
				 alert(XMLHttpRequest.readyState);
				 alert(textStatus);
			}
		});
	}
 </script>