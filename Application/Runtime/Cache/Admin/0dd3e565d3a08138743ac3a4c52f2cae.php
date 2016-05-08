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
						href="/myframework/<?php echo (CONTROLLER_NAME); ?>/add/m_id/<?php echo I('m_id');?>/p_id/<?php echo I('p_id');?>"><button
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
							<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
								<td><input type="checkbox" name="checkBoxItems" value="<?php echo ($vo["id"]); ?>" /></td>
								<td><?php echo ($vo["name"]); ?></td>
								<td><?php if($vo["sex"] == '00A'): ?>男<?php elseif($vo["sex"] == '00B'): ?>女<?php endif; ?></td>
								<td><?php echo ($vo["tel_phone"]); ?></td>
								<td><?php echo ($vo["account"]); ?></td>
								<td><?php if($vo["state"] == '00A'): ?>正常<?php elseif($vo["state"] == '00B'): ?>已冻结<?php endif; ?></td>
								<td><?php echo ($vo["last_login"]); ?></td>
								<td><?php echo ($vo["create_time"]); ?></td>
								<td>
									<div class="btn-group">
										<button data-toggle="dropdown"
											class="btn btn-mini dropdown-toggle ">
											单项操作<span class="caret"></span>
										</button>
										<ul class="dropdown-menu">
											<li><a href="#detail" class="fa fa-file-o" data-toggle="modal" onclick="javascrpt:loadDetail('<?php echo ($vo["id"]); ?>');"> 详情</a></li>
											<li><a href="/myframework/<?php echo (CONTROLLER_NAME); ?>/modify/m_id/<?php echo I('m_id');?>/p_id/<?php echo I('p_id');?>/id/<?php echo ($vo["id"]); ?>" class="fa fa-edit"> 修改</a></li>
											<li class="divider"></li>
											<li><a href="/myframework/<?php echo (CONTROLLER_NAME); ?>/pswreset/m_id/<?php echo I('m_id');?>/p_id/<?php echo I('p_id');?>/id/<?php echo ($vo["id"]); ?>" class="fa fa-key"> 密码重置</a></li>
											<li><a href="/myframework/<?php echo (CONTROLLER_NAME); ?>/frozen/m_id/<?php echo I('m_id');?>/p_id/<?php echo I('p_id');?>/id/<?php echo ($vo["id"]); ?>" class="fa fa-key"> 冻结帐号</a></li>
											<li class="divider"></li>
											<li><a href="#myAlert" data-toggle="modal" onclick="javascript:deleteItem(0 , '<?php echo ($vo["id"]); ?>');" class="fa fa-trash"> 删除</a></li>
										</ul>
									</div>
								</td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
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
						<form action="/myframework/<?php echo (CONTROLLER_NAME); ?>/show/" method="get" id="searchFrom" class="form-horizontal">
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

							<input type="hidden" name="m_id" value="<?php echo I('m_id');?>" /> <input
								type="hidden" name="p_id" value="<?php echo I('p_id');?>" />
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
			<div class="pagination fr"><?php echo ($pageData); ?></div>
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
	var deleteUrl = "/myframework/<?php echo (CONTROLLER_NAME); ?>/delete/";
	var mid = "<?php echo I('m_id');?>";
	var pid = "<?php echo I('p_id');?>";
	
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
			url: "/myframework/<?php echo (CONTROLLER_NAME); ?>/getDetail/",
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