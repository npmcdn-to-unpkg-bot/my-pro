
$(document).ready(function(){
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	
	$('select').select2();
	
	//菜单资源管理表单验证
	$("#menu_validate").validate({
		rules:{
			menu_name:{
				required:true
			},
			pid:{
				required:true
			},
			sort:{
				required:true,
				digits:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('success');
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	//管理员管理表单验证
	$("#admin_validate").validate({
		rules:{
			NAME:{
				required:true,
				chnbyrange:[2,5]
			},
			TEL_PHONE:{
				mobilephone:true
			},
			EMAIL:{
				email:true
			},
			ACCOUNT:{
				required:true,
				rangelength:[6,12],
				accountval:true,
				ajaxunique:[urlHead+"accountUniqeCheck/" , "ACCOUNT" , "帐号"]
			},
			ROLE_ID:{
				roleVal:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('success');
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	//角色管理表单验证
	$("#roles_validate").validate({
		rules:{
			ROLE_NAME:{
				required:true,
				chnbyrange:[2,5],
				ajaxunique:[urlHead+"roleUniqeCheck/" , "ROLE_NAME" , "角色名称"]
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('success');
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
});

/*
 * 自定义验证
 * */
//中文验证（带长度）
jQuery.validator.addMethod(
    "chnbyrange", 
    function(value, element, param) {
        var length = value.length;
        var   pattern = /^([u4e00-u9fa5]|[ufe30-uffa0])*$/gi;   
        if(pattern.test(value))return false;
        for(var i = 0; i < value.length; i++){
            if(value.charCodeAt(i) > 127){
                length++;
            }
        }
        return this.optional(element) || (length/2 >= param[0] && length/2 <= param[1] && length%2 == 0);   
    }, 
    $.validator.format("请输入{0}-{1}个中文字符")
);
//手机号码验证 
jQuery.validator.addMethod(
    "mobilephone", 
    function(value, element) {
    	 return this.optional(element) || /^1[3|4|5|8|7][0-9]\d{8}$/.test(value);
    }, 
    $.validator.format("请输入合法的手机号码")
);
//帐号验证 
jQuery.validator.addMethod(
    "accountval", 
    function(value, element) {
    	 return this.optional(element) ||  /^[a-zA-z]\w{5,11}$/.test(value);
    }, 
    $.validator.format("请输入由字母、数字、下划线组成的帐号（必须以字母开头）")
);
//管理员角色验证
jQuery.validator.addMethod(
    "roleVal", 
    function(value, element) {
    	alert('ss');
    	return false;
    	//return this.optional(element) ||  /^[a-zA-z]\w{5,11}$/.test(value);
    }, 
    $.validator.format("请选择管理员类型")
);

//唯一性校验 
jQuery.validator.addMethod(
    "ajaxunique", 
    function(value, element ,param) {
    	var params = param[1] + "=" + value;
    	var result;
		$.ajax({
			type: "POST",
			dataType:"json",
			url: param[0],
			async:false,                                             //同步方法，如果用异步的话，flag永远为1  
			data: params,
			success: function(msg){
				result = msg['result'];
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				 alert(XMLHttpRequest.status);
				 alert(XMLHttpRequest.readyState);
				 alert(textStatus);
				 result = false;
			}
		});
    	 return this.optional(element) ||  result;
    }, 
    $.validator.format("{2}已经存在")
);
