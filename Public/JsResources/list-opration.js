/**
 * 
 */
$(".search_com").click(function(){
	$(".searchItems").each(function(i,item){
		$("#"+item.id+"_AD").val(item.value);
	});
	
	$("#searchFrom").submit();
});

$("#search_ad").click(function(){
	$("#searchFrom").submit();
});

function deleteItem(type , id)
{
	if(type == 0)
		$("#deleteId").val(id);
	else{
		var url = deleteUrl + "m_id/" + mid + "/p_id/" + pid + "/id/" + $("#deleteId").val();
		window.location = url;
	}
}
function deleteItems(){
	if(0 == $("input:checked[name='checkBoxItems']").size()){
		alert("您未选择任何需要删除的菜单");
		return ;
		}
	
	var url = deleteUrl + "m_id/" + mid + "/p_id/" + pid + "/id/";
	
	$.each($("input:checked[name='checkBoxItems']") , function(i,item){
		if(0 == i)
			url += item['value'];
		else
			url += ","+item['value'];
	});
	window.location = url;
}

//菜单授权checkbox操作
$(":checkbox[name='MenuRecAuth[]']").click(function(){
	//如果点击父菜单，则执行对其所有子菜单的全选/全取消操作
	if('p' == $(this).attr('menu-type')){
		//执行全选操作
		if('checked' == $(this).attr('checked')){
			$(":checkbox[p-id='" +$(this).attr('menu-id')+ "']").each(function(i){
				$(this).parent().addClass("checked");
				$(this).attr("checked" , true);

			});
			$(this).parent().parent().parent().parent().next().attr("class" , "in collapse").css("height","auto");
		}
		//执行取消选中
		else{
			$(":checkbox[p-id='" +$(this).attr('menu-id')+ "']").each(function(i){
				$(this).parent().removeClass("checked");
				$(this).attr("checked" , false);
			});
			$(this).parent().parent().removeClass("disabled");
		}
	}
	//子菜单被点击
	else{
		if('checked' == $(this).attr('checked')){
			$(":checkbox[menu-id='"+$(this).attr('p-id')+"']").attr("checked" , true);
			$(":checkbox[menu-id='"+$(this).attr('p-id')+"']").parent().addClass("checked");
			$(":checkbox[menu-id='"+$(this).attr('p-id')+"']").parent().parent().addClass("disabled");
		}
		else{
			var flag = 0;
			$(":checkbox[p-id='" +$(this).attr('p-id') +"']").each(function(){
				if('checked' == $(this).attr('checked')){
					++flag;
				}
			});
			if(0 == flag){
				$(":checkbox[menu-id='"+$(this).attr('p-id')+"']").attr("checked" , false);
				$(":checkbox[menu-id='"+$(this).attr('p-id')+"']").parent().removeClass("checked");
				$(":checkbox[menu-id='"+$(this).attr('p-id')+"']").parent().parent().removeClass("disabled");
			}
		}
	}
});

