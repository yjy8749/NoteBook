<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>杨家勇--谁记录</title>
<base href="<?=base_url()."res/"?>"/>
<link rel="shortcut icon" href="img/favicon.ico" mce_href="img/favicon.ico" type="image/x-icon">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/js.js"></script>
</head>

<body>
<!-- indexbody -->
<div class="indexbody">
	<div class="index1 fl"></div>
	<div class="index2 fl"></div>
	<div class="index3 fl"></div>
	<div class="index4 fl"></div>
    <div class="index5 fl">
		<!-- formbody -->
        <div class="formbody">
        <form action="<?=base_url()?>login" method="post">
        <div class="fform">
        	<img src="img/un.png"><input type="text" name="username" placeholder="<?=$holder?>" >
        </div>
        <div class="fform">
        	<img src="img/pw.png"><input type="password" name="password"placeholder="密码">
        </div>
        <input value="注册" class="register cur" type="button" id="regist">
        <input value="登录" class="logon cur" type="submit">
        </form>
        </div><!-- /formbody -->
     </div>
 	<div class="index6 fl"></div>
  	<div class="cl"></div>
</div><!-- /indexbody -->
<!-- registerbody -->
<div id="reg" class="black_overlay hidden">
	<div class="regbody">
    <p class="msg">请输入以下信息，完成注册。</p>
    <div class="regdiv">
    <form action="<?=base_url()?>register" method="post" id="regform">
    <div class="regrow">
        <label for="user.username">&nbsp;用&nbsp;户&nbsp;名：</label>
        <input type="text" placeholder="字母或数字2~12个字符(必填)" name="username" id="username">
    </div>
    <div class="regrow">
        <label for="password">&nbsp;密&nbsp;&nbsp;&nbsp;&nbsp;码：</label>
        <input type="password" placeholder="数字字符及英文6~12个字符(必填)" name="password1" id="password1">
    </div>
    <div class="regrow">
       <label for="password2">&nbsp;重复密码：</label>
       <input type="password" placeholder="确认密码输入(必填)" name="password2" id="password2">
    </div>
    <div class="regrow">
       <label for="user.name">&nbsp;姓&nbsp;&nbsp;&nbsp;&nbsp;名：</label>
       <input type="text" placeholder="您的姓名,汉字或英文(必填)" name="name" id="name">
    </div>
      <input type="button" value="返回" class="btn1 cur" id="back">
      <input type="submit" value="提交" class="btn2 cur">
   	</form>
    	</div>
    </div>
</div><!-- /register -->
<script type="text/javascript">
var base_url="<?=base_url()?>";
$(function(){
	$("#regist").click(function(){
		$("#reg").fadeIn(1000);
	});
	$("#back").click(function(){
		$("#reg").fadeOut(1000);
	});
     $("#username").blur(function(){
      checkUsername();
     });
    $("#password1").blur(function(){
      checkPassword1();
     });
    $("#password2").blur(function(){
      checkPassword2();
     });
    $("#name").blur(function(){
      checkName();
     });
})
</script>
</body>
</html>
