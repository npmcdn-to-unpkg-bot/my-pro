
<div class="container-fluid" height="auto">
	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"> <i class="fa fa-info-sign"></i>
					</span>
					<h5>新增接口</h5>
					<ul class="nav nav-tabs">
						<li><a data-toggle="tab" href="#basicsInfoTab">接口基本信息</a></li>
						<li <if condition="$type eq 'paramIn'">class="active"</if> ><a data-toggle="tab" href="#paramsInTab">传入参数<span id="inParamTab">(<?php echo count($paramDatas['paramIn']);?>)</span></a></li>
						<li <if condition="$type eq 'paramOut'">class="active"</if> ><a data-toggle="tab" href="#paramsOutTab">返回参数<span id="outParamTab">(<?php echo count($paramDatas['paramOut']);?>)</span></a></li>
						<li <if condition="$type eq 'errorCode'">class="active"</if> ><a data-toggle="tab" href="#errorTab">Error Code<span id="errorCodeTab">(<?php echo count($paramDatas['errorCode']);?>)</span></a></li>
					</ul>
				</div>
					<div class="widget-content nopadding tab-content">
						<div id="basicsInfoTab" class="tab-pane">
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
						
						<div id="paramsInTab" class="tab-pane <if condition="$type eq 'paramIn'">active</if>">
							<form class="form-horizontal" method="post" action="__ROOT__/{$Think.CONTROLLER_NAME}/paramInOpration" name="paramIn" id="paramIn_validate" novalidate="novalidate">
								<div class="control-group">
					              <label class="control-label">参数名称 :</label>
					              <div class="controls">
					                <input type="text" class="span6" name="paramInName" id="paramInName" placeholder="请输入参数名称（英文，必填）" value="{$paramData.name}"/>
					              </div>
					            </div>
					            <div class="control-group">
					              <label class="control-label">展示排序:</label>
					              <div class="controls">
					                <input type="text" class="span6" name="paramInSort" id="paramInSort" placeholder="请输入展示排序（数字，必填）" value="{$paramData.sort}"/>
					              </div>
					            </div>
					            <div class="control-group">
									<label class="control-label">参数位置：</label>
									<div class="controls">
										<if condition="$paramId eq ''">
											<label class="fl "> <input type="radio" name="paramInLoc" value="00A" checked="checked"/>Header</label> 
											<label class="fl"> <input type="radio" name="paramInLoc" value="00B" />Url</label>
											<else/>
											<label class="fl "> <input type="radio" name="paramInLoc" value="00A" <if condition="$paramData.param_loc eq '00A'">checked="checked" </if>/>Header</label> 
											<label class="fl"> <input type="radio" name="paramInLoc" value="00B" <if condition="$paramData.param_loc eq '00B'">checked="checked" </if> />Url</label>
										</if>
										
									</div>
					            </div>
					            
					            <div class="control-group">
									<label class="control-label">参数描述:</label>
									<div class="controls">
										<textarea name="discription" id="discription" class="span6" placeholder="请输入参数描述（必填）">{$paramData.discription}</textarea>
									</div>
					            </div>
					            <div class="control-group">
									<label class="control-label">参数类型：</label>
									<div class="controls">
										<if condition="$paramId eq ''">
												<label class="fl "> <input type="radio" name="paramInType" value="00A" checked="checked" onclick="removeJsonDiscription();"/>String</label> 
												<label class="fl"> <input type="radio" name="paramInType" value="00B" onclick="removeJsonDiscription();" />Number</label>
												<label class="fl"> <input type="radio" name="paramInType" value="00C" onclick="showJsonDiscription();"/>Json</label>
											<else/>
												<label class="fl "> <input type="radio" name="paramInType" value="00A" <if condition="$paramData.param_type eq '00A'">checked="checked"</if> onclick="removeJsonDiscription();"/>String</label> 
												<label class="fl"> <input type="radio" name="paramInType" value="00B" <if condition="$paramData.param_type eq '00B'">checked="checked"</if> onclick="removeJsonDiscription();" />Number</label>
												<label class="fl"> <input type="radio" name="paramInType" value="00C" <if condition="$paramData.param_type eq '00C'">checked="checked"</if> onclick="showJsonDiscription();"/>Json</label>											
										</if>
									
									</div>
					            </div>
					            <div class="control-group" id="paramInJsonDisDiv" <if condition="$paramData.param_type neq '00C'">style="display: none;"</if>>
									<label class="control-label">Json描述:</label>
									<div class="controls">
										<textarea name="paramInJsonDis" id="paramInJsonDis" class="span6" placeholder="请输入Json描述">{$paramData.json_discription}</textarea>
									</div>
					            </div>
					            <div class="control-group">
									<label class="control-label">是否必须：</label>
									<div class="controls">
										<if condition="$paramId eq ''">
											<label class="fl "> <input type="radio" name="paramInMust" value="00A" checked="checked"/>是</label> 
											<label class="fl"> <input type="radio" name="paramInMust" value="00B" />否</label>
											<else />
												<label class="fl "> <input type="radio" name="paramInMust" value="00A" <if condition="$paramData.must eq '00A'"> checked="checked"</if>/>是</label> 
												<label class="fl"> <input type="radio" name="paramInMust" value="00B" <if condition="$paramData.must eq '00B'"> checked="checked"</if>/>否</label>
										</if>
									</div>
					            </div>
								<input type="hidden" name="m_id" value="{:I('m_id')}" /> 
								<input type="hidden" name="p_id" value="{:I('p_id')}" /> 
								<input type="hidden" name="intId" value="{$intId}" />
								<input type="hidden" name="type" value="{$type}" />
								<input type="hidden" name="paramId" value="{$paramId}" />
								<div class="form-actions">
									<button type="submit" class="btn btn-success fa fa-save">确定</button>
									<button type="reset" class="btn btn-primary fa fa-edit">重置</button>
									<button type="button" class="btn btn-danger fa fa-reply" onclick="javascript:window.location='__ROOT__/{$Think.CONTROLLER_NAME}/viewList/m_id/{:I('m_id')}/p_id/{:I('p_id')}'">返回</button>
								</div>
								</form>
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
						                  <td>
							                  <?php 
												if(20 > strlen($vo['discription']))
													echo $pdata['discription'];
												else
													echo msubstr($pdata['discription'],0,20,"utf-8",true);
												?>
						                  </td>
						                  <td>{$pdata.create_time}</td>
						                  <td>
						                  <div class="btn-group">
												<button data-toggle="dropdown" class="btn btn-mini dropdown-toggle ">
													单项操作<span class="caret"></span>
												</button>
												<ul class="dropdown-menu">
													<li><a href="{:U('interParams' , array('m_id'=>I('m_id') , 'p_id' => I('p_id') , 'paramId' => $pdata['id'] , 'intId' => $intId , 'type' => 'paramIn')) , ''}" class="fa fa-edit"> 修改参数</a></li>
													<li class="divider"></li>
													<li><a href="{:U('deleteParam' , array('m_id'=>I('m_id') , 'p_id' => I('p_id') , 'paramId' => $pdata['id'] , 'intId' => $intId , 'type' => 'paramIn') , '')}" class="fa fa-indent"> 删除参数</a></li>
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

						<div id="paramsOutTab" class="tab-pane <if condition="$type eq 'paramOut'">active</if>">
							<form class="form-horizontal" method="post" action="__ROOT__/{$Think.CONTROLLER_NAME}/add" name="interface" id="interface_validate" novalidate="novalidate">
							<div class="control-group">
								<div class="controls">
									<a class="btn btn-info fa fa-plus"
										onclick="addParamItem(indexCount++ , 'out');">添加回参</a>
								</div>

								<div id="paramOutItems"></div>
							</div>
							</form>
						</div>

						<div id="errorTab" class="tab-pane <if condition="$type eq 'errorCode'">active</if>">
							<form class="form-horizontal" method="post" action="__ROOT__/{$Think.CONTROLLER_NAME}/add" name="interface" id="interface_validate" novalidate="novalidate">
							<div class="control-group">
								<div class="controls">
									<a class="btn btn-info fa fa-plus"
										onclick="addErrorCode(errorCodeIndex++);">添加错误码</a>
								</div>
								<!-- 
								<div class="control-group" id="errorCode_edit_1" index="1">
									<label class="control-label">ErrorCode</label>
									<div class="controls">
										<div style="margin-bottom: 10px;">
											错误代码：&nbsp;&nbsp;&nbsp;<input type="text" class="span2" name="" placeholder="错误代码" class="{required:true}" />
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											返回信息：<input type="text" class="span4" name="" placeholder="接口返回信息" class="{required:true}" />
										</div>
										<div style="margin-bottom: 10px;">
											代码说明:&nbsp;&nbsp;&nbsp;&nbsp;
											<textarea  name=""   class="span11" placeholder="请输入错误码所代表的详细说明" ></textarea>
										</div>
										<div style="margin-bottom: 10px;">
											<button type="reset" class="btn btn-danger fa fa-delete" style="float:right;" onclick="removeErrorCode(errorCodeIndex);"> 删除</button>
										</div>
									</div>
								</div>
								 -->
								<div id="errorCodeItems"></div>
							</div>
							</form>
						</div>
					</div>
			</div>
		</div>
	</div>

</div>
<script type="text/javascript">
//实例化编辑器
//建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
var demoInUe = UE.getEditor('demoIn',{
	toolbars: [['fullscreen', 'source', 'undo', 'redo', 'bold']],
	textarea:'demoIn',
	pasteplain:false,
	elementPathEnabled : false,
	autoHeightEnabled:false,
	initialStyle:'p{line-height:1em;font-size:12px;color:rgb(153,153,153);}',
});
var demoOutUe = UE.getEditor('demoOut',{
	toolbars: [['fullscreen', 'source', 'undo', 'redo', 'bold']],
	textarea:'demoOut',
	pasteplain:false,
	elementPathEnabled : false,
	autoHeightEnabled:false,
	initialStyle:'p{line-height:1em;font-size:12px;color:rgb(153,153,153);}',
});

var indexCount = 0;
var inPraraCount = 0;
var outParamCount = 0;
var errorCodeIndex = 0;
var errorCodeCount = 0;

function addErrorCode(index){
	var htmlStr = "";

	htmlStr += "<div class=\"control-group\" id=\"errorCode_edit_"+index+"\" index=\"1\">";
	htmlStr += "<label class=\"control-label\">ErrorCode</label>";
	htmlStr += "<div class=\"controls\">";
	htmlStr += "<div style=\"margin-bottom: 10px;\">";
	htmlStr += "错误代码：&nbsp;&nbsp;&nbsp;<input type=\"text\" class=\"span2\" name=\"error_code_"+index+"\" placeholder=\"错误代码\" class=\"{required:true}\" />";
	htmlStr += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	htmlStr += "返回信息：<input type=\"text\" class=\"span4\" name=\"error_code_msg_"+index+"\" placeholder=\"接口返回信息\" class=\"{required:true}\" />";
	htmlStr += "</div>";
	htmlStr += "<div style=\"margin-bottom: 10px;\">";
	htmlStr += "代码说明:&nbsp;&nbsp;&nbsp;&nbsp;";
	htmlStr += "<textarea  name=\"error_discriptin"+index+"\"   class=\"span11\" placeholder=\"请输入错误码所代表的详细说明\" ></textarea>";
	htmlStr += "</div>";
	htmlStr += "<div style=\"margin-bottom: 10px;\">";
	htmlStr += "<button type=\"reset\" class=\"btn btn-danger fa fa-delete\" style=\"float:right;\" onclick=\"removeErrorCode("+index+");\"> 删除</button>";
	htmlStr += "</div>";
	htmlStr += "</div>";
	htmlStr += "</div>";

	
	$('#errorCodeTab').html("("+ ++errorCodeCount + ")");
	$('#errorCodeItems').append(htmlStr);
}
//隐藏Json描述
function removeJsonDiscription(){
	$("#paramInJsonDisDiv").css("display","none");
}
//显示Json描述
function showJsonDiscription(){
	$("#paramInJsonDisDiv").css("display","");
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
//移除参数
function removeErrorCode(index){
	var paramItemId = "#errorCode_edit_"+index;
	$('#errorCodeTab').html("("+ --errorCodeCount +")");
	$(paramItemId).remove();
}

function switchJsonDiscriptionTr(id){
	if("none" == $("#json_"+id).css("display"))
		$("#json_"+id).css("display","");
	else
		$("#json_"+id).css("display","none");
}

</script>
