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
var cathtml=" <div class='cata' id='null'> <img src='img/bz.png'>"+
        "<input type='text'  placeholder='请输入新的目录名' value='' id='cata_name'>"+
        "<input type='hidden' id='id' value=''>"+
        "<img class='cataadd update' src='img/bi.png'>"+
        "<img class='cataadd delete' src='img/cha.png'>"+
        "<img class='cataadd add' src='img/jia.png'>"+
        "</div>";
function selectCata(cata){
     var cata_id=cata.find("#id") .val();
     if(cata_id!="")	{
     	cataid=cata_id;
     	$(".checked").removeClass("checked");
     	cata.addClass("checked");
     }
}
function addCata(){
	if($("#null").html()==null) $(".rows").append(cathtml);
	var newcata=$("#null");
	  newcata.click(function(){
	    selectCata(newcata);
	  });
	  var cname=newcata.find("#cata_name");
	  cname.focus();
	  cname.focusout(function(){
	  	if(cname.val()=="") {
	  		newcata.remove();
	  		return;
	  	}
		 $.ajax({
			url: base_url+"catas/add",  
			type: 'POST',  
			data:{"cata_name":cname.val()},
			timeout: 30000,  
			error: function(){alert("目录出错,请刷新页面后重试！");},  
			success: function(ans){ 
				if(ans!="") {
					newcata.attr('id','cata'+ans);
					newcata.find("#cata_name").attr("readonly",true);
					newcata.find("#id").val(ans);
					newcata.mouseover(function(){
					    cataid=ans;
					   });
					newcata.find(".add").click(function(){
					    addCata();
					  });
					newcata.find(".update").click(function(){
					    updateCata();
					  });
					newcata.find(".delete").click(function(){
					    deleteCata();
					  });
				}else{
					newcata.remove();
				}
			}
		});
	  });
}
function updateCata(){
	var total_cata=$("#cata"+cataid);
	var cname=total_cata.find("#cata_name");
	var cata_name=cname.val();
	cname.attr("readonly",false);
	cname.focus();
	cname.focusout(function(){
	  	if(cname.val()==""||cata_name==cname.val()) {
	  		 cname.val(cata_name);
	  		return;
	  	}
		 $.ajax({
			url: base_url+"catas/update",  
			type: 'POST',  
			data:{"cata_name":cname.val(),"cata_id":cataid},
			timeout: 30000,  
			error: function(){alert("目录出错,请刷新页面后重试！");}
		});
	  });
	cname.attr("readonly",true);
}
function deleteCata(){
		$.ajax({
			url: base_url+"catas/delete",  
			type: 'POST',  
			data:{"cata_id":cataid},
			timeout: 30000,  
			error: function(){alert("目录出错,请刷新页面后重试！");},
			success: function(ans){ 
				$("#cata"+cataid).remove();
			}
		});
}
