function  testUsername(str){
	re=/^[a-zA-Z0-9]{2,12}$/g;
	return re.test(str);
}
function  testPassword(str){
	re=/^[^\u4e00-\u9fa5]{6,12}$/g;
	return re.test(str);
}
function testName(str){
	re=/^[\u4e00-\u9fa5|\w]{1,10}$/g;
	return re.test(str);
}
function setRegMsg(msg,isOk){
	var m=$(".msg");
	if(isOk){
		m.css({"color":"green"});
	}else{
		m.css({"color":"red"});
	}
	m.empty();
	m.append(msg);
}
function checkUsernameIsExist(username){
	$.ajax({
		url: base_url+"register/checkUsernameIsExist",  
		type: 'POST',  
		data:{"username":username},
		timeout: 30000,  
		error: function(){setRegMsg("检查用户名出错,请刷新页面后重试！",false);},  
		success: function(ans){ 
			if(ans!=""&&ans=="ok") {
				setRegMsg("恭喜，该用户名尚无人使用.",true);
			}else{
				setRegMsg("用户名重复请重新输入.",false);
				$("#username").focus();
			}
		}
	});
}
function checkUsername(){
	var g=$("#username");
	var uname=g.val();
	if(uname.length==0){
		return;
	}
	if(!testUsername(uname)){
		setRegMsg("用户名含有非法字符,请使用英文和数字",false);
		g.focus();
		return;
	}
	checkUsernameIsExist(uname);
}
function checkPassword1(){
	var g=$("#password1");
	var pwd1=g.val();
	if(pwd1.length==0){
		return;
	}
	if(pwd1.length<6||pwd1.length>12){
		setRegMsg("密码长度不符合要求",false);
		g.focus();
		return;
	}
	if(!testPassword(pwd1)){
		setRegMsg("请不要在密码中使用汉字",false);
		g.focus();
		return;
	}
	setRegMsg("请再输入一遍密码进行确认",true);
}
function checkPassword2(){
	var g1=$("#password1");
	var g2=$("#password2");
	var pwd1=g1.val();
	var pwd2=g2.val();
	if(pwd1.length==0){
		return;
	}
	if(pwd1!=pwd2){
		setRegMsg("两次输入密码不一致,请重新输入." ,false);
		g2.focus();
		return;
	}
	setRegMsg("请输入你的姓名或昵称.",true);
}
function checkName(){
	var g=$("#name");
	var name=g.val();
	if(name.length==0){
		return;
	}
	if(pwd1.length<1||pwd1.length>10){
		setRegMsg("姓名长度不符合要求",false);
		g.focus();
		return;
	}
	if(!testName(name)){
		setRegMsg("姓名中含有非法字符请使用英文或汉字" ,false);
		g.focus();
		return;
	}
	setRegMsg("信息收集完毕，点击提交进行注册.",true);
}

function addARecord(){
	
}