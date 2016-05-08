<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<title>YY_BG</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta chartset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<script src="/myframework/Public/JsResources/Jquery/jquery.min.js"></script> 
</head>
<body>
<a onclick="login();">testtest</a>
<?php dump(I(''));?>
</body>
<script type="text/javascript">
// $(document).ready(function(){
// 	sleep(5000); // sleep 5 seconds
// 	alert(window.icityLogin);
// })
function icityJsReady(){
	window.icityIsCollectBussiness('ff808081473a1a4401474358942e6936' , '13399461630' , 'BFB81FEFFE66494782EE3B293D138CFF');
// 	window.icityCollectBusiness('ff808081473a1a4401474358942e6936' , '13399461630' , 'BFB81FEFFE66494782EE3B293D138CFF');
}
function login(){
// 	icityLogin();
	alert(window.icityLogin);
}

function icityCollectResult(resCode, resMsg){
	alert("resCode:" + resCode + "resMsg:" + resMsg);
}
function icityIsCollectBussinessResult(resCode, resMsg){
	alert("resCode:" + resCode + "resMsg:" + resMsg);
}
function sleep(sleepTime) {
    for(var start = Date.now(); Date.now() - start <= sleepTime; ) { } 
}

// window.location = 'http://m.189gs.com/login';
</script>
</html>