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
	
	<li <?php if(I('p_id') == "" || I('p_id') == null){?>class="active"<?php }?>><a href="/myframework/index/index"><i class="fa fa-home"></i> <span>首页</span></a> </li>

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
					<h5>修改菜单</h5>
				</div>
				<div class="widget-content nopadding">
					<form class="form-horizontal" method="post"
						action="/myframework/resources/menumodify" name="menu"
						id="menu_validate" novalidate="novalidate">
						<div class="control-group">
							<label class="control-label">菜单名称</label>
							<div class="controls">
								<input type="text" name="menu_name" id="menu_name"
									style="width: 300px;" value="<?php echo ($data[0]['menu_name']); ?>" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">父菜单</label>
							<div class="controls">
								<select style="width: 315px;" name="pid" id="pid">
									<option value="none"<?php if($data[0]['pid'] == null): ?>selected="selected"<?php endif; ?>>我就是父菜单
									</option>
									<?php if(is_array($mainMenu)): $i = 0; $__LIST__ = $mainMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>/<?php echo ($vo["menu_name"]); ?>"<?php if($vo["id"] == $data[0]['pid']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["menu_name"]); ?>
									</option><?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">菜单URI</label>
							<div class="controls">
								<input type="text" name="uri" id="uri" style="width: 300px;"
									value="<?php echo ($data[0]['uri']); ?>" />
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">排序</label>
							<div class="controls">
								<input type="text" name="sort" id="sort" style="width: 300px;"
									value="<?php echo ($data[0]['sort']); ?>" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">菜单icon</label>
							<div class="controls">
								<input type="hidden" name="icon" id="icon" value="<?php echo ($data[0]['menu_icon']); ?>" /> <a href="#myIcons" data-toggle="modal"><button class="btn"><i class="fa <?php echo ($data[0]['menu_icon']); ?>" style="margin-right: 20px;" id="selectedI"></i>点击选择</button></a>
							</div>
						</div>


						<input type="hidden" name="m_id" value="<?php echo I('m_id');?>" /> 
						<input type="hidden" name="p_id" value="<?php echo I('p_id');?>" /> 
						<input type="hidden" name="id" value="<?php echo ($data[0]['id']); ?>" />
						<div class="form-actions">
							<button type="submit" value="确定" class="btn btn-success fa fa-save"> 确定</button>
							<button type="reset" class="btn btn-primary fa fa-edit"> 重置</button>
							<button type="button" class="btn btn-danger fa fa-reply" onclick="javascript:window.location='/myframework/<?php echo (CONTROLLER_NAME); ?>/menulist/m_id/<?php echo I('m_id');?>/p_id/<?php echo I('p_id');?>'"> 返回</button>
						</div>
					</form>
					<div id="myIcons" class="modal hide modal-width-2"">
						<div class="modal-header">
							<button data-dismiss="modal" class="close" type="button">×</button>
							<h3>Icon 选择器</h3>
						</div>
						<div class="modal-body">
							<div class="span12 btn-icon-pg">
								<ul id="icons">
<li data-dismiss="modal">  <i class="fa  fa-glass "></i>  fa-glass</li>
<li data-dismiss="modal">  <i class="fa  fa-music "></i>  fa-music</li>
<li data-dismiss="modal">  <i class="fa  fa-search "></i>  fa-search</li>
<li data-dismiss="modal">  <i class="fa  fa-envelope-o "></i>  fa-envelope-o</li>
<li data-dismiss="modal">  <i class="fa  fa-heart "></i>  fa-heart</li>
<li data-dismiss="modal">  <i class="fa  fa-star "></i>  fa-star</li>
<li data-dismiss="modal">  <i class="fa  fa-star-o "></i>  fa-star-o</li>
<li data-dismiss="modal">  <i class="fa  fa-user "></i>  fa-user</li>
<li data-dismiss="modal">  <i class="fa  fa-film "></i>  fa-film</li>
<li data-dismiss="modal">  <i class="fa  fa-th-large "></i>  fa-th-large</li>
<li data-dismiss="modal">  <i class="fa  fa-th "></i>  fa-th</li>
<li data-dismiss="modal">  <i class="fa  fa-th-list "></i>  fa-th-list</li>
<li data-dismiss="modal">  <i class="fa  fa-check "></i>  fa-check</li>
<li data-dismiss="modal">  <i class="fa  fa-remove "></i>  fa-remove</li>
<li data-dismiss="modal">  <i class="fa  fa-close "></i>  fa-close</li>
<li data-dismiss="modal">  <i class="fa  fa-times "></i>  fa-times</li>
<li data-dismiss="modal">  <i class="fa  fa-search-plus "></i>  fa-search-plus</li>
<li data-dismiss="modal">  <i class="fa  fa-search-minus "></i>  fa-search-minus</li>
<li data-dismiss="modal">  <i class="fa  fa-power-off "></i>  fa-power-off</li>
<li data-dismiss="modal">  <i class="fa  fa-signal "></i>  fa-signal</li>
<li data-dismiss="modal">  <i class="fa  fa-gear "></i>  fa-gear</li>
<li data-dismiss="modal">  <i class="fa  fa-cog "></i>  fa-cog</li>
<li data-dismiss="modal">  <i class="fa  fa-trash-o "></i>  fa-trash-o</li>
<li data-dismiss="modal">  <i class="fa  fa-home "></i>  fa-home</li>
<li data-dismiss="modal">  <i class="fa  fa-file-o "></i>  fa-file-o</li>
<li data-dismiss="modal">  <i class="fa  fa-clock-o "></i>  fa-clock-o</li>
<li data-dismiss="modal">  <i class="fa  fa-road "></i>  fa-road</li>
<li data-dismiss="modal">  <i class="fa  fa-download "></i>  fa-download</li>
<li data-dismiss="modal">  <i class="fa  fa-arrow-circle-o-down "></i>  fa-arrow-circle-</li>
<li data-dismiss="modal">  <i class="fa  fa-arrow-circle-o-up "></i>  fa-arrow-circle-o-</li>
<li data-dismiss="modal">  <i class="fa  fa-inbox "></i>  fa-inbox</li>
<li data-dismiss="modal">  <i class="fa  fa-play-circle-o "></i>  fa-play-circle-o</li>
<li data-dismiss="modal">  <i class="fa  fa-rotate-right "></i>  fa-rotate-right</li>
<li data-dismiss="modal">  <i class="fa  fa-repeat "></i>  fa-repeat</li>
<li data-dismiss="modal">  <i class="fa  fa-refresh "></i>  fa-refresh</li>
<li data-dismiss="modal">  <i class="fa  fa-list-alt "></i>  fa-list-alt</li>
<li data-dismiss="modal">  <i class="fa  fa-lock "></i>  fa-lock</li>
<li data-dismiss="modal">  <i class="fa  fa-flag "></i>  fa-flag</li>
<li data-dismiss="modal">  <i class="fa  fa-headphones "></i>  fa-headphones</li>
<li data-dismiss="modal">  <i class="fa  fa-volume-off "></i>  fa-volume-off</li>
<li data-dismiss="modal">  <i class="fa  fa-volume-down "></i>  fa-volume-down</li>
<li data-dismiss="modal">  <i class="fa  fa-volume-up "></i>  fa-volume-up</li>
<li data-dismiss="modal">  <i class="fa  fa-qrcode "></i>  fa-qrcode</li>
<li data-dismiss="modal">  <i class="fa  fa-barcode "></i>  fa-barcode</li>
<li data-dismiss="modal">  <i class="fa  fa-tag "></i>  fa-tag</li>
<li data-dismiss="modal">  <i class="fa  fa-tags "></i>  fa-tags</li>
<li data-dismiss="modal">  <i class="fa  fa-book "></i>  fa-book</li>
<li data-dismiss="modal">  <i class="fa  fa-bookmark "></i>  fa-bookmark</li>
<li data-dismiss="modal">  <i class="fa  fa-print "></i>  fa-print</li>
<li data-dismiss="modal">  <i class="fa  fa-camera "></i>  fa-camera</li>
<li data-dismiss="modal">  <i class="fa  fa-font "></i>  fa-font</li>
<li data-dismiss="modal">  <i class="fa  fa-bold "></i>  fa-bold</li>
<li data-dismiss="modal">  <i class="fa  fa-italic "></i>  fa-italic</li>
<li data-dismiss="modal">  <i class="fa  fa-text-height "></i>  fa-text-height</li>
<li data-dismiss="modal">  <i class="fa  fa-text-width "></i>  fa-text-width</li>
<li data-dismiss="modal">  <i class="fa  fa-align-left "></i>  fa-align-left</li>
<li data-dismiss="modal">  <i class="fa  fa-align-center "></i>  fa-align-center</li>
<li data-dismiss="modal">  <i class="fa  fa-align-right "></i>  fa-align-right</li>
<li data-dismiss="modal">  <i class="fa  fa-align-justify "></i>  fa-align-justify</li>
<li data-dismiss="modal">  <i class="fa  fa-list "></i>  fa-list</li>
<li data-dismiss="modal">  <i class="fa  fa-dedent "></i>  fa-dedent</li>
<li data-dismiss="modal">  <i class="fa  fa-outdent "></i>  fa-outdent</li>
<li data-dismiss="modal">  <i class="fa  fa-indent "></i>  fa-indent</li>
<li data-dismiss="modal">  <i class="fa  fa-video-camera "></i>  fa-video-camera</li>
<li data-dismiss="modal">  <i class="fa  fa-photo "></i>  fa-photo</li>
<li data-dismiss="modal">  <i class="fa  fa-image "></i>  fa-image</li>
<li data-dismiss="modal">  <i class="fa  fa-picture-o "></i>  fa-picture-o</li>
<li data-dismiss="modal">  <i class="fa  fa-pencil "></i>  fa-pencil</li>
<li data-dismiss="modal">  <i class="fa  fa-map-marker "></i>  fa-map-marker</li>
<li data-dismiss="modal">  <i class="fa  fa-adjust "></i>  fa-adjust</li>
<li data-dismiss="modal">  <i class="fa  fa-tint "></i>  fa-tint</li>
<li data-dismiss="modal">  <i class="fa  fa-edit "></i>  fa-edit</li>
<li data-dismiss="modal">  <i class="fa  fa-pencil-square-o "></i>  fa-pencil-square-o</li>
<li data-dismiss="modal">  <i class="fa  fa-share-square-o "></i>  fa-share-square-o</li>
<li data-dismiss="modal">  <i class="fa  fa-check-square-o "></i>  fa-check-square-o</li>
<li data-dismiss="modal">  <i class="fa  fa-arrows "></i>  fa-arrows</li>
<li data-dismiss="modal">  <i class="fa  fa-step-backward "></i>  fa-step-backward</li>
<li data-dismiss="modal">  <i class="fa  fa-fast-backward "></i>  fa-fast-backward</li>
<li data-dismiss="modal">  <i class="fa  fa-backward "></i>  fa-backward</li>
<li data-dismiss="modal">  <i class="fa  fa-play "></i>  fa-play</li>
<li data-dismiss="modal">  <i class="fa  fa-pause "></i>  fa-pause</li>
<li data-dismiss="modal">  <i class="fa  fa-stop "></i>  fa-stop</li>
<li data-dismiss="modal">  <i class="fa  fa-forward "></i>  fa-forward</li>
<li data-dismiss="modal">  <i class="fa  fa-fast-forward "></i>  fa-fast-forward</li>
<li data-dismiss="modal">  <i class="fa  fa-step-forward "></i>  fa-step-forward</li>
<li data-dismiss="modal">  <i class="fa  fa-eject "></i>  fa-eject</li>
<li data-dismiss="modal">  <i class="fa  fa-chevron-left "></i>  fa-chevron-left</li>
<li data-dismiss="modal">  <i class="fa  fa-chevron-right "></i>  fa-chevron-right</li>
<li data-dismiss="modal">  <i class="fa  fa-plus-circle "></i>  fa-plus-circle</li>
<li data-dismiss="modal">  <i class="fa  fa-minus-circle "></i>  fa-minus-circle</li>
<li data-dismiss="modal">  <i class="fa  fa-times-circle "></i>  fa-times-circle</li>
<li data-dismiss="modal">  <i class="fa  fa-check-circle "></i>  fa-check-circle</li>
<li data-dismiss="modal">  <i class="fa  fa-question-circle "></i>  fa-question-circle</li>
<li data-dismiss="modal">  <i class="fa  fa-info-circle "></i>  fa-info-circle</li>
<li data-dismiss="modal">  <i class="fa  fa-crosshairs "></i>  fa-crosshairs</li>
<li data-dismiss="modal">  <i class="fa  fa-times-circle-o "></i>  fa-times-circle-o</li>
<li data-dismiss="modal">  <i class="fa  fa-check-circle-o "></i>  fa-check-circle-o</li>
<li data-dismiss="modal">  <i class="fa  fa-ban "></i>  fa-ban</li>
<li data-dismiss="modal">  <i class="fa  fa-arrow-left "></i>  fa-arrow-left</li>
<li data-dismiss="modal">  <i class="fa  fa-arrow-right "></i>  fa-arrow-right</li>
<li data-dismiss="modal">  <i class="fa  fa-arrow-up "></i>  fa-arrow-up</li>
<li data-dismiss="modal">  <i class="fa  fa-arrow-down "></i>  fa-arrow-down</li>
<li data-dismiss="modal">  <i class="fa  fa-mail-forward "></i>  fa-mail-forward</li>
<li data-dismiss="modal">  <i class="fa  fa-share "></i>  fa-share</li>
<li data-dismiss="modal">  <i class="fa  fa-expand "></i>  fa-expand</li>
<li data-dismiss="modal">  <i class="fa  fa-compress "></i>  fa-compress</li>
<li data-dismiss="modal">  <i class="fa  fa-plus "></i>  fa-plus</li>
<li data-dismiss="modal">  <i class="fa  fa-minus "></i>  fa-minus</li>
<li data-dismiss="modal">  <i class="fa  fa-asterisk "></i>  fa-asterisk</li>
<li data-dismiss="modal">  <i class="fa  fa-exclamation-circle "></i>  fa-exclamation-ci</li>
<li data-dismiss="modal">  <i class="fa  fa-gift "></i>  fa-gift</li>
<li data-dismiss="modal">  <i class="fa  fa-leaf "></i>  fa-leaf</li>
<li data-dismiss="modal">  <i class="fa  fa-fire "></i>  fa-fire</li>
<li data-dismiss="modal">  <i class="fa  fa-eye "></i>  fa-eye</li>
<li data-dismiss="modal">  <i class="fa  fa-eye-slash "></i>  fa-eye-slash</li>
<li data-dismiss="modal">  <i class="fa  fa-warning "></i>  fa-warning</li>
<li data-dismiss="modal">  <i class="fa  fa-exclamation-triangle "></i>  fa-exclamation-</li>
<li data-dismiss="modal">  <i class="fa  fa-plane "></i>  fa-plane</li>
<li data-dismiss="modal">  <i class="fa  fa-calendar "></i>  fa-calendar</li>
<li data-dismiss="modal">  <i class="fa  fa-random "></i>  fa-random</li>
<li data-dismiss="modal">  <i class="fa  fa-comment "></i>  fa-comment</li>
<li data-dismiss="modal">  <i class="fa  fa-magnet "></i>  fa-magnet</li>
<li data-dismiss="modal">  <i class="fa  fa-chevron-up "></i>  fa-chevron-up</li>
<li data-dismiss="modal">  <i class="fa  fa-chevron-down "></i>  fa-chevron-down</li>
<li data-dismiss="modal">  <i class="fa  fa-retweet "></i>  fa-retweet</li>
<li data-dismiss="modal">  <i class="fa  fa-shopping-cart "></i>  fa-shopping-cart</li>
<li data-dismiss="modal">  <i class="fa  fa-folder "></i>  fa-folder</li>
<li data-dismiss="modal">  <i class="fa  fa-folder-open "></i>  fa-folder-open</li>
<li data-dismiss="modal">  <i class="fa  fa-arrows-v "></i>  fa-arrows-v</li>
<li data-dismiss="modal">  <i class="fa  fa-arrows-h "></i>  fa-arrows-h</li>
<li data-dismiss="modal">  <i class="fa  fa-bar-chart-o "></i>  fa-bar-chart-o</li>
<li data-dismiss="modal">  <i class="fa  fa-bar-chart "></i>  fa-bar-chart</li>
<li data-dismiss="modal">  <i class="fa  fa-twitter-square "></i>  fa-twitter-square</li>
<li data-dismiss="modal">  <i class="fa  fa-facebook-square "></i>  fa-facebook-square</li>
<li data-dismiss="modal">  <i class="fa  fa-camera-retro "></i>  fa-camera-retro</li>
<li data-dismiss="modal">  <i class="fa  fa-key "></i>  fa-key</li>
<li data-dismiss="modal">  <i class="fa  fa-gears "></i>  fa-gears</li>
<li data-dismiss="modal">  <i class="fa  fa-cogs "></i>  fa-cogs</li>
<li data-dismiss="modal">  <i class="fa  fa-comments "></i>  fa-comments</li>
<li data-dismiss="modal">  <i class="fa  fa-thumbs-o-up "></i>  fa-thumbs-o-up</li>
<li data-dismiss="modal">  <i class="fa  fa-thumbs-o-down "></i>  fa-thumbs-o-down</li>
<li data-dismiss="modal">  <i class="fa  fa-star-half "></i>  fa-star-half</li>
<li data-dismiss="modal">  <i class="fa  fa-heart-o "></i>  fa-heart-o</li>
<li data-dismiss="modal">  <i class="fa  fa-sign-out "></i>  fa-sign-out</li>
<li data-dismiss="modal">  <i class="fa  fa-linkedin-square "></i>  fa-linkedin-square</li>
<li data-dismiss="modal">  <i class="fa  fa-thumb-tack "></i>  fa-thumb-tack</li>
<li data-dismiss="modal">  <i class="fa  fa-external-link "></i>  fa-external-link</li>
<li data-dismiss="modal">  <i class="fa  fa-sign-in "></i>  fa-sign-in</li>
<li data-dismiss="modal">  <i class="fa  fa-trophy "></i>  fa-trophy</li>
<li data-dismiss="modal">  <i class="fa  fa-github-square "></i>  fa-github-square</li>
<li data-dismiss="modal">  <i class="fa  fa-upload "></i>  fa-upload</li>
<li data-dismiss="modal">  <i class="fa  fa-lemon-o "></i>  fa-lemon-o</li>
<li data-dismiss="modal">  <i class="fa  fa-phone "></i>  fa-phone</li>
<li data-dismiss="modal">  <i class="fa  fa-square-o "></i>  fa-square-o</li>
<li data-dismiss="modal">  <i class="fa  fa-bookmark-o "></i>  fa-bookmark-o</li>
<li data-dismiss="modal">  <i class="fa  fa-phone-square "></i>  fa-phone-square</li>
<li data-dismiss="modal">  <i class="fa  fa-twitter "></i>  fa-twitter</li>
<li data-dismiss="modal">  <i class="fa  fa-facebook-f "></i>  fa-facebook-f</li>
<li data-dismiss="modal">  <i class="fa  fa-facebook "></i>  fa-facebook</li>
<li data-dismiss="modal">  <i class="fa  fa-github "></i>  fa-github</li>
<li data-dismiss="modal">  <i class="fa  fa-unlock "></i>  fa-unlock</li>
<li data-dismiss="modal">  <i class="fa  fa-credit-card "></i>  fa-credit-card</li>
<li data-dismiss="modal">  <i class="fa  fa-feed "></i>  fa-feed</li>
<li data-dismiss="modal">  <i class="fa  fa-rss "></i>  fa-rss</li>
<li data-dismiss="modal">  <i class="fa  fa-hdd-o "></i>  fa-hdd-o</li>
<li data-dismiss="modal">  <i class="fa  fa-bullhorn "></i>  fa-bullhorn</li>
<li data-dismiss="modal">  <i class="fa  fa-bell "></i>  fa-bell</li>
<li data-dismiss="modal">  <i class="fa  fa-certificate "></i>  fa-certificate</li>
<li data-dismiss="modal">  <i class="fa  fa-hand-o-right "></i>  fa-hand-o-right</li>
<li data-dismiss="modal">  <i class="fa  fa-hand-o-left "></i>  fa-hand-o-left</li>
<li data-dismiss="modal">  <i class="fa  fa-hand-o-up "></i>  fa-hand-o-up</li>
<li data-dismiss="modal">  <i class="fa  fa-hand-o-down "></i>  fa-hand-o-down</li>
<li data-dismiss="modal">  <i class="fa  fa-arrow-circle-left "></i>  fa-arrow-circle-le</li>
<li data-dismiss="modal">  <i class="fa  fa-arrow-circle-right "></i>  fa-arrow-circle-r</li>
<li data-dismiss="modal">  <i class="fa  fa-arrow-circle-up "></i>  fa-arrow-circle-up</li>
<li data-dismiss="modal">  <i class="fa  fa-arrow-circle-down "></i>  fa-arrow-circle-do</li>
<li data-dismiss="modal">  <i class="fa  fa-globe "></i>  fa-globe</li>
<li data-dismiss="modal">  <i class="fa  fa-wrench "></i>  fa-wrench</li>
<li data-dismiss="modal">  <i class="fa  fa-tasks "></i>  fa-tasks</li>
<li data-dismiss="modal">  <i class="fa  fa-filter "></i>  fa-filter</li>
<li data-dismiss="modal">  <i class="fa  fa-briefcase "></i>  fa-briefcase</li>
<li data-dismiss="modal">  <i class="fa  fa-arrows-alt "></i>  fa-arrows-alt</li>
<li data-dismiss="modal">  <i class="fa  fa-group "></i>  fa-group</li>
<li data-dismiss="modal">  <i class="fa  fa-users "></i>  fa-users</li>
<li data-dismiss="modal">  <i class="fa  fa-chain "></i>  fa-chain</li>
<li data-dismiss="modal">  <i class="fa  fa-link "></i>  fa-link</li>
<li data-dismiss="modal">  <i class="fa  fa-cloud "></i>  fa-cloud</li>
<li data-dismiss="modal">  <i class="fa  fa-flask "></i>  fa-flask</li>
<li data-dismiss="modal">  <i class="fa  fa-cut "></i>  fa-cut</li>
<li data-dismiss="modal">  <i class="fa  fa-scissors "></i>  fa-scissors</li>
<li data-dismiss="modal">  <i class="fa  fa-copy "></i>  fa-copy</li>
<li data-dismiss="modal">  <i class="fa  fa-files-o "></i>  fa-files-o</li>
<li data-dismiss="modal">  <i class="fa  fa-paperclip "></i>  fa-paperclip</li>
<li data-dismiss="modal">  <i class="fa  fa-save "></i>  fa-save</li>
<li data-dismiss="modal">  <i class="fa  fa-floppy-o "></i>  fa-floppy-o</li>
<li data-dismiss="modal">  <i class="fa  fa-square "></i>  fa-square</li>
<li data-dismiss="modal">  <i class="fa  fa-navicon "></i>  fa-navicon</li>
<li data-dismiss="modal">  <i class="fa  fa-reorder "></i>  fa-reorder</li>
<li data-dismiss="modal">  <i class="fa  fa-bars "></i>  fa-bars</li>
<li data-dismiss="modal">  <i class="fa  fa-list-ul "></i>  fa-list-ul</li>
<li data-dismiss="modal">  <i class="fa  fa-list-ol "></i>  fa-list-ol</li>
<li data-dismiss="modal">  <i class="fa  fa-strikethrough "></i>  fa-strikethrough</li>
<li data-dismiss="modal">  <i class="fa  fa-underline "></i>  fa-underline</li>
<li data-dismiss="modal">  <i class="fa  fa-table "></i>  fa-table</li>
<li data-dismiss="modal">  <i class="fa  fa-magic "></i>  fa-magic</li>
<li data-dismiss="modal">  <i class="fa  fa-truck "></i>  fa-truck</li>
<li data-dismiss="modal">  <i class="fa  fa-pinterest "></i>  fa-pinterest</li>
<li data-dismiss="modal">  <i class="fa  fa-pinterest-square "></i>  fa-pinterest-square</li>
<li data-dismiss="modal">  <i class="fa  fa-google-plus-square "></i>  fa-google-plus-sq</li>
<li data-dismiss="modal">  <i class="fa  fa-google-plus "></i>  fa-google-plus</li>
<li data-dismiss="modal">  <i class="fa  fa-money "></i>  fa-money</li>
<li data-dismiss="modal">  <i class="fa  fa-caret-down "></i>  fa-caret-down</li>
<li data-dismiss="modal">  <i class="fa  fa-caret-up "></i>  fa-caret-up</li>
<li data-dismiss="modal">  <i class="fa  fa-caret-left "></i>  fa-caret-left</li>
<li data-dismiss="modal">  <i class="fa  fa-caret-right "></i>  fa-caret-right</li>
<li data-dismiss="modal">  <i class="fa  fa-columns "></i>  fa-columns</li>
<li data-dismiss="modal">  <i class="fa  fa-unsorted "></i>  fa-unsorted</li>
<li data-dismiss="modal">  <i class="fa  fa-sort "></i>  fa-sort</li>
<li data-dismiss="modal">  <i class="fa  fa-sort-down "></i>  fa-sort-down</li>
<li data-dismiss="modal">  <i class="fa  fa-sort-desc "></i>  fa-sort-desc</li>
<li data-dismiss="modal">  <i class="fa  fa-sort-up "></i>  fa-sort-up</li>
<li data-dismiss="modal">  <i class="fa  fa-sort-asc "></i>  fa-sort-asc</li>
<li data-dismiss="modal">  <i class="fa  fa-envelope "></i>  fa-envelope</li>
<li data-dismiss="modal">  <i class="fa  fa-linkedin "></i>  fa-linkedin</li>
<li data-dismiss="modal">  <i class="fa  fa-rotate-left "></i>  fa-rotate-left</li>
<li data-dismiss="modal">  <i class="fa  fa-undo "></i>  fa-undo</li>
<li data-dismiss="modal">  <i class="fa  fa-legal "></i>  fa-legal</li>
<li data-dismiss="modal">  <i class="fa  fa-gavel "></i>  fa-gavel</li>
<li data-dismiss="modal">  <i class="fa  fa-dashboard "></i>  fa-dashboard</li>
<li data-dismiss="modal">  <i class="fa  fa-tachometer "></i>  fa-tachometer</li>
<li data-dismiss="modal">  <i class="fa  fa-comment-o "></i>  fa-comment-o</li>
<li data-dismiss="modal">  <i class="fa  fa-comments-o "></i>  fa-comments-o</li>
<li data-dismiss="modal">  <i class="fa  fa-flash "></i>  fa-flash</li>
<li data-dismiss="modal">  <i class="fa  fa-bolt "></i>  fa-bolt</li>
<li data-dismiss="modal">  <i class="fa  fa-sitemap "></i>  fa-sitemap</li>
<li data-dismiss="modal">  <i class="fa  fa-umbrella "></i>  fa-umbrella</li>
<li data-dismiss="modal">  <i class="fa  fa-paste "></i>  fa-paste</li>
<li data-dismiss="modal">  <i class="fa  fa-clipboard "></i>  fa-clipboard</li>
<li data-dismiss="modal">  <i class="fa  fa-lightbulb-o "></i>  fa-lightbulb-o</li>
<li data-dismiss="modal">  <i class="fa  fa-exchange "></i>  fa-exchange</li>
<li data-dismiss="modal">  <i class="fa  fa-cloud-download "></i>  fa-cloud-download</li>
<li data-dismiss="modal">  <i class="fa  fa-cloud-upload "></i>  fa-cloud-upload</li>
<li data-dismiss="modal">  <i class="fa  fa-user-md "></i>  fa-user-md</li>
<li data-dismiss="modal">  <i class="fa  fa-stethoscope "></i>  fa-stethoscope</li>
<li data-dismiss="modal">  <i class="fa  fa-suitcase "></i>  fa-suitcase</li>
<li data-dismiss="modal">  <i class="fa  fa-bell-o "></i>  fa-bell-o</li>
<li data-dismiss="modal">  <i class="fa  fa-coffee "></i>  fa-coffee</li>
<li data-dismiss="modal">  <i class="fa  fa-cutlery "></i>  fa-cutlery</li>
<li data-dismiss="modal">  <i class="fa  fa-file-text-o "></i>  fa-file-text-o</li>
<li data-dismiss="modal">  <i class="fa  fa-building-o "></i>  fa-building-o</li>
<li data-dismiss="modal">  <i class="fa  fa-hospital-o "></i>  fa-hospital-o</li>
<li data-dismiss="modal">  <i class="fa  fa-ambulance "></i>  fa-ambulance</li>
<li data-dismiss="modal">  <i class="fa  fa-medkit "></i>  fa-medkit</li>
<li data-dismiss="modal">  <i class="fa  fa-fighter-jet "></i>  fa-fighter-jet</li>
<li data-dismiss="modal">  <i class="fa  fa-beer "></i>  fa-beer</li>
<li data-dismiss="modal">  <i class="fa  fa-h-square "></i>  fa-h-square</li>
<li data-dismiss="modal">  <i class="fa  fa-plus-square "></i>  fa-plus-square</li>
<li data-dismiss="modal">  <i class="fa  fa-angle-double-left "></i>  fa-angle-double-le</li>
<li data-dismiss="modal">  <i class="fa  fa-angle-double-right "></i>  fa-angle-double-r</li>
<li data-dismiss="modal">  <i class="fa  fa-angle-double-up "></i>  fa-angle-double-up</li>
<li data-dismiss="modal">  <i class="fa  fa-angle-double-down "></i>  fa-angle-double-do</li>
<li data-dismiss="modal">  <i class="fa  fa-angle-left "></i>  fa-angle-left</li>
<li data-dismiss="modal">  <i class="fa  fa-angle-right "></i>  fa-angle-right</li>
<li data-dismiss="modal">  <i class="fa  fa-angle-up "></i>  fa-angle-up</li>
<li data-dismiss="modal">  <i class="fa  fa-angle-down "></i>  fa-angle-down</li>
<li data-dismiss="modal">  <i class="fa  fa-desktop "></i>  fa-desktop</li>
<li data-dismiss="modal">  <i class="fa  fa-laptop "></i>  fa-laptop</li>
<li data-dismiss="modal">  <i class="fa  fa-tablet "></i>  fa-tablet</li>
<li data-dismiss="modal">  <i class="fa  fa-mobile-phone "></i>  fa-mobile-phone</li>
<li data-dismiss="modal">  <i class="fa  fa-mobile "></i>  fa-mobile</li>
<li data-dismiss="modal">  <i class="fa  fa-circle-o "></i>  fa-circle-o</li>
<li data-dismiss="modal">  <i class="fa  fa-quote-left "></i>  fa-quote-left</li>
<li data-dismiss="modal">  <i class="fa  fa-quote-right "></i>  fa-quote-right</li>
<li data-dismiss="modal">  <i class="fa  fa-spinner "></i>  fa-spinner</li>
<li data-dismiss="modal">  <i class="fa  fa-circle "></i>  fa-circle</li>
<li data-dismiss="modal">  <i class="fa  fa-mail-reply "></i>  fa-mail-reply</li>
<li data-dismiss="modal">  <i class="fa  fa-reply "></i>  fa-reply</li>
<li data-dismiss="modal">  <i class="fa  fa-github-alt "></i>  fa-github-alt</li>
<li data-dismiss="modal">  <i class="fa  fa-folder-o "></i>  fa-folder-o</li>
<li data-dismiss="modal">  <i class="fa  fa-folder-open-o "></i>  fa-folder-open-o</li>
<li data-dismiss="modal">  <i class="fa  fa-smile-o "></i>  fa-smile-o</li>
<li data-dismiss="modal">  <i class="fa  fa-frown-o "></i>  fa-frown-o</li>
<li data-dismiss="modal">  <i class="fa  fa-meh-o "></i>  fa-meh-o</li>
<li data-dismiss="modal">  <i class="fa  fa-gamepad "></i>  fa-gamepad</li>
<li data-dismiss="modal">  <i class="fa  fa-keyboard-o "></i>  fa-keyboard-o</li>
<li data-dismiss="modal">  <i class="fa  fa-flag-o "></i>  fa-flag-o</li>
<li data-dismiss="modal">  <i class="fa  fa-flag-checkered "></i>  fa-flag-checkered</li>
<li data-dismiss="modal">  <i class="fa  fa-terminal "></i>  fa-terminal</li>
<li data-dismiss="modal">  <i class="fa  fa-code "></i>  fa-code</li>
<li data-dismiss="modal">  <i class="fa  fa-mail-reply-all "></i>  fa-mail-reply-all</li>
<li data-dismiss="modal">  <i class="fa  fa-reply-all "></i>  fa-reply-all</li>
<li data-dismiss="modal">  <i class="fa  fa-star-half-empty "></i>  fa-star-half-empty</li>
<li data-dismiss="modal">  <i class="fa  fa-star-half-full "></i>  fa-star-half-full</li>
<li data-dismiss="modal">  <i class="fa  fa-star-half-o "></i>  fa-star-half-o</li>
<li data-dismiss="modal">  <i class="fa  fa-location-arrow "></i>  fa-location-arrow</li>
<li data-dismiss="modal">  <i class="fa  fa-crop "></i>  fa-crop</li>
<li data-dismiss="modal">  <i class="fa  fa-code-fork "></i>  fa-code-fork</li>
<li data-dismiss="modal">  <i class="fa  fa-unlink "></i>  fa-unlink</li>
<li data-dismiss="modal">  <i class="fa  fa-chain-broken "></i>  fa-chain-broken</li>
<li data-dismiss="modal">  <i class="fa  fa-question "></i>  fa-question</li>
<li data-dismiss="modal">  <i class="fa  fa-info "></i>  fa-info</li>
<li data-dismiss="modal">  <i class="fa  fa-exclamation "></i>  fa-exclamation</li>
<li data-dismiss="modal">  <i class="fa  fa-superscript "></i>  fa-superscript</li>
<li data-dismiss="modal">  <i class="fa  fa-subscript "></i>  fa-subscript</li>
<li data-dismiss="modal">  <i class="fa  fa-eraser "></i>  fa-eraser</li>
<li data-dismiss="modal">  <i class="fa  fa-puzzle-piece "></i>  fa-puzzle-piece</li>
<li data-dismiss="modal">  <i class="fa  fa-microphone "></i>  fa-microphone</li>
<li data-dismiss="modal">  <i class="fa  fa-microphone-slash "></i>  fa-microphone-slash</li>
<li data-dismiss="modal">  <i class="fa  fa-shield "></i>  fa-shield</li>
<li data-dismiss="modal">  <i class="fa  fa-calendar-o "></i>  fa-calendar-o</li>
<li data-dismiss="modal">  <i class="fa  fa-fire-extinguisher "></i>  fa-fire-extinguish</li>
<li data-dismiss="modal">  <i class="fa  fa-rocket "></i>  fa-rocket</li>
<li data-dismiss="modal">  <i class="fa  fa-maxcdn "></i>  fa-maxcdn</li>
<li data-dismiss="modal">  <i class="fa  fa-chevron-circle-left "></i>  fa-chevron-circl</li>
<li data-dismiss="modal">  <i class="fa  fa-chevron-circle-right "></i>  fa-chevron-circ</li>
<li data-dismiss="modal">  <i class="fa  fa-chevron-circle-up "></i>  fa-chevron-circle-</li>
<li data-dismiss="modal">  <i class="fa  fa-chevron-circle-down "></i>  fa-chevron-circl</li>
<li data-dismiss="modal">  <i class="fa  fa-html5 "></i>  fa-html5</li>
<li data-dismiss="modal">  <i class="fa  fa-css3 "></i>  fa-css3</li>
<li data-dismiss="modal">  <i class="fa  fa-anchor "></i>  fa-anchor</li>
<li data-dismiss="modal">  <i class="fa  fa-unlock-alt "></i>  fa-unlock-alt</li>
<li data-dismiss="modal">  <i class="fa  fa-bullseye "></i>  fa-bullseye</li>
<li data-dismiss="modal">  <i class="fa  fa-ellipsis-h "></i>  fa-ellipsis-h</li>
<li data-dismiss="modal">  <i class="fa  fa-ellipsis-v "></i>  fa-ellipsis-v</li>
<li data-dismiss="modal">  <i class="fa  fa-rss-square "></i>  fa-rss-square</li>
<li data-dismiss="modal">  <i class="fa  fa-play-circle "></i>  fa-play-circle</li>
<li data-dismiss="modal">  <i class="fa  fa-ticket "></i>  fa-ticket</li>
<li data-dismiss="modal">  <i class="fa  fa-minus-square "></i>  fa-minus-square</li>
<li data-dismiss="modal">  <i class="fa  fa-minus-square-o "></i>  fa-minus-square-o</li>
<li data-dismiss="modal">  <i class="fa  fa-level-up "></i>  fa-level-up</li>
<li data-dismiss="modal">  <i class="fa  fa-level-down "></i>  fa-level-down</li>
<li data-dismiss="modal">  <i class="fa  fa-check-square "></i>  fa-check-square</li>
<li data-dismiss="modal">  <i class="fa  fa-pencil-square "></i>  fa-pencil-square</li>
<li data-dismiss="modal">  <i class="fa  fa-external-link-square "></i>  fa-external-lin</li>
<li data-dismiss="modal">  <i class="fa  fa-share-square "></i>  fa-share-square</li>
<li data-dismiss="modal">  <i class="fa  fa-compass "></i>  fa-compass</li>
<li data-dismiss="modal">  <i class="fa  fa-toggle-down "></i>  fa-toggle-down</li>
<li data-dismiss="modal">  <i class="fa  fa-caret-square-o-down "></i>  fa-caret-square-</li>
<li data-dismiss="modal">  <i class="fa  fa-toggle-up "></i>  fa-toggle-up</li>
<li data-dismiss="modal">  <i class="fa  fa-caret-square-o-up "></i>  fa-caret-square-o-</li>
<li data-dismiss="modal">  <i class="fa  fa-toggle-right "></i>  fa-toggle-right</li>
<li data-dismiss="modal">  <i class="fa  fa-caret-square-o-right "></i>  fa-caret-square</li>
<li data-dismiss="modal">  <i class="fa  fa-euro "></i>  fa-euro</li>
<li data-dismiss="modal">  <i class="fa  fa-eur "></i>  fa-eur</li>
<li data-dismiss="modal">  <i class="fa  fa-gbp "></i>  fa-gbp</li>
<li data-dismiss="modal">  <i class="fa  fa-dollar "></i>  fa-dollar</li>
<li data-dismiss="modal">  <i class="fa  fa-usd "></i>  fa-usd</li>
<li data-dismiss="modal">  <i class="fa  fa-rupee "></i>  fa-rupee</li>
<li data-dismiss="modal">  <i class="fa  fa-inr "></i>  fa-inr</li>
<li data-dismiss="modal">  <i class="fa  fa-cny "></i>  fa-cny</li>
<li data-dismiss="modal">  <i class="fa  fa-rmb "></i>  fa-rmb</li>
<li data-dismiss="modal">  <i class="fa  fa-yen "></i>  fa-yen</li>
<li data-dismiss="modal">  <i class="fa  fa-jpy "></i>  fa-jpy</li>
<li data-dismiss="modal">  <i class="fa  fa-ruble "></i>  fa-ruble</li>
<li data-dismiss="modal">  <i class="fa  fa-rouble "></i>  fa-rouble</li>
<li data-dismiss="modal">  <i class="fa  fa-rub "></i>  fa-rub</li>
<li data-dismiss="modal">  <i class="fa  fa-won "></i>  fa-won</li>
<li data-dismiss="modal">  <i class="fa  fa-krw "></i>  fa-krw</li>
<li data-dismiss="modal">  <i class="fa  fa-bitcoin "></i>  fa-bitcoin</li>
<li data-dismiss="modal">  <i class="fa  fa-btc "></i>  fa-btc</li>
<li data-dismiss="modal">  <i class="fa  fa-file "></i>  fa-file</li>
<li data-dismiss="modal">  <i class="fa  fa-file-text "></i>  fa-file-text</li>
<li data-dismiss="modal">  <i class="fa  fa-sort-alpha-asc "></i>  fa-sort-alpha-asc</li>
<li data-dismiss="modal">  <i class="fa  fa-sort-alpha-desc "></i>  fa-sort-alpha-desc</li>
<li data-dismiss="modal">  <i class="fa  fa-sort-amount-asc "></i>  fa-sort-amount-asc</li>
<li data-dismiss="modal">  <i class="fa  fa-sort-amount-desc "></i>  fa-sort-amount-desc</li>
<li data-dismiss="modal">  <i class="fa  fa-sort-numeric-asc "></i>  fa-sort-numeric-asc</li>
<li data-dismiss="modal">  <i class="fa  fa-sort-numeric-desc "></i>  fa-sort-numeric-de</li>
<li data-dismiss="modal">  <i class="fa  fa-thumbs-up "></i>  fa-thumbs-up</li>
<li data-dismiss="modal">  <i class="fa  fa-thumbs-down "></i>  fa-thumbs-down</li>
<li data-dismiss="modal">  <i class="fa  fa-youtube-square "></i>  fa-youtube-square</li>
<li data-dismiss="modal">  <i class="fa  fa-youtube "></i>  fa-youtube</li>
<li data-dismiss="modal">  <i class="fa  fa-xing "></i>  fa-xing</li>
<li data-dismiss="modal">  <i class="fa  fa-xing-square "></i>  fa-xing-square</li>
<li data-dismiss="modal">  <i class="fa  fa-youtube-play "></i>  fa-youtube-play</li>
<li data-dismiss="modal">  <i class="fa  fa-dropbox "></i>  fa-dropbox</li>
<li data-dismiss="modal">  <i class="fa  fa-stack-overflow "></i>  fa-stack-overflow</li>
<li data-dismiss="modal">  <i class="fa  fa-instagram "></i>  fa-instagram</li>
<li data-dismiss="modal">  <i class="fa  fa-flickr "></i>  fa-flickr</li>
<li data-dismiss="modal">  <i class="fa  fa-adn "></i>  fa-adn</li>
<li data-dismiss="modal">  <i class="fa  fa-bitbucket "></i>  fa-bitbucket</li>
<li data-dismiss="modal">  <i class="fa  fa-bitbucket-square "></i>  fa-bitbucket-square</li>
<li data-dismiss="modal">  <i class="fa  fa-tumblr "></i>  fa-tumblr</li>
<li data-dismiss="modal">  <i class="fa  fa-tumblr-square "></i>  fa-tumblr-square</li>
<li data-dismiss="modal">  <i class="fa  fa-long-arrow-down "></i>  fa-long-arrow-down</li>
<li data-dismiss="modal">  <i class="fa  fa-long-arrow-up "></i>  fa-long-arrow-up</li>
<li data-dismiss="modal">  <i class="fa  fa-long-arrow-left "></i>  fa-long-arrow-left</li>
<li data-dismiss="modal">  <i class="fa  fa-long-arrow-right "></i>  fa-long-arrow-right</li>
<li data-dismiss="modal">  <i class="fa  fa-apple "></i>  fa-apple</li>
<li data-dismiss="modal">  <i class="fa  fa-windows "></i>  fa-windows</li>
<li data-dismiss="modal">  <i class="fa  fa-android "></i>  fa-android</li>
<li data-dismiss="modal">  <i class="fa  fa-linux "></i>  fa-linux</li>
<li data-dismiss="modal">  <i class="fa  fa-dribbble "></i>  fa-dribbble</li>
<li data-dismiss="modal">  <i class="fa  fa-skype "></i>  fa-skype</li>
<li data-dismiss="modal">  <i class="fa  fa-foursquare "></i>  fa-foursquare</li>
<li data-dismiss="modal">  <i class="fa  fa-trello "></i>  fa-trello</li>
<li data-dismiss="modal">  <i class="fa  fa-female "></i>  fa-female</li>
<li data-dismiss="modal">  <i class="fa  fa-male "></i>  fa-male</li>
<li data-dismiss="modal">  <i class="fa  fa-gittip "></i>  fa-gittip</li>
<li data-dismiss="modal">  <i class="fa  fa-gratipay "></i>  fa-gratipay</li>
<li data-dismiss="modal">  <i class="fa  fa-sun-o "></i>  fa-sun-o</li>
<li data-dismiss="modal">  <i class="fa  fa-moon-o "></i>  fa-moon-o</li>
<li data-dismiss="modal">  <i class="fa  fa-archive "></i>  fa-archive</li>
<li data-dismiss="modal">  <i class="fa  fa-bug "></i>  fa-bug</li>
<li data-dismiss="modal">  <i class="fa  fa-vk "></i>  fa-vk</li>
<li data-dismiss="modal">  <i class="fa  fa-weibo "></i>  fa-weibo</li>
<li data-dismiss="modal">  <i class="fa  fa-renren "></i>  fa-renren</li>
<li data-dismiss="modal">  <i class="fa  fa-pagelines "></i>  fa-pagelines</li>
<li data-dismiss="modal">  <i class="fa  fa-stack-exchange "></i>  fa-stack-exchange</li>
<li data-dismiss="modal">  <i class="fa  fa-arrow-circle-o-right "></i>  fa-arrow-circle</li>
<li data-dismiss="modal">  <i class="fa  fa-arrow-circle-o-left "></i>  fa-arrow-circle-</li>
<li data-dismiss="modal">  <i class="fa  fa-toggle-left "></i>  fa-toggle-left</li>
<li data-dismiss="modal">  <i class="fa  fa-caret-square-o-left "></i>  fa-caret-square-</li>
<li data-dismiss="modal">  <i class="fa  fa-dot-circle-o "></i>  fa-dot-circle-o</li>
<li data-dismiss="modal">  <i class="fa  fa-wheelchair "></i>  fa-wheelchair</li>
<li data-dismiss="modal">  <i class="fa  fa-vimeo-square "></i>  fa-vimeo-square</li>
<li data-dismiss="modal">  <i class="fa  fa-turkish-lira "></i>  fa-turkish-lira</li>
<li data-dismiss="modal">  <i class="fa  fa-try "></i>  fa-try</li>
<li data-dismiss="modal">  <i class="fa  fa-plus-square-o "></i>  fa-plus-square-o</li>
<li data-dismiss="modal">  <i class="fa  fa-space-shuttle "></i>  fa-space-shuttle</li>
<li data-dismiss="modal">  <i class="fa  fa-slack "></i>  fa-slack</li>
<li data-dismiss="modal">  <i class="fa  fa-envelope-square "></i>  fa-envelope-square</li>
<li data-dismiss="modal">  <i class="fa  fa-wordpress "></i>  fa-wordpress</li>
<li data-dismiss="modal">  <i class="fa  fa-openid "></i>  fa-openid</li>
<li data-dismiss="modal">  <i class="fa  fa-institution "></i>  fa-institution</li>
<li data-dismiss="modal">  <i class="fa  fa-bank "></i>  fa-bank</li>
<li data-dismiss="modal">  <i class="fa  fa-university "></i>  fa-university</li>
<li data-dismiss="modal">  <i class="fa  fa-mortar-board "></i>  fa-mortar-board</li>
<li data-dismiss="modal">  <i class="fa  fa-graduation-cap "></i>  fa-graduation-cap</li>
<li data-dismiss="modal">  <i class="fa  fa-yahoo "></i>  fa-yahoo</li>
<li data-dismiss="modal">  <i class="fa  fa-google "></i>  fa-google</li>
<li data-dismiss="modal">  <i class="fa  fa-reddit "></i>  fa-reddit</li>
<li data-dismiss="modal">  <i class="fa  fa-reddit-square "></i>  fa-reddit-square</li>
<li data-dismiss="modal">  <i class="fa  fa-stumbleupon-circle "></i>  fa-stumbleupon-ci</li>
<li data-dismiss="modal">  <i class="fa  fa-stumbleupon "></i>  fa-stumbleupon</li>
<li data-dismiss="modal">  <i class="fa  fa-delicious "></i>  fa-delicious</li>
<li data-dismiss="modal">  <i class="fa  fa-digg "></i>  fa-digg</li>
<li data-dismiss="modal">  <i class="fa  fa-pied-piper "></i>  fa-pied-piper</li>
<li data-dismiss="modal">  <i class="fa  fa-pied-piper-alt "></i>  fa-pied-piper-alt</li>
<li data-dismiss="modal">  <i class="fa  fa-drupal "></i>  fa-drupal</li>
<li data-dismiss="modal">  <i class="fa  fa-joomla "></i>  fa-joomla</li>
<li data-dismiss="modal">  <i class="fa  fa-language "></i>  fa-language</li>
<li data-dismiss="modal">  <i class="fa  fa-fax "></i>  fa-fax</li>
<li data-dismiss="modal">  <i class="fa  fa-building "></i>  fa-building</li>
<li data-dismiss="modal">  <i class="fa  fa-child "></i>  fa-child</li>
<li data-dismiss="modal">  <i class="fa  fa-paw "></i>  fa-paw</li>
<li data-dismiss="modal">  <i class="fa  fa-spoon "></i>  fa-spoon</li>
<li data-dismiss="modal">  <i class="fa  fa-cube "></i>  fa-cube</li>
<li data-dismiss="modal">  <i class="fa  fa-cubes "></i>  fa-cubes</li>
<li data-dismiss="modal">  <i class="fa  fa-behance "></i>  fa-behance</li>
<li data-dismiss="modal">  <i class="fa  fa-behance-square "></i>  fa-behance-square</li>
<li data-dismiss="modal">  <i class="fa  fa-steam "></i>  fa-steam</li>
<li data-dismiss="modal">  <i class="fa  fa-steam-square "></i>  fa-steam-square</li>
<li data-dismiss="modal">  <i class="fa  fa-recycle "></i>  fa-recycle</li>
<li data-dismiss="modal">  <i class="fa  fa-automobile "></i>  fa-automobile</li>
<li data-dismiss="modal">  <i class="fa  fa-car "></i>  fa-car</li>
<li data-dismiss="modal">  <i class="fa  fa-cab "></i>  fa-cab</li>
<li data-dismiss="modal">  <i class="fa  fa-taxi "></i>  fa-taxi</li>
<li data-dismiss="modal">  <i class="fa  fa-tree "></i>  fa-tree</li>
<li data-dismiss="modal">  <i class="fa  fa-spotify "></i>  fa-spotify</li>
<li data-dismiss="modal">  <i class="fa  fa-deviantart "></i>  fa-deviantart</li>
<li data-dismiss="modal">  <i class="fa  fa-soundcloud "></i>  fa-soundcloud</li>
<li data-dismiss="modal">  <i class="fa  fa-database "></i>  fa-database</li>
<li data-dismiss="modal">  <i class="fa  fa-file-pdf-o "></i>  fa-file-pdf-o</li>
<li data-dismiss="modal">  <i class="fa  fa-file-word-o "></i>  fa-file-word-o</li>
<li data-dismiss="modal">  <i class="fa  fa-file-excel-o "></i>  fa-file-excel-o</li>
<li data-dismiss="modal">  <i class="fa  fa-file-powerpoint-o "></i>  fa-file-powerpoint</li>
<li data-dismiss="modal">  <i class="fa  fa-file-photo-o "></i>  fa-file-photo-o</li>
<li data-dismiss="modal">  <i class="fa  fa-file-picture-o "></i>  fa-file-picture-o</li>
<li data-dismiss="modal">  <i class="fa  fa-file-image-o "></i>  fa-file-image-o</li>
<li data-dismiss="modal">  <i class="fa  fa-file-zip-o "></i>  fa-file-zip-o</li>
<li data-dismiss="modal">  <i class="fa  fa-file-archive-o "></i>  fa-file-archive-o</li>
<li data-dismiss="modal">  <i class="fa  fa-file-sound-o "></i>  fa-file-sound-o</li>
<li data-dismiss="modal">  <i class="fa  fa-file-audio-o "></i>  fa-file-audio-o</li>
<li data-dismiss="modal">  <i class="fa  fa-file-movie-o "></i>  fa-file-movie-o</li>
<li data-dismiss="modal">  <i class="fa  fa-file-video-o "></i>  fa-file-video-o</li>
<li data-dismiss="modal">  <i class="fa  fa-file-code-o "></i>  fa-file-code-o</li>
<li data-dismiss="modal">  <i class="fa  fa-vine "></i>  fa-vine</li>
<li data-dismiss="modal">  <i class="fa  fa-codepen "></i>  fa-codepen</li>
<li data-dismiss="modal">  <i class="fa  fa-jsfiddle "></i>  fa-jsfiddle</li>
<li data-dismiss="modal">  <i class="fa  fa-life-bouy "></i>  fa-life-bouy</li>
<li data-dismiss="modal">  <i class="fa  fa-life-buoy "></i>  fa-life-buoy</li>
<li data-dismiss="modal">  <i class="fa  fa-life-saver "></i>  fa-life-saver</li>
<li data-dismiss="modal">  <i class="fa  fa-support "></i>  fa-support</li>
<li data-dismiss="modal">  <i class="fa  fa-life-ring "></i>  fa-life-ring</li>
<li data-dismiss="modal">  <i class="fa  fa-circle-o-notch "></i>  fa-circle-o-notch</li>
<li data-dismiss="modal">  <i class="fa  fa-ra "></i>  fa-ra</li>
<li data-dismiss="modal">  <i class="fa  fa-rebel "></i>  fa-rebel</li>
<li data-dismiss="modal">  <i class="fa  fa-ge "></i>  fa-ge</li>
<li data-dismiss="modal">  <i class="fa  fa-empire "></i>  fa-empire</li>
<li data-dismiss="modal">  <i class="fa  fa-git-square "></i>  fa-git-square</li>
<li data-dismiss="modal">  <i class="fa  fa-git "></i>  fa-git</li>
<li data-dismiss="modal">  <i class="fa  fa-y-combinator-square "></i>  fa-y-combinator-</li>
<li data-dismiss="modal">  <i class="fa  fa-yc-square "></i>  fa-yc-square</li>
<li data-dismiss="modal">  <i class="fa  fa-hacker-news "></i>  fa-hacker-news</li>
<li data-dismiss="modal">  <i class="fa  fa-tencent-weibo "></i>  fa-tencent-weibo</li>
<li data-dismiss="modal">  <i class="fa  fa-qq "></i>  fa-qq</li>
<li data-dismiss="modal">  <i class="fa  fa-wechat "></i>  fa-wechat</li>
<li data-dismiss="modal">  <i class="fa  fa-weixin "></i>  fa-weixin</li>
<li data-dismiss="modal">  <i class="fa  fa-send "></i>  fa-send</li>
<li data-dismiss="modal">  <i class="fa  fa-paper-plane "></i>  fa-paper-plane</li>
<li data-dismiss="modal">  <i class="fa  fa-send-o "></i>  fa-send-o</li>
<li data-dismiss="modal">  <i class="fa  fa-paper-plane-o "></i>  fa-paper-plane-o</li>
<li data-dismiss="modal">  <i class="fa  fa-history "></i>  fa-history</li>
<li data-dismiss="modal">  <i class="fa  fa-circle-thin "></i>  fa-circle-thin</li>
<li data-dismiss="modal">  <i class="fa  fa-header "></i>  fa-header</li>
<li data-dismiss="modal">  <i class="fa  fa-paragraph "></i>  fa-paragraph</li>
<li data-dismiss="modal">  <i class="fa  fa-sliders "></i>  fa-sliders</li>
<li data-dismiss="modal">  <i class="fa  fa-share-alt "></i>  fa-share-alt</li>
<li data-dismiss="modal">  <i class="fa  fa-share-alt-square "></i>  fa-share-alt-square</li>
<li data-dismiss="modal">  <i class="fa  fa-bomb "></i>  fa-bomb</li>
<li data-dismiss="modal">  <i class="fa  fa-soccer-ball-o "></i>  fa-soccer-ball-o</li>
<li data-dismiss="modal">  <i class="fa  fa-futbol-o "></i>  fa-futbol-o</li>
<li data-dismiss="modal">  <i class="fa  fa-tty "></i>  fa-tty</li>
<li data-dismiss="modal">  <i class="fa  fa-binoculars "></i>  fa-binoculars</li>
<li data-dismiss="modal">  <i class="fa  fa-plug "></i>  fa-plug</li>
<li data-dismiss="modal">  <i class="fa  fa-slideshare "></i>  fa-slideshare</li>
<li data-dismiss="modal">  <i class="fa  fa-twitch "></i>  fa-twitch</li>
<li data-dismiss="modal">  <i class="fa  fa-yelp "></i>  fa-yelp</li>
<li data-dismiss="modal">  <i class="fa  fa-newspaper-o "></i>  fa-newspaper-o</li>
<li data-dismiss="modal">  <i class="fa  fa-wifi "></i>  fa-wifi</li>
<li data-dismiss="modal">  <i class="fa  fa-calculator "></i>  fa-calculator</li>
<li data-dismiss="modal">  <i class="fa  fa-paypal "></i>  fa-paypal</li>
<li data-dismiss="modal">  <i class="fa  fa-google-wallet "></i>  fa-google-wallet</li>
<li data-dismiss="modal">  <i class="fa  fa-cc-visa "></i>  fa-cc-visa</li>
<li data-dismiss="modal">  <i class="fa  fa-cc-mastercard "></i>  fa-cc-mastercard</li>
<li data-dismiss="modal">  <i class="fa  fa-cc-discover "></i>  fa-cc-discover</li>
<li data-dismiss="modal">  <i class="fa  fa-cc-amex "></i>  fa-cc-amex</li>
<li data-dismiss="modal">  <i class="fa  fa-cc-paypal "></i>  fa-cc-paypal</li>
<li data-dismiss="modal">  <i class="fa  fa-cc-stripe "></i>  fa-cc-stripe</li>
<li data-dismiss="modal">  <i class="fa  fa-bell-slash "></i>  fa-bell-slash</li>
<li data-dismiss="modal">  <i class="fa  fa-bell-slash-o "></i>  fa-bell-slash-o</li>
<li data-dismiss="modal">  <i class="fa  fa-trash "></i>  fa-trash</li>
<li data-dismiss="modal">  <i class="fa  fa-copyright "></i>  fa-copyright</li>
<li data-dismiss="modal">  <i class="fa  fa-at "></i>  fa-at</li>
<li data-dismiss="modal">  <i class="fa  fa-eyedropper "></i>  fa-eyedropper</li>
<li data-dismiss="modal">  <i class="fa  fa-paint-brush "></i>  fa-paint-brush</li>
<li data-dismiss="modal">  <i class="fa  fa-birthday-cake "></i>  fa-birthday-cake</li>
<li data-dismiss="modal">  <i class="fa  fa-area-chart "></i>  fa-area-chart</li>
<li data-dismiss="modal">  <i class="fa  fa-pie-chart "></i>  fa-pie-chart</li>
<li data-dismiss="modal">  <i class="fa  fa-line-chart "></i>  fa-line-chart</li>
<li data-dismiss="modal">  <i class="fa  fa-lastfm "></i>  fa-lastfm</li>
<li data-dismiss="modal">  <i class="fa  fa-lastfm-square "></i>  fa-lastfm-square</li>
<li data-dismiss="modal">  <i class="fa  fa-toggle-off "></i>  fa-toggle-off</li>
<li data-dismiss="modal">  <i class="fa  fa-toggle-on "></i>  fa-toggle-on</li>
<li data-dismiss="modal">  <i class="fa  fa-bicycle "></i>  fa-bicycle</li>
<li data-dismiss="modal">  <i class="fa  fa-bus "></i>  fa-bus</li>
<li data-dismiss="modal">  <i class="fa  fa-ioxhost "></i>  fa-ioxhost</li>
<li data-dismiss="modal">  <i class="fa  fa-angellist "></i>  fa-angellist</li>
<li data-dismiss="modal">  <i class="fa  fa-cc "></i>  fa-cc</li>
<li data-dismiss="modal">  <i class="fa  fa-shekel "></i>  fa-shekel</li>
<li data-dismiss="modal">  <i class="fa  fa-sheqel "></i>  fa-sheqel</li>
<li data-dismiss="modal">  <i class="fa  fa-ils "></i>  fa-ils</li>
<li data-dismiss="modal">  <i class="fa  fa-meanpath "></i>  fa-meanpath</li>
<li data-dismiss="modal">  <i class="fa  fa-buysellads "></i>  fa-buysellads</li>
<li data-dismiss="modal">  <i class="fa  fa-connectdevelop "></i>  fa-connectdevelop</li>
<li data-dismiss="modal">  <i class="fa  fa-dashcube "></i>  fa-dashcube</li>
<li data-dismiss="modal">  <i class="fa  fa-forumbee "></i>  fa-forumbee</li>
<li data-dismiss="modal">  <i class="fa  fa-leanpub "></i>  fa-leanpub</li>
<li data-dismiss="modal">  <i class="fa  fa-sellsy "></i>  fa-sellsy</li>
<li data-dismiss="modal">  <i class="fa  fa-shirtsinbulk "></i>  fa-shirtsinbulk</li>
<li data-dismiss="modal">  <i class="fa  fa-simplybuilt "></i>  fa-simplybuilt</li>
<li data-dismiss="modal">  <i class="fa  fa-skyatlas "></i>  fa-skyatlas</li>
<li data-dismiss="modal">  <i class="fa  fa-cart-plus "></i>  fa-cart-plus</li>
<li data-dismiss="modal">  <i class="fa  fa-cart-arrow-down "></i>  fa-cart-arrow-down</li>
<li data-dismiss="modal">  <i class="fa  fa-diamond "></i>  fa-diamond</li>
<li data-dismiss="modal">  <i class="fa  fa-ship "></i>  fa-ship</li>
<li data-dismiss="modal">  <i class="fa  fa-user-secret "></i>  fa-user-secret</li>
<li data-dismiss="modal">  <i class="fa  fa-motorcycle "></i>  fa-motorcycle</li>
<li data-dismiss="modal">  <i class="fa  fa-street-view "></i>  fa-street-view</li>
<li data-dismiss="modal">  <i class="fa  fa-heartbeat "></i>  fa-heartbeat</li>
<li data-dismiss="modal">  <i class="fa  fa-venus "></i>  fa-venus</li>
<li data-dismiss="modal">  <i class="fa  fa-mars "></i>  fa-mars</li>
<li data-dismiss="modal">  <i class="fa  fa-mercury "></i>  fa-mercury</li>
<li data-dismiss="modal">  <i class="fa  fa-intersex "></i>  fa-intersex</li>
<li data-dismiss="modal">  <i class="fa  fa-transgender "></i>  fa-transgender</li>
<li data-dismiss="modal">  <i class="fa  fa-transgender-alt "></i>  fa-transgender-alt</li>
<li data-dismiss="modal">  <i class="fa  fa-venus-double "></i>  fa-venus-double</li>
<li data-dismiss="modal">  <i class="fa  fa-mars-double "></i>  fa-mars-double</li>
<li data-dismiss="modal">  <i class="fa  fa-venus-mars "></i>  fa-venus-mars</li>
<li data-dismiss="modal">  <i class="fa  fa-mars-stroke "></i>  fa-mars-stroke</li>
<li data-dismiss="modal">  <i class="fa  fa-mars-stroke-v "></i>  fa-mars-stroke-v</li>
<li data-dismiss="modal">  <i class="fa  fa-mars-stroke-h "></i>  fa-mars-stroke-h</li>
<li data-dismiss="modal">  <i class="fa  fa-neuter "></i>  fa-neuter</li>
<li data-dismiss="modal">  <i class="fa  fa-genderless "></i>  fa-genderless</li>
<li data-dismiss="modal">  <i class="fa  fa-facebook-official "></i>  fa-facebook-offici</li>
<li data-dismiss="modal">  <i class="fa  fa-pinterest-p "></i>  fa-pinterest-p</li>
<li data-dismiss="modal">  <i class="fa  fa-whatsapp "></i>  fa-whatsapp</li>
<li data-dismiss="modal">  <i class="fa  fa-server "></i>  fa-server</li>
<li data-dismiss="modal">  <i class="fa  fa-user-plus "></i>  fa-user-plus</li>
<li data-dismiss="modal">  <i class="fa  fa-user-times "></i>  fa-user-times</li>
<li data-dismiss="modal">  <i class="fa  fa-hotel "></i>  fa-hotel</li>
<li data-dismiss="modal">  <i class="fa  fa-bed "></i>  fa-bed</li>
<li data-dismiss="modal">  <i class="fa  fa-viacoin "></i>  fa-viacoin</li>
<li data-dismiss="modal">  <i class="fa  fa-train "></i>  fa-train</li>
<li data-dismiss="modal">  <i class="fa  fa-subway "></i>  fa-subway</li>
<li data-dismiss="modal">  <i class="fa  fa-medium "></i>  fa-medium</li>
<li data-dismiss="modal">  <i class="fa  fa-yc "></i>  fa-yc</li>
<li data-dismiss="modal">  <i class="fa  fa-y-combinator "></i>  fa-y-combinator</li>
<li data-dismiss="modal">  <i class="fa  fa-optin-monster "></i>  fa-optin-monster</li>
<li data-dismiss="modal">  <i class="fa  fa-opencart "></i>  fa-opencart</li>
<li data-dismiss="modal">  <i class="fa  fa-expeditedssl "></i>  fa-expeditedssl</li>
<li data-dismiss="modal">  <i class="fa  fa-battery-4 "></i>  fa-battery-4</li>
<li data-dismiss="modal">  <i class="fa  fa-battery-full "></i>  fa-battery-full</li>
<li data-dismiss="modal">  <i class="fa  fa-battery-3 "></i>  fa-battery-3</li>
<li data-dismiss="modal">  <i class="fa  fa-battery-three-quarters "></i>  fa-battery-thters</li>
<li data-dismiss="modal">  <i class="fa  fa-battery-2 "></i>  fa-battery-2</li>
<li data-dismiss="modal">  <i class="fa  fa-battery-half "></i>  fa-battery-half</li>
<li data-dismiss="modal">  <i class="fa  fa-battery-1 "></i>  fa-battery-1</li>
<li data-dismiss="modal">  <i class="fa  fa-battery-quarter "></i>  fa-battery-quarter</li>
<li data-dismiss="modal">  <i class="fa  fa-battery-0 "></i>  fa-battery-0</li>
<li data-dismiss="modal">  <i class="fa  fa-battery-empty "></i>  fa-battery-empty</li>
<li data-dismiss="modal">  <i class="fa  fa-mouse-pointer "></i>  fa-mouse-pointer</li>
<li data-dismiss="modal">  <i class="fa  fa-i-cursor "></i>  fa-i-cursor</li>
<li data-dismiss="modal">  <i class="fa  fa-object-group "></i>  fa-object-group</li>
<li data-dismiss="modal">  <i class="fa  fa-object-ungroup "></i>  fa-object-ungroup</li>
<li data-dismiss="modal">  <i class="fa  fa-sticky-note "></i>  fa-sticky-note</li>
<li data-dismiss="modal">  <i class="fa  fa-sticky-note-o "></i>  fa-sticky-note-o</li>
<li data-dismiss="modal">  <i class="fa  fa-cc-jcb "></i>  fa-cc-jcb</li>
<li data-dismiss="modal">  <i class="fa  fa-cc-diners-club "></i>  fa-cc-diners-club</li>
<li data-dismiss="modal">  <i class="fa  fa-clone "></i>  fa-clone</li>
<li data-dismiss="modal">  <i class="fa  fa-balance-scale "></i>  fa-balance-scale</li>
<li data-dismiss="modal">  <i class="fa  fa-hourglass-o "></i>  fa-hourglass-o</li>
<li data-dismiss="modal">  <i class="fa  fa-hourglass-1 "></i>  fa-hourglass-1</li>
<li data-dismiss="modal">  <i class="fa  fa-hourglass-start "></i>  fa-hourglass-start</li>
<li data-dismiss="modal">  <i class="fa  fa-hourglass-2 "></i>  fa-hourglass-2</li>
<li data-dismiss="modal">  <i class="fa  fa-hourglass-half "></i>  fa-hourglass-half</li>
<li data-dismiss="modal">  <i class="fa  fa-hourglass-3 "></i>  fa-hourglass-3</li>
<li data-dismiss="modal">  <i class="fa  fa-hourglass-end "></i>  fa-hourglass-end</li>
<li data-dismiss="modal">  <i class="fa  fa-hourglass "></i>  fa-hourglass</li>
<li data-dismiss="modal">  <i class="fa  fa-hand-grab-o "></i>  fa-hand-grab-o</li>
<li data-dismiss="modal">  <i class="fa  fa-hand-rock-o "></i>  fa-hand-rock-o</li>
<li data-dismiss="modal">  <i class="fa  fa-hand-stop-o "></i>  fa-hand-stop-o</li>
<li data-dismiss="modal">  <i class="fa  fa-hand-paper-o "></i>  fa-hand-paper-o</li>
<li data-dismiss="modal">  <i class="fa  fa-hand-scissors-o "></i>  fa-hand-scissors-o</li>
<li data-dismiss="modal">  <i class="fa  fa-hand-lizard-o "></i>  fa-hand-lizard-o</li>
<li data-dismiss="modal">  <i class="fa  fa-hand-spock-o "></i>  fa-hand-spock-o</li>
<li data-dismiss="modal">  <i class="fa  fa-hand-pointer-o "></i>  fa-hand-pointer-o</li>
<li data-dismiss="modal">  <i class="fa  fa-hand-peace-o "></i>  fa-hand-peace-o</li>
<li data-dismiss="modal">  <i class="fa  fa-trademark "></i>  fa-trademark</li>
<li data-dismiss="modal">  <i class="fa  fa-registered "></i>  fa-registered</li>
<li data-dismiss="modal">  <i class="fa  fa-creative-commons "></i>  fa-creative-commons</li>
<li data-dismiss="modal">  <i class="fa  fa-gg "></i>  fa-gg</li>
<li data-dismiss="modal">  <i class="fa  fa-gg-circle "></i>  fa-gg-circle</li>
<li data-dismiss="modal">  <i class="fa  fa-tripadvisor "></i>  fa-tripadvisor</li>
<li data-dismiss="modal">  <i class="fa  fa-odnoklassniki "></i>  fa-odnoklassniki</li>
<li data-dismiss="modal">  <i class="fa  fa-odnoklassniki-square "></i>  fa-odnoklassnik</li>
<li data-dismiss="modal">  <i class="fa  fa-get-pocket "></i>  fa-get-pocket</li>
<li data-dismiss="modal">  <i class="fa  fa-wikipedia-w "></i>  fa-wikipedia-w</li>
<li data-dismiss="modal">  <i class="fa  fa-safari "></i>  fa-safari</li>
<li data-dismiss="modal">  <i class="fa  fa-chrome "></i>  fa-chrome</li>
<li data-dismiss="modal">  <i class="fa  fa-firefox "></i>  fa-firefox</li>
<li data-dismiss="modal">  <i class="fa  fa-opera "></i>  fa-opera</li>
<li data-dismiss="modal">  <i class="fa  fa-internet-explorer "></i>  fa-internet-explor</li>
<li data-dismiss="modal">  <i class="fa  fa-tv "></i>  fa-tv</li>
<li data-dismiss="modal">  <i class="fa  fa-television "></i>  fa-television</li>
<li data-dismiss="modal">  <i class="fa  fa-contao "></i>  fa-contao</li>
<li data-dismiss="modal">  <i class="fa  fa-500px "></i>  fa-500px</li>
<li data-dismiss="modal">  <i class="fa  fa-amazon "></i>  fa-amazon</li>
<li data-dismiss="modal">  <i class="fa  fa-calendar-plus-o "></i>  fa-calendar-plus-o</li>
<li data-dismiss="modal">  <i class="fa  fa-calendar-minus-o "></i>  fa-calendar-minus-o</li>
<li data-dismiss="modal">  <i class="fa  fa-calendar-times-o "></i>  fa-calendar-times-o</li>
<li data-dismiss="modal">  <i class="fa  fa-calendar-check-o "></i>  fa-calendar-check-o</li>
<li data-dismiss="modal">  <i class="fa  fa-industry "></i>  fa-industry</li>
<li data-dismiss="modal">  <i class="fa  fa-map-pin "></i>  fa-map-pin</li>
<li data-dismiss="modal">  <i class="fa  fa-map-signs "></i>  fa-map-signs</li>
<li data-dismiss="modal">  <i class="fa  fa-map-o "></i>  fa-map-o</li>
<li data-dismiss="modal">  <i class="fa  fa-map "></i>  fa-map</li>
<li data-dismiss="modal">  <i class="fa  fa-commenting "></i>  fa-commenting</li>
<li data-dismiss="modal">  <i class="fa  fa-commenting-o "></i>  fa-commenting-o</li>
<li data-dismiss="modal">  <i class="fa  fa-houzz "></i>  fa-houzz</li>
<li data-dismiss="modal">  <i class="fa  fa-vimeo "></i>  fa-vimeo</li>
<li data-dismiss="modal">  <i class="fa  fa-black-tie "></i>  fa-black-tie</li>
<li data-dismiss="modal">  <i class="fa  fa-fonticons "></i>  fa-fonticons</li > 
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

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