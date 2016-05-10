
<div class="widget-box">
	<div class="widget-title bg_lo">
		<span class="icon"> <i class=" fa fa-chevron-down"></i>
		</span>
		<h5>
		<if condition="I('m_id') eq ''">所有接口<else/>{$list[0]['category_name']}</if>
		</h5>
	</div>
	<div class="widget-content  nopadding">
		<volist name='list' id='item'>
			<div class="new-update clearfix">
				<i class="fa fa-exchange"></i>
				<div class="update-done">
					<a title="" href="{:U('interDetails' , array('id' => $item['id']))}">
						<p>
							{$item.name}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						</p>
					</a>
					<span>
						<strong>接口描述</strong>：{$item.discription}
					</span>
					<if condition="$item.remark neq ''">
						<span>
							<strong>备注</strong>：{$item.remark}
						</span>
					</if>
					<span>
					<strong>创建于</strong>:{$item.create_time}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<strong>修改于</strong>:{$item.update_time}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<strong>调用方式</strong>:<if condition="$item.int_method eq '00A'">GET方式<else/>POST方式</if>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<strong>所属分类</strong>:{$item.category_name}
					</span>
					<span onclick="copy_code('{$item.url}');"><strong>生产环境地址</strong>:{:C('URL_PREFIX')}{$item.url}<i class="fa fa-copy"></i></span>
					<span><strong>测试环境地址</strong>:{:C('TEST_URL_PREFIX')}{$item.test_url}<i class="fa fa-copy"></i></span>
				</div>
				<div class="update-date">
					<span class="update-day"><?php echo date("d" , strtotime($item['update_time'])); ?></span>
					<?php echo date("y/m" , strtotime($item['update_time']));?>
					<strong>{$item.author}</strong>
				</div>
			</div>
		</volist>
		
	</div>
</div>
<!-- 分页数据展示 begin -->
<div class="pagination fr">{$pageData}</div>
<!-- 分页数据展示 end -->
<script type="text/javascript">
    function copy_code(copyText) 
    {
        if (window.clipboardData) 
        {
            window.clipboardData.setData("Text", copyText)
        } 
        else 
        {
            var flashcopier = 'flashcopier';
            if(!document.getElementById(flashcopier)) 
            {
              var divholder = document.createElement('div');
              divholder.id = flashcopier;
              document.body.appendChild(divholder);
            }
            document.getElementById(flashcopier).innerHTML = '';
            var divinfo = '<embed src="__FILE_RES__/_clipboard.swf" FlashVars="clipboard='+encodeURIComponent(copyText)+'" width="0" height="0" type="application/x-shockwave-flash"></embed>';
            document.getElementById(flashcopier).innerHTML = divinfo;
        }
      alert('copy成功！');
    }
    </script>

