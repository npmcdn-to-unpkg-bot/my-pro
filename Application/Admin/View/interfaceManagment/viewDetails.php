
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"> <i class="fa fa-info-sign"></i>
					</span>
					<h5>接口详情</h5>
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#basicsInfoTab">接口基本信息</a></li>
						<li><a data-toggle="tab" href="#paramsInTab">传入参数<span id="inParamTab">(<?php echo count($paramDatas['paramIn']);?>)</span></a></li>
						<li><a data-toggle="tab" href="#paramsOutTab">返回参数<span id="outParamTab">(<?php echo count($paramDatas['paramOut']);?>)</span></a></li>
						<li><a data-toggle="tab" href="#errorTab">Code<span id="errorCodeTab">(<?php echo count($ecDatas);?>)</span></a></li>
					</ul>
				</div>
					<div class="widget-content nopadding tab-content">
						<div id="basicsInfoTab" class="tab-pane active">
						<form class="form-horizontal" method="post" action="__ROOT__/{$Think.CONTROLLER_NAME}/viewList" >
							<div class="control-group">
								<label class="control-label">接口名称</label>
								<div class="controls">
									{$intData['name']}
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">接口分类</label>
								<div class="controls">
									{$intData['category_name']}
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">接口调用方法</label>
								<div class="controls">
									<if condition="$intData['int_method'] eq '00A'">GET方法</if>
									<if condition="$intData['int_method'] eq '00B'">POST方法</if>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">生产环境接口地址</label>
								<div class="controls">
									{$intData['url']}
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">测试环境接口地址</label>
								<div class="controls">
									{$intData['test_url']}
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">传入参数示例</label>
								<div class="controls">
									{$intData['demo_in']}
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">返回参数示例</label>
								<div class="controls">
									{$intData['demo_out']}
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">接口开发者</label>
								<div class="controls">
									{$intData['author']}
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">排序</label>
								<div class="controls">
									{$intData['sort']}
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">创建时间</label>
								<div class="controls">
									{$intData['create_time']}
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">最近修改时间</label>
								<div class="controls">
									{$intData['update_time']}
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">接口描述</label>
								<div class="controls">
									{$intData['discription']}
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">备注</label>
								<div class="controls">
									{$intData['remark']}
								</div>
							</div>
							<input type="hidden" name="m_id" value="{:I('m_id')}" /> 
							<input type="hidden" name="p_id" value="{:I('p_id')}" /> 
							<div class="form-actions">
								<button type="button" class="btn btn-danger fa fa-reply" onclick="javascript:window.location='__ROOT__/{$Think.CONTROLLER_NAME}/viewList/m_id/{:I('m_id')}/p_id/{:I('p_id')}'">返回</button>
							</div>
							</form>
						</div>
						
						<div id="paramsInTab" class="tab-pane">
								<table class="table table-bordered table-striped">
					              <thead>
					                <tr>
					                  <th width="10%">参数名称</th>
					                  <th width="6%">参数类型</th>
					                  <th width="6%">参数位置</th>
					                  <th width="6%">是否必须</th>
					                  <th width="6%">参数排序</th>
					                  <th width="41%">参数描述</th>
					                  <th width="12%">创建时间</th>
					                  <th width="13%">操作</th>
					                </tr>
					              </thead>
					              <tbody>
					              	<volist name="paramDatas['paramIn']" id="pdata" >
						              	<tr>
						                  <td>{$pdata.name}</td>
						                  <td <if condition="$pdata.param_type eq '00C'">onclick="switchJsonDiscriptionTr('{$pdata.id}');" style="color:red;"</if>>
						                  	<if condition="$pdata.param_type eq '00A'">String</if>
						                  	<if condition="$pdata.param_type eq '00B'">Number</if>
						                  	<if condition="$pdata.param_type eq '00C'">Json<i class="fa fa-hand-pointer-o" style="margin-left: 10px;"></i></if>
						                  </td>
						                  <td>
						                  	<if condition="$pdata.param_loc eq '00A'">Headr</if>
						                  	<if condition="$pdata.param_loc eq '00B'">Url</if>
						                  </td>
						                  <td>
						                  	<if condition="$pdata.must eq '00A'">是</if>
						                  	<if condition="$pdata.must eq '00B'">否</if>
						                  </td>
						                  <td>{$pdata.sort}</td>
						                  <td title="{$pdata['discription']}">
							                  <?php 
												if(60 > strlen($pdata['discription']))
													echo $pdata['discription'];
												else
													echo msubstr($pdata['discription'],0,60,"utf-8",true);
												?>
						                  </td>
						                  <td>{$pdata.create_time}</td>
						                  <td>
						                  <div class="btn-group">
												<button data-toggle="dropdown" class="btn btn-mini dropdown-toggle ">
													单项操作<span class="caret"></span>
												</button>
												<ul class="dropdown-menu">
													<li><a href="{:U('interParams' , array('m_id'=>I('m_id') , 'p_id' => I('p_id') , 'paramInId' => $pdata['id'] , 'intId' => $intId , 'type' => 'paramIn')) , ''}" class="fa fa-edit"> 修改参数</a></li>
													<li class="divider"></li>
													<li><a href="{:U('deleteParam' , array('m_id'=>I('m_id') , 'p_id' => I('p_id') , 'paramInId' => $pdata['id'] , 'intId' => $intId , 'type' => 'paramIn') , '')}" class="fa fa-indent"> 删除参数</a></li>
												</ul>
											</div>
						                  </td>
						                </tr>
						                <tr style="display: none;" id="json_{$pdata.id}">
						                  <td>Json描述</td>
						                  <td colspan="7">{$pdata.json_discription}</td>
						                </tr>
					              	</volist>
					              </tbody>
					            </table>
						</div>

						<div id="paramsOutTab" class="tab-pane">
								<table class="table table-bordered table-striped">
					              <thead>
					                <tr>
					                  <th width="10%">参数名称</th>
					                  <th width="6%">参数类型</th>
					                  <th width="6%">参数位置</th>
					                  <th width="6%">是否必须</th>
					                  <th width="6%">参数排序</th>
					                  <th width="41%">参数描述</th>
					                  <th width="12%">创建时间</th>
					                  <th width="13%">操作</th>
					                </tr>
					              </thead>
					              <tbody>
					              	<volist name="paramDatas['paramOut']" id="pdata" >
						              	<tr>
						                  <td>{$pdata.name}</td>
						                  <td <if condition="$pdata.param_type eq '00C'">onclick="switchJsonDiscriptionTr('{$pdata.id}');" style="color:red;"</if>>
						                  	<if condition="$pdata.param_type eq '00A'">String</if>
						                  	<if condition="$pdata.param_type eq '00B'">Number</if>
						                  	<if condition="$pdata.param_type eq '00C'">Json<i class="fa fa-hand-pointer-o" style="margin-left: 10px;"></i></if>
						                  </td>
						                  <td>
						                  	<if condition="$pdata.param_loc eq '00A'">Headr</if>
						                  	<if condition="$pdata.param_loc eq '00B'">Url</if>
						                  </td>
						                  <td>
						                  	<if condition="$pdata.must eq '00A'">是</if>
						                  	<if condition="$pdata.must eq '00B'">否</if>
						                  </td>
						                  <td>{$pdata.sort}</td>
						                  <td title="{$pdata['discription']}">
							                  <?php 
												if(60 > strlen($pdata['discription']))
													echo $pdata['discription'];
												else
													echo msubstr($pdata['discription'],0,60,"utf-8",true);
												?>
						                  </td>
						                  <td>{$pdata.create_time}</td>
						                  <td>
						                  <div class="btn-group">
												<button data-toggle="dropdown" class="btn btn-mini dropdown-toggle ">
													单项操作<span class="caret"></span>
												</button>
												<ul class="dropdown-menu">
													<li><a href="{:U('interParams' , array('m_id'=>I('m_id') , 'p_id' => I('p_id') , 'paramOutId' => $pdata['id'] , 'intId' => $intId , 'type' => 'paramOut')) , ''}" class="fa fa-edit"> 修改参数</a></li>
													<li class="divider"></li>
													<li><a href="{:U('deleteParam' , array('m_id'=>I('m_id') , 'p_id' => I('p_id') , 'paramOutId' => $pdata['id'] , 'intId' => $intId , 'type' => 'paramOut') , '')}" class="fa fa-indent"> 删除参数</a></li>
												</ul>
											</div>
						                  </td>
						                </tr>
						                <tr style="display: none;" id="json_{$pdata.id}">
						                  <td>Json描述</td>
						                  <td colspan="7">{$pdata.json_discription}</td>
						                </tr>
					              	</volist>
					              </tbody>
					            </table>
						</div>

						<div id="errorTab" class="tab-pane">
								<table class="table table-bordered table-striped">
					              <thead>
					                <tr>
					                  <th width="10%">名称</th>
					                  <th width="20%">Msg</th>
					                  <th width="29%">描述</th>
					                  <th width="6%">参数排序</th>
					                  <th width="12%">创建时间</th>
					                  <th width="13%">操作</th>
					                </tr>
					              </thead>
					              <tbody>
					              	<volist name="ecDatas" id="ecdata" >
						              	<tr>
						                  <td>{$ecdata.code_name}</td>
						                  <td title="{$ecdata.code_msg}">
							                  <?php 
												if(40 > strlen($ecdata['code_msg']))
													echo $ecdata['code_msg'];
												else
													echo msubstr($ecdata['code_msg'],0,40,"utf-8",true);
												?>
						                  </td>
						                  <td title="{$ecdata.discription}">
							                  <?php 
												if(60 > strlen($ecdata['discription']))
													echo $ecdata['discription'];
												else
													echo msubstr($ecdata['discription'],0,60,"utf-8",true);
												?>
						                  </td>
						                  <td>{$ecdata.sort}</td>
						                  <td>{$ecdata.create_time}</td>
						                  <td>
						                  <div class="btn-group">
												<button data-toggle="dropdown" class="btn btn-mini dropdown-toggle ">
													单项操作<span class="caret"></span>
												</button>
												<ul class="dropdown-menu">
													<li><a href="{:U('interParams' , array('m_id'=>I('m_id') , 'p_id' => I('p_id') , 'ecId' => $ecdata['id'] , 'intId' => $intId , 'type' => 'errorCode')) , ''}" class="fa fa-edit"> 修改参数</a></li>
													<li class="divider"></li>
													<li><a href="{:U('deleteErrorCode' , array('m_id'=>I('m_id') , 'p_id' => I('p_id') , 'ecId' => $ecdata['id'] , 'intId' => $intId , 'type' => 'errorCode') , '')}" class="fa fa-indent"> 删除参数</a></li>
												</ul>
											</div>
						                  </td>
						                </tr>
						                <tr style="display: none;" id="json_{$pdata.id}">
						                  <td>Json描述</td>
						                  <td colspan="7">{$pdata.json_discription}</td>
						                </tr>
					              	</volist>
					              </tbody>
					            </table>
						</div>
					</div>
			</div>
		</div>
	</div>

</div>
<script type="text/javascript">
//隐藏Json描述
function removeJsonDiscription(id){
	$("#"+id).css("display","none");
}
//显示Json描述
function showJsonDiscription(id){
	$("#"+id).css("display","");
}
//移除参数
function removeParam(index , type){
	var paramItemId = "#param_edit_"+index;
	if('in' == type){
		$('#inParamTab').html("("+ --inPraraCount +")");
	}
	else if('out' == type){
		$('#outParamTab').html("("+ --outParamCount +")");
	}
	$(paramItemId).remove();
}

function switchJsonDiscriptionTr(id){
	if("none" == $("#json_"+id).css("display"))
		$("#json_"+id).css("display","");
	else
		$("#json_"+id).css("display","none");
}

</script>
