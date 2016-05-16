<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>
<head>
<title>车维汇后台管理系统 LOGIN</title>
<meta charset="UTF-8" />
<meta name="Designer" content="PremiumPixels.com">
<meta name="Author" content="$hekh@r d-Ziner, CSSJUNTION.com">

<link rel="stylesheet" type="text/css" href="/my-pro/Public/StyleResources/login/reset.css" />
<link rel="stylesheet" type="text/css" href="/my-pro/Public/StyleResources/login/structure.css" />
</head>

<body>
<form class="box login" method="post" action="/my-pro/Admin/Index/adminValidate">
	<fieldset class="boxBody">
	  <label>登录帐号</label>
	  <input type="text" tabindex="1" placeholder="管理员帐号" name="account" required>
	  <label><a href="#" class="rLink" tabindex="5">忘记密码?</a>密码</label>
	  <input type="password" tabindex="2" name="password" required>
	</fieldset>
	<footer>
	  <label><input type="checkbox" tabindex="3">保持登录</label>
	  <input type="submit" class="btnLogin" value="Login" tabindex="4">
	</footer>
</form>
<footer id="main">
<!--   <a href="http://wwww.cssjunction.com">Simple Login Form (HTML5/CSS3 Coded) by CSS Junction</a> | <a href="http://www.premiumpixels.com">PSD by Premium Pixels</a> -->
</footer>
</body>
</html>