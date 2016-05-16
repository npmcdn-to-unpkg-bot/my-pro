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
								<td>{$intData.discription}</td>
							</tr>
							<tr>
								<td>调用方法</td>
								<td><if condition="$intData.int_method eq '00A'">GET方法</if> <if
										condition="$intData.int_method eq '00B'">POST方法</if></td>
							</tr>
							<tr>
								<td>所属分类</td>
								<td>{$intData.category_name}</td>
							</tr>
							<tr>
								<td>开发者</td>
								<td>{$intData.author}</td>
							</tr>
							<tr>
								<td>正式地址</td>
								<td>{:C('URL_PREFIX')}{$intData.url}</td>
							</tr>
							<tr>
								<td>测试地址</td>
								<td>{:C('TEST_URL_PREFIX')}{$intData.test_url}</td>
							</tr>
							<tr>
								<td>备注</td>
								<td>{$intData.remark}</td>
							</tr>
							<tr>
								<td>发布时间</td>
								<td>{$intData.create_time}</td>
							</tr>
							<tr>
								<td>修改时间</td>
								<td>{$intData.update_time}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<hr>
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"> <i class="fa fa-exchange"></i>
					</span>
					<h5>传入参数(<?php echo count($params['paramIn']);?>)</h5>
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#headerParam">Header参数</a></li>
						<li><a data-toggle="tab" href="#urlParam">Url参数</a></li>
					</ul>
				</div>
				<div class="widget-content tab-content nopadding">
					<div id="headerParam" class="tab-pane active">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="1%">M</th>
									<th width="10%">名称</th>
									<th width="5%">类型</th>
								</tr>
							</thead>
							<tbody>
								<volist name="params['paramIn']" id='dataIn'> <if
									condition="$dataIn.param_loc eq '00A'">
								<tr>
									<td rowspan="2"><if condition="$dataIn.must eq '00A'"> <span
											class="icon"> <i class="fa fa-star"></i>
										</span> </if> <if condition="$dataIn.must eq '00B'"> <span
											class="icon"> <i class="fa fa-star-o"></i>
										</span> </if></td>
									<td>{$dataIn.name}</td>
									<td><if condition="$dataIn.param_type eq '00A'">String</if> <if
											condition="$dataIn.param_type eq '00B'">Number</if> <if
											condition="$dataIn.param_type eq '00C'">Json</if></td>
								</tr>
								<tr>
									<td colspan="2">{$dataIn.discription}</td>
								</tr>
								</if> </volist>
							</tbody>
						</table>
					</div>

					<div id="urlParam" class="tab-pane">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="1%">M</th>
									<th width="10%">名称</th>
									<th width="5%">类型</th>
								</tr>
							</thead>
							<tbody>
								<volist name="params['paramIn']" id='dataIn'> <if
									condition="$dataIn.param_loc eq '00B'">
								<tr>
									<td rowspan="2"><if condition="$dataIn.must eq '00A'"> <span
											class="icon"> <i class="fa fa-star"></i>
										</span> </if> <if condition="$dataIn.must eq '00B'"> <span
											class="icon"> <i class="fa fa-star-o"></i>
										</span> </if></td>
									<td>{$dataIn.name}</td>
									<td><if condition="$dataIn.param_type eq '00A'">String</if> <if
											condition="$dataIn.param_type eq '00B'">Number</if> <if
											condition="$dataIn.param_type eq '00C'">Json</if></td>
								</tr>
								<tr>
									<td colspan="2">{$dataIn.discription}</td>
								</tr>
								</if> </volist>
							</tbody>
						</table>
					</div>
				</div>
			</div>


			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"> <i class="fa fa-exchange"></i>
					</span>
					<h5>返回参数(<?php echo count($params['paramOut']);?>)</h5>
				</div>
				<div class="widget-content nopadding">
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
							<volist name="params['paramOut']" id='dataIn'>
							<tr>
								<td rowspan="2"><if condition="$dataIn.must eq '00A'"> <span
										class="icon"> <i class="fa fa-star"></i>
									</span> </if> <if condition="$dataIn.must eq '00B'"> <span
										class="icon"> <i class="fa fa-star-o"></i>
									</span> </if></td>
								<td>{$dataIn.name}</td>
								<td><if condition="$dataIn.param_type eq '00A'">String</if> <if
										condition="$dataIn.param_type eq '00B'">Number</if> <if
										condition="$dataIn.param_type eq '00C'">Json</if></td>
								<td><if condition="$dataIn.param_loc eq '00A'">Header参数</if> <if
										condition="$dataIn.param_loc eq '00B'">Url参数</if></td>
							</tr>
							<tr>
								<td colspan="3">{$dataIn.discription}</td>
							</tr>
							</volist>
						</tbody>
					</table>
				</div>
			</div>


			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"> <i class="fa fa-exchange"></i>
					</span>
					<h5>Code(<?php echo count($codes);?>)</h5>
				</div>
				<div class="widget-content nopadding">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="5%">Code</th>
								<th>值</th>
							</tr>
						</thead>
						<tbody>
							<volist name="codes" id="code">
							<tr>
								<td rowspan="2">{$code.code_name}</td>
								<td>Msg:{$code.code_msg}</td>
							</tr>
							<tr>
								<td>描述:{$code.discription}</td>
							</tr>
							</volist>
						</tbody>
					</table>
				</div>
			</div>
			<hr>


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
					<div id="demo_in" class="tab-pane active">{$intData.demo_in}</div>
					<div id="demo_out" class="tab-pane">{$intData.demo_out}</div>
				</div>
			</div>
	<!-- 
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"> <i class="fa fa-exchange"></i>
					</span>
					<h5>模拟调用（模拟调用测试地址）</h5>
				</div>
				<div class="widget-content nopadding">
					<form action="#" method="get" class="form-horizontal">
						<div class="control-group" style="color: red;font-weight: bolder;">
							Header参数
						</div>
						<volist name="params['paramIn']" id="param"> 
							<if condition="$param['param_loc'] eq '00A'">
								<div class="control-group">
									<label class="control-label fl" <if condition="$param.must eq '00A'">style="color: red;font-weight: bolder;"</if>>{$param.name}<if
											condition="$param.must eq '00A'">*</if></label>
									<div class="controls">
										<input type="text" class="span11 testInvoke" placeholder=""
											name="{$param.name}" />
									</div>
								</div>
							</if> 
						</volist>

						<div class="control-group" style="color: red;font-weight: bolder;">
							Url参数
						</div>
						<volist name="params['paramIn']" id="param"> 
							<if condition="$param['param_loc'] eq '00B'">
		
								<div class="control-group">
									<label class="control-label fl">{$param.name}<if
											condition="$param.must eq '00A'">*</if></label>
									<div class="controls">
										<input type="text" class="span11 testInvoke" placeholder=""
											name="{$param.name}" />
									</div>
								</div>
							</if> 
						</volist>
						
						<div class="form-actions">
							<a class="btn btn-success" onclick="testInvoke();">发起请求</a>
						</div>
					</form>
				</div>
			</div>
			-->
		</div>
	</div>
	<hr>
</div>
