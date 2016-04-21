<div class="row-fluid">
	<div class="span12">
		<form action="__ROOT__/{$Think.CONTROLLER_NAME}/auth" method="post"
			name="authForm">
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"> <i class="fa fa-list"></i>
					</span>
					<h5>角色授权</h5>

					<button type="reset" class="btn btn-primary fa fa-edit fr"
						style="margin-top: 5px;">返回</button>
					<button type="submit" class="btn btn-success fa fa-save fr"
						style="margin-top: 5px;">授权</button>
				</div>
				<div class="widget-content">

					<div class="widget-box collapsible">
						<volist name="menu" id="menu">
						<div class="widget-title">
							<a data-toggle="collapse" href="#collapseOne"> <span class="icon"><i
									class="fa fa-arrow-right"></i></span>
								<h5>{$menu.menu_name}</h5>
							</a>
							<div class="checkboxDiv">
								<label> <input type="checkbox" name="MenuRecAuth[]"
									value="{$menu.id}" menu-type="p" menu-id="{$menu.id}"
								
								<if condition="$menu.checked eq 'checked'">checked="checked" </if>/>
								</label>
							</div>
						</div>
						<div id="collapseOne" class="collapse in">
							<div class="widget-content">
								<volist name="menu.submenu" id="sub"> <label> <input
									type="checkbox" name="MenuRecAuth[]" value="{$sub.id}"
									menu-type="s" menu-id="{$sub.id}" p-id="{$menu.id}"
								
								<if condition="$sub.checked eq 'checked'">checked="checked"</if>/>
									{$sub.menu_name}
								</label> </volist>
							</div>
						</div>
						</volist>
					</div>
				</div>
			</div>
			<input type="hidden" name="m_id" value="{:I('m_id')}"/>
			<input type="hidden" name="p_id" value="{:I('p_id')}"/>
			<input type="hidden" name="role_id" value="{:I('role_id')}"/>
		</form>
	</div>
</div>


