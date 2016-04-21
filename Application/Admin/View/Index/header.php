<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<title>__BG_NAME__</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta chartset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- 引入样式表 -->
<load href="__STYLE_RES__/Bootstrap/bootstrap.min.css" />
<load href="__STYLE_RES__/Bootstrap/bootstrap-responsive.min.css" />
<load href="__STYLE_RES__/Matrix/matrix-style.css" />
<load href="__STYLE_RES__/Matrix/matrix-media.css" />

<switch name="PAGE_FROM">
	<case value="Index">
		<load href="__STYLE_RES__/fullcalendar.css" />
		<load href="__STYLE_RES__/Matrix/matrix-media.css/jquery.gritter.css" />
	</case>
	<case value="List|Add">
		<load href="__STYLE_RES__/uniform.css" />
		<load href="__STYLE_RES__/select2.css" />
	</case>
</switch>
<load href="__STYLE_RES__/font-awesome-4.4.0/css/font-awesome.css" />
<!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'> -->
<script type="text/javascript">
var urlHead="__ROOT__/{$Think.CONTROLLER_NAME}/";
</script>

</head>
<body>

<!--Header-part-->
<div id="header">

  <h1><a href="dashboard.html">__BG_NAME__</a></h1>
</div>
<!--close-Header-part--> 
<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="fa fa-user"></i>  <span class="text">欢迎你 {$Think.session.adminName}</span><b class="caret"></b></a>
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
    <li class=""><a title="" href="__ROOT__/index/logout"><i class="fa fa-share-alt"></i> <span class="text">安全退出</span></a></li>
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
	
	<li <?php if(I('p_id') == "" || I('p_id') == null){?>class="active"<?php }?>><a href="__ROOT__/index/index"><i class="fa fa-home"></i> <span>首页</span></a> </li>

	<volist name="Menu" id="menuItem">
		<if condition="count($menuItem['subMenu']) gt 0">
			<li class="submenu <?php if(I('p_id') == $menuItem['id']){?> open<?php }?>"> <a href="#"><i class="fa {$menuItem['menu_icon']}"></i> <span>{$menuItem.menu_name}</span> <span class="label label-important"><?php echo count($menuItem['subMenu']);?></span></a>
			<ul>
				<volist name="menuItem.subMenu" id="submenuItem">
					<li <?php if(I('m_id') == $submenuItem['id']){?>class="active"<?php }?>><span><a href="__ROOT__{$submenuItem.uri}/m_id/{$submenuItem.id}/p_id/{$menuItem.id}"><i class="fa {$submenuItem.menu_icon}" style="margin-right: 10px;"></i>{$submenuItem.menu_name}</a></span></li>
				</volist>
			</ul>
			</li>
			<else/>
			<li><a href="{$menuItem.uri}/m_id/{$menuItem.id}/p_id/{$menuItem.id}"><i class="fa "></i> <span>{$menuItem.menu_name}</span></a> </li>
		</if>
	</volist>
	</ul>
</div>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
	    <a href="__ROOT__/Index/Index" title="Go to Home" class="tip-bottom"><i class="fa-home"></i> 首页</a>
	    <if condition="$BreadCrumb[0] neq null">
	    	<a href="#" class="current">{$BreadCrumb[0]}</a>
	    </if>
	    <if condition="$BreadCrumb[1] neq null">
	    	<a href="#" class="current">{$BreadCrumb[1]}</a>
	    </if>
	    
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
						<form action="__ROOT__/Admins/setPsw/" method="post" id="setPswForm" class="form-horizontal">

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
