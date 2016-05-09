<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<title>车维汇汽车服务平台-接口发布管理</title>
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
<!-- 代码着色器初始化 -->
<?php if($CODE == true): ?><link rel="stylesheet" type="text/css" href="/myframework/Public/StyleResources/code/shCoreDefault.css" />
	<script type="text/javascript" src="/myframework/Public/JsResources/code/shCore.js"></script>
	<script type="text/javascript" src="/myframework/Public/JsResources/code/shBrushXml.js"></script>
	<script type="text/javascript">SyntaxHighlighter.all();</script><?php endif; ?>
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
	
	<li <?php if(I('p_id') == "" || I('p_id') == null){?>class="active"<?php }?>><a href="<?php echo U('Inter/Index/Index');?>"><i class="fa fa-rocket"></i> <span>全部</span></a> </li>

	<?php if(is_array($icData)): $i = 0; $__LIST__ = $icData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$icItem): $mod = ($i % 2 );++$i; if(count($icItem['children']) > 0): ?><li class="submenu <?php if(I('p_id') == $icItem['id']){?> open<?php }?>"> <a href="<?php echo U('Inter/Index/Index' , array('m_id' => $icItem['id'] , 'p_id' => $icItem['id']));?>"><i class="fa fa-retweet"></i> <span><?php echo ($icItem["name"]); ?></span> <span class="label label-important"><?php echo count($icItem['children']);?></span></a>
			<ul>
				<?php if(is_array($icItem["children"])): $i = 0; $__LIST__ = $icItem["children"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$icChiItem): $mod = ($i % 2 );++$i;?><li <?php if(I('m_id') == $icChiItem['id']){?>class="active"<?php }?>><span><a href="<?php echo U('Inter/Index/Index' , array('m_id' => $icChiItem['id'] , 'p_id' => $icItem['id']));?>"><i class="fa fa-retweet" style="margin-right: 10px;"></i><?php echo ($icChiItem["name"]); ?></a></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			</li>
			<?php else: ?>
			<li><a href="<?php echo U('Inter/Index/Index' , array('m_id' => $icItem['id'] , 'p_id' => $icItem['id']));?>"><i class="fa fa-retweet"></i> <span><?php echo ($icItem["name"]); ?></span></a> </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
	</ul>
</div>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
	    <a href="<?php echo U('Inter/Index/document');?>" title="Go to Home" class="tip-bottom"><i class="fa-home"></i> 首页</a>
	    <?php if($BreadCrumb[0] != null): ?><a href="#" class="current"><?php echo ($BreadCrumb[0]); ?></a><?php endif; ?>
	    <?php if($BreadCrumb[1] != null): ?><a href="#" class="current"><?php echo ($BreadCrumb[1]); ?></a><?php endif; ?>
	    
    </div>
     <h1><?php echo ($intData["name"]); ?></h1>
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
	<hr>
	<div class="row-fluid">
		<div class="span7">
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"> <i class="fa fa-exchange"></i>
					</span>
					<h5>接口详情</h5>
				</div>
				<div class="widget-content nopadding">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="15%">项目</th>
								<th>值</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>接口描述</td>
								<td><?php echo ($intData["discription"]); ?></td>
							</tr>
							<tr>
								<td>调用方法</td>
								<td><?php if($intData["int_method"] == '00A'): ?>GET方法<?php endif; ?> <?php if($intData["int_method"] == '00B'): ?>POST方法<?php endif; ?></td>
							</tr>
							<tr>
								<td>所属分类</td>
								<td><?php echo ($intData["category_name"]); ?></td>
							</tr>
							<tr>
								<td>开发者</td>
								<td><?php echo ($intData["author"]); ?></td>
							</tr>
							<tr>
								<td>正式地址</td>
								<td><?php echo ($intData["url"]); ?></td>
							</tr>
							<tr>
								<td>测试地址</td>
								<td><?php echo ($intData["test_url"]); ?></td>
							</tr>
							<tr>
								<td>备注</td>
								<td><?php echo ($intData["remark"]); ?></td>
							</tr>
							<tr>
								<td>发布时间</td>
								<td><?php echo ($intData["create_time"]); ?></td>
							</tr>
							<tr>
								<td>修改时间</td>
								<td><?php echo ($intData["update_time"]); ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"> <i class="fa fa-exchange"></i>
					</span>
					<h5>Parameters List</h5>
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#paramIn">传入参数(<?php echo count($params['paramIn']);?>)</a></li>
						<li><a data-toggle="tab" href="#paramOut">返回参数(<?php echo count($params['paramOut']);?>)</a></li>
						<li><a data-toggle="tab" href="#code">Code(<?php echo count($codes);?>)</a></li>
					</ul>
				</div>
				<div class="widget-content tab-content nopadding">
					<div id="paramIn" class="tab-pane active">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="1%">M</th>
									<th width="10%">名称</th>
									<th width="5%">类型</th>
									<th width="5%">位置</th>
								</tr>
							</thead>
							<tbody>
								<?php if(is_array($params['paramIn'])): $i = 0; $__LIST__ = $params['paramIn'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dataIn): $mod = ($i % 2 );++$i;?><tr>
									<td rowspan="2"><?php if($dataIn["must"] == '00A'): ?><span class="icon">
											<i class="fa fa-star"></i>
										</span><?php endif; ?>
										<?php if($dataIn["must"] == '00B'): ?><span class="icon">
											<i class="fa fa-star-o"></i>
										</span><?php endif; ?>
									</td>
									<td><?php echo ($dataIn["name"]); ?></td>
									<td>
										<?php if($dataIn["param_type"] == '00A'): ?>String<?php endif; ?>
										<?php if($dataIn["param_type"] == '00B'): ?>Number<?php endif; ?>
										<?php if($dataIn["param_type"] == '00C'): ?>Json<?php endif; ?>
									</td>
									<td>
										<?php if($dataIn["param_loc"] == '00A'): ?>Header参数<?php endif; ?>
										<?php if($dataIn["param_loc"] == '00B'): ?>Url参数<?php endif; ?>
									</td>
								</tr>
								<tr ><td colspan="3"><?php echo ($dataIn["discription"]); ?></td></tr><?php endforeach; endif; else: echo "" ;endif; ?>
							</tbody>
						</table>
					</div>
					<div id="paramOut" class="tab-pane">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="1%">M</th>
									<th width="10%">名称</th>
									<th width="5%">类型</th>
									<th width="5%">位置</th>
								</tr>
							</thead>
							<tbody>
								<?php if(is_array($params['paramOut'])): $i = 0; $__LIST__ = $params['paramOut'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dataIn): $mod = ($i % 2 );++$i;?><tr>
									<td rowspan="2"><?php if($dataIn["must"] == '00A'): ?><span class="icon">
											<i class="fa fa-star"></i>
										</span><?php endif; ?>
										<?php if($dataIn["must"] == '00B'): ?><span class="icon">
											<i class="fa fa-star-o"></i>
										</span><?php endif; ?>
									</td>
									<td><?php echo ($dataIn["name"]); ?></td>
									<td>
										<?php if($dataIn["param_type"] == '00A'): ?>String<?php endif; ?>
										<?php if($dataIn["param_type"] == '00B'): ?>Number<?php endif; ?>
										<?php if($dataIn["param_type"] == '00C'): ?>Json<?php endif; ?>
									</td>
									<td>
										<?php if($dataIn["param_loc"] == '00A'): ?>Header参数<?php endif; ?>
										<?php if($dataIn["param_loc"] == '00B'): ?>Url参数<?php endif; ?>
									</td>
								</tr>
								<tr ><td colspan="3"><?php echo ($dataIn["discription"]); ?></td></tr><?php endforeach; endif; else: echo "" ;endif; ?>
							</tbody>
						</table>
					</div>
					<div id="code" class="tab-pane">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="5%">Code</th>
									<th>值</th>
								</tr>
							</thead>
							<tbody>
								<?php if(is_array($codes)): $i = 0; $__LIST__ = $codes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$code): $mod = ($i % 2 );++$i;?><tr>
										<td rowspan="2"><?php echo ($code["code_name"]); ?></td>
										<td>Msg:<?php echo ($code["code_msg"]); ?></td>
									</tr>
									<tr>
										<td>描述:<?php echo ($code["discription"]); ?></td>
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="span5">
			
			<div class="widget-box">
				<div class="widget-title">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#demo_in">传入Demo</a></li>
						<li><a data-toggle="tab" href="#demo_out">返回Demo</a></li>
					</ul>
				</div>
				<div class="widget-content tab-content">
					<div id="demo_in" class="tab-pane active">
						<?php echo ($intData["demo_in"]); ?>
					</div>
					<div id="demo_out" class="tab-pane">
						<?php echo ($intData["demo_out"]); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	
</div>
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