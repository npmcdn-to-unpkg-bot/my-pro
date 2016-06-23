
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"> <i class="fa fa-info-sign"></i>
					</span>
					<h5>新增城市</h5>
				</div>
				<form class="form-horizontal" method="post"
					action="{:U('Add')} name="city"
					id="city_validate" novalidate="novalidate">
					<div class="widget-content nopadding tab-content">

						<div id="basicsInfoTab" class="tab-pane active">
							<div class="control-group">
								<label class="control-label">城市名称</label>
								<div class="controls">
									<input type="text" class="span5" name="name" id="name"
										placeholder="请输入城市名称(必填)"  />
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">接口分类</label>
								<div class="controls">
									<select name="category" id="category" class="span5" >
										<option value="none">请选择接口分类</option>
										<volist name="catData" id="top">
										<option value="{$top.id}/{$top.name}">{$top.name}</option>
										<volist name="top.children" id='chls'>
										<option value="{$chls.id}/{$chls.name}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;----{$chls.name}</option>
										</volist> </volist>
									</select>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">接口调用方法</label>
								<div class="controls">
									<label class="fl "> <input type="radio" name="method"
										value="00A" checked="checked"/> GET方法
									</label> <label class="fl"> <input type="radio" name="method"
										value="00B" /> POST方法
									</label>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">生产环境接口地址</label>
								<div class="controls">
									<input type="text" class="span5" name="url" id="url"
										placeholder="请输入生产环境接口地址（完整带Http地址）" />
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">测试环境接口地址</label>
								<div class="controls">
									<input type="text" class="span5" name="testUrl" id="testUrl"
										placeholder="请输入生产环境接口地址（完整带Http地址）" />
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">传入参数示例</label>
								<div class="controls">
									<script id="demoIn" type="text/plain"
										style="width: 95%; height: 150px;"></script>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">返回参数示例</label>
								<div class="controls">
									<script id="demoOut" type="text/plain"
										style="width: 95%; height: 150px;"></script>
								</div>
							</div>
							
							<!-- 
							<div class="control-group">
								<label class="control-label">接口开发者</label>
								<div class="controls">
									<input type="text" class="span5" name="author" id=""
										author"" placeholder="请输入接口开发人员姓名（必填）" />
								</div>
							</div>
							 -->
							<div class="control-group">
								<label class="control-label">排序</label>
								<div class="controls">
									<input type="text" name="sort" id="sort" class="span5"
										placeholder="请输入接口展示排序（越大越前，必填）" />
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">接口描述</label>
								<div class="controls">
									<textarea name="discription" id="discription" class="span11" placeholder="请输入接口描述"></textarea>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">备注</label>
								<div class="controls">
									<textarea name="remark" id="remark" class="span11"
										placeholder="请输入接口备注"></textarea>
								</div>
							</div>
						</div>
						<input type="hidden" name="m_id" value="{:I('m_id')}" /> 
						<input type="hidden" name="p_id" value="{:I('p_id')}" /> 
						<input type="hidden" name="id" value="{$id}" />
						<div class="form-actions">
							<button type="submit" class="btn btn-success fa fa-save">确定</button>
							<button type="reset" class="btn btn-primary fa fa-edit">重置</button>
							<button type="button" class="btn btn-danger fa fa-reply" onclick="javascript:window.location='__ROOT__/{$Think.CONTROLLER_NAME}/viewList/m_id/{:I('m_id')}/p_id/{:I('p_id')}'">返回</button>
						</div>
					</div>

				</form>
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
function addParamItem(indexCount , type){
	var htmlStr = "";
	htmlStr += "<div class=\"control-group\" id=\"param_edit_"+indexCount+"\" index=\""+indexCount+"\" >";
	if('in' == type)
		htmlStr += "<label class=\"control-label\">传入参数</label>";
	else
		htmlStr += "<label class=\"control-label\">返回参数</label>";
	htmlStr += "<div class=\"controls\" index=\""+indexCount+"\" >";
	htmlStr += "<div style=\"margin-bottom: 10px;\">";
	htmlStr += "参数名称：<input type=\"text\" class=\"span2\" name=\"param_"+indexCount+"_"+type+"_name\" placeholder=\"参数名称(必填)\" class=\"{required:true}\" />";
	htmlStr += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;展示排序：<input type=\"text\" class=\"span1\" name=\"param_"+indexCount+"_"+type+"_sort\" placeholder=\"数字\" class=\"{required:true}\" />";
	htmlStr += "</div>";
	htmlStr += "<div style=\"margin-bottom: 10px;\">";
	htmlStr += "参数位置:&nbsp;&nbsp;&nbsp;&nbsp;";
	htmlStr += "<label><input type=\"radio\" name=\"param_"+indexCount+"_"+type+"_loc\" value=\"00A\" checked=\"checked\"/>&nbsp;&nbsp;&nbsp;&nbsp;Header</label>";
	htmlStr += "<label><input type=\"radio\" name=\"param_"+indexCount+"_"+type+"_loc\" value=\"00B\" />&nbsp;&nbsp;&nbsp;&nbsp;Url</label>";
	htmlStr += "</div>";
	htmlStr += "<div style=\"margin-bottom: 10px;\">";
	htmlStr += "参数类型:&nbsp;&nbsp;&nbsp;&nbsp;";
	htmlStr += "<label><input type=\"radio\" name=\"param_"+indexCount+"_"+type+"_type\" value=\"00A\"  checked=\"checked\" onclick=\"removeJsonDiscription("+indexCount+")\"/>&nbsp;&nbsp;&nbsp;&nbsp;String</label>";
	htmlStr += "<label><input type=\"radio\" name=\"param_"+indexCount+"_"+type+"_type\" value=\"00B\" onclick=\"removeJsonDiscription("+indexCount+")\"/>&nbsp;&nbsp;&nbsp;&nbsp;Number</label>";
	htmlStr += "<label><input type=\"radio\" name=\"param_"+indexCount+"_"+type+"_type\" value=\"00B\" _"+indexCount+" onclick=\"showJsonDiscription("+indexCount+")\"/>&nbsp;&nbsp;&nbsp;&nbsp;Json</label>";
	htmlStr += "</div>";
	htmlStr += "<div style=\"margin-bottom: 10px;\">";
	htmlStr += "是否必须:&nbsp;&nbsp;&nbsp;&nbsp;";
	htmlStr += "<label><input type=\"radio\" name=\"param_"+indexCount+"_"+type+"_must\"   value=\"00A\" />&nbsp;&nbsp;&nbsp;&nbsp;是</label>";
	htmlStr += "<label><input type=\"radio\" name=\"param_"+indexCount+"_"+type+"_must\"   value=\"00B\"  checked=\"checked\"/>&nbsp;&nbsp;&nbsp;&nbsp;否</label>";
	htmlStr += "</div>";
	htmlStr += "<div style=\"margin-bottom: 10px;\">";
	htmlStr += "参数描述:&nbsp;&nbsp;&nbsp;&nbsp;";
	htmlStr += "<textarea  name=\"param_"+indexCount+"_"+type+"_discription\"   class=\"span11\" placeholder=\"请输入参数描述\" ></textarea>";
	htmlStr += "</div>";
	htmlStr += "<div style=\"margin-bottom: 10px;display:none;\" id=\"param_"+indexCount+"_json_discription_content\"  >";
	htmlStr += "Json描述:&nbsp;&nbsp;&nbsp;&nbsp;";
	htmlStr += "<textarea  name=\"param_"+indexCount+"_"+type+"_discription\"   class=\"span11\" placeholder=\"请输入参数描述\" ></textarea>";
	htmlStr += "</div>";
	htmlStr += "<div style=\"margin-bottom: 10px;\" id=\"param_"+indexCount+"_json_discription_content\"  >";
	htmlStr += "<button type=\"reset\" class=\"btn btn-danger fa fa-delete\" style=\"float:right;\" onclick=\"removeParam("+indexCount+" , '"+ type +"');\"> 删除</button>";
	htmlStr += "</div>";
	htmlStr += "</div>";
	htmlStr += "</div>";
	if('in' == type){
		$('#inParamTab').html("("+ ++inPraraCount +")");
		$('#paramInItems').append(htmlStr);
	}
	else if('out' == type){
		$('#outParamTab').html("("+ ++outParamCount +")");
		$('#paramOutItems').append(htmlStr);
	}
}
//隐藏Json描述
function removeJsonDiscription(index){
	var jsonDivId = "#param_"+index+"_json_discription_content";
	$(jsonDivId).css("display","none");
}
//显示Json描述
function showJsonDiscription(index){
	var jsonDivId = "#param_"+index+"_json_discription_content";
	$(jsonDivId).css("display","");
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




</script>
