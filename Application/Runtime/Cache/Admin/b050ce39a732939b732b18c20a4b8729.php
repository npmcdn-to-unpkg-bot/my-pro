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
					<ul class="nav nav-tabs">
						<li><a data-toggle="tab" href="#basicsInfoTab">接口基本信息</a></li>
						<li <?php if($type == 'paramIn'): ?>class="active"<?php endif; ?> ><a data-toggle="tab" href="#paramsInTab">传入参数<span id="inParamTab">(<?php echo count($paramDatas['paramIn']);?>)</span></a></li>
						<li <?php if($type == 'paramOut'): ?>class="active"<?php endif; ?> ><a data-toggle="tab" href="#paramsOutTab">返回参数<span id="outParamTab">(<?php echo count($paramDatas['paramOut']);?>)</span></a></li>
						<li <?php if($type == 'errorCode'): ?>class="active"<?php endif; ?> ><a data-toggle="tab" href="#errorTab">Code<span id="errorCodeTab">(<?php echo count($ecDatas);?>)</span></a></li>
					</ul>
				</div>
					<div class="widget-content nopadding tab-content">
						<div id="basicsInfoTab" class="tab-pane">
						<form class="form-horizontal" method="post" action="/myframework/<?php echo (CONTROLLER_NAME); ?>/viewList" >
							<div class="control-group">
								<label class="control-label">接口名称</label>
								<div class="controls">
									<?php echo ($intData['name']); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">接口分类</label>
								<div class="controls">
									<?php echo ($intData['category_name']); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">接口调用方法</label>
								<div class="controls">
									<?php if($intData['int_method'] == '00A'): ?>GET方法<?php endif; ?>
									<?php if($intData['int_method'] == '00B'): ?>POST方法<?php endif; ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">生产环境接口地址</label>
								<div class="controls">
									<?php echo ($intData['url']); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">测试环境接口地址</label>
								<div class="controls">
									<?php echo ($intData['test_url']); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">传入参数示例</label>
								<div class="controls">
									<?php echo ($intData['demo_in']); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">返回参数示例</label>
								<div class="controls">
									<?php echo ($intData['demo_out']); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">接口开发者</label>
								<div class="controls">
									<?php echo ($intData['author']); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">排序</label>
								<div class="controls">
									<?php echo ($intData['sort']); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">创建时间</label>
								<div class="controls">
									<?php echo ($intData['create_time']); ?>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">最近修改时间</label>
								<div class="controls">
									<?php echo ($intData['update_time']); ?>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">接口描述</label>
								<div class="controls">
									<?php echo ($intData['discription']); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">备注</label>
								<div class="controls">
									<?php echo ($intData['remark']); ?>
								</div>
							</div>
							<input type="hidden" name="m_id" value="<?php echo I('m_id');?>" /> 
							<input type="hidden" name="p_id" value="<?php echo I('p_id');?>" /> 
							<div class="form-actions">
								<button type="button" class="btn btn-danger fa fa-reply" onclick="javascript:window.location='/myframework/<?php echo (CONTROLLER_NAME); ?>/viewList/m_id/<?php echo I('m_id');?>/p_id/<?php echo I('p_id');?>'">返回</button>
							</div>
							</form>
						</div>
						
						<div id="paramsInTab" class="tab-pane <?php if($type == 'paramIn'): ?>active<?php endif; ?>">
							<form class="form-horizontal" method="post" action="/myframework/<?php echo (CONTROLLER_NAME); ?>/paramInOpration" name="paramIn" id="paramIn_validate" novalidate="novalidate">
								<div class="control-group">
					              <label class="control-label">参数名称 :</label>
					              <div class="controls">
					                <input type="text" class="span6" name="paramInName" id="paramInName" placeholder="请输入参数名称（英文，必填）" value="<?php echo ($paramInData["name"]); ?>"/>
					              </div>
					            </div>
					            <div class="control-group">
					              <label class="control-label">展示排序:</label>
					              <div class="controls">
					                <input type="text" class="span6" name="paramInSort" id="paramInSort" placeholder="请输入展示排序（数字，必填）" value="<?php echo ($paramInData["sort"]); ?>"/>
					              </div>
					            </div>
					            <div class="control-group">
									<label class="control-label">参数位置：</label>
									<div class="controls">
										<?php if($paramInId == ''): ?><label class="fl"> <input type="radio" name="paramInLoc" value="00B" checked="checked" />Url</label>
											<label class="fl "> <input type="radio" name="paramInLoc" value="00A"/>Header</label> 
											<?php else: ?>
											<label class="fl"> <input type="radio" name="paramInLoc" value="00B" <?php if($paramInData["param_loc"] == '00B'): ?>checked="checked"<?php endif; ?> />Url</label>
											<label class="fl "> <input type="radio" name="paramInLoc" value="00A" <?php if($paramInData["param_loc"] == '00A'): ?>checked="checked"<?php endif; ?>/>Header</label><?php endif; ?>
										
									</div>
					            </div>
					            
					            <div class="control-group">
									<label class="control-label">参数描述:</label>
									<div class="controls">
										<textarea name="discription" id="discription" class="span6" placeholder="请输入参数描述（必填）"><?php echo ($paramInData["discription"]); ?></textarea>
									</div>
					            </div>
					            <div class="control-group">
									<label class="control-label">参数类型：</label>
									<div class="controls">
										<?php if($paramInId == ''): ?><label class="fl "> <input type="radio" name="paramInType" value="00A" checked="checked" onclick="removeJsonDiscription('paramInJsonDisDiv');"/>String</label> 
												<label class="fl"> <input type="radio" name="paramInType" value="00B" onclick="removeJsonDiscription('paramInJsonDisDiv');" />Number</label>
												<label class="fl"> <input type="radio" name="paramInType" value="00C" onclick="showJsonDiscription('paramInJsonDisDiv');"/>Json</label>
											<?php else: ?>
												<label class="fl "> <input type="radio" name="paramInType" value="00A" <?php if($paramInData["param_type"] == '00A'): ?>checked="checked"<?php endif; ?> onclick="removeJsonDiscription('paramInJsonDisDiv');"/>String</label> 
												<label class="fl"> <input type="radio" name="paramInType" value="00B" <?php if($paramInData["param_type"] == '00B'): ?>checked="checked"<?php endif; ?> onclick="removeJsonDiscription('paramInJsonDisDiv');" />Number</label>
												<label class="fl"> <input type="radio" name="paramInType" value="00C" <?php if($paramInData["param_type"] == '00C'): ?>checked="checked"<?php endif; ?> onclick="showJsonDiscription('paramInJsonDisDiv');"/>Json</label><?php endif; ?>
									
									</div>
					            </div>
					            <div class="control-group" id="paramInJsonDisDiv" <?php if($paramInData["param_type"] != '00C'): ?>style="display: none;"<?php endif; ?>>
									<label class="control-label">Json描述:</label>
									<div class="controls">
										<textarea name="paramInJsonDis" id="paramInJsonDis" class="span6" placeholder="请输入Json描述"><?php echo ($paramInData["json_discription"]); ?></textarea>
									</div>
					            </div>
					            <div class="control-group">
									<label class="control-label">是否必须：</label>
									<div class="controls">
										<?php if($paramInId == ''): ?><label class="fl "> <input type="radio" name="paramInMust" value="00A" checked="checked"/>是</label> 
											<label class="fl"> <input type="radio" name="paramInMust" value="00B" />否</label>
											<?php else: ?>
												<label class="fl "> <input type="radio" name="paramInMust" value="00A" <?php if($paramInData["must"] == '00A'): ?>checked="checked"<?php endif; ?>/>是</label> 
												<label class="fl"> <input type="radio" name="paramInMust" value="00B" <?php if($paramInData["must"] == '00B'): ?>checked="checked"<?php endif; ?>/>否</label><?php endif; ?>
									</div>
					            </div>
								<input type="hidden" name="m_id" value="<?php echo I('m_id');?>" /> 
								<input type="hidden" name="p_id" value="<?php echo I('p_id');?>" /> 
								<input type="hidden" name="intId" value="<?php echo ($intId); ?>" />
								<input type="hidden" name="type" value="paramIn" />
								<input type="hidden" name="paramId" value="<?php echo ($paramInId); ?>" />
								<input type="hidden" name="paramDic" value="00A" />
								
								<div class="form-actions">
									<button type="submit" class="btn btn-success fa fa-save">确定</button>
									<button type="reset" class="btn btn-primary fa fa-edit">重置</button>
									<button type="button" class="btn btn-danger fa fa-reply" onclick="javascript:window.location='/myframework/<?php echo (CONTROLLER_NAME); ?>/viewList/m_id/<?php echo I('m_id');?>/p_id/<?php echo I('p_id');?>'">返回</button>
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
					              	<?php if(is_array($paramDatas['paramIn'])): $i = 0; $__LIST__ = $paramDatas['paramIn'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pdata): $mod = ($i % 2 );++$i;?><tr>
						                  <td><?php echo ($pdata["name"]); ?></td>
						                  <td <?php if($pdata["param_type"] == '00C'): ?>onclick="switchJsonDiscriptionTr('<?php echo ($pdata["id"]); ?>');" style="color:red;"<?php endif; ?>>
						                  	<?php if($pdata["param_type"] == '00A'): ?>String<?php endif; ?>
						                  	<?php if($pdata["param_type"] == '00B'): ?>Number<?php endif; ?>
						                  	<?php if($pdata["param_type"] == '00C'): ?>Json<i class="fa fa-hand-pointer-o" style="margin-left: 10px;"></i><?php endif; ?>
						                  </td>
						                  <td>
						                  	<?php if($pdata["param_loc"] == '00A'): ?>Headr<?php endif; ?>
						                  	<?php if($pdata["param_loc"] == '00B'): ?>Url<?php endif; ?>
						                  </td>
						                  <td>
						                  	<?php if($pdata["must"] == '00A'): ?>是<?php endif; ?>
						                  	<?php if($pdata["must"] == '00B'): ?>否<?php endif; ?>
						                  </td>
						                  <td><?php echo ($pdata["sort"]); ?></td>
						                  <td title="<?php echo ($pdata['discription']); ?>">
							                  <?php  if(60 > strlen($pdata['discription'])) echo $pdata['discription']; else echo msubstr($pdata['discription'],0,60,"utf-8",true); ?>
						                  </td>
						                  <td><?php echo ($pdata["create_time"]); ?></td>
						                  <td>
						                  <div class="btn-group">
												<button data-toggle="dropdown" class="btn btn-mini dropdown-toggle ">
													单项操作<span class="caret"></span>
												</button>
												<ul class="dropdown-menu">
													<li><a href="<?php echo U('interParams' , array('m_id'=>I('m_id') , 'p_id' => I('p_id') , 'paramInId' => $pdata['id'] , 'intId' => $intId , 'type' => 'paramIn')) , '';?>" class="fa fa-edit"> 修改参数</a></li>
													<li class="divider"></li>
													<li><a href="<?php echo U('deleteParam' , array('m_id'=>I('m_id') , 'p_id' => I('p_id') , 'paramInId' => $pdata['id'] , 'intId' => $intId , 'type' => 'paramIn') , '');?>" class="fa fa-indent"> 删除参数</a></li>
												</ul>
											</div>
						                  </td>
						                </tr>
						                <tr style="display: none;" id="json_<?php echo ($pdata["id"]); ?>">
						                  <td>Json描述</td>
						                  <td colspan="7"><?php echo ($pdata["json_discription"]); ?></td>
						                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
					              </tbody>
					            </table>
						</div>

						<div id="paramsOutTab" class="tab-pane <?php if($type == 'paramOut'): ?>active<?php endif; ?>">
							<form class="form-horizontal" method="post" action="/myframework/<?php echo (CONTROLLER_NAME); ?>/paramInOpration" name="paramOut" id="paramIn_validate" novalidate="novalidate">
								<div class="control-group">
					              <label class="control-label">参数名称 :</label>
					              <div class="controls">
					                <input type="text" class="span6" name="paramInName" id="paramInName" placeholder="请输入参数名称（英文，必填）" value="<?php echo ($paramOutData["name"]); ?>"/>
					              </div>
					            </div>
					            <div class="control-group">
					              <label class="control-label">展示排序:</label>
					              <div class="controls">
					                <input type="text" class="span6" name="paramInSort" id="paramInSort" placeholder="请输入展示排序（数字，必填）" value="<?php echo ($paramOutData["sort"]); ?>"/>
					              </div>
					            </div>
					            <div class="control-group">
									<label class="control-label">参数位置：</label>
									<div class="controls">
										<?php if($paramOutId == ''): ?><label class="fl"> <input type="radio" name="paramInLoc" value="00B" checked="checked" />Url</label>
											<label class="fl "> <input type="radio" name="paramInLoc" value="00A"/>Header</label> 
											<?php else: ?>
											<label class="fl"> <input type="radio" name="paramInLoc" value="00B" <?php if($paramOutData["param_loc"] == '00B'): ?>checked="checked"<?php endif; ?> />Url</label>
											<label class="fl "> <input type="radio" name="paramInLoc" value="00A" <?php if($paramOutData["param_loc"] == '00A'): ?>checked="checked"<?php endif; ?>/>Header</label><?php endif; ?>
										
									</div>
					            </div>
					            
					            <div class="control-group">
									<label class="control-label">参数描述:</label>
									<div class="controls">
										<textarea name="discription" id="discription" class="span6" placeholder="请输入参数描述（必填）"><?php echo ($paramOutData["discription"]); ?></textarea>
									</div>
					            </div>
					            <div class="control-group">
									<label class="control-label">参数类型：</label>
									<div class="controls">
										<?php if($paramOutId == ''): ?><label class="fl "> <input type="radio" name="paramInType" value="00A" checked="checked" onclick="removeJsonDiscription('paramOutJsonDisDiv');"/>String</label> 
												<label class="fl"> <input type="radio" name="paramInType" value="00B" onclick="removeJsonDiscription('paramOutJsonDisDiv');" />Number</label>
												<label class="fl"> <input type="radio" name="paramInType" value="00C" onclick="showJsonDiscription('paramOutJsonDisDiv');"/>Json</label>
											<?php else: ?>
												<label class="fl "> <input type="radio" name="paramInType" value="00A" <?php if($paramOutData["param_type"] == '00A'): ?>checked="checked"<?php endif; ?> onclick="removeJsonDiscription('paramOutJsonDisDiv');"/>String</label> 
												<label class="fl"> <input type="radio" name="paramInType" value="00B" <?php if($paramOutData["param_type"] == '00B'): ?>checked="checked"<?php endif; ?> onclick="removeJsonDiscription('paramOutJsonDisDiv');" />Number</label>
												<label class="fl"> <input type="radio" name="paramInType" value="00C" <?php if($paramOutData["param_type"] == '00C'): ?>checked="checked"<?php endif; ?> onclick="showJsonDiscription('paramOutJsonDisDiv');"/>Json</label><?php endif; ?>
									
									</div>
					            </div>
					            <div class="control-group" id="paramOutJsonDisDiv" <?php if($paramOutData["param_type"] != '00C'): ?>style="display: none;"<?php endif; ?>>
									<label class="control-label">Json描述:</label>
									<div class="controls">
										<textarea name="paramInJsonDis" id="paramInJsonDis" class="span6" placeholder="请输入Json描述"><?php echo ($paramOutData["json_discription"]); ?></textarea>
									</div>
					            </div>
					            <div class="control-group">
									<label class="control-label">是否必须：</label>
									<div class="controls">
										<?php if($paramOutId == ''): ?><label class="fl "> <input type="radio" name="paramInMust" value="00A" checked="checked"/>是</label> 
											<label class="fl"> <input type="radio" name="paramInMust" value="00B" />否</label>
											<?php else: ?>
												<label class="fl "> <input type="radio" name="paramInMust" value="00A" <?php if($paramOutData["must"] == '00A'): ?>checked="checked"<?php endif; ?>/>是</label> 
												<label class="fl"> <input type="radio" name="paramInMust" value="00B" <?php if($paramOutData["must"] == '00B'): ?>checked="checked"<?php endif; ?>/>否</label><?php endif; ?>
									</div>
					            </div>
								<input type="hidden" name="m_id" value="<?php echo I('m_id');?>" /> 
								<input type="hidden" name="p_id" value="<?php echo I('p_id');?>" /> 
								<input type="hidden" name="intId" value="<?php echo ($intId); ?>" />
								<input type="hidden" name="type" value="paramOut" />
								<input type="hidden" name="paramId" value="<?php echo ($paramOutId); ?>" />
								<input type="hidden" name="paramDic" value="00B" />
								<div class="form-actions">
									<button type="submit" class="btn btn-success fa fa-save">确定</button>
									<button type="reset" class="btn btn-primary fa fa-edit">重置</button>
									<button type="button" class="btn btn-danger fa fa-reply" onclick="javascript:window.location='/myframework/<?php echo (CONTROLLER_NAME); ?>/viewList/m_id/<?php echo I('m_id');?>/p_id/<?php echo I('p_id');?>'">返回</button>
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
					              	<?php if(is_array($paramDatas['paramOut'])): $i = 0; $__LIST__ = $paramDatas['paramOut'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pdata): $mod = ($i % 2 );++$i;?><tr>
						                  <td><?php echo ($pdata["name"]); ?></td>
						                  <td <?php if($pdata["param_type"] == '00C'): ?>onclick="switchJsonDiscriptionTr('<?php echo ($pdata["id"]); ?>');" style="color:red;"<?php endif; ?>>
						                  	<?php if($pdata["param_type"] == '00A'): ?>String<?php endif; ?>
						                  	<?php if($pdata["param_type"] == '00B'): ?>Number<?php endif; ?>
						                  	<?php if($pdata["param_type"] == '00C'): ?>Json<i class="fa fa-hand-pointer-o" style="margin-left: 10px;"></i><?php endif; ?>
						                  </td>
						                  <td>
						                  	<?php if($pdata["param_loc"] == '00A'): ?>Headr<?php endif; ?>
						                  	<?php if($pdata["param_loc"] == '00B'): ?>Url<?php endif; ?>
						                  </td>
						                  <td>
						                  	<?php if($pdata["must"] == '00A'): ?>是<?php endif; ?>
						                  	<?php if($pdata["must"] == '00B'): ?>否<?php endif; ?>
						                  </td>
						                  <td><?php echo ($pdata["sort"]); ?></td>
						                  <td title="<?php echo ($pdata['discription']); ?>">
							                  <?php  if(60 > strlen($pdata['discription'])) echo $pdata['discription']; else echo msubstr($pdata['discription'],0,60,"utf-8",true); ?>
						                  </td>
						                  <td><?php echo ($pdata["create_time"]); ?></td>
						                  <td>
						                  <div class="btn-group">
												<button data-toggle="dropdown" class="btn btn-mini dropdown-toggle ">
													单项操作<span class="caret"></span>
												</button>
												<ul class="dropdown-menu">
													<li><a href="<?php echo U('interParams' , array('m_id'=>I('m_id') , 'p_id' => I('p_id') , 'paramOutId' => $pdata['id'] , 'intId' => $intId , 'type' => 'paramOut')) , '';?>" class="fa fa-edit"> 修改参数</a></li>
													<li class="divider"></li>
													<li><a href="<?php echo U('deleteParam' , array('m_id'=>I('m_id') , 'p_id' => I('p_id') , 'paramOutId' => $pdata['id'] , 'intId' => $intId , 'type' => 'paramOut') , '');?>" class="fa fa-indent"> 删除参数</a></li>
												</ul>
											</div>
						                  </td>
						                </tr>
						                <tr style="display: none;" id="json_<?php echo ($pdata["id"]); ?>">
						                  <td>Json描述</td>
						                  <td colspan="7"><?php echo ($pdata["json_discription"]); ?></td>
						                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
					              </tbody>
					            </table>
						</div>

						<div id="errorTab" class="tab-pane <?php if($type == 'errorCode'): ?>active<?php endif; ?>">
							<form class="form-horizontal" method="post" action="/myframework/<?php echo (CONTROLLER_NAME); ?>/errorCodeOpration" name="paramOut" id="errorcode_validate" novalidate="novalidate">
								<div class="control-group">
					              <label class="control-label">Code:</label>
					              <div class="controls">
					                <input type="text" class="span6" name="ecName" id="ecName" placeholder="请输入Code（英文，必填）" value="<?php echo ($ecData["code_name"]); ?>"/>
					              </div>
					            </div>
					            <div class="control-group">
					              <label class="control-label">Msg:</label>
					              <div class="controls">
					                <input type="text" class="span6" name="ecMsg" id="ecMsg" placeholder="请输入Msg（英文，必填）" value="<?php echo ($ecData["code_msg"]); ?>"/>
					              </div>
					            </div>
					            <div class="control-group">
					              <label class="control-label">展示排序:</label>
					              <div class="controls">
					                <input type="text" class="span6" name="ecSort" id="ecSort" placeholder="请输入展示排序（数字，必填）" value="<?php echo ($ecData["sort"]); ?>"/>
					              </div>
					            </div>
					            <div class="control-group">
									<label class="control-label">Code描述:</label>
									<div class="controls">
										<textarea name="discription" id="discription" class="span6" placeholder="请输入Code描述（必填）"><?php echo ($ecData["discription"]); ?></textarea>
									</div>
					            </div>
								<input type="hidden" name="m_id" value="<?php echo I('m_id');?>" /> 
								<input type="hidden" name="p_id" value="<?php echo I('p_id');?>" /> 
								<input type="hidden" name="intId" value="<?php echo ($intId); ?>" />
								<input type="hidden" name="type" value="errorCode" />
								<input type="hidden" name="ecId" value="<?php echo ($ecId); ?>" />
								<div class="form-actions">
									<button type="submit" class="btn btn-success fa fa-save">确定</button>
									<button type="reset" class="btn btn-primary fa fa-edit">重置</button>
									<button type="button" class="btn btn-danger fa fa-reply" onclick="javascript:window.location='/myframework/<?php echo (CONTROLLER_NAME); ?>/viewList/m_id/<?php echo I('m_id');?>/p_id/<?php echo I('p_id');?>'">返回</button>
								</div>
								</form>
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
					              	<?php if(is_array($ecDatas)): $i = 0; $__LIST__ = $ecDatas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ecdata): $mod = ($i % 2 );++$i;?><tr>
						                  <td><?php echo ($ecdata["code_name"]); ?></td>
						                  <td title="<?php echo ($ecdata["code_msg"]); ?>">
							                  <?php  if(40 > strlen($ecdata['code_msg'])) echo $ecdata['code_msg']; else echo msubstr($ecdata['code_msg'],0,40,"utf-8",true); ?>
						                  </td>
						                  <td title="<?php echo ($ecdata["discription"]); ?>">
							                  <?php  if(60 > strlen($ecdata['discription'])) echo $ecdata['discription']; else echo msubstr($ecdata['discription'],0,60,"utf-8",true); ?>
						                  </td>
						                  <td><?php echo ($ecdata["sort"]); ?></td>
						                  <td><?php echo ($ecdata["create_time"]); ?></td>
						                  <td>
						                  <div class="btn-group">
												<button data-toggle="dropdown" class="btn btn-mini dropdown-toggle ">
													单项操作<span class="caret"></span>
												</button>
												<ul class="dropdown-menu">
													<li><a href="<?php echo U('interParams' , array('m_id'=>I('m_id') , 'p_id' => I('p_id') , 'ecId' => $ecdata['id'] , 'intId' => $intId , 'type' => 'errorCode')) , '';?>" class="fa fa-edit"> 修改参数</a></li>
													<li class="divider"></li>
													<li><a href="<?php echo U('deleteErrorCode' , array('m_id'=>I('m_id') , 'p_id' => I('p_id') , 'ecId' => $ecdata['id'] , 'intId' => $intId , 'type' => 'errorCode') , '');?>" class="fa fa-indent"> 删除参数</a></li>
												</ul>
											</div>
						                  </td>
						                </tr>
						                <tr style="display: none;" id="json_<?php echo ($pdata["id"]); ?>">
						                  <td>Json描述</td>
						                  <td colspan="7"><?php echo ($pdata["json_discription"]); ?></td>
						                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
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