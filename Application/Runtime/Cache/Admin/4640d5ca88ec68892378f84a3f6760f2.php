<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<title>YY_BG</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta chartset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- 引入样式表 -->
<link rel="stylesheet" type="text/css" href="/myframework/Public/StyleResources/Bootstrap/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="/myframework/Public/StyleResources/Bootstrap/bootstrap-responsive.min.css" />
<link rel="stylesheet" type="text/css" href="/myframework/Public/StyleResources/Matrix/matrix-style.css" />
<link rel="stylesheet" type="text/css" href="/myframework/Public/StyleResources/Matrix/matrix-media.css" />

<?php switch($PAGE_FROM): case "Index": ?><link rel="stylesheet" type="text/css" href="/myframework/Public/StyleResources/fullcalendar.css" />
		<link rel="stylesheet" type="text/css" href="/myframework/Public/StyleResources/Matrix/matrix-media.css/jquery.gritter.css" /><?php break;?>
	<?php case "List": case "Add": ?><link rel="stylesheet" type="text/css" href="/myframework/Public/StyleResources/uniform.css" />
		<link rel="stylesheet" type="text/css" href="/myframework/Public/StyleResources/select2.css" /><?php break; endswitch;?>
<link rel="stylesheet" type="text/css" href="/myframework/Public/StyleResources/font-awesome-4.4.0/css/font-awesome.css" />
<!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'> -->
<?php if($EDIT): ?><script type="text/javascript" charset="utf-8" src="/myframework/Public/uedit/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/myframework/Public/uedit/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/myframework/Public/uedit/lang/zh-cn/zh-cn.js"></script><?php endif; ?>

<script type="text/javascript">
var urlHead="/myframework/<?php echo (CONTROLLER_NAME); ?>/";
</script>

</head>
<body>
<!--Header-part-->
<div id="header">

  <h1><a href="dashboard.html">YY_BG</a></h1>
</div>
<!--close-Header-part--> 
<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="fa fa-user"></i>  <span class="text">欢迎你 <?php echo (session('adminName')); ?></span><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="#"><i class="fa fa-user"></i> My Profile</a></li>
        <li class="divider"></li>
        <li><a href="#"><i class="fa fa-check"></i> My Tasks</a></li>
        <li class="divider"></li>
        <li><a href="login.html"><i class="fa fa-key"></i> Log Out</a></li>
      </ul>
    </li>
    <li class="dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="fa fa-envelope"></i> <span class="text">Messages</span> <span class="label label-important">5</span> <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a class="sAdd" title="" href="#"><i class="fa-plus"></i> new message</a></li>
        <li class="divider"></li>
        <li><a class="sInbox" title="" href="#"><i class="fa-envelope"></i> inbox</a></li>
        <li class="divider"></li>
        <li><a class="sOutbox" title="" href="#"><i class="fa-arrow-up"></i> outbox</a></li>
        <li class="divider"></li>
        <li><a class="sTrash" title="" href="#"><i class="fa-trash"></i> trash</a></li>
      </ul>
    </li>
    <li class=""><a title="" href="#setting"  data-toggle="modal"><i class="fa fa-cog"></i> <span class="text">密码设置</span></a></li>
    <li class=""><a title="" href="/myframework/index/logout"><i class="fa fa-share-alt"></i> <span class="text">安全退出</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<!-- <div id="search"> -->
<!--   <input type="text" placeholder="Search here..."/> -->
<!--   <button type="submit" class="tip-bottom" title="Search"><i class="fa-search fa-white"></i></button> -->
<!-- </div> -->
<!--close-top-serch-->


<!--sidebar-menu-->

<div id="sidebar"><a href="#" class="visible-phone"><i class="fa fa-home"></i> Dashboard</a>
	<ul>
	
	<li <?php if(I('p_id') == "" || I('p_id') == null){?>class="active"<?php }?>><a href="<?php echo U('Admin/Index/index') , '';?>"><i class="fa fa-home"></i> <span>首页</span></a> </li>

	<?php if(is_array($Menu)): $i = 0; $__LIST__ = $Menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menuItem): $mod = ($i % 2 );++$i; if(count($menuItem['subMenu']) > 0): ?><li class="submenu <?php if(I('p_id') == $menuItem['id']){?> open<?php }?>"> <a href="#"><i class="fa <?php echo ($menuItem['menu_icon']); ?>"></i> <span><?php echo ($menuItem["menu_name"]); ?></span> <span class="label label-important"><?php echo count($menuItem['subMenu']);?></span></a>
			<ul>
				<?php if(is_array($menuItem["subMenu"])): $i = 0; $__LIST__ = $menuItem["subMenu"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$submenuItem): $mod = ($i % 2 );++$i;?><li <?php if(I('m_id') == $submenuItem['id']){?>class="active"<?php }?>><span><a href="/myframework<?php echo ($submenuItem["uri"]); ?>/m_id/<?php echo ($submenuItem["id"]); ?>/p_id/<?php echo ($menuItem["id"]); ?>"><i class="fa <?php echo ($submenuItem["menu_icon"]); ?>" style="margin-right: 10px;"></i><?php echo ($submenuItem["menu_name"]); ?></a></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			</li>
			<?php else: ?>
			<li><a href="<?php echo ($menuItem["uri"]); ?>/m_id/<?php echo ($menuItem["id"]); ?>/p_id/<?php echo ($menuItem["id"]); ?>"><i class="fa "></i> <span><?php echo ($menuItem["menu_name"]); ?></span></a> </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
	</ul>
</div>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
	    <a href="/myframework/Index/Index" title="Go to Home" class="tip-bottom"><i class="fa-home"></i> 首页</a>
	    <?php if($BreadCrumb[0] != null): ?><a href="#" class="current"><?php echo ($BreadCrumb[0]); ?></a><?php endif; ?>
	    <?php if($BreadCrumb[1] != null): ?><a href="#" class="current"><?php echo ($BreadCrumb[1]); ?></a><?php endif; ?>
	    
    </div>
  </div>
<!--End-breadcrumbs-->
<!-- 高级搜索弹出框 begin -->
				<div id="setting" class="modal hide">
					<div class="modal-header">
						<button data-dismiss="modal" class="close" type="button">×</button>
						<h3>密码设置</h3>
					</div>
					<div class="modal-body">
						<form action="/myframework/Admins/setPsw/" method="post" id="setPswForm" class="form-horizontal">

							<div class="control-group">
								<label class="control-label">旧密码</label>
								<div class="controls">
									<input type="password" name="OLD_PSW" class="span2" placeholder="请输入旧密码" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">新密码</label>
								<div class="controls">
									<input type="password" name="NEW_PSW" class="span2" placeholder="请输入新密码" />
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<a class="btn btn-primary search-btu" href="#" onclick="javascript:document.getElementById('setPswForm').submit();">确认</a>
						<a data-dismiss="modal" class="btn" href="#">取消</a>
					</div>
				</div>
				<!-- 高级搜索弹出框 end -->


<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"> <i class="fa fa-info-sign"></i>
					</span>
					<h5>新增接口</h5>
				</div>
				<form class="form-horizontal" method="post" action="/myframework/<?php echo (CONTROLLER_NAME); ?>/modify" name="interface" id="interface_validate" novalidate="novalidate">
					<div class="widget-content nopadding tab-content">
						<div id="basicsInfoTab" class="tab-pane active">
							<div class="control-group">
								<label class="control-label">接口名称</label>
								<div class="controls">
									<input type="text" class="span5" name="name" id="name"
										placeholder="请输入接口名称(必填)"  value="<?php echo ($data['name']); ?>"/>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">接口分类</label>
								<div class="controls">
									<select name="category" id="category" class="span5" >
										<option value="none">请选择接口分类</option>
										<?php if(is_array($catData)): $i = 0; $__LIST__ = $catData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$top): $mod = ($i % 2 );++$i;?><option value="<?php echo ($top["id"]); ?>/<?php echo ($top["name"]); ?>" <?php if($top["id"] == $data['category_id']): ?>selected="selected"<?php endif; ?>><?php echo ($top["name"]); ?></option>
											<?php if(is_array($top["children"])): $i = 0; $__LIST__ = $top["children"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$chls): $mod = ($i % 2 );++$i;?><option value="<?php echo ($chls["id"]); ?>/<?php echo ($chls["name"]); ?>" <?php if($chls["id"] == $data['category_id']): ?>selected="selected"<?php endif; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;----<?php echo ($chls["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
									</select>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">接口调用方法</label>
								<div class="controls">
									<label class="fl "> <input type="radio" name="method" value="00A" <?php if($data['int_method'] == '00A'): ?>checked="checked"<?php endif; ?>/> GET方法
									</label> <label class="fl"> <input type="radio" name="method" <?php if($data['int_method'] == '00B'): ?>checked="checked"<?php endif; ?>value="00B" /> POST方法
									</label>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">生产环境接口地址</label>
								<div class="controls">
									<input type="text" class="span5" name="url" id="url" placeholder="请输入生产环境接口地址（完整带Http地址）" value="<?php echo ($data['url']); ?>"/>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">测试环境接口地址</label>
								<div class="controls">
									<input type="text" class="span5" name="testUrl" id="testUrl" placeholder="请输入生产环境接口地址（完整带Http地址）"  value="<?php echo ($data['test_url']); ?>"/>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">传入参数示例</label>
								<div class="controls">
									<script id="demoIn" type="text/plain" style="width: 95%; height: 150px;"><?php echo ($data['demo_in']); ?></script>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">返回参数示例</label>
								<div class="controls">
									<script id="demoOut" type="text/plain" style="width: 95%; height: 150px;"><?php echo ($data['demo_out']); ?></script>
								</div>
							</div>
							<!-- 
							<div class="control-group">
								<label class="control-label">接口开发者</label>
								<div class="controls">
									<input type="text" class="span5" name="author" id="" author"" placeholder="请输入接口开发人员姓名（必填）" value="<?php echo ($data['author']); ?>"/>
								</div>
							</div>
							 -->
							<div class="control-group">
								<label class="control-label">排序</label>
								<div class="controls">
									<input type="text" name="sort" id="sort" class="span5"  placeholder="请输入接口展示排序（越大越前，必填）" value="<?php echo ($data['sort']); ?>"/>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">接口描述</label>
								<div class="controls">
									<textarea name="discription" id="discription" class="span11"  placeholder="请输入接口描述"><?php echo ($data['discription']); ?></textarea>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">备注</label>
								<div class="controls">
									<textarea name="remark" id="remark" class="span11" placeholder="请输入接口备注"><?php echo ($data['remark']); ?></textarea>
								</div>
							</div>
						</div>
						<input type="hidden" name="m_id" value="<?php echo I('m_id');?>" /> 
						<input type="hidden" name="p_id" value="<?php echo I('p_id');?>" /> 
						<input type="hidden" name="id" value="<?php echo ($data['id']); ?>" />
						<div class="form-actions">
							<button type="submit" class="btn btn-success fa fa-save">确定</button>
							<button type="reset" class="btn btn-primary fa fa-edit">重置</button>
							<button type="button" class="btn btn-danger fa fa-reply"
								onclick="javascript:window.location='/myframework/<?php echo (CONTROLLER_NAME); ?>/viewList/m_id/<?php echo I('m_id');?>/p_id/<?php echo I('p_id');?>'">
								返回</button>
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

</div>

<!--end-main-container-part-->
<!--Footer-part-->

<div class="row-fluid">
	<div id="footer" class="span12"></div>
 </div>

<!--end-Footer-part-->
 
<script src="/myframework/Public/JsResources/Jquery/jquery.min.js"></script> 
<script src="/myframework/Public/JsResources/Jquery/jquery.ui.custom.js"></script> 
<script src="/myframework/Public/JsResources/Bootstrap/bootstrap.min.js"></script> 
<script src="/myframework/Public/JsResources/Jquery/jquery.uniform.js"></script> 
<script src="/myframework/Public/JsResources/Jquery/jquery.dataTables.min.js"></script> 
<script src="/myframework/Public/JsResources/Matrix/matrix.js"></script> 
<script src="/myframework/Public/JsResources/Matrix/matrix.tables.js"></script> 
 <?php switch($PAGE_FROM): case "Index": ?><script src="/myframework/Public/JsResources/excanvas.min.js"></script> 
		<script src="/myframework/Public/JsResources/Jquery/jquery.flot.min.js"></script> 
		<script src="/myframework/Public/JsResources/Jquery/jquery.flot.resize.min.js"></script> 
		<script src="/myframework/Public/JsResources/Jquery/jquery.peity.min.js"></script> 
		<script src="/myframework/Public/JsResources/fullcalendar.min.js"></script> 
		<script src="/myframework/Public/JsResources/Matrix/matrix.dashboard.js"></script> 
		<script src="/myframework/Public/JsResources/Matrix/jquery.gritter.min.js"></script> 
		<script src="/myframework/Public/JsResources/Matrix/matrix.interface.js"></script> 
		<script src="/myframework/Public/JsResources/Matrix/matrix.chat.js"></script> 
		<script src="/myframework/Public/JsResources/Jquery/jquery.validate.js"></script> 
		<script src="/myframework/Public/JsResources/Matrix/matrix.form_validation.js"></script> 
		<script src="/myframework/Public/JsResources/Jquery/Jquery.wizard.js"></script> 
		<script src="/myframework/Public/JsResources/select2.min.js"></script> 
		<script src="/myframework/Public/JsResources/Matrix/matrix.popover.js"></script><?php break;?>
 	<?php case "List": ?><script src="/myframework/Public/JsResources/select2.min.js"></script> 
		<script src="/myframework/Public/JsResources/Matrix/matrix.interface.js"></script> 
		<script src="/myframework/Public/JsResources/list-opration.js"></script><?php break;?>
 	<?php case "Add": ?><script src="/myframework/Public/JsResources/Jquery/jquery.validate.js"></script> 
 		<script src="/myframework/Public/JsResources/select2.min.js"></script> 
 		<script src="/myframework/Public/JsResources/Matrix/matrix.form_validation.js"></script> 
 		<script src="/myframework/Public/JsResources/Matrix/matrix.form_common.js"></script> 
		<script src="/myframework/Public/JsResources/iconSelect.js"></script><?php break; endswitch;?>
 <?php if($PAGE_FROM == Index): ?><script type="text/javascript">
	  // This function is called from the pop-up menus to transfer to
	  // a different page. Ignore if the value returned is a null string:
	  function goPage (newURL) {
	
	      // if url is empty, skip the menu dividers and reset the menu selection to default
	      if (newURL != "") {
	      
	          // if url is "-", it is this page -- reset the menu:
	          if (newURL == "-" ) {
	              resetMenu();            
	          } 
	          // else, send page to designated URL            
	          else {  
	            document.location.href = newURL;
	          }
	      }
	  }
	
	// resets the menu selection upon entry to this page:
	function resetMenu() {
	   document.gomenu.selector.selectedIndex = 2;
	}
	
	</script><?php endif; ?>
</body>
</html>